<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MarketPrice;
use App\Models\Transaction;
use App\Models\Petani;
use App\Models\ContactMessage;
use Carbon\Carbon;

class UserController extends Controller
{
    public function beranda()
    {
        // Harga pasar terbaru untuk ditampilkan di halaman publik
        $latestPrice = MarketPrice::latest()->first();
        $marketPrice = $latestPrice ? number_format($latestPrice->price, 0, ',', '.') : '0';

        // Statistik publik
        $totalPetani   = Petani::count();
        $totalTonnage  = Transaction::where('status', 'Selesai')->sum('tonnage');

        return view('user.pages.beranda.beranda', compact(
            'marketPrice',
            'totalPetani',
            'totalTonnage'
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

        return view('user.pages.layanan.layanan', compact('gradeA', 'gradeB', 'gradeC'));
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