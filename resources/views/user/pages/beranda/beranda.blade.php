@extends('user.layout.master')

@section('title', 'SIDJ-Kluwih | Agro-Modernist Precision')

@section('content')
    <main>
        <!-- Hero Section -->
        <section class="hero-gradient pt-32 pb-20 px-6 lg:px-40 min-h-screen flex items-center">
            <div class="max-w-[1200px] mx-auto w-full grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div class="flex flex-col gap-8 reveal active">
                    <div class="flex flex-col gap-4">
                        <span class="text-secondary font-semibold tracking-widest text-xs uppercase">Teknologi Pertanian
                            4.0</span>
                        <h1 class="font-headline text-4xl lg:text-6xl text-primary leading-[1.1] font-bold">
                            Satu Data Terpadu untuk <span class="text-secondary italic">Jagung Kluwih</span> Berkualitas
                        </h1>
                        <p class="text-lg text-secondary/80 max-w-lg leading-relaxed">
                            Platform Agri-Tech berbasis IoT untuk pemantauan suhu, tonase hasil panen, dan transparansi
                            harga dalam satu ekosistem digital.
                        </p>
                    </div>
                    <div class="flex flex-wrap gap-4">
                        <button
                            class="flex min-w-[160px] cursor-pointer items-center justify-center rounded-lg h-14 px-8 bg-primary-container text-surface text-base font-bold shadow-lg shadow-primary-container/20 hover:scale-105 transition-transform">
                            Eksplor Dashboard
                        </button>
                        <a href="{{ route('admin.login') }}"
                            class="flex min-w-[160px] cursor-pointer items-center justify-center rounded-lg h-14 px-8 border border-outline bg-transparent text-primary text-base font-bold hover:bg-surface-container transition-colors">
                            Login Admin
                        </a>
                    </div>
                    <div class="flex items-center gap-6 pt-4 border-t border-outline-variant">
                        <div>
                            <p class="text-2xl font-bold text-primary">1.2k+</p>
                            <p class="text-xs text-secondary uppercase font-medium">Petani Terdaftar</p>
                        </div>
                        <div class="w-px h-8 bg-outline-variant"></div>
                        <div>
                            <p class="text-2xl font-bold text-primary">98%</p>
                            <p class="text-xs text-secondary uppercase font-medium">Akurasi IoT</p>
                        </div>
                    </div>
                </div>
                <div class="relative h-[400px] lg:h-[600px] reveal active" style="transition-delay: 200ms;">
                    <!-- 3D Animation Component -->
                    <threejs-scene class="absolute inset-0 w-full h-full rounded-2xl overflow-hidden shadow-2xl"
                        src="DATA:ANIMATION:ANIMATION_42"></threejs-scene>
                    <!-- Floating Badge -->
                    <div
                        class="absolute -bottom-6 -left-6 bg-white p-6 rounded-xl shadow-xl flex items-center gap-4 z-10 border border-outline-variant">
                        <div class="bg-secondary-container p-3 rounded-lg">
                            <span class="material-symbols-outlined text-primary" data-icon="thermometer">thermometer</span>
                        </div>
                        <div>
                            <p class="text-sm font-bold text-primary">Status Suhu</p>
                            <p class="text-xs text-secondary">Optimal: 28°C - 32°C</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Ecosystem Digital Section -->
        <section class="py-24 px-6 lg:px-40 bg-white" id="ecosystem">
            <div class="max-w-[1200px] mx-auto">
                <div class="flex flex-col gap-4 mb-16 reveal active">
                    <h2 class="font-headline text-3xl lg:text-4xl font-bold text-primary">Ecosystem Digital</h2>
                    <p class="text-secondary max-w-2xl text-lg">Inovasi modern untuk mendukung kualitas hasil tani jagung
                        Kluwih yang unggul melalui integrasi perangkat keras dan lunak.</p>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <!-- Feature 1 -->
                    <div class="group flex flex-col gap-6 p-8 rounded-2xl border border-outline-variant hover:border-secondary hover:shadow-xl transition-all duration-300 reveal active"
                        style="transition-delay: 100ms;">
                        <div
                            class="size-14 rounded-full bg-surface-container flex items-center justify-center text-primary group-hover:bg-secondary group-hover:text-surface transition-colors">
                            <span class="material-symbols-outlined text-3xl" data-icon="sensors">sensors</span>
                        </div>
                        <div class="flex flex-col gap-2">
                            <h3 class="font-headline text-xl font-bold text-primary">Pemantauan IoT Real-time</h3>
                            <p class="text-secondary leading-relaxed">Integrasi sensor cerdas untuk data akurat yang
                                dikirimkan langsung dari lahan ke dashboard utama.</p>
                        </div>
                    </div>
                    <!-- Feature 2 -->
                    <div class="group flex flex-col gap-6 p-8 rounded-2xl border border-outline-variant hover:border-secondary hover:shadow-xl transition-all duration-300 reveal active"
                        style="transition-delay: 200ms;">
                        <div
                            class="size-14 rounded-full bg-surface-container flex items-center justify-center text-primary group-hover:bg-secondary group-hover:text-surface transition-colors">
                            <span class="material-symbols-outlined text-3xl" data-icon="query_stats">query_stats</span>
                        </div>
                        <div class="flex flex-col gap-2">
                            <h3 class="font-headline text-xl font-bold text-primary">Optimasi Suhu &amp; Tonase</h3>
                            <p class="text-secondary leading-relaxed">Algoritma cerdas yang membantu menjaga suhu
                                pengeringan dan mencatat berat hasil panen secara otomatis.</p>
                        </div>
                    </div>
                    <!-- Feature 3 -->
                    <div class="group flex flex-col gap-6 p-8 rounded-2xl border border-outline-variant hover:border-secondary hover:shadow-xl transition-all duration-300 reveal active"
                        style="transition-delay: 300ms;">
                        <div
                            class="size-14 rounded-full bg-surface-container flex items-center justify-center text-primary group-hover:bg-secondary group-hover:text-surface transition-colors">
                            <span class="material-symbols-outlined text-3xl" data-icon="payments">payments</span>
                        </div>
                        <div class="flex flex-col gap-2">
                            <h3 class="font-headline text-xl font-bold text-primary">Transparansi Harga</h3>
                            <p class="text-secondary leading-relaxed">Update harga pasar harian untuk memastikan transaksi
                                yang adil dan transparan bagi seluruh pihak terkait.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Workflow Section -->
        <section class="py-24 px-6 lg:px-40 bg-surface-container" id="workflow">
            <div class="max-w-[1200px] mx-auto">
                <h2 class="font-headline text-3xl lg:text-4xl font-bold text-primary mb-16 text-center reveal active">Alur
                    Kerja Digital</h2>
                <div class="relative flex flex-col gap-12 reveal active">
                    <!-- Workflow Line (Desktop) -->
                    <div class="hidden lg:block absolute left-[28px] top-0 bottom-0 w-px bg-outline-variant/50"></div>
                    <!-- Step 01 -->
                    <div class="grid grid-cols-[60px_1fr] lg:grid-cols-[60px_1fr_400px] gap-8 items-center group">
                        <div
                            class="size-14 rounded-full bg-primary flex items-center justify-center text-surface z-10 font-bold border-4 border-surface shadow-lg">
                            01</div>
                        <div class="flex flex-col gap-2">
                            <h4 class="text-xl font-bold text-primary group-hover:text-secondary transition-colors">
                                Pemasangan IoT</h4>
                            <p class="text-secondary">Instalasi perangkat sensor suhu dan kelembapan di titik-titik krusial
                                gudang penyimpanan.</p>
                        </div>
                        <div class="hidden lg:block h-48 rounded-xl overflow-hidden border border-outline-variant bg-white">
                            <img class="w-full h-full object-cover grayscale hover:grayscale-0 transition-all duration-500"
                                data-alt="Close-up of a high-tech agricultural IoT sensor device being installed on a rustic wooden beam, warm evening sunlight streaming in, macro photography style, clean industrial design, forest green accents."
                                src="https://lh3.googleusercontent.com/aida-public/AB6AXuD87yiLXY7RZBUroI-IInbEownCa5QGWrsY970NibbzP5KGj-RtVqZk4f-xDbsuu9wEcKrlHibzIsj43uqOev42CwTDObhvXbGntGn5jl6HqhVEpviguFh0Kpk4DrDUEud2W9OeWuz73mTQMlUn49a5-6AlCLftBT0IUa_FcZBcUajDzMdlpMvV_rhXWwxkO-cMKW9TS5l0Jaf3LKTDf6Cu4ltbbWrCZTniT-XDShvrvOpo_fEmzZCiLQ">
                        </div>
                    </div>
                    <!-- Step 02 -->
                    <div class="grid grid-cols-[60px_1fr] lg:grid-cols-[60px_1fr_400px] gap-8 items-center group">
                        <div
                            class="size-14 rounded-full bg-primary flex items-center justify-center text-surface z-10 font-bold border-4 border-surface shadow-lg">
                            02</div>
                        <div class="flex flex-col gap-2">
                            <h4 class="text-xl font-bold text-primary group-hover:text-secondary transition-colors">
                                Monitoring Suhu</h4>
                            <p class="text-secondary">Data suhu dikirimkan setiap detik ke server cloud untuk dianalisis
                                kestabilannya.</p>
                        </div>
                        <div class="hidden lg:block h-48 rounded-xl overflow-hidden border border-outline-variant bg-white">
                            <img class="w-full h-full object-cover grayscale hover:grayscale-0 transition-all duration-500"
                                data-alt="A sleek digital tablet displaying complex heat maps and temperature graphs, minimalist UI design with deep green and cream colors, soft studio lighting, professional agri-tech software interface."
                                src="https://lh3.googleusercontent.com/aida-public/AB6AXuCFylwrMLneiOCexVzgX7VPBwZSFWuEsFb5FfW1hc_YNpET7osXu2-KGaRBIcdAW4DK91M0oo3wlaAqW2OLH5rAJk0ju47DsTDwz4QOzasgMMWpAKYAlp18VqfXGveRKEYfER6j7A3eGo2xaCVjK3YfI8DIUrp0sD-yarqdL7jwNCBVHjs82EE2P9QAfJN9OP3BZdqTDQAUntH_4jhAUB3llM0d4hBtRQpqCxmK9I-GscmyUJviAj5H6A">
                        </div>
                    </div>
                    <!-- Step 03 -->
                    <div class="grid grid-cols-[60px_1fr] lg:grid-cols-[60px_1fr_400px] gap-8 items-center group">
                        <div
                            class="size-14 rounded-full bg-primary flex items-center justify-center text-surface z-10 font-bold border-4 border-surface shadow-lg">
                            03</div>
                        <div class="flex flex-col gap-2">
                            <h4 class="text-xl font-bold text-primary group-hover:text-secondary transition-colors">
                                Pencatatan Tonase</h4>
                            <p class="text-secondary">Integrasi timbangan digital secara otomatis mencatat volume masuk dan
                                keluar hasil panen.</p>
                        </div>
                        <div class="hidden lg:block h-48 rounded-xl overflow-hidden border border-outline-variant bg-white">
                            <img class="w-full h-full object-cover grayscale hover:grayscale-0 transition-all duration-500"
                                data-alt="Large golden corn kernels flowing into a professional digital weighing station, dynamic movement captured with high speed photography, bright natural lighting, industrial agricultural warehouse setting."
                                src="https://lh3.googleusercontent.com/aida-public/AB6AXuBGzfgZ9-VT4rilQx19BK19l9JfFY2b7_iG-dDUGIoNwOkguuLSL2h2SHzf-S6ZOVmFDEBPJPTnyJ9IcDtAowB1Eyfnss1GE46gN6SHGEGu4dwxTaW84RqVEZDItaOl1oETdfxZuH7w3yzOSggT_EvlxDQOfoz3J_e95zFoSNzrztK9YT65Wec-sjVRwuCMojIKoDwsb0G4Omb8o0EWc70w84YduDeUya5KZmClcuy8IO1NvJHPhDSjAA">
                        </div>
                    </div>
                    <!-- Step 04 -->
                    <div class="grid grid-cols-[60px_1fr] lg:grid-cols-[60px_1fr_400px] gap-8 items-center group">
                        <div
                            class="size-14 rounded-full bg-primary flex items-center justify-center text-surface z-10 font-bold border-4 border-surface shadow-lg">
                            04</div>
                        <div class="flex flex-col gap-2">
                            <h4 class="text-xl font-bold text-primary group-hover:text-secondary transition-colors">Analisis
                                Data</h4>
                            <p class="text-secondary">Laporan otomatis dihasilkan untuk melihat performa kualitas jagung
                                antar periode.</p>
                        </div>
                        <div class="hidden lg:block h-48 rounded-xl overflow-hidden border border-outline-variant bg-white">
                            <img class="w-full h-full object-cover grayscale hover:grayscale-0 transition-all duration-500"
                                data-alt="Detailed agricultural reports and data visualizations printed on high-quality paper resting on a dark wood desk, morning light from a nearby window, analytical atmosphere, clean and professional."
                                src="https://lh3.googleusercontent.com/aida-public/AB6AXuCbhQEK2TrrcMvyWh2goTffCnZyvbt-MXYEzx7V_V6VpMHcPkpZ6WFs5tIySsYGgQkFZ5xUv3650TtWcFBAkVmEK6015LKIjpaE-uVhbXZJ3eQPvI36DcrBY5yxLzcx-euX4IycmEpx0Dt0356Fzn4vyZ-5QxF7zKjnhTwQyAma19e-wk6niibFKBnB8kzwaYhbekDjGKM-3EERMHJNWLlUlgPsx1j-i9r_Jz5DC2uME2juBQMVmfmZmQ">
                        </div>
                    </div>
                    <!-- Step 05 -->
                    <div class="grid grid-cols-[60px_1fr] lg:grid-cols-[60px_1fr_400px] gap-8 items-center group">
                        <div
                            class="size-14 rounded-full bg-primary flex items-center justify-center text-surface z-10 font-bold border-4 border-surface shadow-lg">
                            05</div>
                        <div class="flex flex-col gap-2">
                            <h4 class="text-xl font-bold text-primary group-hover:text-secondary transition-colors">
                                Distribusi &amp; Harga</h4>
                            <p class="text-secondary">Informasi stok dan harga tersedia bagi pembeli terverifikasi di
                                portal ekosistem.</p>
                        </div>
                        <div
                            class="hidden lg:block h-48 rounded-xl overflow-hidden border border-outline-variant bg-white">
                            <img class="w-full h-full object-cover grayscale hover:grayscale-0 transition-all duration-500"
                                data-alt="Modern logistics truck being loaded with sacks of corn in a clean, organized distribution center, cinematic lighting, sunset glow, representing efficient global supply chain management."
                                src="https://lh3.googleusercontent.com/aida-public/AB6AXuCznU3pA1eTnpoPgTw8lkTEJ-qFVa90f0WW7n4CBUlr4-zAARv4TqgS4bwz5QK3iKNMGaOta4qyoHN7pCw4uGQ3mmHmaN1fyKykYBCvYXhjOtBzAcxzrhqp9wS7L7vG8vc9FYRN9_YfJHRXsHElDDvofcEQyTuRClVPpN9uBRCPOE_SCwcDCnHVfMPW5JZ2BbAtRe0IOR-BoeYHlL0upKGK7XYs3YN1ONnseKM4L3FlWlNCDDlOp-dw5Q">
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- CTA Section -->
        <section class="py-24 px-6 lg:px-40">
            <div
                class="max-w-[1200px] mx-auto relative rounded-3xl overflow-hidden bg-primary p-12 lg:p-20 flex flex-col items-center text-center gap-8 reveal">
                <!-- Abstract Background Pattern -->
                <div class="absolute inset-0 opacity-10 pointer-events-none overflow-hidden">
                    <webgl-shader class="w-full h-full" src="DATA:ANIMATION:ANIMATION_2"></webgl-shader>
                </div>
                <h2 class="font-headline text-3xl lg:text-5xl text-surface font-bold relative z-10">Siap Modernisasi Panen
                    Anda?</h2>
                <p class="text-secondary-container text-lg max-w-xl relative z-10">
                    Bergabunglah dengan ribuan petani jagung lainnya yang telah bertransformasi ke ekosistem digital untuk
                    hasil yang lebih terukur.
                </p>
                <div class="flex flex-wrap justify-center gap-6 relative z-10">
                    <button
                        class="px-10 h-14 bg-surface text-primary font-bold rounded-lg hover:scale-105 transition-transform">
                        Daftar Sekarang
                    </button>
                    <button
                        class="px-10 h-14 border border-surface text-surface font-bold rounded-lg hover:bg-surface/10 transition-colors">
                        Hubungi Tim Ahli
                    </button>
                </div>
            </div>
        </section>
    </main>
    @push('scripts')
        <script>
            // Simple Intersection Observer for Reveal Animations
            const observerOptions = {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            };

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('active');
                    }
                });
            }, observerOptions);

            document.querySelectorAll('.reveal').forEach(el => observer.observe(el));

            // Smooth scroll for nav links
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function(e) {
                    e.preventDefault();
                    document.querySelector(this.getAttribute('href')).scrollIntoView({
                        behavior: 'smooth'
                    });
                });
            });
        </script>
    @endpush
@endsection
