@extends('user.layout.master')

@section('title', 'Layanan - SIDJ-Kluwih')

@section('content')
    {{-- Hero Section --}}
    <section class="max-w-7xl mx-auto px-6 lg:px-16 pt-10 pb-16">
        <div class="flex flex-col md:flex-row items-center gap-12">
            <div class="w-full md:w-1/2">
                <span class="inline-block px-4 py-1 bg-secondary-container text-on-secondary-container rounded-full text-xs font-semibold mb-4 uppercase tracking-wider">Eksplorasi Layanan</span>
                <h1 class="text-4xl lg:text-5xl font-bold text-on-background mb-4 leading-tight">Modernisasi Pasca Panen Berbasis IoT.</h1>
                <p class="text-lg text-on-surface-variant max-w-xl leading-relaxed">
                    Kami menghadirkan transparansi dan efisiensi melalui integrasi teknologi digital pada setiap tahap pengelolaan jagung Anda.
                </p>
            </div>
            <div class="w-full md:w-1/2 h-72 relative overflow-hidden rounded-2xl">
                <img class="w-full h-full object-cover" alt="Pengelolaan jagung modern"
                     src="https://images.unsplash.com/photo-1624053535062-5ac1b17bbb8e?w=800&q=80">
                <div class="absolute inset-0 bg-gradient-to-t from-primary/40 to-transparent"></div>
            </div>
        </div>
    </section>

    {{-- 1. Smart Dryer Monitoring --}}
    <section class="max-w-7xl mx-auto px-6 lg:px-16 mb-16">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
            <div class="lg:col-span-5">
                <span class="text-xs font-bold uppercase tracking-widest text-secondary mb-3 block">01 — IoT Monitoring</span>
                <h2 class="text-2xl lg:text-3xl font-bold text-on-background mb-4">Smart Dryer Monitoring</h2>
                <p class="text-on-surface-variant mb-6 leading-relaxed">
                    Sistem pemantauan pengeringan cerdas kami memastikan kualitas jagung tetap terjaga dengan kontrol parameter yang presisi secara real-time.
                </p>
                <div class="space-y-4">
                    <div class="flex items-center gap-4">
                        <div class="w-10 h-10 rounded-full bg-tertiary-fixed flex items-center justify-center text-on-tertiary-fixed flex-shrink-0">
                            <span class="material-symbols-outlined">thermostat</span>
                        </div>
                        <div>
                            <h4 class="font-semibold text-sm">Rentang Suhu Presisi</h4>
                            <p class="text-xs text-on-surface-variant">Stabilisasi otomatis pada 35–80°C.</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-4">
                        <div class="w-10 h-10 rounded-full bg-secondary-fixed flex items-center justify-center text-on-secondary-fixed flex-shrink-0">
                            <span class="material-symbols-outlined">humidity_percentage</span>
                        </div>
                        <div>
                            <h4 class="font-semibold text-sm">Sensor Kelembaban</h4>
                            <p class="text-xs text-on-surface-variant">Akurasi tinggi untuk deteksi kadar air optimal.</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-4">
                        <div class="w-10 h-10 rounded-full bg-primary-fixed flex items-center justify-center text-on-primary-fixed flex-shrink-0">
                            <span class="material-symbols-outlined">notifications_active</span>
                        </div>
                        <div>
                            <h4 class="font-semibold text-sm">Notifikasi Real-time</h4>
                            <p class="text-xs text-on-surface-variant">Peringatan otomatis jika parameter melampaui batas.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="lg:col-span-7 soft-card p-5">
                <div class="flex justify-between items-center mb-5">
                    <h3 class="font-bold text-lg text-on-surface">Dashboard Smart Dryer</h3>
                    <span class="bg-secondary-container text-on-secondary-container px-3 py-1 rounded-full text-xs font-bold animate-pulse">AKTIF</span>
                </div>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-3 mb-5">
                    @foreach([['label'=>'Suhu','val'=>'80°C','icon'=>'thermostat'],['label'=>'Kelembaban','val'=>'14.2%','icon'=>'water_drop'],['label'=>'Durasi','val'=>'02:45','icon'=>'timer'],['label'=>'Beban','val'=>'4.2 T','icon'=>'scale']] as $m)
                    <div class="p-3 bg-surface-container rounded-xl text-center">
                        <span class="material-symbols-outlined text-primary text-lg">{{ $m['icon'] }}</span>
                        <p class="text-xs text-on-surface-variant mt-1">{{ $m['label'] }}</p>
                        <p class="text-xl font-bold text-primary">{{ $m['val'] }}</p>
                    </div>
                    @endforeach
                </div>
                <div class="h-40 w-full bg-surface-container flex items-end gap-1 p-2 rounded-xl overflow-hidden border border-outline-variant">
                    @foreach([40,55,50,70,85,90,95,80,60,45] as $h)
                    <div class="bg-primary flex-1 rounded-t-sm transition-all hover:opacity-80" style="height:{{ $h }}%"></div>
                    @endforeach
                </div>
                <p class="text-xs text-on-surface-variant mt-2 text-center italic">Visualisasi Tren Suhu &amp; Kelembaban (Interval 30 Menit)</p>
            </div>
        </div>
    </section>

    {{-- 2. Manajemen Tonase Digital --}}
    <section class="bg-primary py-16 mb-16">
        <div class="max-w-7xl mx-auto px-6 lg:px-16">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
                <div class="order-2 md:order-1">
                    <div class="bg-surface-container-highest p-6 rounded-2xl shadow-xl border border-outline-variant/20">
                        <div class="flex items-center gap-3 mb-5">
                            <div class="w-12 h-12 bg-primary flex items-center justify-center rounded-xl">
                                <span class="material-symbols-outlined text-on-primary">scale</span>
                            </div>
                            <div>
                                <h3 class="font-bold text-on-surface">Validasi Berat Digital</h3>
                                <p class="text-xs text-on-surface-variant">Terintegrasi Database Petani</p>
                            </div>
                        </div>
                        <div class="space-y-2">
                            <div class="flex justify-between p-3 bg-surface rounded-lg text-sm">
                                <span class="text-on-surface-variant">ID Petani</span>
                                <span class="font-bold">KLU-8829-01</span>
                            </div>
                            <div class="flex justify-between p-3 bg-surface rounded-lg text-sm">
                                <span class="text-on-surface-variant">Status Timbangan</span>
                                <span class="text-secondary font-bold">Terverifikasi</span>
                            </div>
                            <div class="flex justify-between p-3 bg-surface rounded-lg text-sm">
                                <span class="text-on-surface-variant">Berat Bruto</span>
                                <span class="font-bold">5.240 Kg</span>
                            </div>
                            <div class="mt-4 pt-3 border-t border-outline-variant flex items-center gap-2 text-primary text-xs">
                                <span class="material-symbols-outlined text-sm">verified_user</span>
                                Data terkunci otomatis &amp; tidak dapat dimanipulasi manual.
                            </div>
                        </div>
                    </div>
                </div>
                <div class="order-1 md:order-2 text-on-primary">
                    <span class="text-xs font-bold uppercase tracking-widest text-secondary-fixed mb-3 block">02 — Tonase</span>
                    <h2 class="text-3xl font-bold mb-4">Manajemen Tonase Digital</h2>
                    <p class="text-on-primary/80 mb-6 leading-relaxed">
                        Dengan timbangan digital yang terhubung langsung ke pusat data, setiap gram hasil panen Anda tercatat dengan presisi tanpa celah manipulasi.
                    </p>
                    <ul class="space-y-3">
                        @foreach(['Pencatatan Otomatis: Nilai berat langsung terkirim ke profil digital petani tanpa input manual.','Proteksi Data: Enkripsi end-to-end mencegah perubahan data oleh operator lapangan.','Integrasi Langsung: Data tonase menjadi basis instan untuk perhitungan nilai transaksi.'] as $item)
                        @php [$bold, $rest] = explode(':', $item, 2); @endphp
                        <li class="flex gap-3">
                            <span class="material-symbols-outlined text-secondary-fixed flex-shrink-0">check_circle</span>
                            <span><strong>{{ $bold }}:</strong>{{ $rest }}</span>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </section>

    {{-- 3. Transparansi Harga & Grade --}}
    <section class="max-w-7xl mx-auto px-6 lg:px-16 mb-16">
        <div class="text-center mb-12">
            <span class="text-xs font-bold uppercase tracking-widest text-secondary mb-3 block">03 — Harga</span>
            <h2 class="text-3xl font-bold text-on-background mb-3">Transparansi Harga Berdasarkan Grade</h2>
            <p class="text-on-surface-variant max-w-2xl mx-auto">
                Sistem kami secara otomatis mengkalkulasi harga menggunakan matriks kadar air dan kemurnian biji.
                @if($gradeA !== '0') Harga dihitung berdasarkan data pasar terkini. @endif
            </p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="soft-card p-6 border-t-4 border-t-primary hover:-translate-y-1 transition-all">
                <div class="flex justify-between items-start mb-4">
                    <div>
                        <span class="text-2xl font-bold text-primary">Grade A</span>
                        <p class="text-xs text-on-surface-variant">Kualitas Premium</p>
                    </div>
                    <span class="material-symbols-outlined text-primary text-4xl">workspace_premium</span>
                </div>
                <ul class="space-y-2 mb-5 text-sm">
                    <li class="flex justify-between"><span class="text-on-surface-variant">Kadar Air</span> <span class="font-medium">&lt; 14%</span></li>
                    <li class="flex justify-between"><span class="text-on-surface-variant">Biji Rusak</span> <span class="font-medium">&lt; 2%</span></li>
                    <li class="flex justify-between"><span class="text-on-surface-variant">Benda Asing</span> <span class="font-medium">&lt; 1%</span></li>
                </ul>
                <div class="bg-surface-container p-4 rounded-xl text-center">
                    <p class="text-xs text-on-surface-variant">Estimasi Harga</p>
                    <p class="text-lg font-bold text-on-surface mt-1">Rp {{ $gradeA }} / Kg</p>
                </div>
            </div>
            <div class="soft-card p-6 border-t-4 border-t-secondary hover:-translate-y-1 transition-all">
                <div class="flex justify-between items-start mb-4">
                    <div>
                        <span class="text-2xl font-bold text-secondary">Grade B</span>
                        <p class="text-xs text-on-surface-variant">Kualitas Standar</p>
                    </div>
                    <span class="material-symbols-outlined text-secondary text-4xl">grade</span>
                </div>
                <ul class="space-y-2 mb-5 text-sm">
                    <li class="flex justify-between"><span class="text-on-surface-variant">Kadar Air</span> <span class="font-medium">14% – 17%</span></li>
                    <li class="flex justify-between"><span class="text-on-surface-variant">Biji Rusak</span> <span class="font-medium">2% – 5%</span></li>
                    <li class="flex justify-between"><span class="text-on-surface-variant">Benda Asing</span> <span class="font-medium">1% – 3%</span></li>
                </ul>
                <div class="bg-surface-container p-4 rounded-xl text-center">
                    <p class="text-xs text-on-surface-variant">Estimasi Harga</p>
                    <p class="text-lg font-bold text-on-surface mt-1">Rp {{ $gradeB }} / Kg</p>
                </div>
            </div>
            <div class="soft-card p-6 border-t-4 border-t-tertiary hover:-translate-y-1 transition-all">
                <div class="flex justify-between items-start mb-4">
                    <div>
                        <span class="text-2xl font-bold text-tertiary">Grade C</span>
                        <p class="text-xs text-on-surface-variant">Kualitas Rendah</p>
                    </div>
                    <span class="material-symbols-outlined text-tertiary text-4xl">priority_high</span>
                </div>
                <ul class="space-y-2 mb-5 text-sm">
                    <li class="flex justify-between"><span class="text-on-surface-variant">Kadar Air</span> <span class="font-medium">&gt; 17%</span></li>
                    <li class="flex justify-between"><span class="text-on-surface-variant">Biji Rusak</span> <span class="font-medium">&gt; 5%</span></li>
                    <li class="flex justify-between"><span class="text-on-surface-variant">Benda Asing</span> <span class="font-medium">&gt; 3%</span></li>
                </ul>
                <div class="bg-surface-container p-4 rounded-xl text-center">
                    <p class="text-xs text-on-surface-variant">Estimasi Harga</p>
                    <p class="text-lg font-bold text-on-surface mt-1">Rp {{ $gradeC }} / Kg</p>
                </div>
            </div>
        </div>
    </section>

    {{-- 4. Alur Kerja & FAQ --}}
    <section class="max-w-4xl mx-auto px-6 lg:px-16 mb-16">
        <span class="text-xs font-bold uppercase tracking-widest text-secondary mb-3 block text-center">04 — Alur Kerja</span>
        <h2 class="text-3xl font-bold text-on-background text-center mb-12">Alur Kerja Digital Petani</h2>
        <div class="relative">
            <div class="absolute left-6 top-0 bottom-0 w-0.5 bg-outline-variant hidden md:block"></div>
            <div class="space-y-6 relative">
                @php
                    $steps = [
                        ['t'=>'Registrasi & Drop-off','d'=>'Petani mendaftarkan hasil panen melalui aplikasi dan menyerahkan jagung di titik pengumpulan resmi.'],
                        ['t'=>'Uji Lab & Grading','d'=>'Sampel jagung diuji kadar airnya menggunakan alat sensor digital untuk menentukan grade harga.'],
                        ['t'=>'Proses Pengeringan','d'=>'Jagung dikeringkan di Smart Dryer dengan pemantauan suhu IoT hingga mencapai kadar air yang ditargetkan.'],
                        ['t'=>'Pembayaran Otomatis','d'=>'Dana cair langsung ke rekening petani berdasarkan data tonase dan grade yang telah terkunci di sistem.'],
                    ];
                @endphp
                @foreach($steps as $i => $s)
                <div class="flex flex-col md:flex-row gap-5">
                    <div class="flex-shrink-0 w-12 h-12 rounded-full bg-primary text-on-primary flex items-center justify-center font-bold text-lg z-10">{{ $i+1 }}</div>
                    <div class="soft-card p-4 flex-grow">
                        <h4 class="font-bold text-base mb-1 text-on-surface">{{ $s['t'] }}</h4>
                        <p class="text-sm text-on-surface-variant">{{ $s['d'] }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        {{-- FAQ --}}
        <div class="mt-12 border-t border-outline-variant pt-12">
            <h3 class="text-2xl font-bold mb-6 text-on-background">Pertanyaan Umum (FAQ)</h3>
            <div class="space-y-3">
                @php
                    $faqs = [
                        ['q'=>'Bagaimana jika data timbangan saya tidak sesuai?','a'=>'Setiap timbangan kami dikalibrasi secara berkala dan hasil cetak digital dapat diverifikasi langsung melalui aplikasi petani Anda secara real-time.'],
                        ['q'=>'Apakah ada biaya tambahan untuk penggunaan Smart Dryer?','a'=>'Biaya operasional dryer sudah termasuk dalam potongan margin harga sesuai dengan kesepakatan kemitraan yang transparan di awal.'],
                        ['q'=>'Berapa lama proses pencairan dana setelah jagung terjual?','a'=>'Dana akan cair maksimal dalam 1x24 jam setelah proses administrasi tonase selesai divalidasi oleh sistem.'],
                    ];
                @endphp
                @foreach($faqs as $faq)
                <details class="group soft-card p-4 cursor-pointer">
                    <summary class="flex justify-between items-center font-semibold text-sm list-none">
                        <span>{{ $faq['q'] }}</span>
                        <span class="material-symbols-outlined group-open:rotate-180 transition-transform flex-shrink-0 ml-3">expand_more</span>
                    </summary>
                    <p class="mt-3 text-sm text-on-surface-variant leading-relaxed">{{ $faq['a'] }}</p>
                </details>
                @endforeach
            </div>
        </div>
    </section>
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