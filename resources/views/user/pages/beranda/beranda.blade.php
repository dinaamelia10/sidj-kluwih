@extends('user.layout.master')

@section('title', 'SIDJ-Kluwih | Platform Agri-Tech Jagung')

@section('content')
    {{-- Hero Section --}}
    <section class="hero-gradient hero-pattern pt-12 pb-20 px-6 lg:px-16 min-h-[90vh] flex items-center">
        <div class="max-w-7xl mx-auto w-full grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div class="flex flex-col gap-8 reveal active">
                <div class="flex flex-col gap-4">
                    <span class="inline-flex w-fit items-center gap-2 py-1 px-4 rounded-full bg-secondary-container text-on-secondary-container font-semibold tracking-widest text-xs uppercase">
                        <span class="material-symbols-outlined text-base">eco</span> Teknologi Pertanian 4.0
                    </span>
                    <h1 class="text-4xl lg:text-6xl text-primary leading-[1.1] font-bold">
                        Satu Data Terpadu untuk <span class="text-secondary italic">Jagung Kluwih</span> Berkualitas
                    </h1>
                    <p class="text-lg text-on-surface-variant max-w-lg leading-relaxed">
                        Platform Agri-Tech berbasis IoT untuk pemantauan suhu, tonase hasil panen, dan transparansi harga dalam satu ekosistem digital.
                    </p>
                </div>
                <div class="flex flex-wrap gap-4">
                    <a href="{{ route('user.data_jagung') }}"
                       class="flex min-w-[160px] items-center justify-center rounded-xl h-14 px-8 bg-primary text-on-primary text-base font-bold shadow-lg hover:scale-105 active:scale-95 transition-all">
                        <span class="material-symbols-outlined mr-2">bar_chart</span> Lihat Data
                    </a>
                    <a href="{{ route('user.layanan') }}"
                       class="flex min-w-[160px] items-center justify-center rounded-xl h-14 px-8 border border-outline bg-transparent text-primary text-base font-bold hover:bg-surface-container active:scale-95 transition-all">
                        Layanan Kami
                    </a>
                </div>
                {{-- Stats --}}
                <div class="flex items-center gap-6 pt-4 border-t border-outline-variant">
                    <div>
                        <p class="text-2xl font-bold text-primary">{{ $totalPetani > 0 ? number_format($totalPetani) : '—' }}</p>
                        <p class="text-xs text-on-surface-variant uppercase font-medium tracking-wide">Petani Terdaftar</p>
                    </div>
                    <div class="w-px h-8 bg-outline-variant"></div>
                    <div>
                        <p class="text-2xl font-bold text-primary">Rp {{ $marketPrice }}</p>
                        <p class="text-xs text-on-surface-variant uppercase font-medium tracking-wide">Harga Beli / Kg</p>
                    </div>
                    @if($totalTonnage > 0)
                    <div class="w-px h-8 bg-outline-variant"></div>
                    <div>
                        <p class="text-2xl font-bold text-primary">{{ number_format($totalTonnage, 0, ',', '.') }} Kg</p>
                        <p class="text-xs text-on-surface-variant uppercase font-medium tracking-wide">Total Berat</p>
                    </div>
                    @endif
                </div>
            </div>

            {{-- Visual Panel --}}
            <div class="relative h-[380px] lg:h-[520px] reveal active" style="transition-delay:200ms">
                <div class="absolute inset-0 bg-surface-container rounded-3xl overflow-hidden shadow-2xl border border-outline-variant flex flex-col">
                    {{-- Panel Header --}}
                    <div class="bg-primary px-6 py-4 flex items-center justify-between">
                        <div class="flex items-center gap-2 text-on-primary">
                            <span class="material-symbols-outlined">sensors</span>
                            <span class="font-semibold text-sm">Dashboard IoT — Live</span>
                        </div>
                        <span class="flex items-center gap-1.5 bg-white/20 text-on-primary text-xs px-3 py-1 rounded-full font-medium">
                            <span class="w-1.5 h-1.5 rounded-full bg-green-400 animate-pulse"></span> Online
                        </span>
                    </div>
                    {{-- Panel Body --}}
                    <div class="flex-1 p-5 grid grid-cols-2 gap-4">
                        <div class="bg-surface rounded-xl p-4 border border-outline-variant flex flex-col gap-1">
                            <span class="material-symbols-outlined text-primary">thermostat</span>
                            <p class="text-xs text-on-surface-variant uppercase tracking-wide mt-1">Suhu Dryer</p>
                            <p class="text-2xl font-bold text-primary">80°C</p>
                            <p class="text-xs text-secondary">Status Optimal</p>
                        </div>
                        <div class="bg-surface rounded-xl p-4 border border-outline-variant flex flex-col gap-1">
                            <span class="material-symbols-outlined text-tertiary">water_drop</span>
                            <p class="text-xs text-on-surface-variant uppercase tracking-wide mt-1">Kadar Air</p>
                            <p class="text-2xl font-bold text-on-surface">14%</p>
                            <p class="text-xs text-on-surface-variant">Target: ≤ 14%</p>
                        </div>
                        <div class="bg-surface rounded-xl p-4 border border-outline-variant flex flex-col gap-1">
                            <span class="material-symbols-outlined text-secondary">scale</span>
                            <p class="text-xs text-on-surface-variant uppercase tracking-wide mt-1">Tonase Aktif</p>
                            <p class="text-2xl font-bold text-on-surface">4.200 Kg</p>
                            <p class="text-xs text-on-surface-variant">Batch berjalan</p>
                        </div>
                        <div class="bg-secondary-container rounded-xl p-4 flex flex-col gap-1">
                            <span class="material-symbols-outlined text-on-secondary-container">payments</span>
                            <p class="text-xs text-on-surface-variant uppercase tracking-wide mt-1">Harga Pasar</p>
                            <p class="text-lg font-bold text-primary">Rp {{ $marketPrice }}</p>
                            <p class="text-xs text-on-surface-variant">/kg</p>
                        </div>
                    </div>
                    {{-- Mini Chart --}}
                    <div class="px-5 pb-5">
                        <div class="bg-surface rounded-xl border border-outline-variant p-3 h-20 flex items-end gap-1">
                            @foreach([40,55,50,70,85,90,80,95,75,85] as $h)
                            <div class="flex-1 rounded-sm bg-primary/70 hover:bg-primary transition-colors" style="height:{{ $h }}%"></div>
                            @endforeach
                        </div>
                        <p class="text-xs text-on-surface-variant text-center mt-1">Tren suhu pengeringan (simulasi visual)</p>
                    </div>
                </div>

                {{-- Floating Badge --}}
                <div class="absolute -bottom-4 -left-4 bg-surface p-4 rounded-xl shadow-xl flex items-center gap-3 z-10 border border-outline-variant">
                    <div class="bg-secondary-container p-2 rounded-lg">
                        <span class="material-symbols-outlined text-on-secondary-container">verified</span>
                    </div>
                    <div>
                        <p class="text-sm font-bold text-primary">Data Terverifikasi</p>
                        <p class="text-xs text-on-surface-variant">Real-time & Transparan</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Ecosystem Digital Section --}}
    <section class="py-24 px-6 lg:px-16 bg-surface-container-lowest" id="ecosystem">
        <div class="max-w-7xl mx-auto">
            <div class="flex flex-col gap-4 mb-16 reveal">
                <span class="text-xs uppercase tracking-widest text-secondary font-bold">Teknologi Kami</span>
                <h2 class="text-3xl lg:text-4xl font-bold text-primary">Ecosystem Digital</h2>
                <p class="text-on-surface-variant max-w-2xl text-lg">Inovasi modern untuk mendukung kualitas hasil tani jagung Kluwih yang unggul melalui integrasi perangkat keras dan lunak.</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="group flex flex-col gap-6 p-8 rounded-2xl border border-outline-variant bg-surface hover:border-secondary hover:shadow-xl transition-all duration-300 reveal">
                    <div class="size-14 rounded-full bg-surface-container flex items-center justify-center text-primary group-hover:bg-secondary group-hover:text-on-secondary transition-colors">
                        <span class="material-symbols-outlined text-3xl">sensors</span>
                    </div>
                    <div class="flex flex-col gap-2">
                        <h3 class="text-xl font-bold text-primary">Pemantauan IoT Real-time</h3>
                        <p class="text-on-surface-variant leading-relaxed">Integrasi sensor cerdas untuk data akurat yang dikirimkan langsung dari lahan ke dashboard utama.</p>
                    </div>
                </div>
                <div class="group flex flex-col gap-6 p-8 rounded-2xl border border-outline-variant bg-surface hover:border-secondary hover:shadow-xl transition-all duration-300 reveal" style="transition-delay:100ms">
                    <div class="size-14 rounded-full bg-surface-container flex items-center justify-center text-primary group-hover:bg-secondary group-hover:text-on-secondary transition-colors">
                        <span class="material-symbols-outlined text-3xl">query_stats</span>
                    </div>
                    <div class="flex flex-col gap-2">
                        <h3 class="text-xl font-bold text-primary">Optimasi Suhu &amp; Tonase</h3>
                        <p class="text-on-surface-variant leading-relaxed">Algoritma cerdas yang membantu menjaga suhu pengeringan dan mencatat berat hasil panen secara otomatis.</p>
                    </div>
                </div>
                <div class="group flex flex-col gap-6 p-8 rounded-2xl border border-outline-variant bg-surface hover:border-secondary hover:shadow-xl transition-all duration-300 reveal" style="transition-delay:200ms">
                    <div class="size-14 rounded-full bg-surface-container flex items-center justify-center text-primary group-hover:bg-secondary group-hover:text-on-secondary transition-colors">
                        <span class="material-symbols-outlined text-3xl">payments</span>
                    </div>
                    <div class="flex flex-col gap-2">
                        <h3 class="text-xl font-bold text-primary">Transparansi Harga</h3>
                        <p class="text-on-surface-variant leading-relaxed">Update harga pasar harian untuk memastikan transaksi yang adil dan transparan bagi seluruh pihak terkait.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Workflow Section --}}
    <section class="py-24 px-6 lg:px-16 bg-surface-container" id="workflow">
        <div class="max-w-7xl mx-auto">
            <h2 class="text-3xl lg:text-4xl font-bold text-primary mb-16 text-center reveal">Alur Kerja Digital</h2>
            <div class="relative flex flex-col gap-10 reveal">
                <div class="hidden lg:block absolute left-[28px] top-0 bottom-0 w-px bg-outline-variant/60"></div>
                @php
                    $steps = [
                        ['n'=>'01','t'=>'Pemasangan IoT','d'=>'Instalasi perangkat sensor suhu dan kelembapan di titik-titik krusial gudang penyimpanan.','icon'=>'sensors'],
                        ['n'=>'02','t'=>'Monitoring Suhu','d'=>'Data suhu dikirimkan setiap detik ke server untuk dianalisis kestabilannya.','icon'=>'thermostat'],
                        ['n'=>'03','t'=>'Pencatatan Tonase','d'=>'Integrasi timbangan digital secara otomatis mencatat volume masuk dan keluar hasil panen.','icon'=>'scale'],
                        ['n'=>'04','t'=>'Analisis Data','d'=>'Laporan otomatis dihasilkan untuk melihat performa kualitas jagung antar periode.','icon'=>'bar_chart'],
                        ['n'=>'05','t'=>'Distribusi & Harga','d'=>'Informasi stok dan harga tersedia bagi pembeli terverifikasi di portal ekosistem.','icon'=>'local_shipping'],
                    ];
                @endphp
                @foreach($steps as $step)
                <div class="grid grid-cols-[60px_1fr] gap-8 items-center group">
                    <div class="size-14 rounded-full bg-primary flex items-center justify-center text-on-primary z-10 font-bold text-sm border-4 border-surface shadow-lg">{{ $step['n'] }}</div>
                    <div class="flex flex-col gap-1">
                        <h4 class="text-lg font-bold text-primary group-hover:text-secondary transition-colors">{{ $step['t'] }}</h4>
                        <p class="text-on-surface-variant">{{ $step['d'] }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- CTA Section --}}
    <section class="py-24 px-6 lg:px-16">
        <div class="max-w-7xl mx-auto relative rounded-3xl overflow-hidden bg-primary p-12 lg:p-20 flex flex-col items-center text-center gap-8 reveal">
            <div class="absolute inset-0 opacity-10 pointer-events-none bg-[radial-gradient(circle_at_top_right,_#a3f69c,_transparent_60%)]"></div>
            <h2 class="font-bold text-3xl lg:text-5xl text-on-primary relative z-10">Siap Modernisasi Panen Anda?</h2>
            <p class="text-on-primary/80 text-lg max-w-xl relative z-10">
                Bergabunglah dengan petani jagung lainnya yang telah bertransformasi ke ekosistem digital untuk hasil yang lebih terukur.
            </p>
            <div class="flex flex-wrap justify-center gap-6 relative z-10">
                <a href="{{ route('user.kontak') }}"
                   class="px-10 h-14 bg-surface text-primary font-bold rounded-xl hover:scale-105 active:scale-95 transition-all flex items-center gap-2">
                    <span class="material-symbols-outlined">mail</span> Hubungi Kami
                </a>
                <a href="{{ route('user.layanan') }}"
                   class="px-10 h-14 border border-on-primary/30 text-on-primary font-bold rounded-xl hover:bg-on-primary/10 active:scale-95 transition-all flex items-center gap-2">
                    Eksplorasi Layanan
                </a>
            </div>
        </div>
    </section>
@endsection
