    <!DOCTYPE html>

<html class="light" lang="id"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Tentang Kami - SIDJ-Kluwih</title>
<!-- Fonts & Icons -->
<link href="https://fonts.googleapis.com" rel="preconnect"/>
<link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<!-- Tailwind CSS -->
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<script id="tailwind-config">
      tailwind.config = {
        darkMode: "class",
        theme: {
          extend: {
            "colors": {
                    "on-secondary-container": "#00731e",
                    "surface": "#f9f9ff",
                    "surface-bright": "#f9f9ff",
                    "on-secondary": "#ffffff",
                    "on-surface": "#111c2d",
                    "error": "#ba1a1a",
                    "inverse-on-surface": "#ecf1ff",
                    "on-secondary-fixed": "#002204",
                    "on-primary-container": "#cbffc2",
                    "surface-tint": "#1b6d24",
                    "tertiary-fixed": "#ffdfa0",
                    "on-error-container": "#93000a",
                    "tertiary-container": "#8c6800",
                    "tertiary-fixed-dim": "#f8bd2a",
                    "surface-container-low": "#f0f3ff",
                    "on-primary-fixed": "#002204",
                    "surface-container-lowest": "#ffffff",
                    "primary-fixed": "#a3f69c",
                    "outline-variant": "#bfcaba",
                    "outline": "#707a6c",
                    "secondary": "#006e1c",
                    "on-surface-variant": "#40493d",
                    "secondary-fixed": "#94f990",
                    "on-secondary-fixed-variant": "#005313",
                    "on-primary": "#ffffff",
                    "inverse-primary": "#88d982",
                    "error-container": "#ffdad6",
                    "secondary-fixed-dim": "#78dc77",
                    "tertiary": "#6e5100",
                    "surface-dim": "#cfdaf2",
                    "inverse-surface": "#263143",
                    "primary": "#0d631b",
                    "secondary-container": "#91f78e",
                    "background": "#f9f9ff",
                    "surface-container-highest": "#d8e3fb",
                    "on-tertiary-fixed-variant": "#5c4300",
                    "on-tertiary-fixed": "#261a00",
                    "on-error": "#ffffff",
                    "on-tertiary": "#ffffff",
                    "surface-container": "#e7eeff",
                    "on-background": "#111c2d",
                    "primary-container": "#2e7d32",
                    "on-primary-fixed-variant": "#005312",
                    "primary-fixed-dim": "#88d982",
                    "surface-variant": "#d8e3fb",
                    "on-tertiary-container": "#ffefd7",
                    "surface-container-high": "#dee8ff"
            },
            "borderRadius": {
                    "DEFAULT": "0.25rem",
                    "lg": "0.5rem",
                    "xl": "0.75rem",
                    "full": "9999px"
            },
            "spacing": {
                    "xs": "4px",
                    "lg": "24px",
                    "gutter": "20px",
                    "container-margin": "24px",
                    "md": "16px",
                    "base": "4px",
                    "xl": "40px",
                    "sm": "8px"
            },
            "fontFamily": {
                    "label-md": ["Inter"],
                    "body-md": ["Inter"],
                    "display": ["Inter"],
                    "headline-lg": ["Inter"],
                    "title-lg": ["Inter"],
                    "label-sm": ["Inter"],
                    "headline-md": ["Inter"],
                    "body-lg": ["Inter"],
                    "headline-lg-mobile": ["Inter"]
            },
            "fontSize": {
                    "label-md": ["14px", {"lineHeight": "20px", "letterSpacing": "0.01em", "fontWeight": "500"}],
                    "body-md": ["16px", {"lineHeight": "24px", "fontWeight": "400"}],
                    "display": ["48px", {"lineHeight": "1.2", "letterSpacing": "-0.02em", "fontWeight": "700"}],
                    "headline-lg": ["32px", {"lineHeight": "40px", "letterSpacing": "-0.01em", "fontWeight": "600"}],
                    "title-lg": ["20px", {"lineHeight": "28px", "fontWeight": "600"}],
                    "label-sm": ["12px", {"lineHeight": "16px", "letterSpacing": "0.05em", "fontWeight": "600"}],
                    "headline-md": ["24px", {"lineHeight": "32px", "fontWeight": "600"}],
                    "body-lg": ["18px", {"lineHeight": "28px", "fontWeight": "400"}],
                    "headline-lg-mobile": ["24px", {"lineHeight": "32px", "fontWeight": "600"}]
            }
          },
        },
      }
    </script>
