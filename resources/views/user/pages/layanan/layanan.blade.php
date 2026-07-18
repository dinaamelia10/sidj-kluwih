@extends('user.layout.master')

@section('title', 'Eksplorasi Layanan - SIDJ-Kluwih')

@section('content')
<!-- Menyuntikkan konfigurasi tema asli milikmu agar di-render oleh Tailwind CDN master -->
<script>
    try {
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "inverse-surface": "#263143",
                        "surface": "#f9f9ff",
                        "on-background": "#111c2d",
                        "surface-container-lowest": "#ffffff",
                        "on-primary": "#ffffff",
                        "on-tertiary-container": "#ffefd7",
                        "outline": "#707a6c",
                        "background": "#f9f9ff",
                        "surface-variant": "#d8e3fb",
                        "surface-container-low": "#f0f3ff",
                        "surface-container-high": "#dee8ff",
                        "on-primary-container": "#cbffc2",
                        "secondary-container": "#91f78e",
                        "surface-container": "#e7eeff",
                        "tertiary-container": "#8c6800",
                        "secondary": "#006e1c",
                        "inverse-primary": "#88d982",
                        "surface-tint": "#1b6d24",
                        "primary-fixed": "#a3f69c",
                        "on-surface-variant": "#40493d",
                        "outline-variant": "#bfcaba",
                        "error": "#ba1a1a",
                        "secondary-fixed-dim": "#78dc77",
                        "on-error": "#ffffff",
                        "tertiary-fixed-dim": "#f8bd2a",
                        "on-tertiary-fixed": "#261a00",
                        "tertiary": "#6e5100",
                        "surface-bright": "#f9f9ff",
                        "primary-container": "#2e7d32",
                        "on-secondary": "#ffffff",
                        "on-secondary-container": "#00731e",
                        "primary-fixed-dim": "#88d982",
                        "on-error-container": "#93000a",
                        "tertiary-fixed": "#ffdfa0",
                        "primary": "#0d631b",
                        "secondary-fixed": "#94f990",
                        "on-secondary-fixed-variant": "#005313",
                        "on-primary-fixed-variant": "#005312",
                        "surface-dim": "#cfdaf2",
                        "error-container": "#ffdad6",
                        "on-tertiary": "#ffffff",
                        "surface-container-highest": "#d8e3fb",
                        "on-surface": "#111c2d",
                        "on-tertiary-fixed-variant": "#5c4300",
                        "on-primary-fixed": "#002204",
                        "on-secondary-fixed": "#002204",
                        "inverse-on-surface": "#ecf1ff"
                    },
                    "borderRadius": {
                        "DEFAULT": "0.25rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
                        "full": "9999px"
                    },
                    "spacing": {
                        "xs": "4px",
                        "sm": "8px",
                        "gutter": "20px",
                        "md": "16px",
                        "lg": "24px",
                        "container-margin": "24px",
                        "base": "4px",
                        "xl": "40px"
                    },
                    "fontFamily": {
                        "headline-md": ["Inter"],
                        "headline-lg": ["Inter"],
                        "display": ["Inter"],
                        "body-md": ["Inter"],
                        "title-lg": ["Inter"],
                        "headline-lg-mobile": ["Inter"],
                        "body-lg": ["Inter"],
                        "label-md": ["Inter"],
                        "label-sm": ["Inter"]
                    },
                    "fontSize": {
                        "headline-md": ["24px", {"lineHeight": "32px", "fontWeight": "600"}],
                        "headline-lg": ["32px", {"lineHeight": "40px", "letterSpacing": "-0.01em", "fontWeight": "600"}],
                        "display": ["48px", {"lineHeight": "1.2", "letterSpacing": "-0.02em", "fontWeight": "700"}],
                        "body-md": ["16px", {"lineHeight": "24px", "fontWeight": "400"}],
                        "title-lg": ["20px", {"lineHeight": "28px", "fontWeight": "600"}],
                        "headline-lg-mobile": ["24px", {"lineHeight": "32px", "fontWeight": "600"}],
                        "body-lg": ["18px", {"lineHeight": "28px", "fontWeight": "400"}],
                        "label-md": ["14px", {"lineHeight": "20px", "letterSpacing": "0.01em", "fontWeight": "500"}],
                        "label-sm": ["12px", {"lineHeight": "16px", "letterSpacing": "0.05em", "fontWeight": "600"}]
                    }
                },
            },
        }
    } catch (_e) {}
</script>

