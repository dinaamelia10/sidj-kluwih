@extends('user.layout.master')

@section('title', 'Pusat Data Jagung Kolektif - SIDJ-Kluwih')

@section('content')
<!-- Seluruh isi objek konfigurasi tema halaman aslimu agar warnanya konsisten -->
<script>
    try {
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "primary-container": "#2e7d32",
                        "primary": "#0d631b",
                        "surface-container-low": "#f0f3ff",
                        "surface-container-high": "#dee8ff",
                        "surface-bright": "#f9f9ff",
                        "on-primary-fixed": "#002204",
                        "on-primary-fixed-variant": "#005312",
                        "on-secondary": "#ffffff",
                        "surface-tint": "#1b6d24",
                        "secondary-fixed": "#94f990",
                        "primary-fixed-dim": "#88d982",
                        "on-tertiary-fixed": "#261a00",
                        "on-tertiary": "#ffffff",
                        "on-tertiary-fixed-variant": "#5c4300",
                        "error-container": "#ffdad6",
                        "on-tertiary-container": "#ffefd7",
                        "inverse-surface": "#263143",
                        "on-error-container": "#93000a",
                        "background": "#f9f9ff",
                        "on-secondary-fixed": "#002204",
                        "surface-container-highest": "#d8e3fb",
                        "tertiary-fixed": "#ffdfa0",
                        "on-surface-variant": "#40493d",
                        "tertiary-container": "#8c6800",
                        "inverse-primary": "#88d982",
                        "tertiary": "#6e5100",
                        "tertiary-fixed-dim": "#f8bd2a",
                        "surface-dim": "#cfdaf2",
                        "surface-container": "#e7eeff",
                        "outline": "#707a6c",
                        "surface-container-lowest": "#ffffff",
                        "primary-fixed": "#a3f69c",
                        "on-primary-container": "#cbffc2",
                        "on-primary": "#ffffff",
                        "on-secondary-fixed-variant": "#005313",
                        "on-surface": "#111c2d",
                        "outline-variant": "#bfcaba",
                        "surface-variant": "#d8e3fb",
                        "error": "#ba1a1a",
                        "secondary": "#006e1c",
                        "inverse-on-surface": "#ecf1ff",
                        "surface": "#f9f9ff",
                        "on-background": "#111c2d",
                        "secondary-container": "#91f78e",
                        "on-secondary-container": "#00731e",
                        "secondary-fixed-dim": "#78dc77",
                        "on-error": "#ffffff"
                    },
                    "borderRadius": {
                        "DEFAULT": "0.25rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
                        "full": "9999px"
                    },
                    "spacing": {
                        "sm": "8px",
                        "xl": "40px",
                        "container-margin": "24px",
                        "md": "16px",
                        "xs": "4px",
                        "gutter": "20px",
                        "lg": "24px",
                        "base": "4px"
                    },
                    "fontFamily": {
                        "headline-lg": ["Inter"],
                        "body-lg": ["Inter"],
                        "title-lg": ["Inter"],
                        "label-sm": ["Inter"],
                        "label-md": ["Inter"],
                        "headline-md": ["Inter"],
                        "display": ["Inter"],
                        "headline-lg-mobile": ["Inter"],
                        "body-md": ["Inter"]
                    },
                    "fontSize": {
                        "headline-lg": ["32px", {"lineHeight": "40px", "letterSpacing": "-0.01em", "fontWeight": "600"}],
                        "body-lg": ["18px", {"lineHeight": "28px", "fontWeight": "400"}],
                        "title-lg": ["20px", {"lineHeight": "28px", "fontWeight": "600"}],
                        "label-sm": ["12px", {"lineHeight": "16px", "letterSpacing": "0.05em", "fontWeight": "600"}],
                        "label-md": ["14px", {"lineHeight": "20px", "letterSpacing": "0.01em", "fontWeight": "500"}],
                        "headline-md": ["24px", {"lineHeight": "32px", "fontWeight": "600"}],
                        "display": ["48px", {"lineHeight": "1.2", "letterSpacing": "-0.02em", "fontWeight": "700"}],
                        "headline-lg-mobile": ["24px", {"lineHeight": "32px", "fontWeight": "600"}],
                        "body-md": ["16px", {"lineHeight": "24px", "fontWeight": "400"}]
                    }
                },
            },
        }
    } catch (_e) {}
</script>

