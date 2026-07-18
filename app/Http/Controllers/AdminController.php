<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DryingMonitor;
use App\Models\MarketPrice;
use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function index()
    {
        // 1. Ambil data sensor IoT terbaru
        $latestData = DryingMonitor::latest()->first();
        $currentTemperature = $latestData ? $latestData->temperature : 0.0;
        $currentMoisture = $latestData ? $latestData->moisture : 0.0;

        // Logika Batas Pemicu Notifikasi Pembalikan Jagung
        $showNotification = false;
        $notificationMessage = "";
        if ($currentTemperature >= 45.0 || $currentMoisture >= 18.0) {
            $showNotification = true;
            $notificationMessage = "Peringatan: Kondisi pengeringan kritis (Suhu: {$currentTemperature}°C, Kadar Air: {$currentMoisture}%). Segera lakukan pembalikan jagung agar merata!";
        }

        // 2. Logika Hitung Kecepatan Kipas Dinamis Berdasarkan Suhu
        // Makin panas suhu pengeringan, RPM kipas otomatis naik
        if ($currentTemperature >= 45.0) {
            $currentFanSpeed = "1.5k RPM";
        } elseif ($currentTemperature >= 35.0) {
            $currentFanSpeed = "1.2k RPM";
        } else {
            $currentFanSpeed = "0.8k RPM";
        }

        // 3. Ambil Nama Petani Aktif yang Sedang Mengeringkan Jagung (Status: Proses)
        $activeBatch = Transaction::where('status', 'Proses')->latest()->first();
        $activeFarmerName = $activeBatch ? $activeBatch->farmer_name : 'Tidak Ada Antrean';

        // 4. Data Harga Pasar Terakhir
        $latestPriceObj = MarketPrice::latest()->first();
        $marketPrice = $latestPriceObj ? number_format($latestPriceObj->price, 0, ',', '.') : '0';
        $priceUpdatedTime = $latestPriceObj ? $latestPriceObj->created_at->diffForHumans() : 'Belum diperbarui';

        // 5. Total Petani & Total Tonase
        $totalFarmers = User::count();
        $farmersThisWeek = User::where('created_at', '>=', Carbon::now()->startOfWeek())->count();

        $totalTonnage = Transaction::sum('tonnage');
        $totalTonnageFormatted = number_format($totalTonnage, 1, '.', ',');

        // Pertumbuhan Month-over-Month (MoM)
        $tonnageThisMonth = Transaction::whereMonth('created_at', Carbon::now()->month)->sum('tonnage');
        $tonnageLastMonth = Transaction::whereMonth('created_at', Carbon::now()->subMonth()->month)->sum('tonnage');
        $momGrowth = $tonnageLastMonth > 0 ? (($tonnageThisMonth - $tonnageLastMonth) / $tonnageLastMonth) * 100 : 0.0;
        $momGrowthFormatted = ($momGrowth >= 0 ? '+' : '') . number_format($momGrowth, 1, '.', ',') . '% MoM';

        // 6. Data Tabel Transaksi & Chart History
        $recentTransactions = Transaction::latest()->take(3)->get();
        $chartHistory = DryingMonitor::latest()->take(6)->get()->reverse();
        $chartMoistureData = $chartHistory->pluck('moisture')->toArray();
        $chartLabels = $chartHistory->map(function ($data) {
            return $data->created_at->format('H:i');
        })->toArray();

        if (empty($chartMoistureData)) {
            $chartMoistureData = [32, 24, 18, 14, 13, 12];
            $chartLabels = ['Batch A', 'Batch B', 'Batch C', 'Batch D', 'Batch E', 'Batch F'];
        }

        return view('admin.page.dashboard.dashboard', compact(
            'currentTemperature',
            'currentMoisture',
            'currentFanSpeed',
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
            'chartLabels'
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
        // 1. Ambil data IoT terbaru dari Yesaya
        $latestData = DryingMonitor::latest()->first();

        $currentTemperature = $latestData ? $latestData->temperature : 30.0; // fallback jika kosong
        $startTime = $latestData ? $latestData->created_at : Carbon::now();

        // 2. Hitung Durasi Berjalan (dalam detik)
        $durationInSeconds = Carbon::now()->diffInSeconds($startTime);

        // Memastikan pembagian angka bulat agar tidak menghasilkan angka pecahan/desimal
        $h = floor($durationInSeconds / 3600);
        $m = floor(($durationInSeconds % 3600) / 60);
        $s = $durationInSeconds % 60;

        // Format bersih: HH:MM:SS (Contoh: 00:17:25)
        $timerString = sprintf('%02d:%02d:%02d', $h, $m, $s);

        // 3. RUMUS SIMULASI KADAR AIR (Moisture) & PROGRES (%)
        // Asumsi: Proses pengeringan jagung ideal butuh waktu sekitar 3 jam (10800 detik)
        // Kadar air awal = 25%, Target = 14% (Selisih penurunan = 11%)
        $totalEstimatedTime = 10800;

        if ($durationInSeconds >= $totalEstimatedTime) {
            $progressPercent = 100;
            $currentMoisture = 14.0;
        } else {
            // Progres naik seiring waktu berjalan
            $progressPercent = round(($durationInSeconds / $totalEstimatedTime) * 100);

            // Rumus Penurunan Kadar Air: Awal - (Proporsi Waktu * Selisih Target)
            $currentMoisture = round(25.0 - (($durationInSeconds / $totalEstimatedTime) * 11), 1);
        }

        // 4. LOGIKA STATUS MESIN & NOTIFIKASI BERDASARKAN ATURAN SUHU
        $statusMesin = "WARMING";
        $statusClass = "bg-tertiary-fixed text-on-tertiary-fixed"; // Kuning/Amber
        $keterangan = "Proses kenaikan suhu dryer";

        if ($currentTemperature >= 80.0 && $currentTemperature <= 85.0) {
            $statusMesin = "OPTIMAL";
            $statusClass = "bg-secondary-container text-on-secondary-container"; // Hijau
            $keterangan = "Suhu stabil terkendali";
        } elseif ($currentTemperature > 85.0) {
            $statusMesin = "WARNING";
            $statusClass = "bg-error-container text-on-error-container"; // Merah
            $keterangan = "Suhu melebihi batas! Perkecil pengapian";
        } elseif ($progressPercent == 100) {
            $statusMesin = "SELESAI";
            $statusClass = "bg-secondary-container text-on-secondary-container";
            $keterangan = "Jagung sudah kering sempurna";
        }

        // 5. DATA UNTUK GRAFIK & TABEL RIWAYAT
        // Ambil 10 data riwayat sensor terakhir
        $historyData = DryingMonitor::latest()->take(10)->get();

        // Format data koordinat untuk SVG Chart (Skala lebar 1000, tinggi 300)
        // Memetakan suhu (0°C - 100°C) ke dalam tinggi SVG (300px - 0px)
        $svgPoints = "";
        $chartHistory = $historyData->reverse();
        $totalPoints = $chartHistory->count();

        if ($totalPoints > 1) {
            $index = 0;
            foreach ($chartHistory as $data) {
                $x = ($index / ($totalPoints - 1)) * 1000;
                // Rumus mapping Y: 300 - (Suhu * 3) -> karena max suhu 100°C muat di 300px
                $y = 300 - ($data->temperature * 3);
                $svgPoints .= ($index == 0 ? "M" : " L") . "{$x},{$y}";
                $index++;
            }
        } else {
            // Garis lurus standar jika data masih sangat sedikit
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
            'svgPoints'
        ));
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
        $yearlyTarget = 1500; // Target default sistem pengeringan

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
            'pricesHistory'
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
    public function laporan()
    {
        return view('admin.page.laporan.laporan');
    }
    public function pengguna()
    {
        return view('admin.page.pengguna.pengguna');
    }
    public function pengaturan()
    {
        return view('admin.page.pengaturan.pengaturan');
    }
    public function addTonase()
    {
        return view('admin.page.tonase.add_tonase');
    }
    // 1. Method untuk menampilkan halaman form tambah harga
    // Ubah fungsi addHarga menjadi auto-redirect ke halaman utama harga beli
    public function addHarga()
    {
        return redirect()->route('admin.harga-beli');
    }
    public function logout()
    {
        return view('admin.page.auth.login');
    }
}
