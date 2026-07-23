@extends('user.layout.master')

@section('title', 'Tentang Kami - SIDJ-Kluwih')

@section('content')
    {{-- Hero Section --}}
    <section class="relative pt-12 pb-20 md:pt-20 md:pb-32 px-6 lg:px-16 hero-pattern overflow-hidden">
        <div class="max-w-7xl mx-auto grid md:grid-cols-2 gap-10 items-center relative z-10">
            <div class="order-2 md:order-1 reveal active">
                <span class="inline-block py-1 px-4 mb-4 rounded-full bg-secondary-container text-on-secondary-container font-semibold text-xs uppercase tracking-wider">
                    Tentang Kami
                </span>
                <h1 class="text-4xl md:text-5xl mb-6 leading-tight text-primary font-bold">
                    Menghubungkan <span class="text-secondary italic">Tradisi</span> dengan Teknologi Modern
                </h1>
                <p class="text-lg text-on-surface-variant mb-8 max-w-xl leading-relaxed">
                    SIDJ-Kluwih lahir dari visi untuk mentransformasi sektor agrikultur lokal menjadi ekosistem digital yang efisien, transparan, dan berkelanjutan. Kami menyediakan solusi data terpadu untuk memberdayakan petani jagung di Kluwih.
                </p>
                <div class="flex flex-wrap gap-4">
                    <a href="{{ route('user.layanan') }}" class="bg-primary text-on-primary px-6 py-3 rounded-xl font-semibold text-sm hover:bg-primary-container hover:scale-105 active:scale-95 transition-all shadow-lg">
                        Eksplorasi Layanan
                    </a>
                    <a href="{{ route('user.kontak') }}" class="bg-surface border border-outline px-6 py-3 rounded-xl font-semibold text-sm hover:bg-surface-container transition-all">
                        Hubungi Kami
                    </a>
                </div>
            </div>

            <div class="order-1 md:order-2 relative reveal active" style="transition-delay:200ms">
                <div class="aspect-square rounded-3xl overflow-hidden shadow-2xl rotate-3 scale-95 hover:rotate-0 hover:scale-100 duration-500 transition-all border border-outline-variant">
                    <img class="w-full h-full object-cover"
                         alt="Platform digital pertanian jagung"
                         src="https://images.unsplash.com/photo-1625246333195-78d9c38ad449?w=700&q=80">
                </div>
                <div class="absolute -bottom-8 -left-8 glass-card p-5 rounded-2xl shadow-xl hidden lg:flex items-center gap-4 z-10">
                    <div class="w-12 h-12 bg-secondary-container rounded-full flex items-center justify-center text-on-secondary-container">
                        <span class="material-symbols-outlined">trending_up</span>
                    </div>
                    <div>
                        <p class="text-xs text-on-surface-variant uppercase font-semibold">Efisiensi Meningkat</p>
                        <p class="text-xl font-bold text-primary">+85% Efisiensi</p>
                    </div>
                </div>
            </div>
        </div>
        {{-- Background Decoration --}}
        <div class="absolute top-0 right-0 w-1/3 h-1/2 bg-gradient-to-bl from-secondary-container/20 to-transparent blur-3xl -z-10 pointer-events-none"></div>
        <div class="absolute bottom-0 left-0 w-1/4 h-1/3 bg-gradient-to-tr from-secondary-container/20 to-transparent blur-3xl -z-10 pointer-events-none"></div>
    </section>

    {{-- Visi & Misi --}}
    <section class="py-24 bg-surface-container-lowest px-6 lg:px-16">
        <div class="max-w-7xl mx-auto">
            <div class="grid md:grid-cols-2 gap-10 items-stretch">
                {{-- Visi --}}
                <div class="p-8 rounded-3xl bg-surface-container border border-outline-variant/50 flex flex-col justify-center reveal">
                    <div class="w-16 h-16 bg-primary-container text-on-primary rounded-2xl flex items-center justify-center mb-6 shadow-lg">
                        <span class="material-symbols-outlined text-4xl">visibility</span>
                    </div>
                    <h2 class="text-2xl font-bold text-primary mb-4">Visi Kami</h2>
                    <p class="text-lg italic text-on-surface leading-relaxed border-l-4 border-primary pl-4">
                        "Menjadi ekosistem digital terdepan untuk kesejahteraan petani jagung di Kluwih melalui inovasi data yang inklusif."
                    </p>
                </div>

                {{-- Misi --}}
                <div class="p-8 rounded-3xl bg-primary text-on-primary shadow-2xl flex flex-col justify-center relative overflow-hidden reveal" style="transition-delay:150ms">
                    <div class="relative z-10">
                        <div class="w-16 h-16 bg-on-primary text-primary rounded-2xl flex items-center justify-center mb-6">
                            <span class="material-symbols-outlined text-4xl">target</span>
                        </div>
                        <h2 class="text-2xl font-bold mb-4">Misi Kami</h2>
                        <ul class="space-y-4">
                            <li class="flex items-start gap-3">
                                <span class="material-symbols-outlined mt-0.5 text-secondary-fixed">check_circle</span>
                                <p class="text-sm leading-relaxed">Digitalisasi data pertanian untuk pengambilan keputusan yang lebih cerdas dan berbasis fakta.</p>
                            </li>
                            <li class="flex items-start gap-3">
                                <span class="material-symbols-outlined mt-0.5 text-secondary-fixed">check_circle</span>
                                <p class="text-sm leading-relaxed">Membangun transparansi harga pasar untuk meminimalkan kerugian petani.</p>
                            </li>
                            <li class="flex items-start gap-3">
                                <span class="material-symbols-outlined mt-0.5 text-secondary-fixed">check_circle</span>
                                <p class="text-sm leading-relaxed">Optimasi hasil panen melalui teknologi pemantauan pasca-panen terintegrasi.</p>
                            </li>
                        </ul>
                    </div>
                    <div class="absolute top-0 right-0 w-full h-full opacity-10 pointer-events-none">
                        <div class="w-full h-full bg-[radial-gradient(circle_at_bottom_left,_#a3f69c,_transparent_60%)]"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Nilai Inti --}}
    <section class="py-24 px-6 lg:px-16 bg-surface-container">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-16 reveal">
                <h2 class="text-3xl font-bold text-primary mb-4">Nilai Inti Kami</h2>
                <p class="text-lg text-on-surface-variant max-w-2xl mx-auto">
                    Prinsip-prinsip yang mendasari setiap baris kode dan setiap keputusan yang kami ambil untuk kemajuan agrikultur.
                </p>
            </div>
            <div class="grid md:grid-cols-3 gap-6">
                @php
                    $values = [
                        ['icon'=>'lightbulb','bg'=>'bg-surface-dim','label'=>'Inovasi','desc'=>'Terus mendorong batas teknologi untuk menciptakan solusi yang lebih efektif dan efisien bagi tantangan pertanian modern.'],
                        ['icon'=>'verified','bg'=>'bg-secondary-container','label'=>'Kejujuran','desc'=>'Membangun kepercayaan melalui transparansi data dan kejujuran dalam setiap interaksi dengan stakeholder kami.'],
                        ['icon'=>'groups','bg'=>'bg-primary-container','label'=>'Pemberdayaan','desc'=>'Fokus kami adalah memberi alat dan pengetahuan kepada petani agar mereka mampu mandiri dan sejahtera secara ekonomi.'],
                    ];
                @endphp
                @foreach($values as $i => $v)
                <div class="group p-8 rounded-3xl bg-surface border border-outline-variant/30 hover:border-primary/50 hover:shadow-xl hover:-translate-y-2 transition-all duration-300 reveal" style="transition-delay:{{ $i * 100 }}ms">
                    <div class="w-16 h-16 {{ $v['bg'] }} text-primary rounded-full flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                        <span class="material-symbols-outlined text-3xl">{{ $v['icon'] }}</span>
                    </div>
                    <h3 class="text-xl font-bold text-on-background mb-3">{{ $v['label'] }}</h3>
                    <p class="text-sm text-on-surface-variant leading-relaxed">{{ $v['desc'] }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- CTA Section --}}
    <section class="py-24 px-6 lg:px-16">
        <div class="max-w-5xl mx-auto rounded-3xl bg-surface-container border border-outline-variant/30 p-10 md:p-20 text-center relative overflow-hidden shadow-xl reveal">
            <div class="relative z-10">
                <h2 class="text-3xl font-bold text-primary mb-6">Ingin bergabung dengan kami?</h2>
                <p class="text-lg text-on-surface-variant mb-8 max-w-xl mx-auto">
                    Mari berkontribusi dalam revolusi data jagung di Kluwih. Hubungi tim kami untuk kemitraan atau informasi lebih lanjut.
                </p>
                <a href="{{ route('user.kontak') }}"
                   class="bg-primary text-on-primary px-8 py-4 rounded-full font-bold text-lg hover:bg-primary-container hover:scale-105 active:scale-95 transition-all shadow-lg flex items-center gap-3 mx-auto w-fit group">
                    Hubungi Kami
                    <span class="material-symbols-outlined group-hover:translate-x-1 transition-transform">arrow_forward</span>
                </a>
            </div>
            <div class="absolute -top-24 -right-24 w-64 h-64 bg-primary-container/10 rounded-full blur-3xl pointer-events-none"></div>
            <div class="absolute -bottom-24 -left-24 w-64 h-64 bg-secondary-container/20 rounded-full blur-3xl pointer-events-none"></div>
        </div>
    </section>
@endsection