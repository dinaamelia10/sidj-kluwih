<!DOCTYPE html>
<html lang="id" class="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=block" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script id="tailwind-config">
        try {
            tailwind.config = {
                darkMode: "class",
                theme: {
                    extend: {
                        colors: {
                            surface: "#f9f9ff",
                            background: "#f9f9ff",
                            "surface-container": "#e7eeff",
                            "surface-container-low": "#f0f3ff",
                            "surface-container-high": "#dee8ff",
                            "surface-container-highest": "#d8e3fb",
                            "surface-container-lowest": "#ffffff",
                            "surface-tint": "#1b6d24",
                            "surface-variant": "#d8e3fb",
                            "surface-dim": "#cfdaf2",
                            "outline": "#707a6c",
                            "outline-variant": "#bfcaba",
                            "primary": "#0d631b",
                            "primary-container": "#2e7d32",
                            "primary-fixed": "#a3f69c",
                            "primary-fixed-dim": "#88d982",
                            "on-primary": "#ffffff",
                            "on-primary-container": "#cbffc2",
                            "on-primary-fixed": "#002204",
                            "on-primary-fixed-variant": "#005312",
                            secondary: "#006e1c",
                            "secondary-container": "#91f78e",
                            "secondary-fixed": "#94f990",
                            "secondary-fixed-dim": "#78dc77",
                            "on-secondary": "#ffffff",
                            "on-secondary-container": "#00731e",
                            "on-secondary-fixed": "#002204",
                            "on-secondary-fixed-variant": "#005313",
                            tertiary: "#6e5100",
                            "tertiary-container": "#8c6800",
                            "tertiary-fixed": "#ffdfa0",
                            "tertiary-fixed-dim": "#f8bd2a",
                            "on-tertiary": "#ffffff",
                            "on-tertiary-container": "#ffefd7",
                            "on-tertiary-fixed-variant": "#5c4300",
                            "on-surface": "#111c2d",
                            "on-surface-variant": "#40493d",
                            "inverse-surface": "#263143",
                            "inverse-on-surface": "#ecf1ff",
                            error: "#ba1a1a",
                            "error-container": "#ffdad6",
                            "on-error": "#ffffff",
                            "on-error-container": "#93000a"
                        },
                        borderRadius: {
                            DEFAULT: "0.25rem",
                            lg: "0.5rem",
                            xl: "0.75rem",
                            xxl: "20px",
                            full: "9999px"
                        },
                        spacing: {
                            xs: "4px",
                            sm: "8px",
                            "container-margin": "24px",
                            base: "4px",
                            gutter: "20px",
                            lg: "24px",
                            xl: "40px",
                            md: "16px"
                        },
                        fontFamily: {
                            "headline-md": ["Inter"],
                            "body-lg": ["Inter"],
                            "headline-lg": ["Inter"],
                            display: ["Inter"],
                            "title-lg": ["Inter"],
                            "label-md": ["Inter"],
                            "headline-lg-mobile": ["Inter"],
                            "label-sm": ["Inter"],
                            "body-md": ["Inter"]
                        },
                        fontSize: {
                            "headline-md": ["24px", {lineHeight: "32px", fontWeight: "600"}],
                            "body-lg": ["18px", {lineHeight: "28px", fontWeight: "400"}],
                            "headline-lg": ["32px", {lineHeight: "40px", letterSpacing: "-0.01em", fontWeight: "600"}],
                            display: ["48px", {lineHeight: "1.2", letterSpacing: "-0.02em", fontWeight: "700"}],
                            "title-lg": ["20px", {lineHeight: "28px", fontWeight: "600"}],
                            "label-md": ["14px", {lineHeight: "20px", letterSpacing: "0.01em", fontWeight: "500"}],
                            "headline-lg-mobile": ["24px", {lineHeight: "32px", fontWeight: "600"}],
                            "label-sm": ["12px", {lineHeight: "16px", letterSpacing: "0.05em", fontWeight: "600"}],
                            "body-md": ["16px", {lineHeight: "24px", fontWeight: "400"}]
                        }
                    }
                }
            }
        } catch (_e) {}
    </script>
    <meta charset="utf-8">
</head>
<body class="flex min-h-screen">
    @include('admin.layout.navbar')
    <main class="flex-1 flex flex-col min-w-0 bg-background overflow-y-auto">
        @include('admin.layout.header')
        <div class="p-lg md:p-xl space-y-xl max-w-7xl mx-auto w-full">
            @yield('content')
        </div>
        @include('admin.layout.footer')
    </main>
    <div class="fixed inset-0 bg-black/50 z-[100] opacity-0 pointer-events-none transition-opacity duration-300 md:hidden" id="mobile-menu">
        <div class="w-64 h-full bg-white p-lg flex flex-col -translate-x-full transition-transform duration-300" id="mobile-drawer"></div>
    </div>
    <script>
        document.querySelectorAll('button, a').forEach(el => {
            el.addEventListener('mousedown', () => {
                el.classList.add('scale-95');
                setTimeout(() => el.classList.remove('scale-95'), 150);
            });
        });

        const searchInput = document.querySelector('input[type="text"]');
        if (searchInput) {
            searchInput.addEventListener('input', (e) => {
                const val = e.target.value.toLowerCase();
                const rows = document.querySelectorAll('tbody tr');
                rows.forEach(row => {
                    const text = row.innerText.toLowerCase();
                    row.style.display = text.includes(val) ? '' : 'none';
                });
            });
        }
    </script>
</body>
</html>
