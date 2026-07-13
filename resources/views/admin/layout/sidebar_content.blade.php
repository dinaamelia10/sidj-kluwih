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
</nav>
<div class="mt-auto flex flex-col gap-sm">
    <a href="{{ route('admin.pengaturan') }}" class="flex items-center gap-3 px-4 py-3 text-on-surface-variant hover:bg-surface-container-high transition-all">
        <span class="material-symbols-outlined">settings</span>
        <span class="font-label-md text-label-md">Pengaturan</span>
    </a>
    <a href="#" class="flex items-center gap-3 px-4 py-3 text-error hover:bg-error-container/20 transition-all">
        <span class="material-symbols-outlined">logout</span>
        <span class="font-label-md text-label-md">Keluar</span>
    </a>
</div>
