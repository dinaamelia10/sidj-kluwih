<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DryingMonitor;
use App\Models\MarketPrice;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Petani;
use App\Models\Setting;
use App\Models\ContactMessage;
use App\Models\DryingSession;
use App\Models\Variety;
use App\Services\WhatsAppService;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function index()
    {
        // 1. Ambil data sensor IoT terbaru
        $currentTemperature = $this->getLatestTemperature(0.0);
        $latestData = DryingMonitor::latest()->first();
        $currentMoisture = $latestData ? $latestData->moisture : 0.0;

        // 3. Ambil Sesi Pengeringan Aktif (Timer & Riwayat)
        $activeSession = DryingSession::where('status', 'Berjalan')->latest()->first();
        
        // Cek jika timer aktif sudah habis -> pemicu WA otomatis
        if ($activeSession && $activeSession->remaining_seconds <= 0 && !$activeSession->wa_notified) {
            $activeSession->finishAndNotify();
            $activeSession = null;
        }

        $activeFarmerName = $activeSession ? $activeSession->farmer_name : 'Tidak Ada Antrean Sesi';
        $sessionHistory = DryingSession::latest()->take(5)->get();

        // Logika Batas Pemicu Notifikasi Pembalikan Jagung
        $showNotification = false;
        $notificationMessage = "";
        if ($activeSession && $currentTemperature >= 45.0) {
            $showNotification = true;
            $notificationMessage = "Peringatan: Proses pengeringan sedang berjalan (Suhu Kompor: {$currentTemperature}°C). Segera lakukan pembalikan jagung agar panas merata!";
        }

        // 4. Data Harga Pasar Terakhir
        $latestPriceObj = MarketPrice::latest()->first();
        $marketPrice = $latestPriceObj ? number_format($latestPriceObj->price, 0, ',', '.') : '0';
        $priceUpdatedTime = $latestPriceObj ? $latestPriceObj->created_at->diffForHumans() : 'Belum diperbarui';

        // 5. Total Petani & Total Tonase
        $totalFarmers = User::count();
        $farmersThisWeek = User::where('created_at', '>=', Carbon::now()->startOfWeek())->count();

        $totalTonnage = Transaction::sum('tonnage');
        $totalTonnageFormatted = number_format($totalTonnage, 0, ',', '.');

        // Pertumbuhan Month-over-Month (MoM)
        $tonnageThisMonth = Transaction::whereMonth('created_at', Carbon::now()->month)->sum('tonnage');
        $tonnageLastMonth = Transaction::whereMonth('created_at', Carbon::now()->subMonth()->month)->sum('tonnage');
        $momGrowth = $tonnageLastMonth > 0 ? (($tonnageThisMonth - $tonnageLastMonth) / $tonnageLastMonth) * 100 : 0.0;
        $momGrowthFormatted = ($momGrowth >= 0 ? '+' : '') . number_format($momGrowth, 1, '.', ',') . '% MoM';

        // 6. Data Tabel Transaksi & Chart History Per 30 Menit (Riil Database berdasarkan Sesi)
        $recentTransactions = Transaction::latest()->take(3)->get();
        $targetMoistureSetting = (float) Setting::getVal('kadar_air_target', 15);
        $targetTempSetting = (float) Setting::getVal('suhu_target', 82);
        
        $chartLabels = [];
        $chartMoistureData = [];
        $chartTempData = [];

        $chartSession = $activeSession ?? DryingSession::latest()->first();

        if ($chartSession) {
            $sessStart = $chartSession->start_time->copy();
            
            if ($chartSession->status !== 'Berjalan' && $chartSession->end_time) {
                $sessEnd = $chartSession->end_time->copy();
                $diffMins = max(30, $sessStart->diffInMinutes($sessEnd, true));
                $steps = max(2, (int) ceil($diffMins / 30) + 1);
                $isSessionActive = false;
            } else {
                $targetHours = $chartSession->target_duration_hours;
                $steps = max(2, (int) round($targetHours * 2) + 1);
                $isSessionActive = true;
            }

            $nowMins = $sessStart->diffInMinutes(now(), false);

            for ($i = 0; $i < $steps; $i++) {
                $tickTime = $sessStart->copy()->addMinutes($i * 30);
                $elapsedMins = $sessStart->diffInMinutes($tickTime, false);
                $chartLabels[] = $tickTime->format('H:i');

                // Cari log sensor riil dari DryingMonitor di sekitar rentang waktu 30 menit
                $logNear = DryingMonitor::whereBetween('created_at', [
                    $tickTime->copy()->subMinutes(15),
                    $tickTime->copy()->addMinutes(15)
                ])->latest()->first();

                if ($logNear) {
                    $tp = $logNear->temperature;
                    $m = $logNear->moisture;
                } else {
                    if ($elapsedMins <= 0) {
                        $m = 25.0;
                        $tp = $currentTemperature > 0 ? $currentTemperature : 30.0;
                    } elseif (!$isSessionActive || $elapsedMins >= ($chartSession->target_duration_hours * 60)) {
                        $m = $targetMoistureSetting;
                        $tp = $targetTempSetting;
                    } else {
                        $prop = $elapsedMins / max(1, ($chartSession->target_duration_hours * 60));
                        $m = round(25.0 - ($prop * (25.0 - $targetMoistureSetting)), 1);
                        $tp = min(85.0, round(30.0 + ($prop * ($targetTempSetting - 30.0)), 1));
                    }
                }
                $chartMoistureData[] = $m;
                $chartTempData[] = $tp;
            }
        } else {
            // Data sensor riil 7 log terakhir dari database
            $dbLogs = DryingMonitor::latest()->take(7)->get()->reverse();
            if ($dbLogs->count() > 0) {
                foreach ($dbLogs as $lg) {
                    $chartLabels[] = $lg->created_at->format('H:i');
                    $chartMoistureData[] = $lg->moisture;
                    $chartTempData[] = $lg->temperature;
                }
            } else {
                $now = Carbon::now();
                for ($i = 6; $i >= 0; $i--) {
                    $tickTime = $now->copy()->subMinutes($i * 30);
                    $chartLabels[] = $tickTime->format('H:i');
                    $chartMoistureData[] = round(25.0 - ((6 - $i) * 1.5), 1);
                    $chartTempData[] = 80.0;
                }
            }
        }

        return view('admin.page.dashboard.dashboard', compact(
            'currentTemperature',
            'currentMoisture',
            'activeFarmerName',
            'showNotification',
            'notificationMessage',
            'marketPrice',
            'priceUpdatedTime',
            'totalFarmers',
            'farmersThisWeek',
            'totalTonnageFormatted',
            'momGrowthFormatted',
            'recentTransactions',
            'chartMoistureData',
            'chartTempData',
            'chartLabels',
            'activeSession',
            'sessionHistory'
        ));
    }

    public function login()
    {
        return view('admin.page.auth.login');
    }

    public function forgotPassword()
    {
        return view('admin.page.auth.forgot_password');
    }

    public function pemantauan()
    {
        // 1. Ambil data IoT terbaru dari database
        $currentTemperature = $this->getLatestTemperature(30.0);
        $latestData = DryingMonitor::latest()->first();
        $currentMoisture = $latestData ? $latestData->moisture : 14.0;
        $targetMoistureSetting = (float) Setting::getVal('kadar_air_target', 15);
        $targetTempSetting = (float) Setting::getVal('suhu_target', 82);

        // 2. Ambil Sesi Pengeringan Aktif
        $activeSession = DryingSession::where('status', 'Berjalan')->latest()->first();

        // Cek jika timer aktif sudah habis -> trigger WA otomatis
        if ($activeSession && $activeSession->remaining_seconds <= 0 && !$activeSession->wa_notified) {
            $activeSession->finishAndNotify();
            $activeSession = null;
        }

        if ($activeSession) {
            $timerString = $activeSession->formatted_elapsed;
            $durationInSeconds = $activeSession->elapsed_seconds;
            $progressPercent = $activeSession->progress_percent;
            
            $totalEst = $activeSession->target_seconds;
            if ($durationInSeconds >= $totalEst) {
                $currentMoisture = $targetMoistureSetting;
            } else {
                $currentMoisture = round(25.0 - (($durationInSeconds / max(1, $totalEst)) * (25.0 - $targetMoistureSetting)), 1);
            }
        } else {
            $timerString = "00:00:00";
            $durationInSeconds = 0;
            $progressPercent = 0;
        }

        // 3. Status Mesin & Tampilan UI
        if ($activeSession) {
            $statusMesin = "PENGERINGAN AKTIF";
            $statusClass = "bg-primary text-white";
            $keterangan = "Mesin beroperasi (Target: {$activeSession->formatted_target_hours})";
        } else {
            $statusMesin = "STANDBY";
            $statusClass = "bg-surface-container-high text-on-surface-variant";
            $keterangan = "Mesin siap, silakan klik Mulai Pengeringan";
        }

        // 4. DATA RIWAYAT PENGGUNAAN ALAT / SESI
        $historySessions = DryingSession::latest()->paginate(10);
        $historyData = DryingMonitor::latest()->take(10)->get();

        // 5. GENERATE TITIK GRAFIK & LABELS PER 30 MENIT (MENGUTAMAKAN LOG REKAMAN IOT RIIL DARI SESI TERAKHIR / AKTIF)
        $chartTicks = [];
        $chartSession = $activeSession ?? DryingSession::latest()->first();

        if ($chartSession) {
            $sessStart = $chartSession->start_time->copy();

            if ($chartSession->status !== 'Berjalan' && $chartSession->end_time) {
                $sessEnd = $chartSession->end_time->copy();
                $diffMins = max(30, $sessStart->diffInMinutes($sessEnd, true));
                $steps = max(2, (int) ceil($diffMins / 30) + 1);
                $isSessionActive = false;
            } else {
                $targetHours = $chartSession->target_duration_hours;
                $steps = max(2, (int) round($targetHours * 2) + 1);
                $isSessionActive = true;
            }

            $nowMins = $sessStart->diffInMinutes(now(), false);

            for ($i = 0; $i < $steps; $i++) {
                $tickTime = $sessStart->copy()->addMinutes($i * 30);
                $elapsedMins = $sessStart->diffInMinutes($tickTime, false);

                // Cek apakah ada record sensor riil dari database di sekitar jam tersebut
                $logNear = DryingMonitor::whereBetween('created_at', [
                    $tickTime->copy()->subMinutes(15),
                    $tickTime->copy()->addMinutes(15)
                ])->latest()->first();

                if ($logNear) {
                    $t = $logNear->temperature;
                } else {
                    if ($elapsedMins <= 0) {
                        $t = $currentTemperature > 0 ? $currentTemperature : 30.0;
                    } elseif (!$isSessionActive || $elapsedMins >= ($chartSession->target_duration_hours * 60)) {
                        $t = $targetTempSetting;
                    } else {
                        $prop = $elapsedMins / max(1, ($chartSession->target_duration_hours * 60));
                        $t = min(85.0, round(30.0 + ($prop * ($targetTempSetting - 30.0)), 1));
                    }
                }

                $chartTicks[] = [
                    'time' => $tickTime->format('H:i'),
                    'temp' => $t,
                    'is_past' => !$isSessionActive || ($elapsedMins <= $nowMins)
                ];
            }
        } else {
            // Jika belum pernah ada sesi, ambil data riil sensor dari DryingMonitor
            $dbLogs = DryingMonitor::latest()->take(7)->get()->reverse();
            if ($dbLogs->count() > 0) {
                foreach ($dbLogs as $lg) {
                    $chartTicks[] = [
                        'time' => $lg->created_at->format('H:i'),
                        'temp' => $lg->temperature,
                        'is_past' => true
                    ];
                }
            } else {
                $now = Carbon::now();
                for ($i = 6; $i >= 0; $i--) {
                    $tickTime = $now->copy()->subMinutes($i * 30);
                    $chartTicks[] = [
                        'time' => $tickTime->format('H:i'),
                        'temp' => round(78.0 + (($i % 3) * 2), 1),
                        'is_past' => true
                    ];
                }
            }
        }

        // Hitung koordinat SVG Points
        $totalTicks = count($chartTicks);
        $svgPoints = "";
        if ($totalTicks > 1) {
            $svgPtsArr = [];
            foreach ($chartTicks as $idx => $tk) {
                $x = ($idx / ($totalTicks - 1)) * 1000;
                $y = 300 - min(300, max(0, ($tk['temp'] * 3))); // 100°C => Y: 0px
                $svgPtsArr[] = ($idx == 0 ? "M" : "L") . "{$x},{$y}";
                $chartTicks[$idx]['x'] = round($x, 1);
                $chartTicks[$idx]['y'] = round($y, 1);
            }
            $svgPoints = implode(' ', $svgPtsArr);
        } else {
            $svgPoints = "M0,200 L1000,200";
        }

        return view('admin.page.pemantauan.pemantauan', compact(
            'currentTemperature',
            'timerString',
            'durationInSeconds',
            'progressPercent',
            'currentMoisture',
            'statusMesin',
            'statusClass',
            'keterangan',
            'historyData',
            'svgPoints',
            'activeSession',
            'historySessions',
            'chartTicks'
        ));
    }

    public function clearSensorData()
    {
        DryingMonitor::truncate();
        return response()->json(['status' => 'success', 'message' => 'Data lokal berhasil dibersihkan.']);
    }

    /**
     * Start Sesi Pengeringan Baru (Input Timer)
     */
    public function startDryingSession(Request $request)
    {
        $request->validate([
            'target_duration_hours' => 'required|numeric|min:0.01|max:48',
            'batch_name' => 'nullable|string|max:100',
            'farmer_name' => 'nullable|string|max:100',
        ]);

        // Selesaikan / Batalkan sesi berjalan sebelumnya jika ada
        $running = DryingSession::where('status', 'Berjalan')->get();
        foreach ($running as $oldSession) {
            $oldSession->update([
                'status' => 'Dibatalkan',
                'end_time' => now(),
                'actual_duration_minutes' => (int) round(now()->diffInMinutes($oldSession->start_time, true))
            ]);
        }

        $batchName = $request->batch_name ?: ('Batch #' . rand(100, 999));
        $farmerName = $request->farmer_name ?: 'Mitra Kluwih';

        $session = DryingSession::create([
            'batch_name' => $batchName,
            'farmer_name' => $farmerName,
            'start_time' => now(),
            'target_duration_hours' => (float)$request->target_duration_hours,
            'status' => 'Berjalan',
            'wa_notified' => false,
        ]);

        return redirect()->back()->with('success', "Sesi pengeringan {$batchName} berhasil dimulai! Durasi target: {$session->formatted_target_hours}.");
    }

    /**
     * Stop / Selesaikan Sesi Pengeringan Manual
     */
    public function stopDryingSession(Request $request, DryingSession $session)
    {
        $session->finishAndNotify();
        return redirect()->back()->with('success', "Sesi pengeringan {$session->batch_name} telah dihentikan.");
    }

    /**
     * Endpoint API/AJAX untuk mengecek sisa timer & trigger WA otomatis jika waktu habis
     */
    public function checkDryingTimer()
    {
        $activeSession = DryingSession::where('status', 'Berjalan')->first();

        if (!$activeSession) {
            return response()->json([
                'has_active' => false,
                'message' => 'Tidak ada sesi berjalan'
            ]);
        }

        $remaining = $activeSession->remaining_seconds;
        $isFinished = ($remaining <= 0);

        if ($isFinished && !$activeSession->wa_notified) {
            $activeSession->finishAndNotify();
        }

        return response()->json([
            'has_active' => true,
            'id' => $activeSession->id,
            'batch_name' => $activeSession->batch_name,
            'farmer_name' => $activeSession->farmer_name,
            'target_hours' => $activeSession->formatted_target_hours,
            'elapsed_formatted' => $activeSession->formatted_elapsed,
            'remaining_seconds' => $remaining,
            'progress_percent' => $activeSession->progress_percent,
            'is_finished' => $isFinished,
            'status' => $activeSession->status,
        ]);
    }

    /**
     * Ekspor data monitoring suhu IoT ke file CSV.
     */
    public function exportPemantauan(Request $request)
    {
        $data = DryingMonitor::latest()->take(100)->get();

        $filename = 'log-monitoring-suhu-' . Carbon::now()->format('d-m-Y-His') . '.csv';
        $headers = [
            'Content-Type'        => 'text/csv; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function () use ($data) {
            $file = fopen('php://output', 'w');
            fputs($file, "\xEF\xBB\xBF");
            fputcsv($file, ['No', 'Waktu Recorded', 'Suhu (°C)', 'Kadar Air (%)', 'Status'], ';');
            foreach ($data as $i => $log) {
                $status = $log->temperature > 85.0 ? 'WARNING' : ($log->temperature >= 80.0 ? 'OPTIMAL' : 'WARMING');
                fputcsv($file, [
                    $i + 1,
                    $log->created_at->format('d M Y H:i:s'),
                    $log->temperature,
                    $log->moisture ?? '14.0',
                    $status,
                ], ';');
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
    public function tonaseJagung()
    {
        // 1. HITUNG STATISTIK BENTO CARD (RIIL DATABASE)
        // Tonase Hari Ini & Kemarin (untuk tren)
        $tonnageToday = \App\Models\Transaction::whereDate('created_at', \Carbon\Carbon::today())->sum('tonnage');
        $tonnageYesterday = \App\Models\Transaction::whereDate('created_at', \Carbon\Carbon::yesterday())->sum('tonnage');

        $dailyGrowth = 0.0;
        if ($tonnageYesterday > 0) {
            $dailyGrowth = (($tonnageToday - $tonnageYesterday) / $tonnageYesterday) * 100;
        }

        // Tonase Bulan Ini & Bulan Lalu (untuk tren)
        $tonnageThisMonth = \App\Models\Transaction::whereMonth('created_at', \Carbon\Carbon::now()->month)
            ->whereYear('created_at', \Carbon\Carbon::now()->year)
            ->sum('tonnage');
        $tonnageLastMonth = \App\Models\Transaction::whereMonth('created_at', \Carbon\Carbon::now()->subMonth()->month)
            ->whereYear('created_at', \Carbon\Carbon::now()->subMonth()->year)
            ->sum('tonnage');

        $monthlyGrowth = 0.0;
        if ($tonnageLastMonth > 0) {
            $monthlyGrowth = (($tonnageThisMonth - $tonnageLastMonth) / $tonnageLastMonth) * 100;
        }

        // Tonase Tahun Ini
        $tonnageThisYear = \App\Models\Transaction::whereYear('created_at', \Carbon\Carbon::now()->year)->sum('tonnage');
        $yearlyTarget = (float) Setting::getVal('target_tonase_tahunan', 1500); // Target default sistem pengeringan

        // 2. DATA GRAFIK BATANG MINGGUAN (Senin - Minggu)
        $startOfWeek = \Carbon\Carbon::now()->startOfWeek();
        $weeklyTonnageData = [];
        $daysLabels = ['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min'];

        // Cari volume tertinggi dalam seminggu untuk basis penskalaan tinggi grafik (max 100%)
        $maxWeeklyVolume = 0;
        for ($i = 0; $i < 7; $i++) {
            $date = $startOfWeek->copy()->addDays($i);
            $vol = \App\Models\Transaction::whereDate('created_at', $date)->sum('tonnage');
            $weeklyTonnageData[$i] = $vol;
            if ($vol > $maxWeeklyVolume) {
                $maxWeeklyVolume = $vol;
            }
        }
        $maxWeeklyVolume = $maxWeeklyVolume > 0 ? $maxWeeklyVolume : 1; // cegah division by zero

        // 3. AMBIL DAFTAR TRANSAKSI PAGINASI
        $transactions = \App\Models\Transaction::latest()->paginate(10);

        return view('admin.page.tonase.tonase-jagung', compact(
            'tonnageToday',
            'dailyGrowth',
            'tonnageThisMonth',
            'monthlyGrowth',
            'tonnageThisYear',
            'yearlyTarget',
            'weeklyTonnageData',
            'maxWeeklyVolume',
            'daysLabels',
            'transactions'
        ));
    }
    public function hargaBeli()
    {
        // 1. STATISTIK UTAMA HARGA (OTOMATIS Rp 0 JIKA BELUM ADA INPUT)
        $latestPriceObj = MarketPrice::latest()->first();
        $currentPrice = $latestPriceObj ? $latestPriceObj->price : 0; 
        $updatedAt = $latestPriceObj ? $latestPriceObj->created_at->format('d M Y') : 'Belum ada input harga';

        // Perhitungan selisih tren harian (+/-)
        $previousPriceObj = MarketPrice::latest()->skip(1)->first();
        $priceDiff = 0;
        if ($previousPriceObj && $latestPriceObj) {
            $priceDiff = $currentPrice - $previousPriceObj->price;
        }

        // Rekor Tertinggi & Terendah Bulan Berjalan Ini
        $maxPrice = MarketPrice::whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->max('price') ?? 0;

        $minPrice = MarketPrice::whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->min('price') ?? 0;

        // Persentase indikator bar visual (Skala rentang Rp 6.000, aman jika bernilai 0)
        $maxBarPercent = $maxPrice > 0 ? min(100, round(($maxPrice / 6000) * 100)) : 0;
        $minBarPercent = $minPrice > 0 ? min(100, round(($minPrice / 6000) * 100)) : 0;

        // 2. DATA GRAFIK PERUBAHAN HARGA (5 Data Batang Riil Terakhir)
        $chartPrices = MarketPrice::latest()->take(5)->get()->reverse();
        $highestChartPrice = $chartPrices->max('price') ?? 0;

        // 3. DAFTAR RIWAYAT HARGA PAGINASI RIIL
        $pricesHistory = MarketPrice::latest()->paginate(10);
        
        // 4. DAFTAR VARIETAS DINAMIS
        $varieties = Variety::orderBy('name')->get();

        return view('admin.page.harga_beli.harga_beli', compact(
            'currentPrice',
            'updatedAt',
            'priceDiff',
            'maxPrice',
            'minPrice',
            'maxBarPercent',
            'minBarPercent',
            'chartPrices',
            'highestChartPrice',
            'pricesHistory',
            'varieties'
        ));
    }

    public function storeHarga(Request $request)
    {
        // Validasi seluruh input data dari Pop-up Modal kamu
        $request->validate([
            'variety' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'moisture_standard' => 'required|numeric|min:0|max:100',
            'note' => 'nullable|string'
        ]);

        // Simpan data baru ke database
        MarketPrice::create([
            'variety' => $request->variety,
            'price' => $request->price,
            'moisture_standard' => $request->moisture_standard,
            'note' => $request->note,
        ]);

        return redirect()->route('admin.harga-beli')->with('success', 'Harga beli resmi jagung berhasil diperbarui!');
    }

    public function updateHarga(Request $request, MarketPrice $harga)
    {
        $request->validate([
            'variety' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'moisture_standard' => 'required|numeric|min:0|max:100',
            'note' => 'nullable|string'
        ]);

        $harga->update([
            'variety' => $request->variety,
            'price' => $request->price,
            'moisture_standard' => $request->moisture_standard,
            'note' => $request->note,
        ]);

        return redirect()->route('admin.harga-beli')->with('success', 'Data harga beli berhasil diperbarui!');
    }

    public function destroyHarga(MarketPrice $harga)
    {
        $harga->delete();
        return redirect()->route('admin.harga-beli')->with('success', 'Data harga beli berhasil dihapus!');
    }

    public function storeVariety(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:varieties,name'
        ]);

        Variety::create(['name' => $request->name]);

        return redirect()->route('admin.harga-beli')->with('success', 'Varietas baru berhasil ditambahkan!');
    }

    public function destroyVariety(Variety $variety)
    {
        $variety->delete();
        return redirect()->route('admin.harga-beli')->with('success', 'Varietas berhasil dihapus!');
    }

    public function laporan(Request $request)
    {
        // ── 1. FILTER TANGGAL ────────────────────────────────────────────────
        try {
            $startDate = $request->input('start_date')
                ? Carbon::parse($request->input('start_date'))->startOfDay()
                : Carbon::now()->startOfMonth();
        } catch (\Throwable $e) {
            $startDate = Carbon::now()->startOfMonth();
        }

        try {
            $endDate = $request->input('end_date')
                ? Carbon::parse($request->input('end_date'))->endOfDay()
                : Carbon::now()->endOfMonth();
        } catch (\Throwable $e) {
            $endDate = Carbon::now()->endOfMonth();
        }

        // ── HANDLE EXPORT CSV ──────────────────────────────────────────────────
        if ($request->input('export') === 'csv') {
            $data = Transaction::whereBetween('created_at', [$startDate, $endDate])
                ->latest()->get();

            $filename = 'laporan-' . $startDate->format('d-m-Y') . '-sd-' . $endDate->format('d-m-Y') . '.csv';
            $headers = [
                'Content-Type'        => 'text/csv; charset=UTF-8',
                'Content-Disposition' => 'attachment; filename="' . $filename . '"',
            ];

            $callback = function () use ($data) {
                $file = fopen('php://output', 'w');
                // BOM agar Excel bisa baca UTF-8
                fputs($file, "\xEF\xBB\xBF");
                fputcsv($file, ['No', 'Tanggal', 'Nama Petani', 'Jenis', 'Kategori', 'Berat (Kg)', 'Status', 'Keterangan'], ';');
                foreach ($data as $i => $item) {
                    fputcsv($file, [
                        $i + 1,
                        $item->created_at->format('d M Y'),
                        $item->farmer_name,
                        $item->jenis_laporan,
                        $item->kategori,
                        number_format($item->tonnage, 2, ',', '.'),
                        $item->status,
                        $item->keterangan ?? '-',
                    ], ';');
                }
                fclose($file);
            };

            return response()->stream($callback, 200, $headers);
        }

        // ── HANDLE EXPORT PDF (Print View) ────────────────────────────────────
        if ($request->input('export') === 'pdf') {
            $data = Transaction::whereBetween('created_at', [$startDate, $endDate])
                ->latest()->get();
            $latestPrice = MarketPrice::latest()->first();
            $totalTonase = $data->sum('tonnage');
            return view('admin.page.laporan.laporan_print', compact(
                'data', 'startDate', 'endDate', 'latestPrice', 'totalTonase'
            ));
        }

        // ── 2. SUMMARY CARDS ─────────────────────────────────────────────────
        $totalLaporan = Transaction::whereBetween('created_at', [$startDate, $endDate])->count();
        $lastMonthStart = $startDate->copy()->subMonth()->startOfMonth();
        $lastMonthEnd   = $startDate->copy()->subMonth()->endOfMonth();
        $totalLaporanLastMonth = Transaction::whereBetween('created_at', [$lastMonthStart, $lastMonthEnd])->count();
        $laporanGrowth = $totalLaporanLastMonth > 0
            ? round((($totalLaporan - $totalLaporanLastMonth) / $totalLaporanLastMonth) * 100, 1)
            : 0;

        $totalTonase = Transaction::whereBetween('created_at', [$startDate, $endDate])->sum('tonnage');
        $totalTonaseFormatted = number_format($totalTonase, 0, ',', '.');
        $tonaseLastMonth = Transaction::whereBetween('created_at', [$lastMonthStart, $lastMonthEnd])->sum('tonnage');
        $tonaseLastMonthFormatted = number_format($tonaseLastMonth, 0, ',', '.');

        $avgPrice = MarketPrice::avg('price') ?? 0;
        $avgPriceFormatted = number_format($avgPrice, 0, ',', '.');
        $latestPrice   = MarketPrice::latest()->first();
        $previousPrice = MarketPrice::latest()->skip(1)->first();
        $priceTrend    = 0;
        if ($latestPrice && $previousPrice && $previousPrice->price > 0) {
            $priceTrend = round((($latestPrice->price - $previousPrice->price) / $previousPrice->price) * 100, 1);
        }

        // ── 3. CHART: TONASE BULANAN (6 bulan terakhir) ──────────────────────
        $monthlyTonase = [];
        $monthLabels   = [];
        for ($i = 5; $i >= 0; $i--) {
            $month = Carbon::now()->subMonths($i);
            $monthLabels[]   = $month->translatedFormat('M');
            $monthlyTonase[] = Transaction::whereYear('created_at', $month->year)
                ->whereMonth('created_at', $month->month)
                ->sum('tonnage');
        }
        $maxMonthlyTonase = max($monthlyTonase) > 0 ? max($monthlyTonase) : 1;

        $svgPoints = '';
        for ($i = 0; $i < 6; $i++) {
            $x = ($i / 5) * 800;
            $y = 200 - (($monthlyTonase[$i] / $maxMonthlyTonase) * 180);
            $svgPoints .= ($i === 0 ? "M" : " L") . round($x, 1) . ',' . round($y, 1);
        }

        $thisWeekTonase = Transaction::whereBetween('created_at', [
            Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()
        ])->sum('tonnage');
        $lastWeekTonase = Transaction::whereBetween('created_at', [
            Carbon::now()->subWeek()->startOfWeek(), Carbon::now()->subWeek()->endOfWeek()
        ])->sum('tonnage');
        $weeklyGrowth = $lastWeekTonase > 0
            ? round((($thisWeekTonase - $lastWeekTonase) / $lastWeekTonase) * 100, 1)
            : 0;

        $monthlyTarget   = (float) Setting::getVal('target_tonase_bulanan', 500);
        $monthlyProgress = min(100, $monthlyTarget > 0 ? round(($totalTonase / $monthlyTarget) * 100) : 0);

        // ── 4. TABEL RIWAYAT ─────────────────────────────────────────────────
        $laporan = Transaction::whereBetween('created_at', [$startDate, $endDate])
            ->latest()
            ->paginate(10)
            ->withQueryString();

        // ── 5. PREVIEW MODAL ──────────────────────────────────────────────────
        $previewTonase = Transaction::where('status', 'Selesai')
            ->whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->sum('tonnage');

        $latestPriceVal   = $latestPrice ? $latestPrice->price : 0;
        $previousPriceVal = $previousPrice ? $previousPrice->price : 0;
        $priceFluktuasi   = $latestPriceVal - $previousPriceVal;

        $totalBulanIni   = Transaction::whereMonth('created_at', Carbon::now()->month)->count();
        $selesaiBulanIni = Transaction::where('status', 'Selesai')
            ->whereMonth('created_at', Carbon::now()->month)->count();
        $progressSelesai = $totalBulanIni > 0 ? round(($selesaiBulanIni / $totalBulanIni) * 100) : 0;

        $petaniList = Petani::orderBy('nama')->get();

        return view('admin.page.laporan.laporan', compact(
            'startDate', 'endDate', 'totalLaporan', 'laporanGrowth',
            'totalTonaseFormatted', 'tonaseLastMonthFormatted',
            'avgPriceFormatted', 'priceTrend',
            'monthLabels', 'monthlyTonase', 'maxMonthlyTonase', 'svgPoints',
            'weeklyGrowth', 'monthlyProgress', 'monthlyTarget', 'laporan',
            'previewTonase', 'priceFluktuasi', 'progressSelesai', 'petaniList'
        ));
    }

    /**
     * Unduh / Cetak Bukti Laporan Transaksi tunggal dalam format Dokumen PDF Cetak.
     */
    public function downloadLaporan(Transaction $transaction)
    {
        $latestPrice = MarketPrice::latest()->first();
        $pricePerKg  = $latestPrice ? $latestPrice->price : 0;
        $totalNilai  = $transaction->tonnage * $pricePerKg; // tonnage is now in kg

        return view('admin.page.laporan.laporan_single_print', compact(
            'transaction',
            'latestPrice',
            'pricePerKg',
            'totalNilai'
        ));
    }

    public function storeLaporan(Request $request)
    {
        $request->validate([
            'farmer_name'     => 'required|string|max:255',
            'tonnage'         => 'required|numeric|min:0',
            'jenis_laporan'   => 'required|string',
            'kategori'        => 'required|string',
            'tanggal_mulai'   => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'keterangan'      => 'nullable|string',
        ]);

        Transaction::create([
            'farmer_name'     => $request->farmer_name,
            'tonnage'         => $request->tonnage,
            'status'          => 'Proses',
            'jenis_laporan'   => $request->jenis_laporan,
            'kategori'        => $request->kategori,
            'tanggal_mulai'   => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'keterangan'      => $request->keterangan,
        ]);

        return redirect()->route('admin.laporan')
            ->with('success', 'Laporan baru berhasil dibuat!');
    }
    public function pengguna(Request $request)
    {
        // ── Statistik berdasarkan data Petani ──
        $totalPetani       = Petani::count();
        $petaniLastMonth   = Petani::whereMonth('created_at', Carbon::now()->subMonth()->month)
            ->whereYear('created_at', Carbon::now()->subMonth()->year)->count();
        $penggunaGrowth    = $petaniLastMonth > 0
            ? round((($totalPetani - $petaniLastMonth) / $petaniLastMonth) * 100, 1) : 0;

        $petaniBulanIni    = Petani::whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)->count();
        $aktivitasPercent  = $totalPetani > 0 ? round(($petaniBulanIni / $totalPetani) * 100, 1) : 0;

        $petaniTerbaru     = Petani::latest()->first();

        // ── Tabel dengan Search & Pagination ──
        $search = $request->input('search');
        $pengguna = Petani::when($search, function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                  ->orWhere('wilayah', 'like', "%{$search}%")
                  ->orWhere('komoditas', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.page.pengguna.pengguna', compact(
            'totalPetani',
            'penggunaGrowth',
            'petaniBulanIni',
            'aktivitasPercent',
            'petaniTerbaru',
            'pengguna',
            'search'
        ));
    }

    public function storePengguna(Request $request)
    {
        $request->validate([
            'nama'        => 'required|string|max:255',
            'no_telp'     => 'nullable|string|max:20',
            'alamat'      => 'nullable|string',
            'wilayah'     => 'nullable|string|max:100',
            'luas_lahan'  => 'nullable|numeric|min:0',
            'komoditas'   => 'required|string',
            'status'      => 'required|string',
        ]);

        Petani::create([
            'nama'       => $request->nama,
            'no_telp'    => $request->no_telp,
            'alamat'     => $request->alamat,
            'wilayah'    => $request->wilayah,
            'luas_lahan' => $request->luas_lahan,
            'komoditas'  => $request->komoditas,
            'status'     => $request->status,
        ]);

        return redirect()->route('admin.pengguna')
            ->with('success', 'Data petani berhasil ditambahkan!');
    }

    public function updatePengguna(Request $request, Petani $petani)
    {
        $request->validate([
            'nama'        => 'required|string|max:255',
            'no_telp'     => 'nullable|string|max:20',
            'alamat'      => 'nullable|string',
            'wilayah'     => 'nullable|string|max:100',
            'luas_lahan'  => 'nullable|numeric|min:0',
            'komoditas'   => 'required|string',
            'status'      => 'required|string',
        ]);

        $petani->update([
            'nama'       => $request->nama,
            'no_telp'    => $request->no_telp,
            'alamat'     => $request->alamat,
            'wilayah'    => $request->wilayah,
            'luas_lahan' => $request->luas_lahan,
            'komoditas'  => $request->komoditas,
            'status'     => $request->status,
        ]);

        return redirect()->route('admin.pengguna')
            ->with('success', 'Data petani ' . $petani->nama . ' berhasil diperbarui!');
    }

    public function destroyPengguna(Petani $petani)
    {
        $petani->delete();
        return redirect()->route('admin.pengguna')
            ->with('success', 'Data petani berhasil dihapus.');
    }
    public function pengaturan()
    {
        $settingsRaw = Setting::all();
        $settings = [];
        foreach ($settingsRaw as $s) {
            $settings[$s->key] = $s->value;
        }

        return view('admin.page.pengaturan.pengaturan', compact('settings'));
    }

    public function updatePengaturan(Request $request)
    {
        $data = $request->except(['_token', '_method']);

        foreach ($data as $key => $value) {
            // Gunakan updateOrCreate agar key baru otomatis dibuat jika belum ada di DB
            Setting::updateOrCreate(['key' => $key], ['value' => $value]);
        }

        // Handle toggle switches explicitly (because unchecked toggles aren't sent in the request)
        $toggles = ['wa_enabled', 'notif_balik', 'notif_selesai', 'notif_jamur', 'notif_suhu_tinggi', 'notif_kirim_ke_petani'];
        foreach ($toggles as $toggle) {
            if (!$request->has($toggle)) {
                Setting::where('key', $toggle)->update(['value' => '0']);
            }
        }

        return redirect()->route('admin.pengaturan')
            ->with('success', 'Pengaturan berhasil diperbarui!');
    }
    public function addTonase()
    {
        // Load daftar petani dari database agar dropdown terisi data nyata
        $petaniList = Petani::orderBy('nama')->get();
        return view('admin.page.tonase.add_tonase', compact('petaniList'));
    }

    /**
     * Simpan data tonase baru ke database.
     */
    public function storeTonase(Request $request)
    {
        $request->validate([
            'farmer_name'      => 'required|string|max:255',
            'tonnage'          => 'required|numeric|min:0',
            'tanggal_mulai'    => 'required|date',
        ], [
            'farmer_name.required' => 'Nama petani wajib diisi.',
            'tonnage.required'     => 'Berat tonase wajib diisi.',
            'tanggal_mulai.required' => 'Tanggal setoran wajib diisi.',
        ]);

        Transaction::create([
            'farmer_name'     => $request->farmer_name,
            'tonnage'         => $request->tonnage,
            'status'          => 'Proses',
            'jenis_laporan'   => 'Harian',
            'kategori'        => 'Tonase Jagung',
            'tanggal_mulai'   => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_mulai, // default sama, bisa diupdate nanti
            'keterangan'      => $request->keterangan,
        ]);

        return redirect()->route('admin.tonase-jagung')
            ->with('success', 'Data tonase jagung berhasil ditambahkan!');
    }

    /**
     * Hapus data transaksi tonase.
     */
    public function destroyTransaction(Transaction $transaction)
    {
        $transaction->delete();
        return redirect()->route('admin.tonase-jagung')
            ->with('success', 'Data transaksi berhasil dihapus.');
    }

    /**
     * Update status transaksi: Proses → Selesai (atau sebaliknya).
     */
    public function updateTransactionStatus(Request $request, Transaction $transaction)
    {
        $request->validate(['status' => 'required|in:Proses,Selesai']);
        $transaction->update(['status' => $request->status]);

        return redirect()->route('admin.tonase-jagung')
            ->with('success', 'Status transaksi berhasil diperbarui menjadi "' . $request->status . '".');
    }

    // Ubah fungsi addHarga menjadi auto-redirect ke halaman utama harga beli
    public function addHarga()
    {
        return redirect()->route('admin.harga-beli');
    }

    /**
     * Logout — hapus session dan redirect ke login.
     */
    public function logout(Request $request)
    {
        \Illuminate\Support\Facades\Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('admin.login');
    }

    // ==========================================
    // PESAN KONTAK MASUK DARI PENGUNJUNG
    // ==========================================

    /**
     * Tampilkan semua pesan kontak yang masuk dari pengunjung.
     */
    public function pesan(Request $request)
    {
        $search = $request->input('search');
        $filter = $request->input('filter', 'all'); // all | unread | read

        $query = ContactMessage::latest();
        if ($filter === 'unread') $query->where('is_read', false);
        if ($filter === 'read')   $query->where('is_read', true);
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('subject', 'like', "%{$search}%")
                  ->orWhere('message', 'like', "%{$search}%");
            });
        }

        $messages     = $query->paginate(15)->withQueryString();
        $totalUnread  = ContactMessage::where('is_read', false)->count();
        $totalMessages = ContactMessage::count();

        return view('admin.page.pesan.pesan', compact(
            'messages', 'totalUnread', 'totalMessages', 'search', 'filter'
        ));
    }

    /**
     * Tandai pesan sebagai sudah dibaca dan tampilkan detailnya.
     */
    public function showPesan(ContactMessage $message)
    {
        $message->update(['is_read' => true]);
        return redirect()->route('admin.pesan')->with('viewMessage', $message->id);
    }

    /**
     * Hapus pesan kontak.
     */
    public function destroyPesan(ContactMessage $message)
    {
        $message->delete();
        return redirect()->route('admin.pesan')->with('success', 'Pesan berhasil dihapus.');
    }

    // ==========================================
    // MANAJEMEN PROFIL & AKUN
    // ==========================================

    public function profil()
    {
        // Karena sistem autentikasi asli sedang disimulasikan di awal,
        // ambil user pertama dari DB atau gunakan data dummy jika auth()->user() null
        $user = auth()->user() ?? \App\Models\User::first() ?? (object)[
            'name' => 'Admin Kluwih',
            'username' => 'admin',
            'email' => 'admin@kluwih.com'
        ];

        return view('admin.page.profil.profil', compact('user'));
    }

    public function updateProfil(\Illuminate\Http\Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'email' => 'required|email|max:255',
        ]);

        $user = auth()->user();
        
        // Jika ada sistem otentikasi login asli
        if ($user) {
            // Karena $user adalah Model, kita bisa memanggil ->update()
            $user->update([
                'name' => $request->name,
                'username' => $request->username,
                'email' => $request->email,
            ]);
        } else {
            // Fallback untuk DB User pertama (apabila login disimulasikan)
            $dbUser = \App\Models\User::first();
            if ($dbUser) {
                $dbUser->update([
                    'name' => $request->name,
                    'username' => $request->username,
                    'email' => $request->email,
                ]);
            }
        }

        return redirect()->route('admin.profil')->with('success', 'Profil berhasil diperbarui!');
    }

    public function updatePassword(\Illuminate\Http\Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ], [
            'new_password.confirmed' => 'Konfirmasi password baru tidak cocok.',
            'new_password.min' => 'Password baru minimal harus 8 karakter.'
        ]);

        $user = auth()->user() ?? \App\Models\User::first();

        // Validasi password lama
        if (!\Illuminate\Support\Facades\Hash::check($request->current_password, $user->password)) {
            return back()->with('error', 'Password lama tidak sesuai!');
        }

        // Update ke password baru
        if ($user instanceof \App\Models\User) {
            $user->update([
                'password' => \Illuminate\Support\Facades\Hash::make($request->new_password)
            ]);
        }

        return back()->with('success', 'Password berhasil diubah!');
    }

    /**
     * API Search Global (Pencarian real-time header)
     */
    public function globalSearch(Request $request)
    {
        $query = trim($request->input('q'));
        if (empty($query) || strlen($query) < 2) {
            return response()->json([
                'petani'       => [],
                'transactions' => [],
                'prices'       => [],
                'messages'     => []
            ]);
        }

        $petani = Petani::where('nama', 'like', "%{$query}%")
            ->orWhere('wilayah', 'like', "%{$query}%")
            ->orWhere('komoditas', 'like', "%{$query}%")
            ->take(5)->get(['id', 'nama', 'wilayah', 'komoditas']);

        $transactions = Transaction::where('farmer_name', 'like', "%{$query}%")
            ->orWhere('jenis_laporan', 'like', "%{$query}%")
            ->orWhere('kategori', 'like', "%{$query}%")
            ->take(5)->get(['id', 'farmer_name', 'tonnage', 'status']);

        $prices = MarketPrice::where('variety', 'like', "%{$query}%")
            ->take(5)->get(['id', 'variety', 'price']);

        $messages = ContactMessage::where('name', 'like', "%{$query}%")
            ->orWhere('subject', 'like', "%{$query}%")
            ->orWhere('message', 'like', "%{$query}%")
            ->take(5)->get(['id', 'name', 'subject']);

        return response()->json([
            'petani'       => $petani,
            'transactions' => $transactions,
            'prices'       => $prices,
            'messages'     => $messages
        ]);
    }

    /**
     * Ambil suhu terbaru secara real-time dari Firebase REST API
     * atau fallback ke database lokal jika offline.
     */
    private function getLatestTemperature($fallback = 30.0)
    {
        try {
            $response = \Illuminate\Support\Facades\Http::withoutVerifying()
                ->timeout(1.5)
                ->get('https://dryerjagung-63ad6-default-rtdb.asia-southeast1.firebasedatabase.app/Suhu_Mesin/Atas.json');

            if ($response->successful()) {
                $data = $response->json();
                if (is_array($data) && count($data) > 0) {
                    return (float) end($data);
                }
            }
        } catch (\Exception $e) {
            // Abaikan jika terjadi kesalahan jaringan
        }

        $latestLocal = DryingMonitor::latest()->first();
        if ($latestLocal) {
            return (float) $latestLocal->temperature;
        }

        return $fallback;
    }
}