<style>
    .glass-card { background: rgba(255, 255, 255, 0.8); backdrop-filter: blur(8px); border: 1px solid #E2E8F0; }
    .hero-pattern { background-image: radial-gradient(#1b6d2411 1px, transparent 1px); background-size: 24px 24px; }
</style>

<main class="flex-grow">
    <!-- Hero Section -->
    <section class="relative w-full overflow-hidden pt-xl pb-lg px-container-margin">
        <div class="max-w-7xl mx-auto relative z-10">
            <nav class="flex mb-md text-label-sm uppercase tracking-widest text-primary font-bold">
                <span class="">Beranda</span>
                <span class="mx-xs">/</span>
                <span class="text-on-surface-variant">Lacak Hasil Panen</span>
            </nav>
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-xl items-end">
                <div>
                    <h1 class="text-display font-display leading-tight mb-sm">
                        Pusat Data Jagung Kolektif
                    </h1>
                    <p class="text-body-lg text-on-surface-variant max-w-xl">
                        Pantau transparansi hasil panen wilayah secara real-time. Masukkan ID Setoran Anda untuk melacak status verifikasi dan detail kualitas.
                    </p>
                </div>
                <!-- Prominent Search Bar -->
                <div class="w-full max-w-md">
                    <label class="block text-label-md font-bold text-primary mb-2" for="track-id">Lacak Hasil Panen Anda</label>
                    <div class="relative flex items-center">
                        <span class="material-symbols-outlined absolute left-md text-on-surface-variant">search</span>
                        <input class="w-full pl-xl pr-32 py-md border-2 border-primary/20 rounded-xl focus:ring-primary focus:border-primary text-body-md shadow-sm" id="track-id" placeholder="Masukkan ID Setoran / Resi..." type="text"/>
                        <button class="absolute right-sm bg-primary text-on-primary px-md py-sm rounded-lg font-bold text-label-sm hover:brightness-110 transition-all">
                            CARI DATA
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Bento Grid -->
    <section class="px-container-margin py-md max-w-7xl mx-auto w-full">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-lg">
            <!-- Stat Card 1 -->
            <div class="bg-white border border-outline-variant p-lg rounded-xl flex flex-col justify-between group hover:shadow-lg transition-all duration-300">
                <div class="flex justify-between items-start">
                    <div class="p-sm bg-secondary-container rounded-full text-on-secondary-container">
                        <span class="material-symbols-outlined">inventory_2</span>
                    </div>
                    <span class="text-label-sm font-bold text-secondary">Hari Ini</span>
                </div>
                <div class="mt-xl">
                    <p class="text-label-md text-on-surface-variant uppercase tracking-wider">Total Tonase Masuk</p>
                    <h2 class="text-headline-lg text-on-surface mt-xs">248.2 <span class="text-title-lg">Ton</span></h2>
                </div>
            </div>
            <!-- Stat Card 2 -->
            <div class="bg-white border border-outline-variant p-lg rounded-xl flex flex-col justify-between group hover:shadow-lg transition-all duration-300">
                <div class="flex justify-between items-start">
                    <div class="p-sm bg-tertiary-container rounded-full text-on-tertiary-container">
                        <span class="material-symbols-outlined">water_drop</span>
                    </div>
                    <span class="text-label-sm font-bold text-tertiary">Wilayah Kluwih</span>
                </div>
                <div class="mt-xl">
                    <p class="text-label-md text-on-surface-variant uppercase tracking-wider">Rata-rata Kadar Air</p>
                    <h2 class="text-headline-lg text-on-surface mt-xs">13.8 <span class="text-title-lg">%</span></h2>
                </div>
            </div>
            <!-- Stat Card 3 -->
            <div class="p-lg rounded-xl flex flex-col justify-between group hover:shadow-lg transition-all duration-300 bg-primary-container text-on-primary-container">
                <div class="flex justify-between items-start">
                    <div class="p-sm bg-on-primary-container rounded-full text-primary-container">
                        <span class="material-symbols-outlined">payments</span>
                    </div>
                    <span class="text-label-sm font-bold">Standard Grade A</span>
                </div>
                <div class="mt-xl">
                    <p class="text-label-md text-on-primary-container opacity-80 uppercase tracking-wider">Harga Beli Resmi Terkini</p>
                    <h2 class="text-headline-lg mt-xs">Rp 5.450 <span class="text-title-lg">/kg</span></h2>
                </div>
            </div>
        </div>
    </section>

    <!-- Charts & Filter Section -->
    <section class="px-container-margin py-lg max-w-7xl mx-auto w-full grid grid-cols-1 lg:grid-cols-4 gap-lg">
        <!-- Filter Sidebar -->
        <div class="lg:col-span-1 space-y-md">
            <div class="bg-white p-lg rounded-xl border border-outline-variant shadow-sm">
                <h3 class="text-title-lg font-bold mb-md flex items-center gap-sm" style="font-family: 'Libre Caslon Text', serif;">
                    <span class="material-symbols-outlined text-primary">filter_list</span> Filter Publik
                </h3>
                <div class="space-y-md">
                    <div>
                        <label class="text-label-md block mb-xs text-on-surface-variant">Periode Panen</label>
                        <select class="w-full border-outline-variant rounded-lg p-sm focus:ring-primary focus:border-primary text-body-md">
                            <option>November 2023</option>
                            <option>Oktober 2023</option>
                            <option>September 2023</option>
                        </select>
                    </div>
                    <div>
                        <label class="text-label-md block mb-xs text-on-surface-variant">Jenis Jagung</label>
                        <select class="w-full border-outline-variant rounded-lg p-sm focus:ring-primary focus:border-primary text-body-md">
                            <option>Semua Jenis</option>
                            <option>Hibrida</option>
                            <option>Manis</option>
                            <option>Pakan</option>
                        </select>
                    </div>
                    <button class="w-full bg-surface-container-high text-primary font-bold py-sm rounded-lg hover:bg-primary hover:text-on-primary transition-all duration-200">
                        Terapkan Filter
                    </button>
                </div>
            </div>
            <div class="bg-primary text-on-primary p-lg rounded-xl shadow-lg relative overflow-hidden group">
                <div class="relative z-10">
                    <h4 class="text-title-lg font-bold mb-sm" style="font-family: 'Libre Caslon Text', serif;">Ada Kendala Data?</h4>
                    <p class="text-label-md opacity-90 mb-md">Hubungi petugas gudang kami jika data setoran Anda belum muncul atau tidak sesuai.</p>
                    <button class="bg-white text-primary px-lg py-sm rounded-lg font-bold text-label-md active:scale-95 transition-all">Hubungi Petugas</button>
                </div>
                <span class="material-symbols-outlined absolute -bottom-4 -right-4 text-9xl opacity-10 group-hover:scale-110 transition-transform">support_agent</span>
            </div>
        </div>

        <!-- Trends Chart -->
        <div class="lg:col-span-3 bg-white p-lg rounded-xl border border-outline-variant shadow-sm overflow-hidden">
            <div class="flex justify-between items-center mb-lg">
                <div>
                    <h3 class="text-title-lg font-bold" style="font-family: 'Libre Caslon Text', serif;">Volume Setoran Wilayah</h3>
                    <p class="text-label-md text-on-surface-variant">Perbandingan produktivitas kolektif bulanan</p>
                </div>
                <div class="flex gap-sm">
                    <span class="flex items-center gap-xs text-label-sm text-primary">
                        <span class="w-3 h-3 bg-primary rounded-full"></span> Tonase Kolektif
                    </span>
                </div>
            </div>
            <div class="chart-container flex items-end justify-between gap-md px-md pb-xl">
                <div class="flex flex-col items-center gap-sm w-full group">
                    <div class="w-full bg-surface-container-low rounded-t-lg relative flex flex-col justify-end h-40">
                        <div class="bg-primary/60 w-full rounded-t-lg transition-all duration-500 group-hover:bg-primary" style="height: 65%;"></div>
                    </div>
                    <span class="text-label-sm text-on-surface-variant">Jun</span>
                </div>
                <div class="flex flex-col items-center gap-sm w-full group">
                    <div class="w-full bg-surface-container-low rounded-t-lg relative flex flex-col justify-end h-40">
                        <div class="bg-primary/60 w-full rounded-t-lg transition-all duration-500 group-hover:bg-primary" style="height: 45%;"></div>
                    </div>
                    <span class="text-label-sm text-on-surface-variant">Jul</span>
                </div>
                <div class="flex flex-col items-center gap-sm w-full group">
                    <div class="w-full bg-surface-container-low rounded-t-lg relative flex flex-col justify-end h-40">
                        <div class="bg-primary/60 w-full rounded-t-lg transition-all duration-500 group-hover:bg-primary" style="height: 85%;"></div>
                    </div>
                    <span class="text-label-sm text-on-surface-variant">Agu</span>
                </div>
                <div class="flex flex-col items-center gap-sm w-full group">
                    <div class="w-full bg-surface-container-low rounded-t-lg relative flex flex-col justify-end h-40">
                        <div class="bg-primary/60 w-full rounded-t-lg transition-all duration-500 group-hover:bg-primary" style="height: 60%;"></div>
                    </div>
                    <span class="text-label-sm text-on-surface-variant">Sep</span>
                </div>
                <div class="flex flex-col items-center gap-sm w-full group">
                    <div class="w-full bg-surface-container-low rounded-t-lg relative flex flex-col justify-end h-40">
                        <div class="bg-primary/60 w-full rounded-t-lg transition-all duration-500 group-hover:bg-primary" style="height: 75%;"></div>
                    </div>
                    <span class="text-label-sm text-on-surface-variant">Okt</span>
                </div>
                <div class="flex flex-col items-center gap-sm w-full group">
                    <div class="w-full bg-surface-container-low rounded-t-lg relative flex flex-col justify-end h-40 border-2 border-primary border-dashed">
                        <div class="bg-primary w-full rounded-t-lg transition-all duration-500" style="height: 95%;"></div>
                    </div>
                    <span class="text-label-sm text-primary font-bold">Nov</span>
                </div>
            </div>
        </div>
    </section>

    <!-- Data Table Section -->
    <section class="px-container-margin py-lg max-w-7xl mx-auto w-full">
        <div class="bg-white rounded-xl border border-outline-variant shadow-sm overflow-hidden">
            <div class="p-lg border-b border-outline-variant flex flex-col md:flex-row justify-between items-center gap-md">
                <h3 class="text-title-lg font-bold" style="font-family: 'Libre Caslon Text', serif;">Riwayat Setoran (Publik)</h3>
                <div class="flex items-center gap-sm w-full md:w-auto">
                    <p class="text-label-sm text-on-surface-variant italic">Data dianonymisasi untuk privasi</p>
                </div>
            </div>
            <div class="overflow-x-auto custom-scrollbar">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-surface-container-lowest">
                        <tr>
                            <th class="px-lg py-md text-label-md text-on-surface-variant uppercase">Tanggal Setor</th>
                            <th class="px-lg py-md text-label-md text-on-surface-variant uppercase">Petani (Anonym)</th>
                            <th class="px-lg py-md text-label-md text-on-surface-variant uppercase">Jenis Jagung</th>
                            <th class="px-lg py-md text-label-md text-on-surface-variant uppercase text-right">Berat (kg)</th>
                            <th class="px-lg py-md text-label-md text-on-surface-variant uppercase text-center">Kadar Air (%)</th>
                            <th class="px-lg py-md text-label-md text-on-surface-variant uppercase text-center">Grade</th>
                            <th class="px-lg py-md text-label-md text-on-surface-variant uppercase">Status</th>
                            <th class="px-lg py-md"></th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-outline-variant">
                        <tr class="hover:bg-surface-container-low transition-colors group">
                            <td class="px-lg py-md text-body-md">12 Nov 2023</td>
                            <td class="px-lg py-md text-body-md">Bpk. A*** S***</td>
                            <td class="px-lg py-md font-bold text-primary">Hibrida Superior</td>
                            <td class="px-lg py-md text-body-md text-right">4,250</td>
                            <td class="px-lg py-md text-center">
                                <span class="px-sm py-1 rounded-full bg-secondary-container text-on-secondary-container text-label-sm">13.5%</span>
                            </td>
                            <td class="px-lg py-md text-center font-bold">A</td>
                            <td class="px-lg py-md">
                                <span class="flex items-center gap-xs text-primary font-bold text-label-md">
                                    <span class="material-symbols-outlined text-sm" style="font-variation-settings: 'FILL' 1;">verified</span> Verified
                                </span>
                            </td>
                            <td class="px-lg py-md text-right">
                                <button class="opacity-0 group-hover:opacity-100 transition-opacity text-primary"><span class="material-symbols-outlined">visibility</span></button>
                            </td>
                        </tr>
                        <tr class="hover:bg-surface-container-low transition-colors group">
                            <td class="px-lg py-md text-body-md">08 Nov 2023</td>
                            <td class="px-lg py-md text-body-md">Ibu S*** A***</td>
                            <td class="px-lg py-md font-bold text-primary">Jagung Manis B1</td>
                            <td class="px-lg py-md text-body-md text-right">1,800</td>
                            <td class="px-lg py-md text-center">
                                <span class="px-sm py-1 rounded-full bg-tertiary-container text-on-tertiary-container text-label-sm">15.2%</span>
                            </td>
                            <td class="px-lg py-md text-center font-bold">B</td>
                            <td class="px-lg py-md">
                                <span class="flex items-center gap-xs text-on-surface-variant font-medium text-label-md italic">
                                    <span class="material-symbols-outlined text-sm">cycle</span> Processed
                                </span>
                            </td>
                            <td class="px-lg py-md text-right">
                                <button class="opacity-0 group-hover:opacity-100 transition-opacity text-primary"><span class="material-symbols-outlined">visibility</span></button>
                            </td>
                        </tr>
                        <tr class="hover:bg-surface-container-low transition-colors group">
                            <td class="px-lg py-md text-body-md">25 Okt 2023</td>
                            <td class="px-lg py-md text-body-md">Bpk. J*** S***</td>
                            <td class="px-lg py-md font-bold text-primary">Hibrida Superior</td>
                            <td class="px-lg py-md text-body-md text-right">5,100</td>
                            <td class="px-lg py-md text-center">
                                <span class="px-sm py-1 rounded-full bg-secondary-container text-on-secondary-container text-label-sm">14.0%</span>
                            </td>
                            <td class="px-lg py-md text-center font-bold">A</td>
                            <td class="px-lg py-md">
                                <span class="flex items-center gap-xs text-primary font-bold text-label-md">
                                    <span class="material-symbols-outlined text-sm" style="font-variation-settings: 'FILL' 1;">verified</span> Verified
                                </span>
                            </td>
                            <td class="px-lg py-md text-right">
                                <button class="opacity-0 group-hover:opacity-100 transition-opacity text-primary"><span class="material-symbols-outlined">visibility</span></button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="p-md bg-surface-container-lowest flex justify-between items-center text-label-md text-on-surface-variant">
                <p class="">Menampilkan data publik wilayah</p>
                <div class="flex gap-sm">
                    <button class="px-md py-1 border border-outline-variant rounded-lg hover:bg-surface-container transition-all">Sebelumnya</button>
                    <button class="px-md py-1 bg-primary text-on-primary rounded-lg shadow-sm">1</button>
                    <button class="px-md py-1 border border-outline-variant rounded-lg hover:bg-surface-container transition-all">2</button>
                    <button class="px-md py-1 border border-outline-variant rounded-lg hover:bg-surface-container transition-all">Berikutnya</button>
                </div>
            </div>
        </div>
    </section>

    <!-- Final CTA -->
    <section class="max-w-7xl mx-auto px-container-margin py-xl mb-xl">
        <div class="relative bg-surface-container-high rounded-3xl p-xl flex flex-col md:flex-row items-center justify-between gap-xl overflow-hidden shadow-sm">
            <div class="relative z-10 max-w-xl text-center md:text-left">
                <h2 class="text-headline-lg text-primary mb-md" style="font-family: 'Libre Caslon Text', serif;">Akses Layanan Unggulan Gudang Kluwih</h2>
                <p class="text-body-lg text-on-surface-variant">Butuh informasi lebih lanjut mengenai penjadwalan dryer atau ingin berkonsultasi dengan tim ahli kami? Kami siap membantu operasional panen Anda.</p>
            </div>
            <div class="relative z-10 flex flex-col sm:flex-row gap-md">
                <button class="bg-primary text-on-primary px-xl py-md rounded-xl font-bold text-title-lg shadow-lg hover:scale-105 active:scale-95 transition-all">Hubungi Petugas Gudang</button>
                <button class="bg-white text-primary border-2 border-primary px-xl py-md rounded-xl font-bold text-title-lg hover:bg-primary-container/10 transition-all">Lihat Panduan Harga</button>
            </div>
            <div class="absolute right-0 top-0 w-1/2 h-full pointer-events-none opacity-20">
                <div class="w-full h-full bg-cover bg-center" style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuBfj9X5PUOhbBKjG1k-PColGtvyJNJzapwJfQsu5eP7Ib7_D9xiU2voul5hHNY31pC3FvhwzV6Npsf02uPU7SYxa5YkHaFw249MJdX_yJ2ixjm9qCeOG4aBDYWE0E84wPJ3oexBxfySbE9ItVL0l4_CwPwxDbPge2TON7RrSGDU75Eckfl_OVw_SmYuhTs0IxzvZKpgQf-Oz5ILsoCk8Ga0Fs3_9p_qKcQhD6UGgLERdxyVbTZ--2x5vQ')"></div>
            </div>
        </div>
    </section>
</main>
@endsection

@push('scripts')
<script>
    document.querySelectorAll('button').forEach(btn => {
        btn.addEventListener('click', function(e) {
            let x = e.clientX - e.target.offsetLeft;
            let y = e.clientY - e.target.offsetTop;
            let ripples = document.createElement('span');
            ripples.style.left = x + 'px';
            ripples.style.top = y + 'px';
            this.appendChild(ripples);
            setTimeout(() => { ripples.remove() }, 1000);
        });
    });
</script>
@endpush