<style>
    .bento-grid {
        display: grid;
        grid-template-columns: repeat(12, 1fr);
        gap: 24px;
    }
    .soft-card {
        background: white;
        border: 1px solid #E2E8F0;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -2px rgba(0, 0, 0, 0.05);
        border-radius: 1rem;
    }
</style>

<main class="pt-24 pb-xl">
    <!-- Hero Section -->
    <section class="max-w-7xl mx-auto px-lg mb-xl">
        <div class="flex flex-col md:flex-row items-center gap-xl">
            <div class="w-full md:w-1/2">
                <span class="inline-block px-md py-xs bg-secondary-container text-on-secondary-container rounded-full font-label-sm mb-md uppercase tracking-wider">Eksplorasi Layanan</span>
                <h1 class="font-display text-display text-on-background mb-md">Modernisasi Pasca Panen Berbasis IoT.</h1>
                <p class="font-body-lg text-body-lg text-on-surface-variant max-w-xl">
                    Kami menghadirkan transparansi dan efisiensi melalui integrasi teknologi digital pada setiap tahap pengelolaan jagung Anda.
                </p>
            </div>
            <div class="w-full md:w-1/2 h-80 relative overflow-hidden rounded-xl">
                <div class="w-full h-full bg-cover bg-center" style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuDv51_tLjnR_goQL3zDtYxdFxen51j-LCHgxu568qXXe9bEW6in4u-3IzLSW_n1-Ok2JYc14595CkiKkUds6ihuqkp21RXzxHPe7GBAHogt0CamejqL8zyj2PpkDGapXguIAnUNY6PJtHC3jNIeYLNW-gVKuZmyl0EID1l0LFyvzmRspTbFqfm-nIWNZCMmSMxlhLQasrF3_4ILJo--Bcu0U-T6Www9PXQLuqdOwRAL7zPsxzw3UUqWEQ')"></div>
            </div>
        </div>
    </section>

    <!-- 1. Smart Dryer Monitoring Section -->
    <section class="max-w-7xl mx-auto px-lg mb-xl">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-lg items-start">
            <div class="lg:col-span-5">
                <h2 class="font-headline-lg text-headline-lg text-on-background mb-md">Smart Dryer Monitoring</h2>
                <p class="font-body-md text-body-md text-on-surface-variant mb-lg">
                    Sistem pemantauan pengeringan cerdas kami memastikan kualitas jagung tetap terjaga dengan kontrol parameter yang presisi secara real-time.
                </p>
                <div class="space-y-md">
                    <div class="flex items-center gap-md">
                        <div class="w-10 h-10 rounded-full bg-tertiary-fixed flex items-center justify-center text-on-tertiary-fixed">
                            <span class="material-symbols-outlined">thermostat</span>
                        </div>
                        <div>
                            <h4 class="font-label-md text-label-md">Rentang Suhu Presisi</h4>
                            <p class="text-label-sm text-on-surface-variant">Stabilisasi otomatis pada 35-80°C.</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-md">
                        <div class="w-10 h-10 rounded-full bg-secondary-fixed flex items-center justify-center text-on-secondary-fixed">
                            <span class="material-symbols-outlined">humidity_percentage</span>
                        </div>
                        <div>
                            <h4 class="font-label-md text-label-md">Sensor Kelembaban</h4>
                            <p class="text-label-sm text-on-surface-variant">Akurasi tinggi untuk deteksi kadar air optimal.</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-md">
                        <div class="w-10 h-10 rounded-full bg-primary-fixed flex items-center justify-center text-on-primary-fixed">
                            <span class="material-symbols-outlined">notifications_active</span>
                        </div>
                        <div>
                            <h4 class="font-label-md text-label-md">Notifikasi Real-time</h4>
                            <p class="text-label-sm text-on-surface-variant">Peringatan otomatis via aplikasi jika parameter melampaui batas.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="lg:col-span-7 soft-card p-lg">
                <div class="flex justify-between items-center mb-lg">
                    <h3 class="font-title-lg text-title-lg">Dashboard Smart Dryer #04</h3>
                    <span class="bg-primary-container text-on-primary-container px-md py-xs rounded-full text-label-sm animate-pulse">AKTIF</span>
                </div>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-md mb-lg">
                    <div class="p-md bg-surface-container-low rounded-lg text-center">
                        <p class="text-label-sm text-on-surface-variant">Suhu</p>
                        <p class="text-headline-md text-primary">62.5°C</p>
                    </div>
                    <div class="p-md bg-surface-container-low rounded-lg text-center">
                        <p class="text-label-sm text-on-surface-variant">Kelembaban</p>
                        <p class="text-headline-md text-primary">14.2%</p>
                    </div>
                    <div class="p-md bg-surface-container-low rounded-lg text-center">
                        <p class="text-label-sm text-on-surface-variant">Durasi</p>
                        <p class="text-headline-md text-primary">02:45</p>
                    </div>
                    <div class="p-md bg-surface-container-low rounded-lg text-center">
                        <p class="text-label-sm text-on-surface-variant">Beban</p>
                        <p class="text-headline-md text-primary">4.2 T</p>
                    </div>
                </div>
                <div class="h-48 w-full bg-surface-container flex items-end gap-xs p-sm rounded-lg overflow-hidden border border-outline-variant">
                    <div class="bg-primary flex-1 rounded-t" style="height: 40%"></div>
                    <div class="bg-primary flex-1 rounded-t" style="height: 55%"></div>
                    <div class="bg-primary flex-1 rounded-t" style="height: 50%"></div>
                    <div class="bg-primary flex-1 rounded-t" style="height: 70%"></div>
                    <div class="bg-primary flex-1 rounded-t" style="height: 85%"></div>
                    <div class="bg-primary flex-1 rounded-t" style="height: 90%"></div>
                    <div class="bg-primary-container flex-1 rounded-t" style="height: 95%"></div>
                    <div class="bg-primary-container flex-1 rounded-t" style="height: 80%"></div>
                    <div class="bg-primary flex-1 rounded-t" style="height: 60%"></div>
                    <div class="bg-primary flex-1 rounded-t" style="height: 45%"></div>
                </div>
                <p class="text-label-sm text-on-surface-variant mt-sm text-center italic">Visualisasi Tren Suhu &amp; Kelembaban (Interval 30 Menit)</p>
            </div>
        </div>
    </section>

    <!-- 2. Manajemen Tonase Digital Section -->
    <section class="bg-on-background py-xl mb-xl">
        <div class="max-w-7xl mx-auto px-lg">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-xl items-center">
                <div class="order-2 md:order-1">
                    <div class="soft-card p-lg bg-surface-container-highest border-none shadow-xl">
                        <div class="flex items-center gap-md mb-lg">
                            <div class="w-12 h-12 bg-primary flex items-center justify-center rounded-xl">
                                <span class="material-symbols-outlined text-on-primary">scale</span>
                            </div>
                            <div>
                                <h3 class="font-headline-md text-on-surface">Validasi Berat Digital</h3>
                                <p class="text-label-sm text-on-surface-variant">Terintegrasi Database Petani</p>
                            </div>
                        </div>
                        <div class="space-y-sm">
                            <div class="flex justify-between p-sm bg-surface-container-lowest rounded-lg">
                                <span>ID Petani</span>
                                <span class="font-bold">KLU-8829-01</span>
                            </div>
                            <div class="flex justify-between p-sm bg-surface-container-lowest rounded-lg">
                                <span>Status Timbangan</span>
                                <span class="text-secondary font-bold">Terverifikasi</span>
                            </div>
                            <div class="flex justify-between p-sm bg-surface-container-lowest rounded-lg">
                                <span>Berat Bruto</span>
                                <span class="font-bold">5.240 Kg</span>
                            </div>
                            <div class="mt-lg pt-md border-t border-outline-variant">
                                <div class="flex items-center gap-sm text-primary text-label-sm">
                                    <span class="material-symbols-outlined text-sm">verified_user</span>
                                    Data terkunci otomatis &amp; tidak dapat dimanipulasi manual.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="order-1 md:order-2 text-on-primary">
                    <h2 class="font-headline-lg text-headline-lg mb-md">Mainajemen Tonase Digital</h2>
                    <p class="font-body-md text-body-md opacity-80 mb-lg">
                        Kejujuran adalah pondasi ekosistem kami. Dengan timbangan digital yang terhubung langsung ke pusat data, setiap gram hasil panen Anda tercatat dengan presisi tanpa celah manipulasi.
                    </p>
                    <ul class="space-y-md">
                        <li class="flex gap-md">
                            <span class="material-symbols-outlined text-secondary-fixed">check_circle</span>
                            <span><strong>Pencatatan Otomatis:</strong> Nilai berat langsung terkirim ke profil digital petani tanpa input manual.</span>
                        </li>
                        <li class="flex gap-md">
                            <span class="material-symbols-outlined text-secondary-fixed">check_circle</span>
                            <span><strong>Proteksi Data:</strong> Enkripsi end-to-end mencegah perubahan data oleh operator lapangan.</span>
                        </li>
                        <li class="flex gap-md">
                            <span class="material-symbols-outlined text-secondary-fixed">check_circle</span>
                            <span><strong>Integrasi Langsung:</strong> Data tonase menjadi basis instan untuk perhitungan nilai transaksi.</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- 3. Transparansi Harga & Grade -->
    <section class="max-w-7xl mx-auto px-lg mb-xl">
        <div class="text-center mb-xl">
            <h2 class="font-headline-lg text-headline-lg mb-sm">Transparansi Harga Berdasarkan Grade</h2>
            <p class="font-body-md text-body-md text-on-surface-variant max-w-2xl mx-auto">
                Keadilan harga didasarkan pada kualitas objektif. Sistem kami secara otomatis mengkalkulasi harga menggunakan matriks kadar air dan kemurnian biji.
            </p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-lg">
            <!-- Grade A -->
            <div class="soft-card p-lg border-t-4 border-t-primary">
                <div class="flex justify-between items-start mb-md">
                    <div>
                        <span class="font-display text-headline-lg text-primary">Grade A</span>
                        <p class="text-label-sm text-on-surface-variant">Kualitas Premium</p>
                    </div>
                    <span class="material-symbols-outlined text-primary text-4xl">workspace_premium</span>
                </div>
                <ul class="space-y-sm mb-lg">
                    <li class="flex justify-between text-body-md"><span>Kadar Air</span> <span>&lt; 14%</span></li>
                    <li class="flex justify-between text-body-md"><span>Biji Rusak</span> <span>&lt; 2%</span></li>
                    <li class="flex justify-between text-body-md"><span>Benda Asing</span> <span>&lt; 1%</span></li>
                </ul>
                <div class="bg-surface-container p-md rounded-lg text-center">
                    <p class="text-label-sm text-on-surface-variant">Estimasi Harga</p>
                    <p class="text-title-lg font-bold text-on-surface">Rp 5.200 / Kg</p>
                </div>
            </div>
            <!-- Grade B -->
            <div class="soft-card p-lg border-t-4 border-t-secondary">
                <div class="flex justify-between items-start mb-md">
                    <div>
                        <span class="font-display text-headline-lg text-secondary">Grade B</span>
                        <p class="text-label-sm text-on-surface-variant">Kualitas Standar</p>
                    </div>
                    <span class="material-symbols-outlined text-secondary text-4xl">grade</span>
                </div>
                <ul class="space-y-sm mb-lg">
                    <li class="flex justify-between text-body-md"><span>Kadar Air</span> <span>14% - 17%</span></li>
                    <li class="flex justify-between text-body-md"><span>Biji Rusak</span> <span>2% - 5%</span></li>
                    <li class="flex justify-between text-body-md"><span>Benda Asing</span> <span>1% - 3%</span></li>
                </ul>
                <div class="bg-surface-container p-md rounded-lg text-center">
                    <p class="text-label-sm text-on-surface-variant">Estimasi Harga</p>
                    <p class="text-title-lg font-bold text-on-surface">Rp 4.800 / Kg</p>
                </div>
            </div>
            <!-- Grade C -->
            <div class="soft-card p-lg border-t-4 border-t-tertiary">
                <div class="flex justify-between items-start mb-md">
                    <div>
                        <span class="font-display text-headline-lg text-tertiary">Grade C</span>
                        <p class="text-label-sm text-on-surface-variant">Kualitas Rendah</p>
                    </div>
                    <span class="material-symbols-outlined text-tertiary text-4xl">priority_high</span>
                </div>
                <ul class="space-y-sm mb-lg">
                    <li class="flex justify-between text-body-md"><span>Kadar Air</span> <span>&gt; 17%</span></li>
                    <li class="flex justify-between text-body-md"><span>Biji Rusak</span> <span>&gt; 5%</span></li>
                    <li class="flex justify-between text-body-md"><span>Benda Asing</span> <span>&gt; 3%</span></li>
                </ul>
                <div class="bg-surface-container p-md rounded-lg text-center">
                    <p class="text-label-sm text-on-surface-variant">Estimasi Harga</p>
                    <p class="text-title-lg font-bold text-on-surface">Rp 4.300 / Kg</p>
                </div>
            </div>
        </div>
    </section>

    <!-- 4. Interactive FAQ & Process Flow -->
    <section class="max-w-4xl mx-auto px-lg mb-xl">
        <h2 class="font-headline-lg text-headline-lg text-center mb-xl">Alur Kerja Digital Petani</h2>
        <div class="relative">
            <div class="absolute left-6 top-0 bottom-0 w-0.5 bg-outline-variant hidden md:block"></div>
            <div class="space-y-lg relative">
                <!-- Step 1 -->
                <div class="flex flex-col md:flex-row gap-lg">
                    <div class="flex-shrink-0 w-12 h-12 rounded-full bg-primary text-on-primary flex items-center justify-center font-bold text-xl z-10">1</div>
                    <div class="soft-card p-md flex-grow">
                        <h4 class="font-title-lg text-title-lg mb-xs">Registrasi &amp; Drop-off</h4>
                        <p class="text-body-md text-on-surface-variant">Petani mendaftarkan hasil panen melalui aplikasi dan menyerahkan jagung di titik pengumpulan resmi.</p>
                    </div>
                </div>
                <!-- Step 2 -->
                <div class="flex flex-col md:flex-row gap-lg">
                    <div class="flex-shrink-0 w-12 h-12 rounded-full bg-primary text-on-primary flex items-center justify-center font-bold text-xl z-10">2</div>
                    <div class="soft-card p-md flex-grow">
                        <h4 class="font-title-lg text-title-lg mb-xs">Uji Lab &amp; Grading</h4>
                        <p class="text-body-md text-on-surface-variant">Sampel jagung diuji kadar airnya menggunakan alat sensor digital untuk menentukan grade harga.</p>
                    </div>
                </div>
                <!-- Step 3 -->
                <div class="flex flex-col md:flex-row gap-lg">
                    <div class="flex-shrink-0 w-12 h-12 rounded-full bg-primary text-on-primary flex items-center justify-center font-bold text-xl z-10">3</div>
                    <div class="soft-card p-md flex-grow">
                        <h4 class="font-title-lg text-title-lg mb-xs">Proses Pengeringan</h4>
                        <p class="text-body-md text-on-surface-variant">Jagung dikeringkan di Smart Dryer dengan pemantauan suhu IoT hingga mencapai kadar air yang ditargetkan.</p>
                    </div>
                </div>
                <!-- Step 4 -->
                <div class="flex flex-col md:flex-row gap-lg">
                    <div class="flex-shrink-0 w-12 h-12 rounded-full bg-primary text-on-primary flex items-center justify-center font-bold text-xl z-10">4</div>
                    <div class="soft-card p-md flex-grow">
                        <h4 class="font-title-lg text-title-lg mb-xs">Pembayaran Otomatis</h4>
                        <p class="text-body-md text-on-surface-variant">Dana cair langsung ke rekening petani berdasarkan data tonase dan grade yang telah terkunci di sistem.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- FAQ Section -->
        <div class="mt-xl border-t border-outline-variant pt-xl">
            <h3 class="font-headline-md text-headline-md mb-lg">Pertanyaan Umum (FAQ)</h3>
            <div class="space-y-md">
                <details class="group soft-card p-md cursor-pointer">
                    <summary class="flex justify-between items-center font-label-md list-none">
                        <span>Bagaimana jika data timbangan saya tidak sesuai?</span>
                        <span class="material-symbols-outlined group-open:rotate-180 transition-transform">expand_more</span>
                    </summary>
                    <p class="mt-md text-body-md text-on-surface-variant">Setiap timbangan kami dikalibrasi secara berkala dan hasil cetak digital dapat diverifikasi langsung melalui aplikasi petani Anda secara real-time.</p>
                </details>
                <details class="group soft-card p-md cursor-pointer">
                    <summary class="flex justify-between items-center font-label-md list-none">
                        <span>Apakah ada biaya tambahan untuk penggunaan Smart Dryer?</span>
                        <span class="material-symbols-outlined group-open:rotate-180 transition-transform">expand_more</span>
                    </summary>
                    <p class="mt-md text-body-md text-on-surface-variant">Biaya operasional dryer sudah termasuk dalam potongan margin harga sesuai dengan kesepakatan kemitraan yang transparan di awal.</p>
                </details>
                <details class="group soft-card p-md cursor-pointer">
                    <summary class="flex justify-between items-center font-label-md list-none">
                        <span>Berapa lama proses pencairan dana setelah jagung terjual?</span>
                        <span class="material-symbols-outlined group-open:rotate-180 transition-transform">expand_more</span>
                    </summary>
                    <p class="mt-md text-body-md text-on-surface-variant">Dana akan cair maksimal dalam 1x24 jam setelah proses administrasi tonase selesai divalidasi oleh sistem.</p>
                </details>
            </div>
        </div>
    </section>
</main>
@endsection

@push('scripts')
<script>
    document.querySelectorAll('details').forEach((el) => {
        el.addEventListener('click', () => {
            document.querySelectorAll('details').forEach((other) => {
                if (other !== el) other.removeAttribute('open');
            });
        });
    });
</script>
@endpush