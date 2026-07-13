<!DOCTYPE html>

<html class="light" lang="id">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Login - SIDJ-Kluwih</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&amp;display=swap"
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
                        "secondary-fixed-dim": "#78dc77",
                        "outline": "#707a6c",
                        "on-error-container": "#93000a",
                        "inverse-surface": "#263143",
                        "on-secondary": "#ffffff",
                        "secondary": "#006e1c",
                        "on-background": "#111c2d",
                        "tertiary-container": "#8c6800",
                        "surface-variant": "#d8e3fb",
                        "background": "#f9f9ff",
                        "on-tertiary-container": "#ffefd7",
                        "tertiary-fixed": "#ffdfa0",
                        "surface": "#f9f9ff",
                        "secondary-fixed": "#94f990",
                        "surface-container-lowest": "#ffffff",
                        "on-secondary-fixed": "#002204",
                        "outline-variant": "#bfcaba",
                        "surface-container-highest": "#d8e3fb",
                        "on-tertiary-fixed-variant": "#5c4300",
                        "on-secondary-fixed-variant": "#005313",
                        "on-surface-variant": "#40493d",
                        "inverse-primary": "#88d982",
                        "surface-dim": "#cfdaf2",
                        "error": "#ba1a1a",
                        "error-container": "#ffdad6",
                        "surface-container": "#e7eeff",
                        "on-secondary-container": "#00731e",
                        "on-surface": "#111c2d",
                        "tertiary": "#6e5100",
                        "on-primary-fixed-variant": "#005312",
                        "primary": "#0d631b",
                        "primary-container": "#2e7d32",
                        "primary-fixed-dim": "#88d982",
                        "on-tertiary": "#ffffff",
                        "on-primary": "#ffffff",
                        "surface-bright": "#f9f9ff",
                        "on-primary-fixed": "#002204",
                        "on-error": "#ffffff",
                        "inverse-on-surface": "#ecf1ff",
                        "surface-container-low": "#f0f3ff",
                        "tertiary-fixed-dim": "#f8bd2a",
                        "surface-tint": "#1b6d24",
                        "surface-container-high": "#dee8ff",
                        "on-primary-container": "#cbffc2",
                        "primary-fixed": "#a3f69c",
                        "on-tertiary-fixed": "#261a00",
                        "secondary-container": "#91f78e"
                    },
                    "borderRadius": {
                        "DEFAULT": "0.25rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
                        "2xl": "1.25rem",
                        "full": "9999px"
                    },
                    "spacing": {
                        "xl": "40px",
                        "container-margin": "24px",
                        "md": "16px",
                        "sm": "8px",
                        "gutter": "20px",
                        "xs": "4px",
                        "lg": "24px",
                        "base": "4px"
                    },
                    "fontFamily": {
                        "sans": ["Inter", "sans-serif"],
                        "headline-lg": ["Inter"],
                        "display": ["Inter"],
                        "body-lg": ["Inter"],
                        "label-md": ["Inter"],
                        "body-md": ["Inter"],
                        "headline-lg-mobile": ["Inter"],
                        "headline-md": ["Inter"],
                        "label-sm": ["Inter"],
                        "title-lg": ["Inter"]
                    },
                    "fontSize": {
                        "headline-lg": ["32px", {
                            "lineHeight": "40px",
                            "letterSpacing": "-0.01em",
                            "fontWeight": "600"
                        }],
                        "display": ["48px", {
                            "lineHeight": "1.2",
                            "letterSpacing": "-0.02em",
                            "fontWeight": "700"
                        }],
                        "body-lg": ["18px", {
                            "lineHeight": "28px",
                            "fontWeight": "400"
                        }],
                        "label-md": ["14px", {
                            "lineHeight": "20px",
                            "letterSpacing": "0.01em",
                            "fontWeight": "500"
                        }],
                        "body-md": ["16px", {
                            "lineHeight": "24px",
                            "fontWeight": "400"
                        }],
                        "headline-lg-mobile": ["24px", {
                            "lineHeight": "32px",
                            "fontWeight": "600"
                        }],
                        "headline-md": ["24px", {
                            "lineHeight": "32px",
                            "fontWeight": "600"
                        }],
                        "label-sm": ["12px", {
                            "lineHeight": "16px",
                            "letterSpacing": "0.05em",
                            "fontWeight": "600"
                        }],
                        "title-lg": ["20px", {
                            "lineHeight": "28px",
                            "fontWeight": "600"
                        }]
                    }
                },
            },
        }
    </script>
</head>

