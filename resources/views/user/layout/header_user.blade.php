<header class="fixed top-0 left-0 right-0 z-50 bg-surface/90 backdrop-blur-md border-b border-outline-variant px-4 sm:px-6 lg:px-40 py-3 sm:py-4 flex items-center justify-between">
    <button id="user-mobile-toggle" class="md:hidden p-2 hover:bg-surface-container rounded-full">
        <span class="material-symbols-outlined">menu</span>
    </button>
    <div class="flex items-center gap-4 text-primary">
        <div class="w-10 h-10 flex items-center justify-center rounded-lg bg-primary-container text-surface">
            <svg class="w-6 h-6" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path clip-rule="evenodd" d="M12.0799 24L4 19.2479L9.95537 8.75216L18.04 13.4961L18.0446 4H29.9554L29.96 13.4961L38.0446 8.75216L44 19.2479L35.92 24L44 28.7521L38.0446 39.2479L29.96 34.5039L29.9554 44H18.0446L18.04 34.5039L9.95537 39.2479L4 28.7521L12.0799 24Z" fill="currentColor" fill-rule="evenodd"></path>
            </svg>
        </div>
        <div>
            <h2 class="font-headline text-lg font-bold tracking-tight">SIDJ-Kluwih</h2>
            <p class="text-xs text-on-surface-variant hidden sm:block">Agri-Tech Platform</p>
        </div>
    </div>
    <nav class="hidden md:flex items-center gap-8">
        <a class="text-sm font-medium hover:text-secondary transition-colors" href="#">Beranda</a>
        <a class="text-sm font-medium hover:text-secondary transition-colors" href="{{ route('user.tentang_kami') }}">Tentang Kami</a>
        <a class="text-sm font-medium hover:text-secondary transition-colors" href="{{ route('user.data_jagung') }}">Data Jagung</a>
        <a class="text-sm font-medium hover:text-secondary transition-colors" href="#">Layanan</a>
        <a class="text-sm font-medium hover:text-secondary transition-colors" href="#">Kontak</a>
    </nav>
    <div class="flex items-center gap-3">
        <button class="hidden sm:flex items-center justify-center rounded-lg h-10 px-6 bg-primary-container text-surface text-sm font-bold hover:bg-primary transition-all">Masuk</button>
        <div class="w-10 h-10 rounded-full border border-outline-variant bg-surface-dim overflow-hidden">
            <img class="w-full h-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDUtQeeYL7ro1mUv7mSfNPR9s74pEN9an8SCSqCKi9Lhks9jY_i717vTgB7STs1NsT0cXjj1MU80QQUECMQ5x5HWIOZCltkUMMOXo_JPFjM8GqEcuNEZvCC-XxmYOISuQN95Ft2BLAAzKPXYH4z4zDatdFQMbHttlkt87cHFS1G9VNZv6kQPq1kG65rIq7Q04yxiEzQ0q2IVkWUbU6fs5ohi9WBI9lPULo576j-T76LE8LHA7WduXzwZg" alt="Profile" />
        </div>
    </div>
</header>

<!-- Background Overlay saat Menu Mobile Terbuka -->
<div id="user-mobile-overlay" class="fixed inset-0 bg-black/50 z-40 hidden transition-opacity duration-300 opacity-0"></div>

<!-- Menu Navigation Mobile Berganti Menjadi Samping Kiri (Drawer Sidebar) -->
<nav id="user-mobile-nav" class="fixed top-0 left-0 bottom-0 w-64 bg-surface border-r border-outline-variant shadow-2xl z-50 transform -translate-x-full transition-transform duration-300 ease-in-out flex flex-col pt-6">
    <div class="px-6 pb-6 flex items-center justify-between border-b border-outline-variant/30">
        <span class="font-headline text-lg font-bold text-primary">SIDJ-Kluwih</span>
        <button id="user-mobile-close" class="p-1 hover:bg-surface-container rounded-full text-on-surface-variant">
            <span class="material-symbols-outlined">close</span>
        </button>
    </div>
    <div class="px-4 py-4 flex flex-col gap-2">
        <a href="{{ route('user.beranda') }}" class="text-sm font-medium text-on-surface px-3 py-2.5 rounded-xl hover:bg-surface-container transition-colors">Beranda</a>
        <a href="{{ route('user.tentang_kami') }}" class="text-sm font-medium text-primary font-semibold bg-secondary-container/50 px-3 py-2.5 rounded-xl transition-colors">Tentang Kami</a>
        <a href="{{ route('user.data_jagung') }}" class="text-sm font-medium text-on-surface px-3 py-2.5 rounded-xl hover:bg-surface-container transition-colors">Data Jagung</a>
        <a href="{{ route('user.layanan') }}" class="text-sm font-medium text-on-surface px-3 py-2.5 rounded-xl hover:bg-surface-container transition-colors">Layanan</a>
        <a href="{{ route('user.kontak') }}" class="text-sm font-medium text-on-surface px-3 py-2.5 rounded-xl hover:bg-surface-container transition-colors">Kontak</a>
    </div>
</nav>