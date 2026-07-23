<header class="w-full h-16 sticky top-0 z-50 bg-white/80 backdrop-blur-md border-b border-outline-variant flex justify-between items-center px-lg">
    <div class="flex items-center gap-4">
        <button class="md:hidden p-2 hover:bg-surface-container rounded-full" aria-controls="mobile-menu" aria-expanded="false">
            <span class="material-symbols-outlined">menu</span>
        </button>
        <div class="relative group flex-1 sm:flex-initial" id="globalSearchWrapper">
            <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-outline text-base sm:text-lg">search</span>
            <input type="text"
                   id="globalHeaderSearch"
                   placeholder="Cari data..."
                   autocomplete="off"
                   class="pl-9 sm:pl-10 pr-3 sm:pr-4 py-1.5 sm:py-2 bg-surface-container-low border border-transparent focus:border-primary rounded-full w-36 xs:w-48 sm:w-72 focus:ring-2 focus:ring-primary/20 text-xs sm:text-sm transition-all placeholder:text-on-surface-variant/60">
            
            <!-- Floating Live Search Dropdown -->
            <div id="globalSearchDropdown"
                 class="absolute left-0 mt-2 w-[85vw] max-w-sm sm:w-96 bg-white rounded-2xl shadow-2xl border border-outline-variant/30 opacity-0 pointer-events-none translate-y-[-10px] transition-all duration-200 z-[70] overflow-hidden max-h-96 overflow-y-auto no-scrollbar">
                <div class="p-3 bg-surface-container-lowest border-b border-outline-variant/20 flex justify-between items-center">
                    <span class="text-xs font-bold text-primary uppercase tracking-wider">Hasil Pencarian Live</span>
                    <span class="text-[10px] text-on-surface-variant" id="searchCountStatus">Ketik min 2 karakter</span>
                </div>
                <div id="searchResultsContainer" class="divide-y divide-outline-variant/10 text-sm">
                    <div class="p-4 text-center text-on-surface-variant text-xs italic">
                        Ketik nama petani, varietas, atau transaksi...
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="flex items-center gap-md relative">
        <!-- Notifikasi Wrapper -->
        <div class="relative" id="notif-wrapper">
            <button id="btn-notif" type="button" class="p-2 hover:bg-surface-container rounded-full relative transition-colors focus:outline-none focus:ring-2 focus:ring-primary/20">
                <span class="material-symbols-outlined">notifications</span>
                @if(isset($notificationsList) && count($notificationsList) > 0)
                <span class="absolute top-2 right-2 w-2.5 h-2.5 bg-error rounded-full ring-2 ring-white animate-pulse"></span>
                @endif
            </button>

            <!-- Dropdown Notifikasi -->
            <div id="dropdown-notif" class="absolute right-0 mt-2 w-80 bg-white rounded-2xl shadow-xl border border-outline-variant/30 opacity-0 pointer-events-none translate-y-[-10px] transition-all duration-200 z-50 overflow-hidden">
                <div class="p-4 border-b border-outline-variant/30 flex justify-between items-center bg-surface-container-lowest">
                    <h4 class="font-title-lg text-title-lg font-bold text-on-surface">Notifikasi</h4>
                    <button type="button" onclick="markAllNotifsAsRead()" class="text-xs font-bold text-primary hover:underline">Tandai Semua Dibaca</button>
                </div>
                <div class="max-h-80 overflow-y-auto no-scrollbar divide-y divide-outline-variant/10" id="notif-list-container">
                    @forelse($notificationsList ?? [] as $notif)
                    <a href="{{ $notif->link }}"
                       data-notif-id="{{ $notif->id }}"
                       onclick="markNotifRead('{{ $notif->id }}')"
                       class="notif-item p-4 transition-colors cursor-pointer flex gap-3 block bg-slate-100/90 hover:bg-slate-200/90 border-l-4 border-l-primary relative">
                        <div class="w-10 h-10 rounded-full {{ $notif->bg }} flex items-center justify-center shrink-0">
                            <span class="material-symbols-outlined text-sm">{{ $notif->icon }}</span>
                        </div>
                        <div class="min-w-0 flex-1">
                            <div class="flex items-center justify-between gap-1">
                                <p class="font-label-md text-on-surface font-bold text-sm leading-tight">{{ $notif->title }}</p>
                                <span class="w-2 h-2 rounded-full bg-primary shrink-0 notif-dot"></span>
                            </div>
                            <p class="font-body-md text-on-surface-variant text-xs mt-0.5 line-clamp-2 leading-relaxed">{{ $notif->message }}</p>
                            <p class="font-label-sm text-on-surface-variant/60 text-[10px] mt-1">{{ $notif->time }}</p>
                        </div>
                    </a>
                    @empty
                    <div class="p-6 text-center text-on-surface-variant text-xs italic">
                        Tidak ada notifikasi baru.
                    </div>
                    @endforelse
                </div>
                <div class="p-3 border-t border-outline-variant/30 bg-surface-container-lowest text-center">
                    <a href="{{ route('admin.laporan') }}" class="text-primary font-label-md text-xs font-bold hover:underline">Lihat Semua Laporan</a>
                </div>
            </div>
        </div>

        <!-- Profil Wrapper -->
        <div class="relative" id="profile-wrapper">
            <button id="btn-profile" type="button" class="flex items-center gap-sm cursor-pointer hover:bg-surface-container p-1 rounded-full pr-4 transition-colors focus:outline-none focus:ring-2 focus:ring-primary/20">
                <div class="w-8 h-8 rounded-full overflow-hidden bg-primary-container shrink-0 text-on-primary-container flex items-center justify-center font-bold">
                    {{ substr(auth()->user()->name ?? 'A', 0, 1) }}
                </div>
                <span class="font-label-md text-label-md hidden lg:block text-on-surface font-bold">{{ auth()->user()->name ?? 'Admin Kluwih' }}</span>
                <span class="material-symbols-outlined text-on-surface-variant hidden lg:block text-sm">arrow_drop_down</span>
            </button>

            <div id="dropdown-profile" class="absolute right-0 mt-2 w-56 bg-white rounded-2xl shadow-xl border border-outline-variant/30 opacity-0 pointer-events-none translate-y-[-10px] transition-all duration-200 z-[60] overflow-hidden flex flex-col py-2">
                <div class="px-4 py-3 border-b border-outline-variant/30 mb-2">
                    <p class="font-label-md font-bold text-on-surface">{{ auth()->user()->name ?? 'Admin Kluwih' }}</p>
                    <p class="font-label-sm text-on-surface-variant text-xs truncate">{{ auth()->user()->email ?? 'admin@kluwih.com' }}</p>
                </div>
                <a href="{{ route('admin.profil') }}" class="px-4 py-2 hover:bg-surface-container-low transition-colors flex items-center gap-3 text-on-surface font-label-md">
                    <span class="material-symbols-outlined text-on-surface-variant text-[20px]">person</span>
                    Lihat Profil
                </a>
                <a href="{{ route('admin.profil') }}#ubah-password" class="px-4 py-2 hover:bg-surface-container-low transition-colors flex items-center gap-3 text-on-surface font-label-md">
                    <span class="material-symbols-outlined text-on-surface-variant text-[20px]">key</span>
                    Ubah Password
                </a>
                <a href="{{ route('admin.pengaturan') }}" class="px-4 py-2 hover:bg-surface-container-low transition-colors flex items-center gap-3 text-on-surface font-label-md">
                    <span class="material-symbols-outlined text-on-surface-variant text-[20px]">help</span>
                    Bantuan &amp; Panduan
                </a>
                <div class="border-t border-outline-variant/30 my-1"></div>
                <form action="{{ route('admin.logout') }}" method="POST" class="block">
                    @csrf
                    <button type="submit" class="w-full text-left px-4 py-2 hover:bg-error-container/20 transition-colors flex items-center gap-3 text-error font-label-md">
                        <span class="material-symbols-outlined text-[20px]">logout</span>
                        Keluar
                    </button>
                </form>
            </div>
        </div>
    </div>
