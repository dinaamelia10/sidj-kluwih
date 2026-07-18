<!DOCTYPE html>

<html class="light" lang="id">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Tambah Laporan Baru | SIDJ-Kluwih</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&amp;display=swap"
        rel="stylesheet" />
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
                        "primary-container": "#2e7d32",
                        "on-primary-fixed": "#002204",
                        "surface-container-lowest": "#ffffff",
                        "error-container": "#ffdad6",
                        "surface-dim": "#cfdaf2",
                        "on-surface": "#111c2d",
                        "on-secondary-fixed-variant": "#005313",
                        "on-tertiary": "#ffffff",
                        "error": "#ba1a1a",
                        "on-error-container": "#93000a",
                        "on-secondary-fixed": "#002204",
                        "surface-variant": "#d8e3fb",
                        "secondary-container": "#91f78e",
                        "surface-tint": "#1b6d24",
                        "outline": "#707a6c",
                        "inverse-surface": "#263143",
                        "on-surface-variant": "#40493d",
                        "on-secondary": "#ffffff",
                        "tertiary": "#6e5100",
                        "on-tertiary-fixed": "#261a00",
                        "on-primary-fixed-variant": "#005312",
                        "on-tertiary-container": "#ffefd7",
                        "tertiary-container": "#8c6800",
                        "primary": "#0d631b",
                        "surface-container-highest": "#d8e3fb",
                        "surface-container-low": "#f0f3ff",
                        "surface-bright": "#f9f9ff",
                        "surface-container-high": "#dee8ff",
                        "surface-container": "#e7eeff",
                        "on-tertiary-fixed-variant": "#5c4300",
                        "on-primary-container": "#cbffc2",
                        "inverse-on-surface": "#ecf1ff",
                        "inverse-primary": "#88d982",
                        "secondary": "#006e1c",
                        "secondary-fixed-dim": "#78dc77",
                        "secondary-fixed": "#94f990",
                        "background": "#f9f9ff",
                        "on-secondary-container": "#00731e",
                        "surface": "#f9f9ff",
                        "tertiary-fixed": "#ffdfa0",
                        "primary-fixed": "#a3f69c",
                        "on-background": "#111c2d",
                        "tertiary-fixed-dim": "#f8bd2a",
                        "on-primary": "#ffffff",
                        "outline-variant": "#bfcaba",
                        "on-error": "#ffffff",
                        "primary-fixed-dim": "#88d982"
                    },
                    "borderRadius": {
                        "DEFAULT": "0.25rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
                        "full": "9999px"
                    },
                    "spacing": {
                        "sm": "8px",
                        "gutter": "20px",
                        "container-margin": "24px",
                        "xs": "4px",
                        "md": "16px",
                        "lg": "24px",
                        "base": "4px",
                        "xl": "40px"
                    },
                    "fontFamily": {
                        "display": ["Inter"],
                        "headline-lg": ["Inter"],
                        "body-md": ["Inter"],
                        "body-lg": ["Inter"],
                        "title-lg": ["Inter"],
                        "headline-md": ["Inter"],
                        "label-sm": ["Inter"],
                        "label-md": ["Inter"]
                    }
                }
            }
        }
    </script>
    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }

        .glass-panel {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
        }
    </style>
</head>

