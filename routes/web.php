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
    Route::get('/admin/pemantauan/export', [AdminController::class, 'exportPemantauan'])->name('admin.pemantauan.export');
    Route::post('/admin/pemantauan/clear', [AdminController::class, 'clearSensorData'])->name('admin.pemantauan.clear');
    Route::post('/admin/drying/start', [AdminController::class, 'startDryingSession'])->name('admin.drying.start');
    Route::post('/admin/drying/stop/{session}', [AdminController::class, 'stopDryingSession'])->name('admin.drying.stop');
    Route::get('/admin/drying/check-timer', [AdminController::class, 'checkDryingTimer'])->name('admin.drying.check_timer');

    // Management Tonase Jagung
    Route::get('/admin/tonase-jagung', [AdminController::class, 'tonaseJagung'])->name('admin.tonase-jagung');
    Route::get('/admin/add-tonase', [AdminController::class, 'addTonase'])->name('admin.tonase.add_tonase');
    Route::post('/admin/tonase-jagung', [AdminController::class, 'storeTonase'])->name('admin.tonase.store');
    Route::delete('/admin/tonase/{transaction}', [AdminController::class, 'destroyTransaction'])->name('admin.tonase.destroy');
    Route::patch('/admin/tonase/{transaction}/status', [AdminController::class, 'updateTransactionStatus'])->name('admin.tonase.update_status');

    // Management Harga Beli
    Route::get('/admin/harga-beli', [AdminController::class, 'hargaBeli'])->name('admin.harga-beli');
    Route::get('/admin/add-harga', [AdminController::class, 'addHarga'])->name('admin.harga_beli.add_harga');
    Route::post('/admin/store-harga', [AdminController::class, 'storeHarga'])->name('admin.harga_beli.store_harga');
    Route::put('/admin/harga-beli/{harga}', [AdminController::class, 'updateHarga'])->name('admin.harga_beli.update');
    Route::delete('/admin/harga-beli/{harga}', [AdminController::class, 'destroyHarga'])->name('admin.harga_beli.destroy');

    // Management Varietas
    Route::post('/admin/varietas', [AdminController::class, 'storeVariety'])->name('admin.variety.store');
    Route::delete('/admin/varietas/{variety}', [AdminController::class, 'destroyVariety'])->name('admin.variety.destroy');

    // Laporan, Data Petani, & Pengaturan
    Route::get('/admin/laporan', [AdminController::class, 'laporan'])->name('admin.laporan');
    Route::post('/admin/laporan', [AdminController::class, 'storeLaporan'])->name('admin.laporan.store');
    Route::get('/admin/laporan/{transaction}/download', [AdminController::class, 'downloadLaporan'])->name('admin.laporan.download');
    Route::get('/admin/pengguna', [AdminController::class, 'pengguna'])->name('admin.pengguna');
    Route::post('/admin/pengguna', [AdminController::class, 'storePengguna'])->name('admin.pengguna.store');
    Route::put('/admin/pengguna/{petani}', [AdminController::class, 'updatePengguna'])->name('admin.pengguna.update');
    Route::delete('/admin/pengguna/{petani}', [AdminController::class, 'destroyPengguna'])->name('admin.pengguna.destroy');
    Route::get('/admin/pengaturan', [AdminController::class, 'pengaturan'])->name('admin.pengaturan');
    Route::post('/admin/pengaturan', [AdminController::class, 'updatePengaturan'])->name('admin.pengaturan.update');

    // Global Live Search API
    Route::get('/admin/api/search', [AdminController::class, 'globalSearch'])->name('admin.global_search');

    // Pesan Kontak Masuk dari Pengunjung
    Route::get('/admin/pesan', [AdminController::class, 'pesan'])->name('admin.pesan');
    Route::get('/admin/pesan/{message}/read', [AdminController::class, 'showPesan'])->name('admin.pesan.read');
    Route::delete('/admin/pesan/{message}', [AdminController::class, 'destroyPesan'])->name('admin.pesan.destroy');

    // Manajemen Profil & Password
    Route::get('/admin/profil', [AdminController::class, 'profil'])->name('admin.profil');
    Route::post('/admin/profil/update', [AdminController::class, 'updateProfil'])->name('admin.profil.update');
    Route::post('/admin/profil/password', [AdminController::class, 'updatePassword'])->name('admin.profil.password');

    // Logout Admin
    Route::post('/logout', [AdminController::class, 'logout'])->name('admin.logout');
    // Backward compat GET logout
    Route::get('/logout', [AdminController::class, 'logout'])->name('admin.logout.get');
});

// Endpoint IoT Publik
Route::post('/api/iot/sensor', [\App\Http\Controllers\IotController::class, 'receiveData']);


// ==========================================
// USER ROUTES (FRONT-END PETANI/PUBLIK)
// ==========================================
Route::get('/beranda', [UserController::class, 'beranda'])->name('user.beranda');
Route::get('/tentang', [UserController::class, 'tentang'])->name('user.tentang_kami');
Route::get('/data-jagung', [UserController::class, 'data_jagung'])->name('user.data_jagung');
Route::get('/layanan', [UserController::class, 'layanan'])->name('user.layanan');
Route::get('/kontak', [UserController::class, 'kontak'])->name('user.kontak');
Route::post('/kontak', [UserController::class, 'storeKontak'])->name('user.kontak.store');
