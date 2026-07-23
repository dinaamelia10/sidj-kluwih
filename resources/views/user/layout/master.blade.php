<!DOCTYPE html>
<html class="scroll-smooth" lang="id">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>@yield('title', 'SIDJ-Kluwih')</title>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=block" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script id="tailwind-config">
        try {
            tailwind.config = {
                darkMode: "class",
                theme: {
                    extend: {
                        colors: {
                            "primary": "#0d631b",
                            "primary-container": "#2e7d32",
                            "primary-fixed": "#a3f69c",
                            "primary-fixed-dim": "#88d982",
                            "on-primary": "#ffffff",
                            "on-primary-container": "#cbffc2",
                            "on-primary-fixed": "#002204",
                            "on-primary-fixed-variant": "#005312",
                            "secondary": "#006e1c",
                            "secondary-container": "#91f78e",
                            "secondary-fixed": "#94f990",
                            "secondary-fixed-dim": "#78dc77",
                            "on-secondary": "#ffffff",
                            "on-secondary-container": "#00731e",
                            "on-secondary-fixed": "#002204",
                            "on-secondary-fixed-variant": "#005313",
                            "tertiary": "#6e5100",
                            "tertiary-container": "#8c6800",
                            "tertiary-fixed": "#ffdfa0",
                            "tertiary-fixed-dim": "#f8bd2a",
                            "on-tertiary": "#ffffff",
                            "on-tertiary-container": "#ffefd7",
                            "on-tertiary-fixed": "#261a00",
                            "on-tertiary-fixed-variant": "#5c4300",
                            "surface": "#f9f9ff",
                            "surface-dim": "#cfdaf2",
                            "surface-container": "#e7eeff",
                            "surface-container-low": "#f0f3ff",
                            "surface-container-high": "#dee8ff",
                            "surface-container-highest": "#d8e3fb",
                            "surface-container-lowest": "#ffffff",
                            "surface-tint": "#1b6d24",
                            "surface-variant": "#d8e3fb",
                            "surface-bright": "#f9f9ff",
                            "background": "#f9f9ff",
                            "on-background": "#111c2d",
                            "on-surface": "#111c2d",
                            "on-surface-variant": "#40493d",
                            "outline": "#707a6c",
                            "outline-variant": "#bfcaba",
                            "inverse-surface": "#263143",
                            "inverse-on-surface": "#ecf1ff",
                            "inverse-primary": "#88d982",
                            "error": "#ba1a1a",
                            "error-container": "#ffdad6",
                            "on-error": "#ffffff",
                            "on-error-container": "#93000a"
                        },
                        fontFamily: {
                            "sans": ["Inter", "sans-serif"],
                            "body": ["Inter", "sans-serif"],
                            "headline": ["Inter", "sans-serif"],
                            "display": ["Inter", "sans-serif"],
                            "label": ["Inter", "sans-serif"]
                        },
                        borderRadius: {
                            "DEFAULT": "0.25rem",
                            "lg": "0.5rem",
                            "xl": "0.75rem",
                            "2xl": "1rem",
                            "3xl": "1.5rem",
                            "full": "9999px"
                        },
                        spacing: {
                            "xs": "4px",
                            "sm": "8px",
                            "md": "16px",
                            "lg": "24px",
                            "xl": "40px",
                            "base": "4px",
                            "gutter": "20px",
                            "container-margin": "24px"
                        },
                        fontSize: {
                            "headline-lg": ["32px", {lineHeight: "40px", letterSpacing: "-0.01em", fontWeight: "600"}],
                            "headline-md": ["24px", {lineHeight: "32px", fontWeight: "600"}],
                            "headline-lg-mobile": ["24px", {lineHeight: "32px", fontWeight: "600"}],
                            "title-lg": ["20px", {lineHeight: "28px", fontWeight: "600"}],
                            "body-lg": ["18px", {lineHeight: "28px", fontWeight: "400"}],
                            "body-md": ["16px", {lineHeight: "24px", fontWeight: "400"}],
                            "label-md": ["14px", {lineHeight: "20px", letterSpacing: "0.01em", fontWeight: "500"}],
                            "label-sm": ["12px", {lineHeight: "16px", letterSpacing: "0.05em", fontWeight: "600"}],
                            "display": ["48px", {lineHeight: "1.2", letterSpacing: "-0.02em", fontWeight: "700"}]
                        }
                    }
                }
            }
        } catch (_e) {}
    </script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f9f9ff;
            color: #111c2d;
        }
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
            vertical-align: middle;
        }
        .hero-gradient {
            background: linear-gradient(135deg, #f9f9ff 0%, #e7eeff 100%);
        }
        .hero-pattern {
            background-image: radial-gradient(#0d631b11 1px, transparent 1px);
            background-size: 24px 24px;
        }
        .glass-card {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(191, 202, 186, 0.5);
        }
        .soft-card {
            background: white;
            border: 1px solid #bfcaba;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -2px rgba(0, 0, 0, 0.05);
            border-radius: 1rem;
        }
        .soft-shadow {
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -2px rgba(0, 0, 0, 0.05);
        }
        .reveal {
            opacity: 0;
            transform: translateY(20px);
            transition: all 0.8s ease-out;
        }
        .reveal.active {
            opacity: 1;
            transform: translateY(0);
        }
        .input-focus-effect:focus {
            border-width: 2px;
            border-color: #0d631b;
            outline: none;
        }
        /* Scrollbar */
        .custom-scrollbar::-webkit-scrollbar { height: 4px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: #f0f3ff; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #bfcaba; border-radius: 9999px; }
        .nav-link-active {
            color: #0d631b;
            font-weight: 600;
        }
    </style>
    @stack('styles')
</head>
<body class="overflow-x-hidden bg-surface text-on-background">
@include('user.layout.header_user')
<main class="pt-20 md:pt-24 min-h-screen">
    @yield('content')
</main>
@include('user.layout.footer_user')

<script>
    // Mobile nav toggle
    const mobileToggle = document.getElementById('user-mobile-toggle');
    const mobileClose = document.getElementById('user-mobile-close');
    const mobileNav = document.getElementById('user-mobile-nav');
    const mobileOverlay = document.getElementById('user-mobile-overlay');

    function openMenu() {
        mobileNav?.classList.remove('-translate-x-full');
        mobileOverlay?.classList.remove('hidden');
        setTimeout(() => { mobileOverlay?.classList.add('opacity-100'); }, 10);
    }
    function closeMenu() {
        mobileNav?.classList.add('-translate-x-full');
        mobileOverlay?.classList.remove('opacity-100');
        setTimeout(() => { mobileOverlay?.classList.add('hidden'); }, 300);
    }

    mobileToggle?.addEventListener('click', openMenu);
    mobileClose?.addEventListener('click', closeMenu);
    mobileOverlay?.addEventListener('click', closeMenu);
    document.querySelectorAll('#user-mobile-nav a').forEach(link => {
        link.addEventListener('click', closeMenu);
    });

    // Reveal on scroll
    const revealObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('active');
            }
        });
    }, { threshold: 0.1, rootMargin: '0px 0px -50px 0px' });
    document.querySelectorAll('.reveal').forEach(el => revealObserver.observe(el));
</script>
@stack('scripts')
</body>
</html>
