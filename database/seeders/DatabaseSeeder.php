<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Membuat akun admin default untuk ujicoba login kamu
        User::create([
            'name' => 'Admin Klwih',
            'username' => 'admin', // Username untuk login
            'email' => 'admin@kluwih.com',
            'password' => Hash::make('password123'), // Password untuk login
        ]);
    }
}