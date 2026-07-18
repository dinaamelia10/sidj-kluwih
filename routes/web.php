<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;

// LANDING / WELCOME
Route::get('/sidj-kluwih', function () {
    return view('welcome');
});

// ==========================================
// ADMIN ROUTES (AUTHENTICATION & DASHBOARD)
// ==========================================

// Route untuk Guest (Admin yang belum login)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('admin.login');
    Route::post('/login', [AuthController::class, 'login'])->name('admin.login.submit');
    Route::get('/admin/forgot-password', [AdminController::class, 'forgotPassword'])->name('admin.forgot-password');
});

// Route untuk Admin yang sudah login (Diproteksi Middleware Auth)
Route::middleware('auth')->group(function () {
    // Dashboard & Monitoring IoT Utama
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/pemantauan', [AdminController::class, 'pemantauan'])->name('admin.pemantauan');

    // Management Tonase Jagung (Disinkronkan dengan nama di Sidebar kamu)
    Route::get('/admin/tonase-jagung', [AdminController::class, 'tonaseJagung'])->name('admin.tonase-jagung');
    Route::get('/admin/add-tonase', [AdminController::class, 'addTonase'])->name('admin.tonase.add_tonase');

    // Management Harga Beli (Disinkronkan dengan nama di Sidebar kamu)
    Route::get('/admin/harga-beli', [AdminController::class, 'hargaBeli'])->name('admin.harga-beli');
    Route::get('/admin/add-harga', [AdminController::class, 'addHarga'])->name('admin.harga_beli.add_harga');
    Route::post('/admin/store-harga', [AdminController::class, 'storeHarga'])->name('admin.harga_beli.store_harga');

    // Laporan, Data Petani, & Pengaturan
    Route::get('/admin/laporan', [AdminController::class, 'laporan'])->name('admin.laporan');
    Route::get('/admin/pengguna', [AdminController::class, 'pengguna'])->name('admin.pengguna');
    Route::get('/admin/pengaturan', [AdminController::class, 'pengaturan'])->name('admin.pengaturan');

    // API Endpoint khusus IoT untuk Yesaya (Bisa ditaruh di sini jika pakai auth device atau taruh luar jika publik)
    // Route::post('/api/iot/monitor', [DryingMonitorController::class, 'store']);

    // Proses Logout Admin (Harus POST demi keamanan token CSRF)
    Route::get('/logout', [AuthController::class, 'logout'])->name('admin.logout');
});

// Endpoint IoT Publik jika Yesaya menembak data tanpa session auth web
// Route::post('/api/iot/monitor', [DryingMonitorController::class, 'store']);


// ==========================================
// USER ROUTES (FRONT-END PETANI/PUBLIK)
// ==========================================
Route::get('/beranda', [UserController::class, 'beranda'])->name('user.beranda');
Route::get('/tentang', [UserController::class, 'tentang'])->name('user.tentang_kami');

// 👈 UBAH DI SINI: Ganti dari 'user.data_aggregate' menjadi 'user.data_jagung'
Route::get('/data-jagung', [UserController::class, 'data_jagung'])->name('user.data_jagung');

Route::get('/layanan', [UserController::class, 'layanan'])->name('user.layanan');
Route::get('/kontak', [UserController::class, 'kontak'])->name('user.kontak');
