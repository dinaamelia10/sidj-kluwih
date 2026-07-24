@extends('user.layout.master')

@section('title', 'Hubungi Kami - SIJALU-Kluwih')

@section('content')
    {{-- Hero Section --}}
    <section class="relative overflow-hidden py-16 md:py-24 bg-surface-container">
        <div class="relative z-10 max-w-7xl mx-auto px-6 lg:px-16 text-center">
            <span class="inline-block py-1 px-4 mb-4 rounded-full bg-secondary-container text-on-secondary-container font-semibold text-xs uppercase tracking-wider">Hubungi Kami</span>
            <h1 class="text-4xl lg:text-5xl font-bold text-primary mb-4">Ada yang bisa kami bantu?</h1>
            <p class="text-lg text-on-surface-variant max-w-2xl mx-auto">
                Kami hadir untuk membantu Anda mengoptimalkan hasil panen dan manajemen pasca-panen jagung dengan teknologi terkini.
            </p>
        </div>
        <div class="absolute top-0 right-0 w-1/3 h-full bg-gradient-to-l from-secondary-container/20 to-transparent pointer-events-none"></div>
    </section>

    {{-- Main Contact Section --}}
    <section class="py-12 max-w-7xl mx-auto px-6 lg:px-16">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12">
            {{-- Contact Form --}}
            <div class="lg:col-span-7 bg-surface p-8 rounded-2xl border border-outline-variant soft-shadow">
                <h2 class="text-2xl font-bold mb-6 text-on-surface">Kirim Pesan</h2>

                {{-- Flash success --}}
                @if(session('success'))
                <div class="mb-4 flex items-center gap-3 bg-secondary-container text-on-secondary-container rounded-xl p-4">
                    <span class="material-symbols-outlined" style="font-variation-settings:'FILL' 1">check_circle</span>
                    <span class="font-semibold text-sm">{{ session('success') }}</span>
                </div>
                @endif

                @if($errors->any())
                <div class="mb-4 bg-error-container text-on-error-container rounded-xl p-4 text-sm">
                    <ul class="list-disc pl-4 space-y-1">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <form id="contact-form" action="{{ route('user.kontak.store') }}" method="POST" class="space-y-4">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium mb-1.5 text-on-surface-variant" for="contact-name">Nama Lengkap <span class="text-error">*</span></label>
                            <input class="w-full rounded-xl border border-outline-variant bg-surface-container py-3 px-4 input-focus-effect text-sm @error('name') border-error @enderror"
                                   id="contact-name" name="name" placeholder="Budi Santoso" type="text"
                                   value="{{ old('name') }}" required/>
                            @error('name')<p class="text-error text-xs mt-1">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium mb-1.5 text-on-surface-variant" for="contact-email">Email</label>
                            <input class="w-full rounded-xl border border-outline-variant bg-surface-container py-3 px-4 input-focus-effect text-sm @error('email') border-error @enderror"
                                   id="contact-email" name="email" placeholder="budi@contoh.com" type="email"
                                   value="{{ old('email') }}"/>
                            @error('email')<p class="text-error text-xs mt-1">{{ $message }}</p>@enderror
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-1.5 text-on-surface-variant" for="contact-subject">Subjek</label>
                        <input class="w-full rounded-xl border border-outline-variant bg-surface-container py-3 px-4 input-focus-effect text-sm"
                               id="contact-subject" name="subject" placeholder="Pertanyaan seputar layanan dryer" type="text"
                               value="{{ old('subject') }}"/>
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-1.5 text-on-surface-variant" for="contact-message">Pesan <span class="text-error">*</span></label>
                        <textarea class="w-full rounded-xl border border-outline-variant bg-surface-container py-3 px-4 input-focus-effect text-sm resize-none @error('message') border-error @enderror"
                                  id="contact-message" name="message" placeholder="Tuliskan pesan Anda di sini..." rows="5"
                                  required>{{ old('message') }}</textarea>
                        @error('message')<p class="text-error text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                    <button class="w-full md:w-auto px-8 py-3 bg-primary text-on-primary rounded-xl font-bold text-sm hover:scale-[1.02] active:scale-95 transition-all flex items-center justify-center gap-2"
                            id="contact-submit" type="submit">
                        <span>Kirim Pesan</span>
                        <span class="material-symbols-outlined text-sm">send</span>
                    </button>
                </form>
            </div>

            {{-- Contact Info --}}
            <div class="lg:col-span-5 flex flex-col gap-5">
                <div class="bg-surface-container p-6 rounded-2xl border border-outline-variant">
                    <h3 class="font-bold text-lg mb-5 text-primary">Informasi Kontak</h3>
                    <ul class="space-y-5">
                        <li class="flex gap-4">
                            <div class="bg-secondary-container p-2.5 rounded-xl flex items-center justify-center h-fit flex-shrink-0">
                                <span class="material-symbols-outlined text-on-secondary-container">location_on</span>
                            </div>
                            <div>
                                <p class="text-xs text-on-surface-variant font-medium uppercase tracking-wide">Alamat Kantor</p>
                                <p class="text-sm font-semibold mt-0.5">Desa Kluwih, Kec. Bandar, Kab. Batang, Jawa Tengah</p>
                            </div>
                        </li>
                        <li class="flex gap-4">
                            <div class="bg-secondary-container p-2.5 rounded-xl flex items-center justify-center h-fit flex-shrink-0">
                                <span class="material-symbols-outlined text-on-secondary-container">call</span>
                            </div>
                            <div>
                                <p class="text-xs text-on-surface-variant font-medium uppercase tracking-wide">Telepon / WhatsApp</p>
                                <p class="text-sm font-semibold mt-0.5">Hubungi via kontak resmi</p>
                            </div>
                        </li>
                        <li class="flex gap-4">
                            <div class="bg-secondary-container p-2.5 rounded-xl flex items-center justify-center h-fit flex-shrink-0">
                                <span class="material-symbols-outlined text-on-secondary-container">mail</span>
                            </div>
                            <div>
                                <p class="text-xs text-on-surface-variant font-medium uppercase tracking-wide">Email</p>
                                <p class="text-sm font-semibold mt-0.5">info@sijalu-kluwih.id</p>
                            </div>
                        </li>
                        <li class="flex gap-4">
                            <div class="bg-secondary-container p-2.5 rounded-xl flex items-center justify-center h-fit flex-shrink-0">
                                <span class="material-symbols-outlined text-on-secondary-container">schedule</span>
                            </div>
                            <div>
                                <p class="text-xs text-on-surface-variant font-medium uppercase tracking-wide">Jam Layanan</p>
                                <p class="text-sm font-semibold mt-0.5">Senin – Sabtu: 08.00 – 17.00 WIB</p>
                            </div>
                        </li>
                    </ul>
                </div>

                {{-- Quick Links --}}
                <div class="bg-primary p-6 rounded-2xl text-on-primary">
                    <h3 class="font-bold text-lg mb-4">Akses Cepat</h3>
                    <div class="flex flex-col gap-2">
                        <a href="{{ route('user.data_jagung') }}" class="flex items-center gap-2 text-on-primary/80 hover:text-on-primary text-sm transition-colors py-1">
                            <span class="material-symbols-outlined text-sm">bar_chart</span> Lihat Data Jagung
                        </a>
                        <a href="{{ route('user.layanan') }}" class="flex items-center gap-2 text-on-primary/80 hover:text-on-primary text-sm transition-colors py-1">
                            <span class="material-symbols-outlined text-sm">category</span> Eksplorasi Layanan
                        </a>
                        <a href="{{ route('admin.login') }}" class="flex items-center gap-2 text-on-primary/80 hover:text-on-primary text-sm transition-colors py-1">
                            <span class="material-symbols-outlined text-sm">login</span> Login Admin Panel
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Technical Support Section --}}
    <section class="py-12 bg-surface-container">
        <div class="max-w-7xl mx-auto px-6 lg:px-16">
            <div class="flex flex-col md:flex-row justify-between items-end mb-8 gap-4">
                <div>
                    <h2 class="text-2xl font-bold text-on-surface">Technical Support</h2>
                    <p class="text-on-surface-variant">Bantuan khusus untuk operasional alat dan platform digital.</p>
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                @php
                    $supports = [
                        ['icon'=>'engineering','bg'=>'bg-secondary-fixed','col'=>'text-on-secondary-fixed','t'=>'Panduan Smart Dryer','d'=>'Akses manual penggunaan dan tutorial perawatan rutin mesin pengering jagung pintar Anda.','link'=>'Unduh PDF','licon'=>'download'],
                        ['icon'=>'monitoring','bg'=>'bg-tertiary-fixed','col'=>'text-on-tertiary-fixed','t'=>'Isu Dashboard Data','d'=>'Mengalami kendala sinkronisasi data real-time? Tim IT kami siap membantu integrasi sistem Anda.','link'=>'Hubungi Tim IT','licon'=>'chevron_right'],
                        ['icon'=>'quiz','bg'=>'bg-primary-fixed','col'=>'text-on-primary-fixed','t'=>'Pusat Bantuan (FAQ)','d'=>'Temukan jawaban cepat untuk pertanyaan yang sering diajukan oleh mitra petani kami.','link'=>'Baca FAQ','licon'=>'help'],
                    ];
                @endphp
                @foreach($supports as $s)
                <div class="bg-surface p-6 rounded-2xl border border-outline-variant soft-shadow hover:-translate-y-1 transition-all duration-300">
                    <div class="w-10 h-10 rounded-full {{ $s['bg'] }} flex items-center justify-center mb-4">
                        <span class="material-symbols-outlined {{ $s['col'] }}">{{ $s['icon'] }}</span>
                    </div>
                    <h4 class="font-bold text-base mb-2 text-on-surface">{{ $s['t'] }}</h4>
                    <p class="text-sm text-on-surface-variant mb-4 leading-relaxed">{{ $s['d'] }}</p>
                    <a class="text-primary text-sm font-semibold flex items-center gap-1 hover:underline" href="#">
                        {{ $s['link'] }}
                        <span class="material-symbols-outlined text-sm">{{ $s['licon'] }}</span>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection

@push('scripts')
<script>
    // Jika ada pesan sukses, scroll ke atas
    @if(session('success'))
        window.scrollTo({ top: 0, behavior: 'smooth' });
    @endif
</script>
@endpush