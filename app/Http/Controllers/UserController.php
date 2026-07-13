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
}
   