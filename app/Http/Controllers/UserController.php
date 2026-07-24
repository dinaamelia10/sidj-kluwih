<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MarketPrice;
use App\Models\Transaction;
use App\Models\Petani;
use App\Models\ContactMessage;
use App\Models\DryingMonitor;
use App\Models\DryingSession;
use App\Models\Setting;
use Carbon\Carbon;

class UserController extends Controller
{
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
        return $fallback;
    }

    public function beranda()
    {
        // Harga pasar terbaru untuk ditampilkan di halaman publik
        $latestPrice = MarketPrice::latest()->first();
        $marketPrice = $latestPrice ? number_format($latestPrice->price, 0, ',', '.') : '0';

        // Statistik publik
        $totalPetani   = Petani::count();
        $totalTonnage  = Transaction::where('status', 'Selesai')->sum('tonnage');

        // 1. Ambil data IoT terbaru
        $currentTemperature = $this->getLatestTemperature(30.0);
        $latestData = DryingMonitor::latest()->first();
        $currentMoisture = $latestData ? $latestData->moisture : 14.0;
        $targetMoistureSetting = (float) Setting::getVal('kadar_air_target', 15);

        // 2. Sesi Aktif
        $activeSession = DryingSession::where('status', 'Berjalan')->latest()->first();
        
        $activeTonnage = 0;
        $activeBatchName = 'Tidak ada sesi';

        if ($activeSession) {
            $activeBatchName = $activeSession->batch_name;
            
            // Hitung estimasi kadar air
            $durationInSeconds = $activeSession->elapsed_seconds;
            $totalEst = $activeSession->target_seconds;
            if ($durationInSeconds >= $totalEst) {
                $currentMoisture = $targetMoistureSetting;
            } else {
                $currentMoisture = round(25.0 - (($durationInSeconds / max(1, $totalEst)) * (25.0 - $targetMoistureSetting)), 1);
            }
            
            // Cari tonase dari transaksi aktif milik petani tersebut
            $matchingTrx = Transaction::where('farmer_name', $activeSession->farmer_name)
                ->where('status', '!=', 'Selesai')
                ->latest()
                ->first();
            
            if ($matchingTrx) {
                $activeTonnage = $matchingTrx->tonnage;
            } else {
                // Fallback ke transaksi terakhir petani tersebut
                $lastTrx = Transaction::where('farmer_name', $activeSession->farmer_name)
                    ->latest()
                    ->first();
                $activeTonnage = $lastTrx ? $lastTrx->tonnage : 0;
            }
        }

        return view('user.pages.beranda.beranda', compact(
            'marketPrice',
            'totalPetani',
            'totalTonnage',
            'currentTemperature',
            'currentMoisture',
            'activeSession',
            'activeTonnage',
            'activeBatchName'
        ));
    }

    public function tentang()
    {
        return view('user.pages.tentang.tentang_kami');
    }

    public function data_jagung(Request $request)
    {
        $search = $request->input('search');

        // Statistik publik
        $tonnageToday = Transaction::whereDate('created_at', Carbon::today())->sum('tonnage');

        // Data tabel transaksi yang sudah selesai (dianonymisasi)
        $query = Transaction::where('status', 'Selesai');

        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('farmer_name', 'like', '%' . $search . '%')
                  ->orWhere('keterangan', 'like', '%' . $search . '%')
                  ->orWhereIn('farmer_name', function ($sub) use ($search) {
                      $sub->select('farmer_name')
                          ->from('drying_sessions')
                          ->where('batch_name', 'like', '%' . $search . '%');
                  });
            });
        }

        $transactions = $query->latest()
            ->take(10)
            ->get();

        // Harga terkini
        $latestPrice = MarketPrice::latest()->first();
        $marketPrice = $latestPrice ? number_format($latestPrice->price, 0, ',', '.') : '0';
        $marketVariety = $latestPrice ? $latestPrice->variety : 'Standard';

        // Data grafik 6 bulan terakhir (tonase)
        $monthlyData = [];
        $monthLabels = [];
        $maxMonthly  = 0;
        for ($i = 5; $i >= 0; $i--) {
            $month = Carbon::now()->subMonths($i);
            $val   = Transaction::whereYear('created_at', $month->year)
                ->whereMonth('created_at', $month->month)
                ->sum('tonnage');
            $monthlyData[] = $val;
            $monthLabels[] = $month->translatedFormat('M');
            if ($val > $maxMonthly) $maxMonthly = $val;
        }
        $maxMonthly = $maxMonthly > 0 ? $maxMonthly : 1;

        return view('user.pages.data_jagung.data_jagung', compact(
            'tonnageToday',
            'transactions',
            'marketPrice',
            'marketVariety',
            'monthlyData',
            'monthLabels',
            'maxMonthly'
        ));
    }

    public function layanan()
    {
        // Harga per grade untuk ditampilkan (dari harga terbaru dengan diskon per grade)
        $latestPrice = MarketPrice::latest()->first();
        $basePrice   = $latestPrice ? $latestPrice->price : 0;

        $gradeA = number_format($basePrice, 0, ',', '.');
        $gradeB = number_format($basePrice * 0.92, 0, ',', '.');
        $gradeC = number_format($basePrice * 0.83, 0, ',', '.');

        // Ambil data IoT terbaru
        $currentTemperature = $this->getLatestTemperature(30.0);
        $latestData = DryingMonitor::latest()->first();
        $currentMoisture = $latestData ? $latestData->moisture : 14.0;
        $targetMoistureSetting = (float) Setting::getVal('kadar_air_target', 15);

        // Sesi Aktif
        $activeSession = DryingSession::where('status', 'Berjalan')->latest()->first();
        
        $activeTonnage = 0;
        $activeBatchName = 'Tidak ada sesi';
        $timerString = '00:00:00';

        if ($activeSession) {
            $activeBatchName = $activeSession->batch_name;
            $timerString = $activeSession->formatted_elapsed;
            
            // Hitung estimasi kadar air
            $durationInSeconds = $activeSession->elapsed_seconds;
            $totalEst = $activeSession->target_seconds;
            if ($durationInSeconds >= $totalEst) {
                $currentMoisture = $targetMoistureSetting;
            } else {
                $currentMoisture = round(25.0 - (($durationInSeconds / max(1, $totalEst)) * (25.0 - $targetMoistureSetting)), 1);
            }
            
            // Cari tonase dari transaksi aktif milik petani tersebut
            $matchingTrx = Transaction::where('farmer_name', $activeSession->farmer_name)
                ->where('status', '!=', 'Selesai')
                ->latest()
                ->first();
            
            if ($matchingTrx) {
                $activeTonnage = $matchingTrx->tonnage;
            } else {
                // Fallback ke transaksi terakhir petani tersebut
                $lastTrx = Transaction::where('farmer_name', $activeSession->farmer_name)
                    ->latest()
                    ->first();
                $activeTonnage = $lastTrx ? $lastTrx->tonnage : 0;
            }
        }

        return view('user.pages.layanan.layanan', compact(
            'gradeA', 
            'gradeB', 
            'gradeC',
            'currentTemperature',
            'currentMoisture',
            'activeSession',
            'activeTonnage',
            'timerString'
        ));
    }

    public function kontak()
    {
        return view('user.pages.kontak_kami.kontak');
    }

    /**
     * Simpan pesan kontak dari pengunjung ke database.
     */
    public function storeKontak(Request $request)
    {
        $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'nullable|email|max:255',
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string|min:10',
        ], [
            'name.required'    => 'Nama lengkap wajib diisi.',
            'message.required' => 'Pesan tidak boleh kosong.',
            'message.min'      => 'Pesan minimal 10 karakter.',
        ]);

        ContactMessage::create([
            'name'    => $request->name,
            'email'   => $request->email,
            'subject' => $request->subject,
            'message' => $request->message,
        ]);

        return redirect()->route('user.kontak')
            ->with('success', 'Pesan Anda berhasil terkirim! Kami akan segera menghubungi Anda.');
    }
}