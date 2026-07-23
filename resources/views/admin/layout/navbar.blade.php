<!-- Sidebar Navigation -->
<aside class="w-64 h-screen flex flex-col sticky top-0 left-0 bg-surface-container-lowest border-r border-outline-variant py-lg px-md gap-sm hidden md:flex">
    <div class="mb-xl px-md">
        <h1 class="font-headline-md text-headline-md font-bold text-primary">SIDJ-Kluwih</h1>
        <p class="font-label-md text-label-md text-on-surface-variant">Agri-Tech System</p>
    </div>
    <nav class="flex flex-col gap-sm flex-1">
        <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-3 transition-all duration-200 {{ request()->routeIs('admin.dashboard') ? 'text-primary font-bold bg-secondary-container rounded-xl' : 'text-on-surface-variant hover:bg-surface-container-high hover:text-primary' }}">
            <span class="material-symbols-outlined" data-original-icon="dashboard">dashboard</span>
            <span class="font-label-md text-label-md">Dashboard</span>
        </a>
        <a href="{{ route('admin.pemantauan') }}" class="flex items-center gap-3 px-4 py-3 transition-all duration-200 {{ request()->routeIs('admin.pemantauan') ? 'text-primary font-bold bg-secondary-container rounded-xl' : 'text-on-surface-variant hover:bg-surface-container-high hover:text-primary' }}">
            <span class="material-symbols-outlined" data-original-icon="thermostat">thermostat</span>
            <span class="font-label-md text-label-md">Monitoring Suhu</span>
        </a>
        <a href="{{ route('admin.tonase-jagung') }}" class="flex items-center gap-3 px-4 py-3 transition-all duration-200 {{ request()->routeIs('admin.tonase-jagung') ? 'text-primary font-bold bg-secondary-container rounded-xl' : 'text-on-surface-variant hover:bg-surface-container-high hover:text-primary' }}">
            <span class="material-symbols-outlined">scale</span>
            <span class="font-label-md text-label-md">Tonase Jagung</span>
        </a>
        <a href="{{ route('admin.harga-beli') }}" class="flex items-center gap-3 px-4 py-3 transition-all duration-200 {{ request()->routeIs('admin.harga-beli') ? 'text-primary font-bold bg-secondary-container rounded-xl' : 'text-on-surface-variant hover:bg-surface-container-high hover:text-primary' }}">
            <span class="material-symbols-outlined" data-original-icon="payments">payments</span>
            <span class="font-label-md text-label-md">Harga Beli</span>
        </a>
        <a href="{{ route('admin.laporan') }}" class="flex items-center gap-3 px-4 py-3 transition-all duration-200 {{ request()->routeIs('admin.laporan') ? 'text-primary font-bold bg-secondary-container rounded-xl' : 'text-on-surface-variant hover:bg-surface-container-high hover:text-primary' }}">
            <span class="material-symbols-outlined">description</span>
            <span class="font-label-md text-label-md">Laporan</span>
        </a>
        <a href="{{ route('admin.pengguna') }}" class="flex items-center gap-3 px-4 py-3 transition-all duration-200 {{ request()->routeIs('admin.pengguna') ? 'text-primary font-bold bg-secondary-container rounded-xl' : 'text-on-surface-variant hover:bg-surface-container-high hover:text-primary' }}">
            <span class="material-symbols-outlined">group</span>
            <span class="font-label-md text-label-md">Pengguna (Data Petani)</span>
        </a>
        @php $unreadCount = \App\Models\ContactMessage::where('is_read', false)->count(); @endphp
        <a href="{{ route('admin.pesan') }}" class="flex items-center gap-3 px-4 py-3 transition-all duration-200 {{ request()->routeIs('admin.pesan*') ? 'text-primary font-bold bg-secondary-container rounded-xl' : 'text-on-surface-variant hover:bg-surface-container-high hover:text-primary' }}">
            <span class="material-symbols-outlined" style="{{ $unreadCount > 0 ? "font-variation-settings:'FILL' 1" : '' }}">inbox</span>
            <span class="font-label-md text-label-md flex-1">Pesan Masuk</span>
            @if($unreadCount > 0)
            <span class="inline-flex items-center justify-center w-5 h-5 rounded-full bg-error text-on-error text-[10px] font-bold">{{ $unreadCount > 9 ? '9+' : $unreadCount }}</span>
            @endif
        </a>
    </nav>
    <div class="mt-auto flex flex-col gap-sm">
        <a href="{{ route('admin.pengaturan') }}" class="flex items-center gap-3 px-4 py-3 text-on-surface-variant hover:bg-surface-container-high transition-all {{ request()->routeIs('admin.pengaturan') ? 'text-primary bg-secondary-container rounded-xl' : '' }}">
            <span class="material-symbols-outlined">settings</span>
            <span class="font-label-md text-label-md">Pengaturan</span>
        </a>
        <form action="{{ route('admin.logout') }}" method="POST">
            @csrf
            <button type="submit" class="w-full flex items-center gap-3 px-4 py-3 text-error hover:bg-error-container/20 transition-all">
                <span class="material-symbols-outlined">logout</span>
                <span class="font-label-md text-label-md">Keluar</span>
            </button>
        </form>
    </div>
</aside>
