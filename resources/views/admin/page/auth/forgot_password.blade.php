<!DOCTYPE html>

<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Atur Ulang Kata Sandi - SIDJ-Kluwih</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&amp;display=swap" rel="stylesheet" />
    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap"
        rel="stylesheet" />
    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap"
        rel="stylesheet" />
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "primary": "#0d631b",
                        "on-background": "#111c2d",
                        "inverse-primary": "#88d982",
                        "inverse-on-surface": "#ecf1ff",
                        "secondary-fixed-dim": "#78dc77",
                        "on-secondary-fixed-variant": "#005313",
                        "error": "#ba1a1a",
                        "primary-container": "#2e7d32",
                        "on-error": "#ffffff",
                        "outline": "#707a6c",
                        "surface-container-low": "#f0f3ff",
                        "secondary-fixed": "#94f990",
                        "on-primary-container": "#cbffc2",
                        "on-secondary-container": "#00731e",
                        "error-container": "#ffdad6",
                        "on-secondary-fixed": "#002204",
                        "on-primary-fixed-variant": "#005312",
                        "secondary": "#006e1c",
                        "primary-fixed": "#a3f69c",
                        "on-primary": "#ffffff",
                        "tertiary-fixed": "#ffdfa0",
                        "tertiary-container": "#8c6800",
                        "surface": "#f9f9ff",
                        "on-error-container": "#93000a",
                        "background": "#f9f9ff",
                        "on-surface": "#111c2d",
                        "tertiary": "#6e5100",
                        "surface-tint": "#1b6d24",
                        "on-primary-fixed": "#002204",
                        "surface-variant": "#d8e3fb",
                        "on-tertiary": "#ffffff",
                        "on-secondary": "#ffffff",
                        "outline-variant": "#bfcaba",
                        "on-tertiary-fixed": "#261a00",
                        "secondary-container": "#91f78e",
                        "inverse-surface": "#263143",
                        "surface-container-highest": "#d8e3fb",
                        "surface-container": "#e7eeff",
                        "surface-container-high": "#dee8ff",
                        "on-tertiary-fixed-variant": "#5c4300",
                        "on-surface-variant": "#40493d",
                        "surface-container-lowest": "#ffffff",
                        "primary-fixed-dim": "#88d982",
                        "on-tertiary-container": "#ffefd7",
                        "surface-bright": "#f9f9ff",
                        "tertiary-fixed-dim": "#f8bd2a",
                        "surface-dim": "#cfdaf2"
                    },
                    "borderRadius": {
                        "DEFAULT": "0.25rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
                        "2xl": "20px",
                        "full": "9999px"
                    },
                    "spacing": {
                        "container-margin": "24px",
                        "base": "4px",
                        "md": "16px",
                        "gutter": "20px",
                        "xs": "4px",
                        "xl": "40px",
                        "sm": "8px",
                        "lg": "24px"
                    },
                    "fontFamily": {
                        "headline-lg": ["Inter"],
                        "headline-lg-mobile": ["Inter"],
                        "title-lg": ["Inter"],
                        "display": ["Inter"],
                        "label-sm": ["Inter"],
                        "headline-md": ["Inter"],
                        "body-md": ["Inter"],
                        "body-lg": ["Inter"],
                        "label-md": ["Inter"]
                    },
                    "fontSize": {
                        "headline-lg": ["32px", {
                            "lineHeight": "40px",
                            "letterSpacing": "-0.01em",
                            "fontWeight": "600"
                        }],
                        "headline-lg-mobile": ["24px", {
                            "lineHeight": "32px",
                            "fontWeight": "600"
                        }],
                        "title-lg": ["20px", {
                            "lineHeight": "28px",
                            "fontWeight": "600"
                        }],
                        "display": ["48px", {
                            "lineHeight": "1.2",
                            "letterSpacing": "-0.02em",
                            "fontWeight": "700"
                        }],
                        "label-sm": ["12px", {
                            "lineHeight": "16px",
                            "letterSpacing": "0.05em",
                            "fontWeight": "600"
                        }],
                        "headline-md": ["24px", {
                            "lineHeight": "32px",
                            "fontWeight": "600"
                        }],
                        "body-md": ["16px", {
                            "lineHeight": "24px",
                            "fontWeight": "400"
                        }],
                        "body-lg": ["18px", {
                            "lineHeight": "28px",
                            "fontWeight": "400"
                        }],
                        "label-md": ["14px", {
                            "lineHeight": "20px",
                            "letterSpacing": "0.01em",
                            "fontWeight": "500"
                        }]
                    }
                },
            },
        }
    </script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #F7FAF7;
        }

        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }

        .custom-shadow {
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -2px rgba(0, 0, 0, 0.05);
        }

        .transition-soft {
            transition: all 0.2s ease-out;
        }
    </style>
