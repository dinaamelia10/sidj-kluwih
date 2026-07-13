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
        <a class="text-sm font-medium hover:text-secondary transition-colors" href="#">Tentang Kami</a>
        <a class="text-sm font-medium hover:text-secondary transition-colors" href="#">Data Jagung</a>
        <a class="text-sm font-medium hover:text-secondary transition-colors" href="#">Layanan</a>
        <a class="text-sm font-medium hover:text-secondary transition-colors" href="#">Kontak</a>
    </nav>
    <div class="flex items-center gap-3">
        <button class="hidden sm:flex items-center justify-center rounded-lg h-10 px-6 bg-primary-container text-surface text-sm font-bold hover:bg-primary transition-all">Masuk</button>
        <div class="w-10 h-10 rounded-full border border-outline-variant bg-surface-dim overflow-hidden">
            <img class="w-full h-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuB6NNz0DCHeSXl2DRdtZczYuzQyIHlNb6FEa24qAMIs01whLUrUWya6-OEOHHDCNh1Qou_oOy-v7KmhZtMqZXvTeiRpkT8QrH9634kW-kUS6MM1ImmlhHeWUaXhSgeudhT3OrHAgMZ8_0qf7YnuDykeHWJgE87K7b9Rv7QZTRNSUnijpJsmv7mgy6JhF7KoEVsKHBZJhQUw5Knt2XOcHxQ_Bxj8MrmNopSa8AGhcmqJOJLVgUwfcrScXw" alt="Profile" />
        </div>
    </div>
</header>
<nav id="user-mobile-nav" class="md:hidden hidden mt-16 bg-surface/95 border-b border-outline-variant shadow-sm">
    <div class="px-6 pb-4 pt-2 flex flex-col gap-3">
        <a class="text-sm font-medium text-on-surface hover:text-secondary transition-colors" href="#">Beranda</a>
        <a href="{{ route('user.tentang_kami') }}" class="text-sm font-medium text-on-surface hover:text-secondary transition-colors">Tentang Kami</a>
        <a class="text-sm font-medium text-on-surface hover:text-secondary transition-colors" href="#">Data Jagung</a>
        <a class="text-sm font-medium text-on-surface hover:text-secondary transition-colors" href="#">Layanan</a>
        <a class="text-sm font-medium text-on-surface hover:text-secondary transition-colors" href="#">Kontak</a>
    </div>
</nav>
