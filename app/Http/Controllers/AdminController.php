<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.page.dashboard.dashboard');
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
        return view('admin.page.pemantauan.pemantauan');
    }
    public function tonaseJagung()
    {
        return view('admin.page.tonase.tonase-jagung');
    }
    public function hargaBeli()
    {
        return view('admin.page.harga_beli.harga_beli');
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
}
   