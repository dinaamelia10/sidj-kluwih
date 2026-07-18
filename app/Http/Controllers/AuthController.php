<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('admin.page.auth.login');
    }

    public function login(Request $request)
    {
        // Menyesuaikan validasi dengan atribut name="username" pada form HTML kamu
        $credentials = $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required'],
        ]);

        // Proses autentikasi berbasis username
        if (Auth::attempt($credentials, $request->has('remember'))) {
            $request->session()->regenerate();

            return redirect()->intended(route('admin.dashboard'));
        }

        return back()->withErrors([
            'username' => 'Username atau password yang dimasukkan salah.',
        ])->onlyInput('username');
    }

    public function logout(Request $request)
    {
        \Illuminate\Support\Facades\Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Mengarahkan browser secara bersih kembali ke rute form login admin
        return redirect()->route('admin.login');
    }
}
