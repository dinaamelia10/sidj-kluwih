@extends('user.layout.master')

@section('title', 'Hubungi Kami | SIDJ-Kluwih')

@section('content')
<!-- Menyuntikkan konfigurasi tema asli milikmu agar di-render oleh Tailwind CDN master -->
<script>
    try {
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "surface-dim": "#cfdaf2",
                        "on-error": "#ffffff",
                        "surface-container-highest": "#d8e3fb",
                        "on-tertiary-fixed-variant": "#5c4300",
                        "on-secondary-fixed": "#002204",
                        "on-tertiary-fixed": "#261a00",
                        "outline": "#707a6c",
                        "surface-container-lowest": "#ffffff",
                        "outline-variant": "#bfcaba",
                        "tertiary": "#6e5100",
                        "surface": "#f9f9ff",
                        "secondary-fixed-dim": "#78dc77",
                        "on-tertiary": "#ffffff",
                        "on-secondary": "#ffffff",
                        "surface-bright": "#f9f9ff",
                        "on-primary": "#ffffff",
                        "error-container": "#ffdad6",
                        "on-primary-fixed": "#002204",
                        "secondary-fixed": "#94f990",
                        "primary": "#0d631b",
                        "tertiary-fixed-dim": "#f8bd2a",
                        "surface-container": "#e7eeff",
                        "on-surface": "#111c2d",
                        "primary-container": "#2e7d32",
                        "on-background": "#111c2d",
                        "on-tertiary-container": "#ffefd7",
                        "on-primary-fixed-variant": "#005312",
                        "background": "#f9f9ff",
                        "surface-container-high": "#dee8ff",
                        "secondary": "#006e1c",
                        "surface-variant": "#d8e3fb",
                        "primary-fixed": "#a3f69c",
                        "on-secondary-fixed-variant": "#005313",
                        "on-secondary-container": "#00731e",
                        "on-surface-variant": "#40493d",
                        "on-primary-container": "#cbffc2",
                        "surface-container-low": "#f0f3ff",
                        "primary-fixed-dim": "#88d982",
                        "inverse-primary": "#88d982",
                        "inverse-on-surface": "#ecf1ff",
                        "surface-tint": "#1b6d24",
                        "on-error-container": "#93000a",
                        "error": "#ba1a1a",
                        "secondary-container": "#91f78e",
                        "inverse-surface": "#263143",
                        "tertiary-fixed": "#ffdfa0",
                        "tertiary-container": "#8c6800"
                    },
                    "borderRadius": {
                        "DEFAULT": "0.25rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
                        "full": "9999px"
                    },
                    "spacing": {
                        "md": "16px",
                        "base": "4px",
                        "gutter": "20px",
                        "container-margin": "24px",
                        "sm": "8px",
                        "xl": "40px",
                        "xs": "4px",
                        "lg": "24px"
                    },
                    "fontFamily": {
                        "body-lg": ["Inter"],
                        "title-lg": ["Inter"],
                        "headline-md": ["Inter"],
                        "headline-lg-mobile": ["Inter"],
                        "display": ["Inter"],
                        "body-md": ["Inter"],
                        "label-sm": ["Inter"],
                        "headline-lg": ["Inter"],
                        "label-md": ["Inter"]
                    },
                    "fontSize": {
                        "body-lg": ["18px", {"lineHeight": "28px", "fontWeight": "400"}],
                        "title-lg": ["20px", {"lineHeight": "28px", "fontWeight": "600"}],
                        "headline-md": ["24px", {"lineHeight": "32px", "fontWeight": "600"}],
                        "headline-lg-mobile": ["24px", {"lineHeight": "32px", "fontWeight": "600"}],
                        "display": ["48px", {"lineHeight": "1.2", "letterSpacing": "-0.02em", "fontWeight": "700"}],
                        "body-md": ["16px", {"lineHeight": "24px", "fontWeight": "400"}],
                        "label-sm": ["12px", {"lineHeight": "16px", "letterSpacing": "0.05em", "fontWeight": "600"}],
                        "headline-lg": ["32px", {"lineHeight": "40px", "letterSpacing": "-0.01em", "fontWeight": "600"}],
                        "label-md": ["14px", {"lineHeight": "20px", "letterSpacing": "0.01em", "fontWeight": "500"}]
                    }
                },
            },
        }
    } catch (_e) {}
</script>

<style>
    .soft-shadow {
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -2px rgba(0, 0, 0, 0.05);
    }
    .input-focus-effect:focus {
        border-width: 2px;
        border-color: #0d631b;
        outline: none;
    }
    .glass-card {
        background: rgba(255, 255, 255, 0.8);
        backdrop-filter: blur(8px);
    }
</style>

