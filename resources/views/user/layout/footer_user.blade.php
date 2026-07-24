<footer class="bg-surface border-t border-outline-variant py-12 px-6 lg:px-16">
    <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-4 gap-10">
        {{-- Brand --}}
        <div class="flex flex-col gap-4 col-span-1 md:col-span-2">
            <a href="{{ route('user.beranda') }}" class="flex items-center">
                <img class="h-14 w-auto object-contain" src="{{ asset('logo.png') }}" alt="Logo SIJALU-Kluwih">
            </a>
            <p class="text-secondary text-sm leading-relaxed max-w-sm">
                Platform inovasi pertanian berbasis IoT untuk transparansi data pengeringan, tonase, dan harga jagung di wilayah Kluwih.
            </p>
        </div>
        {{-- Nav --}}
        <div class="flex flex-col gap-3">
            <h4 class="font-bold text-primary text-sm">Navigasi</h4>
            <nav class="flex flex-col gap-2 text-sm text-on-surface-variant">
                <a class="hover:text-primary transition-colors" href="{{ route('user.beranda') }}">Beranda</a>
                <a class="hover:text-primary transition-colors" href="{{ route('user.tentang_kami') }}">Tentang Kami</a>
                <a class="hover:text-primary transition-colors" href="{{ route('user.data_jagung') }}">Data Jagung</a>
                <a class="hover:text-primary transition-colors" href="{{ route('user.layanan') }}">Layanan</a>
                <a class="hover:text-primary transition-colors" href="{{ route('user.kontak') }}">Kontak</a>
            </nav>
        </div>
        {{-- Kontak --}}
        <div class="flex flex-col gap-3">
            <h4 class="font-bold text-primary text-sm">Kontak</h4>
            <div class="flex flex-col gap-2 text-sm text-on-surface-variant">
                <p>Desa Kluwih, Kec. Bandar, Kab. Batang, Jawa Tengah</p>
                <p>info@sijalu-kluwih.id</p>
            </div>
        </div>
    </div>
    <div class="max-w-7xl mx-auto mt-10 pt-8 border-t border-outline-variant flex flex-col md:flex-row justify-between items-center gap-3 text-xs text-on-surface-variant">
        <p>© {{ date('Y') }} SIJALU-Kluwih. All rights reserved.</p>
        <div class="flex flex-wrap gap-6">
            <a class="hover:text-primary transition-colors" href="#">Syarat & Ketentuan</a>
            <a class="hover:text-primary transition-colors" href="#">Kebijakan Privasi</a>
        </div>
    </div>
</footer>
