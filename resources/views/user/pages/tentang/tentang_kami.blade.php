@extends('user.layout.master')

@section('title', 'Tentang Kami - SIDJ-Kluwih')

@section('content')
<div class="overflow-x-hidden">
    <!-- Hero Section -->
    <section class="relative pt-12 pb-20 md:pt-20 md:pb-32 px-6 hero-pattern overflow-hidden">
        <div class="max-w-7xl mx-auto grid md:grid-cols-2 gap-10 items-center relative z-10">

            <div class="order-2 md:order-1">
                <span class="inline-block py-1 px-4 mb-4 rounded-full bg-secondary-container text-primary font-medium text-xs uppercase tracking-wider">
                    Tentang Kami
                </span>

                <h1 class="font-headline text-4xl md:text-5xl mb-6 leading-tight text-primary">
                    Menghubungkan <span class="text-secondary italic">Tradisi</span> dengan Teknologi Modern
                </h1>

                <p class="font-body text-lg text-secondary mb-8 max-w-xl">
                    SIDJ-Kluwih lahir dari visi untuk mentransformasi sektor agrikultur lokal menjadi ekosistem
                    digital yang efisien, transparan, dan berkelanjutan. Kami menyediakan solusi data terpadu
                    untuk memberdayakan petani jagung di Kluwih.
                </p>

                <div class="flex flex-wrap gap-4">
                    <button class="bg-primary text-surface px-6 py-3 rounded-xl font-semibold text-sm hover:shadow-lg transition-all active:scale-95">
                        Eksplorasi Solusi
                    </button>
                    <button class="bg-surface border border-outline px-6 py-3 rounded-xl font-semibold text-sm hover:bg-surface-container transition-all">
                        Pelajari Lebih Lanjut
                    </button>
                </div>
            </div>

            <div class="order-1 md:order-2 relative">
                <div class="aspect-square rounded-3xl overflow-hidden shadow-2xl rotate-3 scale-95 transition-transform hover:rotate-0 duration-500">
                    <img
                        class="w-full h-full object-cover"
                        alt="Petani menggunakan tablet di ladang jagung"
                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuDUtQeeYL7ro1mUv7mSfNPR9s74pEN9an8SCSqCKi9Lhks9jY_i717vTgB7STs1NsT0cXjj1MU80QQUECMQ5x5HWIOZCltkUMMOXo_JPFjM8GqEcuNEZvCC-XxmYOISuQN95Ft2BLAAzKPXYH4z4zDatdFQMbHttlkt87cHFS1G9VNZv6kQPq1kG65rIq7Q04yxiEzQ0q2IVkWUbU6fs5ohi9WBI9lPULo576j-T76LE8LHA7WduXzwZg"
                    />
                </div>

                <div class="absolute -bottom-8 -left-8 glass-card p-6 rounded-2xl shadow-xl hidden lg:block">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-secondary-container rounded-full flex items-center justify-center text-primary">
                            <span class="material-symbols-outlined">trending_up</span>
                        </div>
                        <div>
                            <p class="text-xs text-secondary uppercase font-semibold">Pertumbuhan Data</p>
                            <p class="font-headline text-xl text-primary">+85% Efisiensi</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!-- Background Decoration -->
        <div class="absolute top-0 right-0 w-1/3 h-1/2 bg-gradient-to-bl from-secondary-container/20 to-transparent blur-3xl -z-10"></div>
        <div class="absolute bottom-0 left-0 w-1/4 h-1/3 bg-gradient-to-tr from-secondary-container/20 to-transparent blur-3xl -z-10"></div>
    </section>

    <!-- Visi & Misi -->
    <section class="py-24 bg-white px-6">
        <div class="max-w-7xl mx-auto">
            <div class="grid md:grid-cols-2 gap-10 items-stretch">

                <!-- Visi -->
                <div class="p-8 rounded-3xl bg-surface-container border border-outline-variant/30 flex flex-col justify-center">
                    <div class="w-16 h-16 bg-primary-container text-surface rounded-2xl flex items-center justify-center mb-6 shadow-lg">
                        <span class="material-symbols-outlined text-4xl">visibility</span>
                    </div>
                    <h2 class="font-headline text-2xl text-primary mb-4">Visi Kami</h2>
                    <p class="font-body text-lg italic text-on-background leading-relaxed border-l-4 border-primary pl-4">
                        "Menjadi ekosistem digital terdepan untuk kesejahteraan petani jagung di Kluwih melalui
                        inovasi data yang inklusif."
                    </p>
                </div>

                <!-- Misi -->
                <div class="p-8 rounded-3xl bg-primary text-surface shadow-2xl flex flex-col justify-center relative overflow-hidden">
                    <div class="relative z-10">
                        <div class="w-16 h-16 bg-surface text-primary rounded-2xl flex items-center justify-center mb-6">
                            <span class="material-symbols-outlined text-4xl">target</span>
                        </div>
                        <h2 class="font-headline text-2xl mb-4">Misi Kami</h2>
                        <ul class="space-y-4">
                            <li class="flex items-start gap-3">
                                <span class="material-symbols-outlined mt-1">check_circle</span>
                                <p class="font-body text-sm">Digitalisasi data pertanian untuk pengambilan keputusan yang lebih cerdas.</p>
                            </li>
                            <li class="flex items-start gap-3">
                                <span class="material-symbols-outlined mt-1">check_circle</span>
                                <p class="font-body text-sm">Membangun transparansi harga pasar untuk meminimalkan kerugian petani.</p>
                            </li>
                            <li class="flex items-start gap-3">
                                <span class="material-symbols-outlined mt-1">check_circle</span>
                                <p class="font-body text-sm">Optimasi hasil panen melalui teknologi pemantauan pasca-panen terintegrasi.</p>
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
    <section class="py-24 px-6 bg-surface-container">
        <div class="max-w-7xl mx-auto text-center mb-20">
            <h2 class="font-headline text-3xl text-primary mb-4">Nilai Inti Kami</h2>
            <p class="font-body text-lg text-secondary max-w-2xl mx-auto">
                Prinsip-prinsip yang mendasari setiap baris kode dan setiap keputusan yang kami ambil untuk
                kemajuan agrikultur.
            </p>
        </div>

        <div class="max-w-7xl mx-auto grid md:grid-cols-3 gap-6">

            <!-- Value Card: Inovasi -->
            <div class="group p-8 rounded-3xl bg-surface border border-outline-variant/30 hover:border-primary/50 transition-all duration-300 hover:shadow-xl hover:-translate-y-2">
                <div class="w-16 h-16 bg-surface-dim text-primary rounded-full flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                    <span class="material-symbols-outlined text-3xl">lightbulb</span>
                </div>
                <h3 class="font-headline text-xl text-on-background mb-3">Inovasi</h3>
                <p class="font-body text-sm text-secondary">
                    Terus mendorong batas teknologi untuk menciptakan solusi yang lebih efektif dan efisien bagi
                    tantangan pertanian modern.
                </p>
            </div>

            <!-- Value Card: Kejujuran -->
            <div class="group p-8 rounded-3xl bg-surface border border-outline-variant/30 hover:border-primary/50 transition-all duration-300 hover:shadow-xl hover:-translate-y-2">
                <div class="w-16 h-16 bg-secondary-container text-primary rounded-full flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                    <span class="material-symbols-outlined text-3xl">verified</span>
                </div>
                <h3 class="font-headline text-xl text-on-background mb-3">Kejujuran</h3>
                <p class="font-body text-sm text-secondary">
                    Membangun kepercayaan melalui transparansi data dan kejujuran dalam setiap interaksi dengan
                    stakeholder kami.
                </p>
            </div>

            <!-- Value Card: Pemberdayaan -->
            <div class="group p-8 rounded-3xl bg-surface border border-outline-variant/30 hover:border-primary/50 transition-all duration-300 hover:shadow-xl hover:-translate-y-2">
                <div class="w-16 h-16 bg-primary-container text-surface rounded-full flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                    <span class="material-symbols-outlined text-3xl">groups</span>
                </div>
                <h3 class="font-headline text-xl text-on-background mb-3">Pemberdayaan</h3>
                <p class="font-body text-sm text-secondary">
                    Fokus kami adalah memberi alat dan pengetahuan kepada petani agar mereka mampu mandiri dan
                    sejahtera secara ekonomi.
                </p>
            </div>

        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-24 px-6">
        <div class="max-w-5xl mx-auto rounded-[3rem] bg-surface-container border border-outline-variant/30 p-8 md:p-24 text-center relative overflow-hidden shadow-2xl">
            <div class="relative z-10">
                <h2 class="font-headline text-3xl text-primary mb-6">Ingin bergabung dengan kami?</h2>
                <p class="font-body text-lg text-secondary mb-8 max-w-xl mx-auto">
                    Mari berkontribusi dalam revolusi data jagung di Kluwih. Hubungi tim kami untuk kemitraan
                    atau informasi lebih lanjut.
                </p>
                <button class="bg-primary text-surface px-8 py-4 rounded-full font-headline text-lg hover:bg-primary-container transition-all active:scale-95 shadow-lg flex items-center gap-3 mx-auto group">
                    Hubungi Kami
                    <span class="material-symbols-outlined group-hover:translate-x-1 transition-transform">arrow_forward</span>
                </button>
            </div>

            <!-- Decorative Circles -->
            <div class="absolute -top-24 -right-24 w-64 h-64 bg-primary-container/10 rounded-full blur-3xl"></div>
            <div class="absolute -bottom-24 -left-24 w-64 h-64 bg-secondary-container/20 rounded-full blur-3xl"></div>
        </div>
    </section>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('opacity-100', 'translate-y-0');
                    entry.target.classList.remove('opacity-0', 'translate-y-10');
                }
            });
        }, {
            threshold: 0.1
        });

        document.querySelectorAll('section').forEach(section => {
            section.classList.add('transition-all', 'duration-700', 'opacity-0', 'translate-y-10');
            observer.observe(section);
        });
    });
</script>
@endpush