</header>

<script>
    function getReadNotifs() {
        try {
            return JSON.parse(localStorage.getItem('sidj_read_notifs') || '[]');
        } catch(e) { return []; }
    }

    function saveReadNotifs(list) {
        try {
            localStorage.setItem('sidj_read_notifs', JSON.stringify(list));
        } catch(e) {}
    }

    function applyNotifReadStates() {
        const readList = getReadNotifs();
        const items = document.querySelectorAll('.notif-item');
        let unreadCount = 0;

        items.forEach(item => {
            const id = item.getAttribute('data-notif-id');
            const dot = item.querySelector('.notif-dot');
            if (id && readList.includes(id)) {
                // Read state: pure white background
                item.className = "notif-item p-4 transition-colors cursor-pointer flex gap-3 block bg-white hover:bg-surface-container-low border-l-4 border-l-transparent opacity-80";
                if (dot) dot.style.display = 'none';
            } else {
                // Unread state: subtle gray background with accent border & dot
                item.className = "notif-item p-4 transition-colors cursor-pointer flex gap-3 block bg-slate-100/90 hover:bg-slate-200/90 border-l-4 border-l-primary font-medium";
                if (dot) dot.style.display = 'inline-block';
                unreadCount++;
            }
        });

        const headerPulseDot = document.querySelector('#btn-notif .bg-error');
        if (headerPulseDot) {
            headerPulseDot.style.display = unreadCount > 0 ? 'block' : 'none';
        }
    }

    function markNotifRead(id) {
        const list = getReadNotifs();
        if (!list.includes(id)) {
            list.push(id);
            saveReadNotifs(list);
        }
        applyNotifReadStates();
    }

    function markAllNotifsAsRead() {
        const items = document.querySelectorAll('.notif-item');
        const list = getReadNotifs();
        items.forEach(item => {
            const id = item.getAttribute('data-notif-id');
            if (id && !list.includes(id)) list.push(id);
        });
        saveReadNotifs(list);
        applyNotifReadStates();
    }

    document.addEventListener('DOMContentLoaded', applyNotifReadStates);
</script>
