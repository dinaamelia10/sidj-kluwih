<!DOCTYPE html>
<html class="scroll-smooth" lang="en">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>@yield('title', 'SIDJ-Kluwih')</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Libre+Caslon+Text:wght@400;700&amp;family=Inter:wght@300;400;500;600;700&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet">
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#18241b",
                        "primary-container": "#2d3a30",
                        "secondary": "#506358",
                        "secondary-container": "#d2e8da",
                        "surface": "#faf9f6",
                        "surface-container": "#efeeeb",
                        "surface-dim": "#dbdad7",
                        "on-background": "#1a1c1a",
                        "outline": "#747873",
                        "outline-variant": "#c3c8c1",
                        "on-surface": "#1a1c1a"
                    },
                    fontFamily: {
                        "headline": ["Libre Caslon Text", "serif"],
                        "body": ["Inter", "sans-serif"]
                    },
                    borderRadius: {
                        "DEFAULT": "0.25rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
                        "full": "9999px"
                    }
                }
            }
        }
    </script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        .hero-gradient {
            background: linear-gradient(135deg, #faf9f6 0%, #efeeeb 100%);
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
    </style>
</head>
<body class="overflow-x-hidden bg-surface text-on-background">
@include('user.layout.header_user')
<main class="pt-24 md:pt-28">
    @yield('content')
</main>
@include('user.layout.footer_user')
<script>
    const mobileToggle = document.getElementById('user-mobile-toggle');
    const mobileNav = document.getElementById('user-mobile-nav');
    mobileToggle?.addEventListener('click', () => {
        mobileNav?.classList.toggle('hidden');
    });
    document.querySelectorAll('#user-mobile-nav a').forEach(link => {
        link.addEventListener('click', () => mobileNav?.classList.add('hidden'));
    });
</script>
@stack('scripts')
</body>
</html>