<style>
        body { font-family: 'Inter', sans-serif; background-color: #F7FAF7; }
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; }
        .glass-card { background: rgba(255, 255, 255, 0.8); backdrop-filter: blur(8px); border: 1px solid #E2E8F0; }
        .hero-pattern { background-image: radial-gradient(#1b6d2411 1px, transparent 1px); background-size: 24px 24px; }
    </style>
</head>
<body class="text-on-surface antialiased">
<!-- TopNavBar -->
<nav class="fixed top-0 w-full bg-surface/90 dark:bg-surface-dim/90 border-b border-outline-variant/30 backdrop-blur-md shadow-sm z-50">
<div class="flex justify-between items-center h-16 px-gutter max-w-7xl mx-auto">
<div class="text-title-lg font-headline-lg text-primary dark:text-primary-fixed-dim">SIDJ-Kluwih</div>
<!-- Desktop Links -->
<div class="hidden md:flex items-center gap-lg">
<a class="font-label-md text-label-md text-on-surface-variant hover:text-primary transition-colors" href="#">Beranda</a>
<a class="font-label-md text-label-md text-primary font-semibold border-b-2 border-primary pb-1" href="#">Tentang Kami</a>
<a class="font-label-md text-label-md text-on-surface-variant hover:text-primary transition-colors" href="#">Data Jagung</a>
<a class="font-label-md text-label-md text-on-surface-variant hover:text-primary transition-colors" href="#">Layanan</a>
<a class="font-label-md text-label-md text-on-surface-variant hover:text-primary transition-colors" href="#">Kontak</a>
</div>
<div class="flex items-center gap-md">
<button class="bg-primary text-on-primary px-lg py-sm rounded-full font-label-md text-label-md hover:bg-primary-container active:scale-95 transition-all">Masuk</button>
<!-- Mobile Menu Toggle -->
<button class="md:hidden p-2 text-on-surface-variant" onclick="document.getElementById('mobile-menu').classList.toggle('hidden')">
<span class="material-symbols-outlined">menu</span>
</button>
</div>
</div>
<!-- Mobile Navigation Menu -->
<div class="hidden md:hidden bg-surface border-t border-outline-variant/30 p-gutter flex flex-col gap-md" id="mobile-menu">
<a class="font-label-md text-label-md text-on-surface-variant" href="#">Beranda</a>
<a class="font-label-md text-label-md text-primary font-semibold" href="#">Tentang Kami</a>
<a class="font-label-md text-label-md text-on-surface-variant" href="#">Data Jagung</a>
<a class="font-label-md text-label-md text-on-surface-variant" href="#">Layanan</a>
<a class="font-label-md text-label-md text-on-surface-variant" href="#">Kontak</a>
</div>
</nav>
<main class="mt-16 overflow-x-hidden">
<!-- Hero Section -->
<section class="relative pt-24 pb-20 md:pt-40 md:pb-32 px-gutter hero-pattern overflow-hidden">
<div class="max-w-7xl mx-auto grid md:grid-cols-2 gap-xl items-center relative z-10">
<div class="order-2 md:order-1">
<span class="inline-block py-1 px-4 mb-md rounded-full bg-secondary-container text-on-secondary-container font-label-sm text-label-sm uppercase tracking-wider">Tentang Kami</span>
<h1 class="font-display text-display mb-md leading-tight text-primary">
                        Menghubungkan <span class="text-secondary italic">Tradisi</span> dengan Teknologi Modern
                    </h1>
<p class="font-body-lg text-body-lg text-on-surface-variant mb-xl max-w-xl">
                        SIDJ-Kluwih lahir dari visi untuk mentransformasi sektor agrikultur lokal menjadi ekosistem digital yang efisien, transparan, dan berkelanjutan. Kami menyediakan solusi data terpadu untuk memberdayakan petani jagung di Kluwih.
                    </p>
<div class="flex flex-wrap gap-md">
<button class="bg-primary text-on-primary px-xl py-md rounded-xl font-label-md text-label-md hover:shadow-lg transition-all active:scale-95">Eksplorasi Solusi</button>
<button class="bg-surface border border-outline px-xl py-md rounded-xl font-label-md text-label-md hover:bg-surface-container-low transition-all">Pelajari Lebih Lanjut</button>
</div>
</div>
<div class="order-1 md:order-2 relative">
<div class="aspect-square rounded-3xl overflow-hidden shadow-2xl rotate-3 scale-95 transition-transform hover:rotate-0 duration-500">
<img class="w-full h-full object-cover" data-alt="A cinematic, high-angle shot of a lush green corn field in Kluwih at sunrise, featuring a modern farmer using a digital tablet. The scene is bathed in soft golden sunlight, emphasizing the blend of traditional agriculture and advanced digital technology. The color palette is dominated by rich greens and warm oranges, reflecting a professional agri-tech aesthetic." src="https://lh3.googleusercontent.com/aida-public/AB6AXuDUtQeeYL7ro1mUv7mSfNPR9s74pEN9an8SCSqCKi9Lhks9jY_i717vTgB7STs1NsT0cXjj1MU80QQUECMQ5x5HWIOZCltkUMMOXo_JPFjM8GqEcuNEZvCC-XxmYOISuQN95Ft2BLAAzKPXYH4z4zDatdFQMbHttlkt87cHFS1G9VNZv6kQPq1kG65rIq7Q04yxiEzQ0q2IVkWUbU6fs5ohi9WBI9lPULo576j-T76LE8LHA7WduXzwZg"/>
</div>
<div class="absolute -bottom-8 -left-8 glass-card p-lg rounded-2xl shadow-xl hidden lg:block animate-bounce-slow">
<div class="flex items-center gap-md">
<div class="w-12 h-12 bg-secondary-container rounded-full flex items-center justify-center">
<span class="material-symbols-outlined text-on-secondary-container">trending_up</span>
</div>
<div>
<p class="font-label-sm text-label-sm text-on-surface-variant uppercase">Pertumbuhan Data</p>
<p class="font-headline-md text-headline-md text-primary">+85% Efisiensi</p>
</div>
</div>
</div>
</div>
</div>
<!-- Background Decoration -->
<div class="absolute top-0 right-0 w-1/3 h-1/2 bg-gradient-to-bl from-primary-fixed/20 to-transparent blur-3xl -z-10"></div>
<div class="absolute bottom-0 left-0 w-1/4 h-1/3 bg-gradient-to-tr from-secondary-fixed/20 to-transparent blur-3xl -z-10"></div>
</section>
<!-- Visi & Misi -->
<section class="py-24 bg-white px-gutter">
<div class="max-w-7xl mx-auto">
<div class="grid md:grid-cols-2 gap-xl items-stretch">
<!-- Visi -->
<div class="p-xl rounded-3xl bg-surface-container-low border border-outline-variant/30 flex flex-col justify-center">
<div class="w-16 h-16 bg-primary-container text-on-primary-container rounded-2xl flex items-center justify-center mb-xl shadow-lg">
<span class="material-symbols-outlined text-4xl">visibility</span>
</div>
<h2 class="font-headline-lg text-headline-lg text-primary mb-lg">Visi Kami</h2>
<p class="font-body-lg text-body-lg italic text-on-surface leading-relaxed border-l-4 border-primary pl-lg">
                            "Menjadi ekosistem digital terdepan untuk kesejahteraan petani jagung di Kluwih melalui inovasi data yang inklusif."
                        </p>
</div>
<!-- Misi -->
<div class="p-xl rounded-3xl bg-primary text-on-primary shadow-2xl flex flex-col justify-center relative overflow-hidden">
<div class="relative z-10">
<div class="w-16 h-16 bg-on-primary text-primary rounded-2xl flex items-center justify-center mb-xl">
<span class="material-symbols-outlined text-4xl" data-weight="fill">target</span>
</div>
<h2 class="font-headline-lg text-headline-lg text-primary-fixed mb-lg">Misi Kami</h2>
<ul class="space-y-md">
<li class="flex items-start gap-md">
<span class="material-symbols-outlined mt-1">check_circle</span>
<p class="font-body-md text-body-md">Digitalisasi data pertanian untuk pengambilan keputusan yang lebih cerdas.</p>
</li>
<li class="flex items-start gap-md">
<span class="material-symbols-outlined mt-1">check_circle</span>
<p class="font-body-md text-body-md">Membangun transparansi harga pasar untuk meminimalkan kerugian petani.</p>
</li>
<li class="flex items-start gap-md">
<span class="material-symbols-outlined mt-1">check_circle</span>
<p class="font-body-md text-body-md">Optimasi hasil panen melalui teknologi pemantauan pasca-panen terintegrasi.</p>
</li>
</ul>
</div>
<!-- Abstract Mesh -->
<div class="absolute top-0 right-0 w-full h-full opacity-10">
<div class="w-full h-full bg-[radial-gradient(circle_at_center,_var(--tw-gradient-stops))] from-white to-transparent"></div>
</div>
</div>
</div>
</div>
</section>
<!-- Nilai Kami (Values) -->
<section class="py-24 px-gutter bg-surface">
<div class="max-w-7xl mx-auto text-center mb-20">
<h2 class="font-headline-lg text-headline-lg text-primary mb-md">Nilai Inti Kami</h2>
<p class="font-body-lg text-body-lg text-on-surface-variant max-w-2xl mx-auto">
                    Prinsip-prinsip yang mendasari setiap baris kode dan setiap keputusan yang kami ambil untuk kemajuan agrikultur.
                </p>
</div>
<div class="max-w-7xl mx-auto grid md:grid-cols-3 gap-lg">
<!-- Value Card: Inovasi -->
<div class="group p-xl rounded-3xl bg-white border border-outline-variant/30 hover:border-primary/50 transition-all duration-300 hover:shadow-xl hover:-translate-y-2">
<div class="w-16 h-16 bg-tertiary-container text-on-tertiary-container rounded-full flex items-center justify-center mb-xl group-hover:scale-110 transition-transform">
<span class="material-symbols-outlined text-3xl">lightbulb</span>
</div>
<h3 class="font-title-lg text-title-lg text-on-surface mb-md">Inovasi</h3>
<p class="font-body-md text-body-md text-on-surface-variant">
                        Terus mendorong batas teknologi untuk menciptakan solusi yang lebih efektif dan efisien bagi tantangan pertanian modern.
                    </p>
</div>
<!-- Value Card: Kejujuran -->
<div class="group p-xl rounded-3xl bg-white border border-outline-variant/30 hover:border-primary/50 transition-all duration-300 hover:shadow-xl hover:-translate-y-2">
<div class="w-16 h-16 bg-secondary-container text-on-secondary-container rounded-full flex items-center justify-center mb-xl group-hover:scale-110 transition-transform">
<span class="material-symbols-outlined text-3xl">verified</span>
</div>
<h3 class="font-title-lg text-title-lg text-on-surface mb-md">Kejujuran</h3>
<p class="font-body-md text-body-md text-on-surface-variant">
                        Membangun kepercayaan melalui transparansi data dan kejujuran dalam setiap interaksi dengan stakeholder kami.
                    </p>
</div>
<!-- Value Card: Pemberdayaan -->
<div class="group p-xl rounded-3xl bg-white border border-outline-variant/30 hover:border-primary/50 transition-all duration-300 hover:shadow-xl hover:-translate-y-2">
<div class="w-16 h-16 bg-primary-container text-on-primary-container rounded-full flex items-center justify-center mb-xl group-hover:scale-110 transition-transform">
<span class="material-symbols-outlined text-3xl">groups</span>
</div>
<h3 class="font-title-lg text-title-lg text-on-surface mb-md">Pemberdayaan</h3>
<p class="font-body-md text-body-md text-on-surface-variant">
                        Fokus kami adalah memberi alat dan pengetahuan kepada petani agar mereka mampu mandiri dan sejahtera secara ekonomi.
                    </p>
</div>
</div>
</section>
<!-- CTA Section -->
<section class="py-24 px-gutter">
<div class="max-w-5xl mx-auto rounded-[3rem] bg-surface-container-highest dark:bg-inverse-surface p-xl md:p-24 text-center relative overflow-hidden shadow-2xl">
<div class="relative z-10">
<h2 class="font-headline-lg text-headline-lg text-primary mb-lg">Ingin bergabung dengan kami?</h2>
<p class="font-body-lg text-body-lg text-on-surface-variant mb-xl max-w-xl mx-auto">
                        Mari berkontribusi dalam revolusi data jagung di Kluwih. Hubungi tim kami untuk kemitraan atau informasi lebih lanjut.
                    </p>
<button class="bg-primary text-on-primary px-2xl py-md rounded-full font-headline-md text-headline-md hover:bg-primary-container transition-all active:scale-95 shadow-lg flex items-center gap-md mx-auto group">
                        Hubungi Kami
                        <span class="material-symbols-outlined group-hover:translate-x-1 transition-transform">arrow_forward</span>
</button>
</div>
<!-- Decorative Circles -->
<div class="absolute -top-24 -right-24 w-64 h-64 bg-primary/10 rounded-full blur-3xl"></div>
<div class="absolute -bottom-24 -left-24 w-64 h-64 bg-secondary/10 rounded-full blur-3xl"></div>
</div>
</section>
</main>
<!-- Footer -->
<footer class="w-full rounded-t-xl bg-surface-container-highest dark:bg-inverse-surface border-t border-outline-variant">
<div class="flex flex-col md:flex-row justify-between items-center gap-md py-xl px-gutter max-w-7xl mx-auto">
<div class="flex flex-col gap-sm items-center md:items-start">
<div class="text-headline-md font-headline-md text-on-secondary-container">SIDJ-Kluwih</div>
<p class="font-body-md text-body-md text-on-surface-variant text-center md:text-left max-w-sm">
                    © 2024 Sistem Informasi Data Jagung Kluwih (SIDJ-Kluwih). Semua Hak Dilindungi.
                </p>
</div>
<div class="flex flex-wrap justify-center gap-lg">
<a class="font-body-md text-body-md text-on-surface-variant hover:text-primary hover:underline decoration-primary underline-offset-4 opacity-80 hover:opacity-100 transition-all" href="#">Kebijakan Privasi</a>
<a class="font-body-md text-body-md text-on-surface-variant hover:text-primary hover:underline decoration-primary underline-offset-4 opacity-80 hover:opacity-100 transition-all" href="#">Syarat &amp; Ketentuan</a>
<a class="font-body-md text-body-md text-on-surface-variant hover:text-primary hover:underline decoration-primary underline-offset-4 opacity-80 hover:opacity-100 transition-all" href="#">Bantuan</a>
<a class="font-body-md text-body-md text-on-surface-variant hover:text-primary hover:underline decoration-primary underline-offset-4 opacity-80 hover:opacity-100 transition-all" href="#">Peta Situs</a>
</div>
<div class="flex gap-md">
<a class="w-10 h-10 rounded-full border border-outline flex items-center justify-center text-on-surface-variant hover:bg-primary hover:text-on-primary transition-all" href="#">
<span class="material-symbols-outlined text-sm">public</span>
</a>
<a class="w-10 h-10 rounded-full border border-outline flex items-center justify-center text-on-surface-variant hover:bg-primary hover:text-on-primary transition-all" href="#">
<span class="material-symbols-outlined text-sm">mail</span>
</a>
</div>
</div>
</footer>
<script>
        // Simple micro-interaction for scroll reveals
        document.addEventListener('DOMContentLoaded', () => {
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('opacity-100', 'translate-y-0');
                        entry.target.classList.remove('opacity-0', 'translate-y-10');
                    }
                });
            }, { threshold: 0.1 });

            document.querySelectorAll('section').forEach(section => {
                section.classList.add('transition-all', 'duration-700', 'opacity-0', 'translate-y-10');
                observer.observe(section);
            });
        });

        // Toggle mobile menu animation
        const menuBtn = document.querySelector('button[onclick*="mobile-menu"]');
        let menuOpen = false;
        menuBtn.addEventListener('click', () => {
            menuOpen = !menuOpen;
            menuBtn.querySelector('.material-symbols-outlined').textContent = menuOpen ? 'close' : 'menu';
        });
    </script>
</body></html>