<body class="font-sans bg-surface text-on-surface selection:bg-primary-fixed selection:text-on-primary-fixed overflow-x-hidden">
    <main class="min-h-screen w-full flex flex-col md:flex-row">
        <!-- Left Column: Visual Anchor -->
        <section
            class="hidden md:flex md:w-1/2 lg:w-[55%] xl:w-[60%] relative overflow-hidden bg-[radial-gradient(circle_at_top_left,_#f0fdf4_0%,_#dcfce7_100%)] p-xl flex-col justify-between">
            <!-- Decorative Elements -->
            <div
                class="absolute top-0 right-0 w-96 h-96 bg-primary-fixed/20 blur-[100px] rounded-full -translate-y-1/2 translate-x-1/2">
            </div>
            <div
                class="absolute bottom-0 left-0 w-64 h-64 bg-secondary-container/30 blur-[80px] rounded-full translate-y-1/2 -translate-x-1/2">
            </div>
            <header class="relative z-10 flex items-center gap-sm">
                <div class="w-10 h-10 bg-primary rounded-xl flex items-center justify-center">
                    <span class="material-symbols-outlined text-on-primary"
                        style="font-variation-settings: 'FILL' 1;">eco</span>
                </div>
                <span class="font-headline-md text-headline-md text-primary tracking-tight">SIDJ-Kluwih</span>
            </header>
            <div class="relative z-10 flex flex-col items-center justify-center grow">
                <!-- Illustration Container -->
                <div class="w-full max-w-2xl transform hover:scale-[1.02] transition-transform duration-700 ease-out">
                    <div
                        class="aspect-[4/3] rounded-2xl overflow-hidden shadow-2xl bg-white/40 p-md border border-white/60">
                        <img class="w-full h-full object-cover rounded-xl"
                            data-alt="A clean, modern flat vector illustration of an expansive green corn field under a clear soft blue sky. In the foreground, a sleek, high-tech industrial corn dryer machine with metallic surfaces and digital displays stands prominently. The style is professional Agri-Tech SaaS, utilizing a soft green and white color palette with minimalist lines and soft ambient lighting to convey growth and technological reliability."
                            src="https://lh3.googleusercontent.com/aida-public/AB6AXuC9jVrK1Jgk2ZPan0ahe9aIE6KeMfZSsAa0g3XXzd_iq81MJFos_TRo6hQQI7ufQKLCJvc6RN8ARFfm08MEIf7tBPbOyCa0ZD4xmiCYeX0AllQzzfHJPFrYHV312ZYB6napbma_fYrh2IU-GR7oIoUKb8888anbcy-YShJJ2LKfdipP0Z-U-66XVerXwGsontvLNSG12SJFNkG1rXI3YOrco6KKzud3-Siovaa0ijAknafVUkt7iJbLqw" />
                    </div>
                </div>
                <div class="mt-xl max-w-lg text-center">
                    <h2 class="font-headline-lg text-headline-lg text-on-surface mb-md">Optimalisasi Pasca Panen dengan
                        Teknologi Pintar</h2>
                    <p class="font-body-lg text-body-lg text-on-surface-variant">Solusi digital terintegrasi untuk
                        pemantauan kadar air dan efisiensi pengeringan jagung secara real-time.</p>
                </div>
            </div>
            <footer class="relative z-10">
                <div class="flex gap-md">
                    <div class="flex items-center gap-xs px-md py-sm bg-white/60 rounded-full border border-white/80">
                        <span class="material-symbols-outlined text-primary text-[18px]">verified</span>
                        <span class="text-label-md font-label-md">ISO 27001 Certified</span>
                    </div>
                    <div class="flex items-center gap-xs px-md py-sm bg-white/60 rounded-full border border-white/80">
                        <span class="material-symbols-outlined text-primary text-[18px]">cloud_done</span>
                        <span class="text-label-md font-label-md">Data Secured</span>
                    </div>
                </div>
            </footer>
        </section>
        <!-- Right Column: Login Form -->
        <section class="flex-1 flex flex-col justify-center items-center p-md sm:p-xl bg-white">
            <div class="w-full max-w-[440px] space-y-xl">
                <!-- Brand Mobile Header -->
                <div class="flex flex-col items-center md:items-start space-y-md">
                    <div class="md:hidden flex items-center gap-xs mb-md">
                        <div class="w-8 h-8 bg-primary rounded-lg flex items-center justify-center">
                            <span class="material-symbols-outlined text-on-primary text-[20px]"
                                style="font-variation-settings: 'FILL' 1;">eco</span>
                        </div>
                        <span class="font-title-lg text-title-lg text-primary font-bold">SIDJ-Kluwih</span>
                    </div>
                    <div class="text-center md:text-left space-y-xs">
                        <h1 class="font-headline-md text-headline-md text-on-surface tracking-tight">Selamat Datang
                            Kembali</h1>
                        <p class="font-body-md text-body-md text-on-surface-variant">Masuk ke akun Anda untuk mengelola
                            data jagung</p>
                    </div>
                </div>
                <!-- Form Section -->
                <form action="#" class="space-y-lg" onsubmit="return false;">
                    <div class="space-y-sm">
                        <label class="block font-label-md text-label-md text-on-surface-variant ml-xs"
                            for="username">Username</label>
                        <div class="relative group">
                            <div
                                class="absolute inset-y-0 left-0 pl-md flex items-center pointer-events-none text-outline group-focus-within:text-primary transition-colors">
                                <span class="material-symbols-outlined">person</span>
                            </div>
                            <input
                                class="w-full pl-xl pr-md py-md bg-surface-container-low border border-outline-variant rounded-2xl font-body-md text-body-md placeholder:text-outline/50 transition-all focus:border-primary focus:ring-4 focus:ring-primary/10 outline-none"
                                id="username" name="username" placeholder="Masukkan username Anda" type="text" />
                        </div>
                    </div>
                    <div class="space-y-sm">
                        <label class="block font-label-md text-label-md text-on-surface-variant ml-xs"
                            for="password">Password</label>
                        <div class="relative group">
                            <div
                                class="absolute inset-y-0 left-0 pl-md flex items-center pointer-events-none text-outline group-focus-within:text-primary transition-colors">
                                <span class="material-symbols-outlined">lock</span>
                            </div>
                            <input
                                class="w-full pl-xl pr-12 py-md bg-surface-container-low border border-outline-variant rounded-2xl font-body-md text-body-md placeholder:text-outline/50 transition-all focus:border-primary focus:ring-4 focus:ring-primary/10 outline-none"
                                id="password" name="password" placeholder="••••••••" type="password" />
                            <button
                                class="absolute inset-y-0 right-0 pr-md flex items-center text-outline hover:text-primary transition-colors"
                                type="button">
                                <span class="material-symbols-outlined">visibility</span>
                            </button>
                        </div>
                    </div>
                    <div class="flex items-center justify-between">
                        <label class="flex items-center group cursor-pointer">
                            <div class="relative flex items-center">
                                <input
                                    class="peer h-5 w-5 rounded border-outline-variant text-primary focus:ring-primary/20 transition-all cursor-pointer"
                                    type="checkbox" />
                            </div>
                            <span
                                class="ml-sm font-label-md text-label-md text-on-surface-variant group-hover:text-on-surface transition-colors">Ingat
                                Saya</span>
                        </label>
                        <a class="font-label-md text-label-md text-primary hover:text-primary-container transition-colors font-bold"
                            href="forgot-password">Lupa Kata Sandi?</a>
                    </div>
                    <button
                        class="w-full py-md bg-primary-container text-on-primary-container font-label-md text-label-md rounded-2xl shadow-lg shadow-primary/10 hover:shadow-primary/20 hover:bg-primary transition-all active:scale-[0.98] flex items-center justify-center gap-sm"
                        type="submit">
                        <span>Masuk</span>
                        <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
                    </button>
                </form>
                <!-- Alternative Methods -->
                <div class="relative py-md">
                    <div aria-hidden="true" class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-outline-variant"></div>
                    </div>
                    <div class="relative flex justify-center text-sm font-label-sm">
                        <span class="bg-white px-md text-outline">Atau masuk dengan</span>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-md">
                    <button
                        class="flex items-center justify-center gap-sm py-sm px-md border border-outline-variant rounded-xl hover:bg-surface-container transition-colors font-label-md">
                        <svg class="w-5 h-5" viewbox="0 0 24 24">
                            <path
                                d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"
                                fill="#4285F4"></path>
                            <path
                                d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"
                                fill="#34A853"></path>
                            <path
                                d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l3.66-2.84z"
                                fill="#FBBC05"></path>
                            <path
                                d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"
                                fill="#EA4335"></path>
                        </svg>
                        <span>Google</span>
                    </button>
                    <button
                        class="flex items-center justify-center gap-sm py-sm px-md border border-outline-variant rounded-xl hover:bg-surface-container transition-colors font-label-md">
                        <span class="material-symbols-outlined text-[20px] text-on-surface">qr_code_scanner</span>
                        <span>QR Code</span>
                    </button>
                </div>
                <!-- Footer -->
                <footer class="pt-xl text-center md:text-left">
                    <p class="font-label-sm text-label-sm text-on-surface-variant">
                        © 2024 SIDJ-Kluwih. Seluruh Hak Cipta Dilindungi.
                        <br class="md:hidden" />
                        <a class="ml-xs md:ml-sm text-primary font-bold hover:underline" href="forgot-password">Butuh
                            Bantuan?</a>
                    </p>
                </footer>
            </div>
        </section>
    </main>
    <script>
        // Micro-interactions and effects
        document.addEventListener('DOMContentLoaded', () => {
            const inputs = document.querySelectorAll('input');
            inputs.forEach(input => {
                input.addEventListener('focus', () => {
                    input.parentElement.classList.add('scale-[1.01]');
                });
                input.addEventListener('blur', () => {
                    input.parentElement.classList.remove('scale-[1.01]');
                });
            });

            // Toggle Password Visibility
            const togglePassword = document.querySelector('button[type="button"]');
            const passwordInput = document.querySelector('#password');

            togglePassword.addEventListener('click', () => {
                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput.setAttribute('type', type);
                togglePassword.querySelector('span').textContent = type === 'password' ? 'visibility' :
                    'visibility_off';
            });
        });
    </script>
</body>

</html>
