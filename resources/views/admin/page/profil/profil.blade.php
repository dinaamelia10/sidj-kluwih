@extends('admin.layout.master')

@section('content')
    <div class="space-y-lg pb-24">
        {{-- ========== HEADER ========== --}}
        <div class="flex flex-col gap-4 md:flex-row md:items-end md:justify-between sticky top-0 z-40 bg-surface/90 backdrop-blur-md pb-4 pt-2 -mx-4 px-4 sm:-mx-6 sm:px-6 md:mx-0 md:px-0">
            <div>
                <nav class="flex flex-wrap items-center gap-2 text-on-surface-variant font-label-sm text-label-sm mb-2">
                    <a class="hover:text-primary" href="{{ route('admin.dashboard') }}">Dashboard</a>
                    <span class="material-symbols-outlined text-[14px]">chevron_right</span>
                    <span class="text-primary font-bold">Profil & Akun</span>
                </nav>
                <h1 class="font-headline-lg text-headline-lg font-extrabold text-on-surface">Pengaturan Akun</h1>
                <p class="text-on-surface-variant font-body-md text-body-md mt-2">
                    Kelola informasi pribadi dan keamanan kata sandi Anda di sini.
                </p>
            </div>
        </div>

        {{-- Flash Messages --}}
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-lg py-md rounded-2xl relative flex items-center gap-3 custom-shadow" role="alert">
                <span class="material-symbols-outlined">check_circle</span>
                <span class="block sm:inline font-medium">{{ session('success') }}</span>
            </div>
        @endif

        @if(session('error'))
            <div class="bg-error-container text-on-error-container px-lg py-md rounded-2xl relative flex items-center gap-3 custom-shadow" role="alert">
                <span class="material-symbols-outlined">error</span>
                <span class="block sm:inline font-medium">{{ session('error') }}</span>
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-lg">
            
            {{-- ========== FORM UPDATE PROFIL ========== --}}
            <div class="space-y-lg">
                <form action="{{ route('admin.profil.update') }}" method="POST" class="bento-card p-lg space-y-6">
                    @csrf
                    <div class="flex items-center gap-3 border-b border-outline-variant/30 pb-4">
                        <div class="w-12 h-12 rounded-full bg-primary-container text-on-primary-container flex items-center justify-center font-bold text-xl">
                            {{ substr($user->name, 0, 1) }}
                        </div>
                        <div>
                            <h2 class="font-title-lg text-title-lg font-bold text-on-surface">Data Profil</h2>
                            <p class="text-label-sm text-on-surface-variant">Informasi identitas akun Anda.</p>
                        </div>
                    </div>

                    {{-- Input Nama --}}
                    <div>
                        <label class="block font-label-md text-on-surface mb-2">Nama Lengkap</label>
                        <input type="text" name="name" value="{{ old('name', $user->name) }}" required
                            class="w-full bg-surface-container-low border border-outline-variant rounded-xl px-4 py-3 text-body-md focus:ring-2 focus:ring-primary focus:outline-none transition-all">
                        @error('name')
                            <p class="text-error text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Input Username --}}
                    <div>
                        <label class="block font-label-md text-on-surface mb-2">Username</label>
                        <input type="text" name="username" value="{{ old('username', $user->username) }}" required
                            class="w-full bg-surface-container-low border border-outline-variant rounded-xl px-4 py-3 text-body-md focus:ring-2 focus:ring-primary focus:outline-none transition-all">
                        @error('username')
                            <p class="text-error text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Input Email --}}
                    <div>
                        <label class="block font-label-md text-on-surface mb-2">Alamat Email</label>
                        <input type="email" name="email" value="{{ old('email', $user->email) }}" required
                            class="w-full bg-surface-container-low border border-outline-variant rounded-xl px-4 py-3 text-body-md focus:ring-2 focus:ring-primary focus:outline-none transition-all">
                        @error('email')
                            <p class="text-error text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="pt-4 flex justify-end">
                        <button type="submit" class="inline-flex items-center justify-center gap-sm rounded-xl bg-primary px-6 py-3 text-on-primary font-bold transition hover:bg-primary/90 active:scale-95 shadow-md">
                            <span class="material-symbols-outlined text-[20px]">save</span>
                            Simpan Profil
                        </button>
                    </div>
                </form>
            </div>

            {{-- ========== FORM UBAH PASSWORD ========== --}}
            <div class="space-y-lg" id="ubah-password">
                <form action="{{ route('admin.profil.password') }}" method="POST" class="bento-card p-lg space-y-6">
                    @csrf
                    <div class="flex items-center gap-3 border-b border-outline-variant/30 pb-4">
                        <div class="w-12 h-12 rounded-full bg-error-container text-on-error-container flex items-center justify-center">
                            <span class="material-symbols-outlined">shield_locked</span>
                        </div>
                        <div>
                            <h2 class="font-title-lg text-title-lg font-bold text-on-surface">Ubah Password</h2>
                            <p class="text-label-sm text-on-surface-variant">Pastikan akun Anda tetap aman.</p>
                        </div>
                    </div>

                    {{-- Password Lama --}}
                    <div>
                        <label class="block font-label-md text-on-surface mb-2">Password Lama</label>
                        <input type="password" name="current_password" required placeholder="Masukkan password saat ini"
                            class="w-full bg-surface-container-low border border-outline-variant rounded-xl px-4 py-3 text-body-md focus:ring-2 focus:ring-primary focus:outline-none transition-all">
                        @error('current_password')
                            <p class="text-error text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Password Baru --}}
                    <div>
                        <label class="block font-label-md text-on-surface mb-2">Password Baru</label>
                        <input type="password" name="new_password" required placeholder="Minimal 8 karakter"
                            class="w-full bg-surface-container-low border border-outline-variant rounded-xl px-4 py-3 text-body-md focus:ring-2 focus:ring-primary focus:outline-none transition-all">
                        @error('new_password')
                            <p class="text-error text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Konfirmasi Password Baru --}}
                    <div>
                        <label class="block font-label-md text-on-surface mb-2">Konfirmasi Password Baru</label>
                        <input type="password" name="new_password_confirmation" required placeholder="Ketik ulang password baru"
                            class="w-full bg-surface-container-low border border-outline-variant rounded-xl px-4 py-3 text-body-md focus:ring-2 focus:ring-primary focus:outline-none transition-all">
                    </div>

                    <div class="pt-4 flex justify-end">
                        <button type="submit" class="inline-flex items-center justify-center gap-sm rounded-xl bg-error text-on-error px-6 py-3 font-bold transition hover:bg-error/90 active:scale-95 shadow-md">
                            <span class="material-symbols-outlined text-[20px]">key</span>
                            Update Password
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