<body class="bg-background font-body-md text-on-background overflow-hidden">
    <!-- Background Context (Blurred) -->
    <div class="fixed inset-0 z-0 blur-sm pointer-events-none opacity-40">
        <div class="w-full h-full bg-cover"
            data-alt="A sophisticated agricultural data dashboard featuring complex charts, maps of corn fields, and a modern UI interface. The scene is dominated by soft greens and crisp whites, representing a data-driven high-tech farming management tool. Professional lighting creates a clean, administrative atmosphere."
            style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuCb6i_FuqUmM3VvlEM9yPuwArtueB4z359UHZRpJqoELc_pDU1AxpP2_gAI-z8fCBh1z06FCGdTJaY1PwsiCuDaUYC1kQQ-Ild09-EOEDiXfpXlEojG_RaJgAeKj_nrrni1xkTV1fwOXSlC2wuKj1s5spzeF9gBLpmi9AbRFLWOVY72lM9RBK8cC9yxkIg1mOXkpYM04JUBGu_ZB9dbMmbV7iy_K_czO0HKuuh2APrmpfrpyu9IQeV7yQ')">
        </div>
    </div>
    <!-- Modal Overlay -->
    <div class="fixed inset-0 z-50 flex items-center justify-center p-md bg-on-surface/20 backdrop-blur-sm">
        <!-- Modal Container -->
        <div
            class="w-full max-w-4xl max-h-[921px] glass-panel rounded-xl shadow-xl flex flex-col overflow-hidden animate-in fade-in zoom-in duration-300">
            <!-- Header -->
            <div
                class="px-lg py-md border-b border-outline-variant flex justify-between items-center bg-surface-container-low bg-primary-container/5">
                <div class="flex items-center gap-sm">
                    <div class="p-xs bg-primary/10 rounded-lg text-primary">
                        <span class="material-symbols-outlined text-[32px]">analytics</span>
                    </div>
                    <div>
                        <h1 class="font-headline-md text-headline-md text-on-surface">Tambah Laporan Baru</h1>
                        <p class="font-label-md text-label-md text-on-surface-variant">Konfigurasi parameter laporan
                            analitik jagung</p>
                    </div>
                </div>
                <button class="p-xs hover:bg-surface-variant rounded-full transition-colors">
                    <span class="material-symbols-outlined text-on-surface-variant">analytics</span>
                </button>
            </div>
            <!-- Content Area (Scrollable) -->
            <div class="flex-1 overflow-y-auto p-lg grid grid-cols-1 md:grid-cols-12 gap-lg">
                <!-- Left: Form Controls -->
                <div class="md:col-span-7 space-y-md">
                    <div class="grid grid-cols-2 gap-md">
                        <!-- Report Type -->
                        <div class="space-y-xs">
                            <label
                                class="font-label-md text-label-md text-on-surface-variant font-bold text-primary uppercase tracking-wider text-[11px]">Jenis
                                Laporan</label>
                            <select
                                class="w-full h-12 rounded-lg border-outline-variant focus:border-primary focus:ring-1 focus:ring-primary bg-surface transition-all">
                                <option>Harian</option>
                                <option>Mingguan</option>
                                <option>Bulanan</option>
                                <option>Tahunan</option>
                            </select>
                        </div>
                        <!-- Category -->
                        <div class="space-y-xs">
                            <label
                                class="font-label-md text-label-md text-on-surface-variant font-bold text-primary uppercase tracking-wider text-[11px]">Kategori</label>
                            <select
                                class="w-full h-12 rounded-lg border-outline-variant focus:border-primary focus:ring-1 focus:ring-primary bg-surface transition-all">
                                <option>Tonase Jagung</option>
                                <option>Monitoring Suhu</option>
                                <option>Harga Beli</option>
                                <option>Kinerja Petani</option>
                            </select>
                        </div>
                    </div>
                    <!-- Date Range -->
                    <div class="space-y-xs">
                        <label
                            class="font-label-md text-label-md text-on-surface-variant font-bold text-primary uppercase tracking-wider text-[11px]">Rentang
                            Tanggal</label>
                        <div class="grid grid-cols-2 gap-md items-center">
                            <div class="relative">
                                <input
                                    class="w-full h-12 pl-10 pr-sm rounded-lg border-outline-variant focus:border-primary focus:ring-1 focus:ring-primary bg-surface transition-all"
                                    type="date" />
                                <span
                                    class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-outline">calendar_month</span>
                            </div>
                            <div class="relative">
                                <input
                                    class="w-full h-12 pl-10 pr-sm rounded-lg border-outline-variant focus:border-primary focus:ring-1 focus:ring-primary bg-surface transition-all"
                                    type="date" />
                                <span
                                    class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-outline">event_repeat</span>
                            </div>
                        </div>
                    </div>
                    <!-- Notes -->
                    <div class="space-y-xs">
                        <label
                            class="font-label-md text-label-md text-on-surface-variant font-bold text-primary uppercase tracking-wider text-[11px]">Keterangan
                            / Catatan</label>
                        <textarea
                            class="w-full rounded-lg border-outline-variant focus:border-primary focus:ring-1 focus:ring-primary bg-surface transition-all"
                            placeholder="Tambahkan konteks atau instruksi khusus untuk laporan ini..." rows="4"></textarea>
                    </div>
                </div>
                <!-- Right: Preview Section (Bento Style) -->
                <div
                    class="md:col-span-5 bg-secondary-container/10 rounded-2xl p-lg border border-outline-variant/30 flex flex-col gap-lg">
                    <div class="flex items-center gap-xs text-primary">
                        <span class="material-symbols-outlined text-[20px]">insights</span>
                        <h3 class="font-title-lg text-title-lg">Preview Data</h3>
                    </div>
                    <div class="flex-1 space-y-sm">
                        <!-- Data Card 1 -->
                        <div
                            class="bg-surface-container-lowest p-md rounded-xl border border-outline-variant/50 flex items-center justify-between shadow-sm">
                            <div class="space-y-xs">
                                <p
                                    class="font-label-sm text-label-sm text-on-surface-variant uppercase tracking-widest">
                                    Estimasi Tonase</p>
                                <p class="font-headline-md text-headline-md text-primary font-bold">124.5 <span
                                        class="text-label-md font-medium">Ton</span></p>
                            </div>
                            <div
                                class="size-10 rounded-full bg-primary/10 flex items-center justify-center text-primary">
                                <span class="material-symbols-outlined text-[20px]">monitoring</span></div>
                        </div>
                        <!-- Data Card 2 -->
                        <div
                            class="bg-surface-container-lowest p-md rounded-xl border border-outline-variant/50 flex items-center justify-between shadow-sm">
                            <div class="space-y-xs">
                                <p
                                    class="font-label-sm text-label-sm text-on-surface-variant uppercase tracking-widest">
                                    Fluktuasi Harga</p>
                                <p class="font-headline-md text-headline-md text-tertiary font-bold">+250 <span
                                        class="text-label-md font-medium">/kg</span></p>
                            </div>
                            <div
                                class="size-10 rounded-full bg-tertiary/10 flex items-center justify-center text-tertiary">
                                <span class="material-symbols-outlined text-[20px]">trending_up</span></div>
                        </div>
                        <!-- Visualizer Mockup -->
                        <div class="pt-sm border-t border-outline-variant">
                            <p class="font-label-md text-label-md text-on-surface-variant mb-xs">Status Pengeringan
                                (Rerata)</p>
                            <div class="w-full bg-surface-variant rounded-full overflow-hidden h-1.5">
                                <div class="w-[72%] h-full bg-primary-container"></div>
                            </div>
                            <div class="flex justify-between mt-xs">
                                <span class="font-label-sm text-label-sm text-on-surface-variant">72% Selesai</span>
                                <span class="font-label-sm text-label-sm text-primary font-bold">Optimal</span>
                            </div>
                        </div>
                    </div>
                    <div class="mt-auto bg-primary-container/5 p-sm rounded-lg">
                        <p class="font-label-sm text-label-sm text-on-surface-variant italic leading-tight">
                            *Data di atas merupakan ringkasan otomatis berdasarkan rentang tanggal yang Anda pilih.
                        </p>
                    </div>
                </div>
            </div>
            <!-- Footer Actions -->
            <div
                class="px-lg py-md border-t border-outline-variant bg-surface-container-lowest flex justify-end items-center gap-md">
                <button
                    class="px-lg h-12 font-label-md text-label-md text-primary border border-primary hover:bg-primary/5 transition-all active:scale-95 rounded-xl">
                    Batal
                </button>
                <button
                    class="px-lg h-12 rounded-xl font-bold text-label-md text-on-primary bg-primary-container hover:bg-primary transition-all shadow-lg shadow-primary-container/20 active:scale-95 flex items-center gap-sm">
                    <span class="material-symbols-outlined text-[20px]">save</span>
                    Buat Laporan Sekarang
                </button>
            </div>
        </div>
    </div>
    <!-- Notification Toast (Hidden by default) -->
    <div class="fixed bottom-lg right-lg z-[100] translate-y-20 opacity-0 transition-all duration-300 pointer-events-none"
        id="toast">
        <div
            class="bg-inverse-surface text-inverse-on-surface px-lg py-sm rounded-lg shadow-xl flex items-center gap-md">
            <span class="material-symbols-outlined text-primary-fixed">check_circle</span>
            <span class="font-label-md text-label-md">Laporan sedang dikompilasi...</span>
        </div>
    </div>
    <script>
        // Simple Interaction logic for demo
        const createBtn = document.querySelector('button.bg-primary-container');
        const toast = document.getElementById('toast');

        createBtn.addEventListener('click', () => {
            toast.classList.remove('translate-y-20', 'opacity-0');
            toast.classList.add('translate-y-0', 'opacity-100');

            setTimeout(() => {
                toast.classList.add('translate-y-20', 'opacity-0');
                toast.classList.remove('translate-y-0', 'opacity-100');
            }, 3000);
        });

        // Date input hover effect
        document.querySelectorAll('input[type="date"]').forEach(input => {
            input.addEventListener('focus', () => {
                input.parentElement.querySelector('.material-symbols-outlined').style.color = '#2e7d32';
            });
            input.addEventListener('blur', () => {
                input.parentElement.querySelector('.material-symbols-outlined').style.color = '#707a6c';
            });
        });
    </script>
</body>

</html>
