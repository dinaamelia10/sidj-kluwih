<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function beranda()
    {
        return view('user.pages.beranda.beranda');
    }
    public function tentang()
    {
        return view('user.pages.tentang.tentang_kami');
    }
    public function data_jagung()
    {
        return view('user.pages.data_jagung.data_jagung');
    }
    public function layanan()
    {
        return view('user.pages.layanan.layanan');
    }
    public function kontak()
    {
        return view('user.pages.kontak_kami.kontak');
    }
}

   