<main class="min-h-screen">
    <!-- Hero Section -->
    <section class="relative overflow-hidden py-xl md:py-32 bg-surface-container-low">
        <div class="relative z-10 max-w-7xl mx-auto px-container-margin text-center">
            <h1 class="font-display text-display text-primary mb-md">Hubungi Kami</h1>
            <p class="font-body-lg text-body-lg text-on-surface-variant max-w-2xl mx-auto">
                Kami hadir untuk membantu Anda mengoptimalkan hasil panen dan manajemen pasca-panen jagung dengan teknologi terkini.
            </p>
        </div>
    </section>

    <!-- Main Contact Section -->
    <section class="py-xl max-w-7xl mx-auto px-container-margin">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-lg lg:gap-xl">
            <!-- Contact Form -->
            <div class="lg:col-span-7 bg-surface p-lg md:p-xl rounded-xl border border-outline-variant soft-shadow">
                <h2 class="font-headline-lg text-headline-lg mb-lg text-on-surface">Kirim Pesan</h2>
                <form class="space-y-md">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-md">
                        <div>
                            <label class="block font-label-md text-label-md mb-xs text-on-surface-variant" for="name">Nama Lengkap</label>
                            <input class="w-full rounded-lg border-outline-variant bg-surface-container-lowest py-sm px-md input-focus-effect font-body-md" id="name" placeholder="John Doe" type="text"/>
                        </div>
                        <div>
                            <label class="block font-label-md text-label-md mb-xs text-on-surface-variant" for="email">Email</label>
                            <input class="w-full rounded-lg border-outline-variant bg-surface-container-lowest py-sm px-md input-focus-effect font-body-md" id="email" placeholder="john@example.com" type="email"/>
                        </div>
                    </div>
                    <div>
                        <label class="block font-label-md text-label-md mb-xs text-on-surface-variant" for="subject">Subjek</label>
                        <input class="w-full rounded-lg border-outline-variant bg-surface-container-lowest py-sm px-md input-focus-effect font-body-md" id="subject" placeholder="Pertanyaan seputar layanan" type="text"/>
                    </div>
                    <div>
                        <label class="block font-label-md text-label-md mb-xs text-on-surface-variant" for="message">Pesan</label>
                        <textarea class="w-full rounded-lg border-outline-variant bg-surface-container-lowest py-sm px-md input-focus-effect font-body-md" id="message" placeholder="Tuliskan pesan Anda di sini..." rows="5"></textarea>
                    </div>
                    <button class="w-full md:w-auto px-xl py-md bg-primary text-on-primary rounded-lg font-title-lg hover:scale-[1.02] active:scale-95 transition-all flex items-center justify-center gap-sm" type="submit">
                        <span>Kirim Pesan</span>
                        <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 0;">send</span>
                    </button>
                </form>
            </div>

            <!-- Contact Info -->
            <div class="lg:col-span-5 flex flex-col gap-lg">
                <div class="bg-surface-container-low p-lg rounded-xl border border-outline-variant">
                    <h3 class="font-title-lg text-title-lg mb-lg text-primary">Informasi Kontak</h3>
                    <ul class="space-y-lg">
                        <li class="flex gap-md">
                            <div class="bg-secondary-container p-sm rounded-lg flex items-center justify-center h-fit">
                                <span class="material-symbols-outlined text-on-secondary-container">location_on</span>
                            </div>
                            <div>
                                <p class="font-label-md text-on-surface-variant">Alamat Kantor</p>
                                <p class="font-body-md font-semibold">Jl. Pertanian Modern No. 45, Kediri, Jawa Timur</p>
                            </div>
                        </li>
                        <li class="flex gap-md">
                            <div class="bg-secondary-container p-sm rounded-lg flex items-center justify-center h-fit">
                                <span class="material-symbols-outlined text-on-secondary-container">call</span>
                            </div>
                            <div>
                                <p class="font-label-md text-on-surface-variant">Telepon / WhatsApp</p>
                                <p class="font-body-md font-semibold">+62 812-3456-7890</p>
                            </div>
                        </li>
                        <li class="flex gap-md">
                            <div class="bg-secondary-container p-sm rounded-lg flex items-center justify-center h-fit">
                                <span class="material-symbols-outlined text-on-secondary-container">mail</span>
                            </div>
                            <div>
                                <p class="font-label-md text-on-surface-variant">Email</p>
                                <p class="font-body-md font-semibold">halo@sidj-kluwih.com</p>
                            </div>
                        </li>
                        <li class="flex gap-md">
                            <div class="bg-secondary-container p-sm rounded-lg flex items-center justify-center h-fit">
                                <span class="material-symbols-outlined text-on-secondary-container">schedule</span>
                            </div>
                            <div>
                                <p class="font-label-md text-on-surface-variant">Jam Layanan</p>
                                <p class="font-body-md font-semibold">Senin - Sabtu: 08.00 - 17.00 WIB</p>
                            </div>
                        </li>
                    </ul>
                </div>

                <!-- Map Placeholder -->
                <div class="h-64 md:h-full min-h-[300px] rounded-xl overflow-hidden border border-outline-variant relative soft-shadow">
                    <div class="absolute inset-0 bg-surface-container-highest flex items-center justify-center" data-location="Kediri, Jawa Timur">
                        <img class="w-full h-full object-cover grayscale opacity-80 mix-blend-multiply" alt="Peta visualisasi Kediri" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCEnmdHEojd05DhphlrWmSG6qVbJMjStG983EwBW4MmBdNsuVoKcZoy5eTQBDpzbwCCzcaVTqYf1kJ6PUOIVMCOgCbDxJpX3NlAZoHqARvectqxGS8gDONi3lbgrCZ-N1Z0EdTLCKEFK48PKW-vtwMubF49QpVRpHBOMNChxC6zqTJUaWPVg91l_WYrqvzFLNTKQt3FsDLUL1XjnMybcmMuUKT4PxNsuN7LL7JvGkom_zunZKeIMG2V4g"/>
                    </div>
                    <div class="absolute bottom-4 left-4 bg-white/90 backdrop-blur p-sm rounded-lg border border-outline shadow-lg">
                        <p class="font-label-sm text-primary flex items-center gap-xs">
                            <span class="material-symbols-outlined text-[16px]">map</span>
                            Lihat di Google Maps
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Technical Support Section -->
    <section class="py-xl bg-surface-container">
        <div class="max-w-7xl mx-auto px-container-margin">
            <div class="flex flex-col md:flex-row justify-between items-end mb-lg gap-md">
                <div>
                    <h2 class="font-headline-lg text-on-surface">Technical Support</h2>
                    <p class="font-body-md text-on-surface-variant">Bantuan khusus untuk operasional alat dan platform digital.</p>
                </div>
                <button class="bg-secondary text-on-secondary px-lg py-sm rounded-full font-label-md flex items-center gap-sm hover:bg-on-secondary-container transition-colors">
                    Buka Tiket Bantuan
                    <span class="material-symbols-outlined text-[18px]">open_in_new</span>
                </button>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-md">
                <!-- Support Card 1 -->
                <div class="bg-surface p-lg rounded-xl border border-outline-variant soft-shadow hover:translate-y-[-4px] transition-all duration-300">
                    <div class="w-10 h-10 rounded-full bg-secondary-fixed flex items-center justify-center mb-md">
                        <span class="material-symbols-outlined text-on-secondary-fixed">engineering</span>
                    </div>
                    <h4 class="font-title-lg mb-sm">Panduan Smart Dryer</h4>
                    <p class="font-body-md text-on-surface-variant mb-md">Akses manual penggunaan dan tutorial perawatan rutin mesin pengering jagung pintar Anda.</p>
                    <a class="text-primary font-label-md flex items-center gap-xs hover:underline" href="#">
                        Unduh PDF
                        <span class="material-symbols-outlined text-[16px]">download</span>
                    </a>
                </div>
                <!-- Support Card 2 -->
                <div class="bg-surface p-lg rounded-xl border border-outline-variant soft-shadow hover:translate-y-[-4px] transition-all duration-300">
                    <div class="w-10 h-10 rounded-full bg-tertiary-fixed flex items-center justify-center mb-md">
                        <span class="material-symbols-outlined text-on-tertiary-fixed">monitoring</span>
                    </div>
                    <h4 class="font-title-lg mb-sm">Isu Dashboard Data</h4>
                    <p class="font-body-md text-on-surface-variant mb-md">Mengalami kendala sinkronisasi data real-time? Tim IT kami siap membantu integrasi sistem Anda.</p>
                    <a class="text-primary font-label-md flex items-center gap-xs hover:underline" href="#">
                        Hubungi Tim IT
                        <span class="material-symbols-outlined text-[16px]">chevron_right</span>
                    </a>
                </div>
                <!-- Support Card 3 -->
                <div class="bg-surface p-lg rounded-xl border border-outline-variant soft-shadow hover:translate-y-[-4px] transition-all duration-300">
                    <div class="w-10 h-10 rounded-full bg-primary-fixed flex items-center justify-center mb-md">
                        <span class="material-symbols-outlined text-on-primary-fixed">quiz</span>
                    </div>
                    <h4 class="font-title-lg mb-sm">Pusat Bantuan (FAQ)</h4>
                    <p class="font-body-md text-on-surface-variant mb-md">Temukan jawaban cepat untuk pertanyaan yang sering diajukan oleh mitra petani kami.</p>
                    <a class="text-primary font-label-md flex items-center gap-xs hover:underline" href="#">
                        Baca FAQ
                        <span class="material-symbols-outlined text-[16px]">help</span>
                    </a>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection

@push('scripts')
<script>
    document.querySelector('form').addEventListener('submit', function(e) {
        e.preventDefault();
        const btn = e.target.querySelector('button');
        const originalContent = btn.innerHTML;
        btn.innerHTML = '<span>Mengirim...</span>';
        btn.disabled = true;
        
        setTimeout(() => {
            btn.innerHTML = '<span class="material-symbols-outlined">check_circle</span> <span>Terkirim!</span>';
            btn.classList.replace('bg-primary', 'bg-green-600');
            
            setTimeout(() => {
                btn.innerHTML = originalContent;
                btn.classList.replace('bg-green-600', 'bg-primary');
                btn.disabled = false;
                e.target.reset();
            }, 3000);
        }, 1500);
    });
</script>
@endpush