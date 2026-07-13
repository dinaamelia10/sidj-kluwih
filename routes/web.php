<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;

Route::get('/sidj-kluwih', function () {
    return view('welcome');
});


// ADMIN ROUTES
Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
Route::get('/admin/login', [AdminController::class, 'login'])->name('admin.login');
Route::get('/beranda', [UserController::class, 'beranda'])->name('user.beranda');
Route::get('/admin/forgot-password', [AdminController::class, 'forgotPassword'])->name('admin.forgot-password');
Route::get('/admin/pemantauan', [AdminController::class, 'pemantauan'])->name('admin.pemantauan');
Route::get('/admin/tonase-jagung', [AdminController::class, 'tonaseJagung'])->name('admin.tonase-jagung');
Route::get('/admin/harga-beli', [AdminController::class, 'hargaBeli'])->name('admin.harga-beli');
Route::get('/admin/laporan', [AdminController::class, 'laporan'])->name('admin.laporan');
Route::get('/admin/pengguna', [AdminController::class, 'pengguna'])->name('admin.pengguna');
Route::get('/admin/pengaturan', [AdminController::class, 'pengaturan'])->name('admin.pengaturan');

// USER ROUTES
Route::get('/tentang', [UserController::class, 'tentang'])->name('user.tentang_kami');
