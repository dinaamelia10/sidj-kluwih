@php
    $currentRoute = Route::currentRouteName();
    $navLinks = [
        ['route' => 'user.beranda',      'label' => 'Beranda'],
        ['route' => 'user.tentang_kami', 'label' => 'Tentang Kami'],
        ['route' => 'user.data_jagung',  'label' => 'Data Jagung'],
        ['route' => 'user.layanan',      'label' => 'Layanan'],
        ['route' => 'user.kontak',       'label' => 'Kontak'],
    ];
@endphp

<header class="fixed top-0 left-0 right-0 z-50 bg-surface/90 backdrop-blur-md border-b border-outline-variant px-4 sm:px-6 lg:px-16 py-3 flex items-center justify-between gap-4">
    {{-- Logo --}}
    <a href="{{ route('user.beranda') }}" class="flex items-center flex-shrink-0">
        <img class="h-11 w-auto object-contain" src="{{ asset('logo.png') }}" alt="Logo SIJALU-Kluwih">
    </a>

    {{-- Desktop Nav --}}
    <nav class="hidden md:flex items-center gap-1">
        @foreach($navLinks as $link)
        <a href="{{ route($link['route']) }}"
           class="text-sm font-medium px-3 py-2 rounded-lg transition-colors
                  {{ $currentRoute === $link['route']
                     ? 'bg-primary-container/20 text-primary font-semibold'
                     : 'text-on-surface-variant hover:text-primary hover:bg-surface-container' }}">
            {{ $link['label'] }}
        </a>
        @endforeach
    </nav>

    {{-- Actions --}}
    <div class="flex items-center gap-2 flex-shrink-0">
        <a href="{{ route('admin.login') }}"
           class="hidden sm:flex items-center justify-center rounded-lg h-9 px-5 bg-primary text-on-primary text-sm font-semibold hover:bg-primary-container transition-all active:scale-95">
            Login Admin
        </a>
        {{-- Mobile menu button --}}
        <button id="user-mobile-toggle" class="md:hidden p-2 hover:bg-surface-container rounded-full text-on-surface-variant" aria-label="Buka menu">
            <span class="material-symbols-outlined">menu</span>
        </button>
    </div>
</header>

{{-- Mobile Overlay --}}
<div id="user-mobile-overlay" class="fixed inset-0 bg-black/50 z-40 hidden transition-opacity duration-300 opacity-0"></div>

{{-- Mobile Drawer --}}
<nav id="user-mobile-nav" class="fixed top-0 left-0 bottom-0 w-64 bg-surface border-r border-outline-variant shadow-2xl z-50 transform -translate-x-full transition-transform duration-300 ease-in-out flex flex-col pt-6">
    <div class="px-5 pb-5 flex items-center justify-between border-b border-outline-variant/30">
        <img class="h-10 w-auto object-contain" src="{{ asset('logo.png') }}" alt="Logo SIJALU-Kluwih">
        <button id="user-mobile-close" class="p-1 hover:bg-surface-container rounded-full text-on-surface-variant" aria-label="Tutup menu">
            <span class="material-symbols-outlined">close</span>
        </button>
    </div>
    <div class="px-4 py-4 flex flex-col gap-1">
        @foreach($navLinks as $link)
        <a href="{{ route($link['route']) }}"
           class="text-sm font-medium px-3 py-2.5 rounded-xl transition-colors
                  {{ $currentRoute === $link['route']
                     ? 'text-primary font-semibold bg-primary-container/20'
                     : 'text-on-surface hover:bg-surface-container' }}">
            {{ $link['label'] }}
        </a>
        @endforeach
        <div class="mt-3 pt-3 border-t border-outline-variant/30">
            <a href="{{ route('admin.login') }}"
               class="flex items-center justify-center rounded-xl h-10 px-5 bg-primary text-on-primary text-sm font-semibold hover:bg-primary-container transition-all">
                Login Admin
            </a>
        </div>
    </div>
</nav>