</head>

<body class="min-h-screen flex items-center justify-center p-0 md:p-md overflow-x-hidden">
    <main
        class="w-full h-full md:h-auto max-w-7xl grid grid-cols-1 md:grid-cols-2 bg-surface-container-lowest md:rounded-2xl overflow-hidden custom-shadow min-h-[921px]">
        <!-- Left Side: Visual -->
        <section class="relative hidden md:flex items-center justify-center bg-primary-container overflow-hidden">
            <div class="absolute inset-0 z-0">
                <div class="w-full h-full bg-cover bg-center opacity-80"
                    data-alt="A wide cinematic shot of a modern, tech-enabled Indonesian corn field during a golden sunrise. In the background, sleek silver and white Smart Dryer silos with glowing green LED status bars stand amidst lush green rows of corn. The atmosphere is clean, professional, and optimistic, featuring soft morning light and a clear sky, illustrating the fusion of agriculture and advanced technology in a high-end SaaS style."
                    style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuDqvfu53HeyhbnnUJZbFZs1Xp-DGaGHuLvghQfSyyfmwAVMdBydGgzbZYzmMuLczDv1NIP2VzZoByJ5423R2nKc3DI1pJPZeHDHCb8E-Zj5m6E6WUcCH5ozTf4RihzTtyOAxeDOibcmSIX9FaLX4tLyAa5IsPLX4eWRAibK6a0usdntJH0nPazCudA8wxWA0cixVOE0ap7oAilkaaTtFHRIbQQ_rzd-LOyRaBZU2ooAaHeHlIBnyrSf-Q')">
                </div>
                <!-- Glassmorphism Overlay for Text -->
                <div
                    class="absolute bottom-12 left-12 right-12 p-lg bg-white/10 backdrop-blur-md rounded-2xl border border-white/20">
                    <h2 class="font-headline-md text-headline-md text-on-primary-container mb-sm">Modernisasi Pasca
                        Panen</h2>
                    <p class="font-body-md text-body-md text-on-primary-container opacity-90">Solusi teknologi pintar
                        untuk pengeringan jagung yang lebih efisien dan terukur secara digital.</p>
                </div>
            </div>
            <!-- Decorative Tech Elements -->
            <div
                class="absolute top-8 left-8 flex items-center gap-2 bg-white/10 backdrop-blur-md px-md py-sm rounded-full border border-white/20">
                <span class="material-symbols-outlined text-inverse-primary">sensors</span>
                <span class="text-white font-label-sm uppercase tracking-widest">IoT Monitoring Active</span>
            </div>
        </section>
        <!-- Right Side: Reset Password Form -->
        <section
            class="flex flex-col items-center justify-center px-lg py-xl md:px-xl md:py-xl bg-surface-container-lowest">
            <div class="w-full max-w-md">
                <!-- Brand Identity -->
                <div class="flex flex-col items-center mb-xl">
                    <div
                        class="w-16 h-16 bg-primary-container rounded-2xl flex items-center justify-center mb-md custom-shadow">
                        <span class="material-symbols-outlined text-white text-[40px]"
                            style="font-variation-settings: 'FILL' 1;">eco</span>
                    </div>
                    <h1 class="font-title-lg text-title-lg text-primary tracking-tight">SIDJ-Kluwih</h1>
                </div>
                <!-- Form Header -->
                <div class="mb-lg">
                    <h2 class="font-headline-lg text-headline-lg text-on-background mb-xs">Atur Ulang Kata Sandi</h2>
                    <p class="font-body-md text-body-md text-on-surface-variant">Masukkan email Anda untuk menerima
                        instruksi pemulihan kata sandi.</p>
                </div>
                <!-- Form -->
                <form class="space-y-lg" id="resetForm">
                    <div class="flex flex-col gap-base">
                        <label class="font-label-md text-label-md text-on-surface-variant ml-1"
                            for="email">Email</label>
                        <div class="relative">
                            <span
                                class="material-symbols-outlined absolute left-md top-1/2 -translate-y-1/2 text-outline">mail</span>
                            <input
                                class="w-full pl-xl pr-md py-md bg-surface-container-low border border-outline-variant rounded-xl focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-soft font-body-md"
                                id="email" name="email" placeholder="Masukkan email Anda" required=""
                                type="email" />
                        </div>
                    </div>
                    <button
                        class="w-full py-md bg-primary-container text-white font-label-md text-label-md rounded-xl hover:bg-primary transition-soft shadow-sm flex items-center justify-center gap-md group"
                        type="submit">
                        <span>Kirim Tautan Pemulihan</span>
                        <span
                            class="material-symbols-outlined group-hover:translate-x-1 transition-transform">arrow_forward</span>
                    </button>
                </form>
                <!-- Footer Action -->
                <div class="mt-xl text-center">
                    <a class="inline-flex items-center gap-xs font-label-md text-label-md text-primary hover:text-primary-container transition-soft group"
                        href="{{ route('admin.login') }}">
                        <span class="material-symbols-outlined text-[18px]">arrow_back</span>
                        Kembali ke Login
                    </a>
                </div>
                <!-- Subtle Info -->
                <div class="mt-xl pt-lg border-t border-outline-variant flex flex-col gap-md">
                    <div class="flex items-start gap-md">
                        <div
                            class="mt-1 w-8 h-8 rounded-full bg-secondary-container flex items-center justify-center shrink-0">
                            <span
                                class="material-symbols-outlined text-on-secondary-container text-[20px]">help_outline</span>
                        </div>
                        <p class="font-label-sm text-label-sm text-on-surface-variant">
                            Butuh bantuan tambahan? Silakan hubungi tim <a class="text-primary font-bold"
                                href="#">Dukungan Teknis</a> kami untuk bantuan langsung.
                        </p>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <!-- JavaScript for micro-interactions -->
    <script>
        document.getElementById('resetForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const button = this.querySelector('button');
            const originalContent = button.innerHTML;

            // Interaction: Loading State
            button.disabled = true;
            button.classList.add('opacity-80', 'cursor-not-allowed');
            button.innerHTML = `
                <div class="flex items-center gap-3">
                    <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    <span>Mengirim...</span>
                </div>
            `;

            // Mock Success
            setTimeout(() => {
                button.innerHTML = `
                    <div class="flex items-center gap-3">
                        <span class="material-symbols-outlined">check_circle</span>
                        <span>Berhasil Dikirim!</span>
                    </div>
                `;
                button.classList.remove('bg-primary-container');
                button.classList.add('bg-secondary');

                // Show floating notification (optional UI touch)
                console.log('Success state triggered');
            }, 1500);
        });

        // Simple mouse tracking for subtle background movement if desktop
        if (window.innerWidth > 768) {
            document.addEventListener('mousemove', (e) => {
                const amount = 5;
                const x = (e.clientX / window.innerWidth - 0.5) * amount;
                const y = (e.clientY / window.innerHeight - 0.5) * amount;
                const visual = document.querySelector('[data-alt]');
                if (visual) {
                    visual.style.transform = `scale(1.05) translate(${x}px, ${y}px)`;
                }
            });
        }
    </script>
</body>

</html>
