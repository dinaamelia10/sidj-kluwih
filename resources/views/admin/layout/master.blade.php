<!DOCTYPE html>
<html lang="id" class="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=block" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script id="tailwind-config">
        try {
            tailwind.config = {
                darkMode: "class",
                theme: {
                    extend: {
                        colors: {
                            surface: "#f9f9ff",
                            background: "#f9f9ff",
                            "surface-container": "#e7eeff",
                            "surface-container-low": "#f0f3ff",
                            "surface-container-high": "#dee8ff",
                            "surface-container-highest": "#d8e3fb",
                            "surface-container-lowest": "#ffffff",
                            "surface-tint": "#1b6d24",
                            "surface-variant": "#d8e3fb",
                            "surface-dim": "#cfdaf2",
                            "outline": "#707a6c",
                            "outline-variant": "#bfcaba",
                            primary: "#0d631b",
                            "primary-container": "#2e7d32",
                            "primary-fixed": "#a3f69c",
                            "primary-fixed-dim": "#88d982",
                            "on-primary": "#ffffff",
                            "on-primary-container": "#cbffc2",
                            "on-primary-fixed": "#002204",
                            "on-primary-fixed-variant": "#005312",
                            secondary: "#006e1c",
                            "secondary-container": "#91f78e",
                            "secondary-fixed": "#94f990",
                            "secondary-fixed-dim": "#78dc77",
                            "on-secondary": "#ffffff",
                            "on-secondary-container": "#00731e",
                            "on-secondary-fixed": "#002204",
                            "on-secondary-fixed-variant": "#005313",
                            tertiary: "#6e5100",
                            "tertiary-container": "#8c6800",
                            "tertiary-fixed": "#ffdfa0",
                            "tertiary-fixed-dim": "#f8bd2a",
                            "on-tertiary": "#ffffff",
                            "on-tertiary-container": "#ffefd7",
                            "on-tertiary-fixed-variant": "#5c4300",
                            "on-surface": "#111c2d",
                            "on-surface-variant": "#40493d",
                            "inverse-surface": "#263143",
                            "inverse-on-surface": "#ecf1ff",
                            error: "#ba1a1a",
                            "error-container": "#ffdad6",
                            "on-error": "#ffffff",
                            "on-error-container": "#93000a"
                        },
                        borderRadius: {
                            DEFAULT: "0.25rem",
                            lg: "0.5rem",
                            xl: "0.75rem",
                            xxl: "20px",
                            full: "9999px"
                        },
                        spacing: {
                            xs: "4px",
                            sm: "8px",
                            "container-margin": "24px",
                            base: "4px",
                            gutter: "20px",
                            lg: "24px",
                            xl: "40px",
                            md: "16px"
                        },
                        fontFamily: {
                            "headline-md": ["Inter"],
                            "body-lg": ["Inter"],
                            "headline-lg": ["Inter"],
                            display: ["Inter"],
                            "title-lg": ["Inter"],
                            "label-md": ["Inter"],
                            "headline-lg-mobile": ["Inter"],
                            "label-sm": ["Inter"],
                            "body-md": ["Inter"]
                        },
                        fontSize: {
                            "headline-md": ["24px", {lineHeight: "32px", fontWeight: "600"}],
                            "body-lg": ["18px", {lineHeight: "28px", fontWeight: "400"}],
                            "headline-lg": ["32px", {lineHeight: "40px", letterSpacing: "-0.01em", fontWeight: "600"}],
                            display: ["48px", {lineHeight: "1.2", letterSpacing: "-0.02em", fontWeight: "700"}],
                            "title-lg": ["20px", {lineHeight: "28px", fontWeight: "600"}],
                            "label-md": ["14px", {lineHeight: "20px", letterSpacing: "0.01em", fontWeight: "500"}],
                            "headline-lg-mobile": ["24px", {lineHeight: "32px", fontWeight: "600"}],
                            "label-sm": ["12px", {lineHeight: "16px", letterSpacing: "0.05em", fontWeight: "600"}],
                            "body-md": ["16px", {lineHeight: "24px", fontWeight: "400"}]
                        }
                    }
                }
            }
        } catch (_e) {}
    </script>
    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
            vertical-align: middle;
        }
        .bento-card {
            background: white;
            border: 1px solid #E2E8F0;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -2px rgba(0, 0, 0, 0.05);
            border-radius: 20px;
            transition: transform 0.2s ease-out, box-shadow 0.2s ease-out;
        }
        .bento-card:hover {
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.08);
            transform: translateY(-2px);
        }
        .hide-scrollbar::-webkit-scrollbar {
            display: none;
        }
        .hide-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    </style>
    @stack('styles')
    <meta charset="utf-8">
</head>
<body class="flex min-h-screen">
    @include('admin.layout.navbar')
    <main class="flex-1 flex flex-col min-w-0 bg-background overflow-y-auto">
        @include('admin.layout.header')
        <div class="p-lg md:p-xl space-y-xl max-w-7xl mx-auto w-full">
            @yield('content')
        </div>
        @include('admin.layout.footer')
    </main>
    <div class="fixed inset-0 bg-black/50 z-[100] opacity-0 pointer-events-none transition-opacity duration-300 md:hidden" id="mobile-menu">
        <div class="w-64 h-full bg-white p-lg flex flex-col -translate-x-full transition-transform duration-300" id="mobile-drawer">
            @include('admin.layout.sidebar_content')
        </div>
    </div>
    <script>
        document.querySelectorAll('button, a').forEach(el => {
            el.addEventListener('mousedown', () => {
                el.classList.add('scale-95');
                setTimeout(() => el.classList.remove('scale-95'), 150);
            });
        });

        const menuButton = document.querySelector('button[aria-controls="mobile-menu"]');
        const mobileMenu = document.getElementById('mobile-menu');
        const mobileDrawer = document.getElementById('mobile-drawer');

        if (menuButton && mobileMenu && mobileDrawer) {
            const toggleMenu = () => {
                const isOpen = mobileMenu.classList.contains('opacity-100');
                mobileMenu.classList.toggle('opacity-100', !isOpen);
                mobileMenu.classList.toggle('pointer-events-none', isOpen);
                mobileDrawer.classList.toggle('translate-x-0', !isOpen);
                mobileDrawer.classList.toggle('-translate-x-full', isOpen);
            };

            menuButton.addEventListener('click', toggleMenu);
            mobileMenu.addEventListener('click', (event) => {
                if (event.target === mobileMenu) toggleMenu();
            });
        }

        // Global Live Search & Filter Logic
        const globalSearchInput = document.getElementById('globalHeaderSearch');
        const globalSearchDropdown = document.getElementById('globalSearchDropdown');
        const searchResultsContainer = document.getElementById('searchResultsContainer');
        const searchCountStatus = document.getElementById('searchCountStatus');
        let searchDebounceTimer = null;

        if (globalSearchInput) {
            globalSearchInput.addEventListener('input', (e) => {
                const val = e.target.value.trim();
                const lowerVal = val.toLowerCase();

                // 1. Filter tabel & kartu lokal jika ada di halaman saat ini
                const rows = document.querySelectorAll('tbody tr');
                rows.forEach(row => {
                    const text = row.innerText.toLowerCase();
                    row.style.display = text.includes(lowerVal) ? '' : 'none';
                });

                const cards = document.querySelectorAll('[data-card="transactions"] .transaction-card, .mobile-card-item');
                cards.forEach(card => {
                    const text = card.innerText.toLowerCase();
                    card.style.display = text.includes(lowerVal) ? '' : 'none';
                });

                // 2. Fetch Live Search API untuk dropdown floating
                if (val.length < 2) {
                    if (globalSearchDropdown) {
                        globalSearchDropdown.classList.add('opacity-0', 'pointer-events-none', 'translate-y-[-10px]');
                        globalSearchDropdown.classList.remove('opacity-100', 'pointer-events-auto', 'translate-y-0');
                    }
                    return;
                }

                clearTimeout(searchDebounceTimer);
                searchDebounceTimer = setTimeout(() => {
                    fetch(`{{ url('/admin/api/search') }}?q=${encodeURIComponent(val)}`)
                        .then(res => res.json())
                        .then(data => {
                            let html = '';
                            let totalCount = 0;

                            // Petani
                            if (data.petani && data.petani.length > 0) {
                                totalCount += data.petani.length;
                                html += `<div class="px-3 py-1.5 bg-surface-container-low font-bold text-[10px] text-primary uppercase tracking-wider">Petani (${data.petani.length})</div>`;
                                data.petani.forEach(p => {
                                    html += `<a href="{{ route('admin.pengguna') }}?search=${encodeURIComponent(p.nama)}" class="p-3 hover:bg-primary/5 transition-colors flex items-center gap-3 block">
                                        <div class="w-8 h-8 rounded-full bg-secondary-container text-primary flex items-center justify-center font-bold text-xs shrink-0">${p.nama.charAt(0).toUpperCase()}</div>
                                        <div class="min-w-0 flex-1">
                                            <p class="font-bold text-on-surface text-sm leading-tight">${p.nama}</p>
                                            <p class="text-xs text-on-surface-variant">${p.wilayah || 'Kluwih'} • ${p.komoditas}</p>
                                        </div>
                                    </a>`;
                                });
                            }

                            // Transaksi / Tonase
                            if (data.transactions && data.transactions.length > 0) {
                                totalCount += data.transactions.length;
                                html += `<div class="px-3 py-1.5 bg-surface-container-low font-bold text-[10px] text-primary uppercase tracking-wider">Transaksi Tonase (${data.transactions.length})</div>`;
                                data.transactions.forEach(t => {
                                    html += `<a href="{{ route('admin.tonase-jagung') }}" class="p-3 hover:bg-primary/5 transition-colors flex items-center gap-3 block">
                                        <div class="w-8 h-8 rounded-full bg-tertiary-fixed text-tertiary flex items-center justify-center font-bold text-xs shrink-0">Kg</div>
                                        <div class="min-w-0 flex-1">
                                            <p class="font-bold text-on-surface text-sm leading-tight">${t.farmer_name} (${t.tonnage} Kg)</p>
                                            <p class="text-xs text-on-surface-variant">Status: ${t.status}</p>
                                        </div>
                                    </a>`;
                                });
                            }

                            // Harga Beli
                            if (data.prices && data.prices.length > 0) {
                                totalCount += data.prices.length;
                                html += `<div class="px-3 py-1.5 bg-surface-container-low font-bold text-[10px] text-primary uppercase tracking-wider">Harga Beli (${data.prices.length})</div>`;
                                data.prices.forEach(pr => {
                                    html += `<a href="{{ route('admin.harga-beli') }}" class="p-3 hover:bg-primary/5 transition-colors flex items-center gap-3 block">
                                        <div class="w-8 h-8 rounded-full bg-primary-fixed text-primary flex items-center justify-center font-bold text-xs shrink-0">Rp</div>
                                        <div class="min-w-0 flex-1">
                                            <p class="font-bold text-on-surface text-sm leading-tight">${pr.variety}</p>
                                            <p class="text-xs text-primary font-bold">Rp ${parseInt(pr.price).toLocaleString('id-ID')}/kg</p>
                                        </div>
                                    </a>`;
                                });
                            }

                            // Pesan Masuk
                            if (data.messages && data.messages.length > 0) {
                                totalCount += data.messages.length;
                                html += `<div class="px-3 py-1.5 bg-surface-container-low font-bold text-[10px] text-primary uppercase tracking-wider">Pesan Kontak (${data.messages.length})</div>`;
                                data.messages.forEach(m => {
                                    html += `<a href="{{ route('admin.pesan') }}?search=${encodeURIComponent(m.name)}" class="p-3 hover:bg-primary/5 transition-colors flex items-center gap-3 block">
                                        <div class="w-8 h-8 rounded-full bg-error-container text-error flex items-center justify-center font-bold text-xs shrink-0">✉</div>
                                        <div class="min-w-0 flex-1">
                                            <p class="font-bold text-on-surface text-sm leading-tight">${m.name}</p>
                                            <p class="text-xs text-on-surface-variant truncate">${m.subject || 'Pesan Pengunjung'}</p>
                                        </div>
                                    </a>`;
                                });
                            }

                            if (totalCount === 0) {
                                html = `<div class="p-4 text-center text-on-surface-variant text-xs italic">Tidak ada hasil ditemukan untuk "${val}"</div>`;
                            }

                            if (searchCountStatus) searchCountStatus.textContent = `${totalCount} hasil ditemukan`;
                            if (searchResultsContainer) searchResultsContainer.innerHTML = html;

                            if (globalSearchDropdown) {
                                globalSearchDropdown.classList.remove('opacity-0', 'pointer-events-none', 'translate-y-[-10px]');
                                globalSearchDropdown.classList.add('opacity-100', 'pointer-events-auto', 'translate-y-0');
                            }
                        })
                        .catch(() => {});
                }, 250);
            });
        }

        // Close global search dropdown on click outside
        document.addEventListener('click', (e) => {
            const wrapper = document.getElementById('globalSearchWrapper');
            if (wrapper && !wrapper.contains(e.target) && globalSearchDropdown) {
                globalSearchDropdown.classList.add('opacity-0', 'pointer-events-none', 'translate-y-[-10px]');
                globalSearchDropdown.classList.remove('opacity-100', 'pointer-events-auto', 'translate-y-0');
            }
        });

        // Header Dropdowns Logic
        const btnNotif = document.getElementById('btn-notif');
        const ddNotif = document.getElementById('dropdown-notif');
        const btnProfile = document.getElementById('btn-profile');
        const ddProfile = document.getElementById('dropdown-profile');

        function toggleDropdown(ddElement) {
            const isClosed = ddElement.classList.contains('opacity-0');
            
            // Close all first
            [ddNotif, ddProfile].forEach(dd => {
                if(dd) {
                    dd.classList.add('opacity-0', 'pointer-events-none', 'translate-y-[-10px]');
                    dd.classList.remove('opacity-100', 'pointer-events-auto', 'translate-y-0');
                }
            });

            if (isClosed) {
                ddElement.classList.remove('opacity-0', 'pointer-events-none', 'translate-y-[-10px]');
                ddElement.classList.add('opacity-100', 'pointer-events-auto', 'translate-y-0');
            }
        }

        if (btnNotif && ddNotif) {
            btnNotif.addEventListener('click', (e) => {
                e.stopPropagation();
                toggleDropdown(ddNotif);
            });
        }

        if (btnProfile && ddProfile) {
            btnProfile.addEventListener('click', (e) => {
                e.stopPropagation();
                toggleDropdown(ddProfile);
            });
        }

        // Click outside to close
        document.addEventListener('click', (e) => {
            const isClickInsideNotif = document.getElementById('notif-wrapper')?.contains(e.target);
            const isClickInsideProfile = document.getElementById('profile-wrapper')?.contains(e.target);
            
            if (!isClickInsideNotif && ddNotif) {
                ddNotif.classList.add('opacity-0', 'pointer-events-none', 'translate-y-[-10px]');
                ddNotif.classList.remove('opacity-100', 'pointer-events-auto', 'translate-y-0');
            }
            if (!isClickInsideProfile && ddProfile) {
                ddProfile.classList.add('opacity-0', 'pointer-events-none', 'translate-y-[-10px]');
                ddProfile.classList.remove('opacity-100', 'pointer-events-auto', 'translate-y-0');
            }
        });
    </script>
    <!-- GLOBAL CONFIRMATION MODAL -->
    <div id="globalConfirmModal"
         class="fixed inset-0 z-[300] flex items-center justify-center p-4 bg-on-surface/40 backdrop-blur-sm opacity-0 pointer-events-none transition-all duration-300">
        <div id="globalConfirmContent"
             class="w-full max-w-md bg-white rounded-2xl shadow-2xl overflow-hidden transform scale-95 transition-all duration-300 border border-outline-variant/30">
            <div class="p-6 text-center space-y-4">
                <div id="globalConfirmIconBg" class="w-16 h-16 rounded-full bg-error-container/30 text-error flex items-center justify-center mx-auto transition-colors">
                    <span class="material-symbols-outlined text-3xl" id="globalConfirmIcon">delete_forever</span>
                </div>
                <div>
                    <h3 class="text-xl font-bold text-on-surface" id="globalConfirmTitle">Konfirmasi Hapus</h3>
                    <p class="text-sm text-on-surface-variant mt-2 leading-relaxed" id="globalConfirmMessage">Apakah Anda yakin ingin menghapus data ini? Tindakan ini tidak dapat dibatalkan.</p>
                </div>
            </div>
            <div class="px-6 py-4 bg-surface-container-low border-t border-outline-variant/20 flex gap-3">
                <button type="button" id="btnGlobalConfirmCancel" onclick="closeGlobalConfirmModal()"
                        class="flex-1 py-2.5 rounded-xl border border-outline-variant text-on-surface-variant font-semibold text-sm hover:bg-surface-container-high transition-all active:scale-95">
                    Batal
                </button>
                <button type="button" id="btnGlobalConfirmOk"
                        class="flex-1 py-2.5 rounded-xl bg-error text-white font-bold text-sm hover:bg-error/90 transition-all shadow-md active:scale-95">
                    Ya, Hapus
                </button>
            </div>
        </div>
    </div>

    <script>
        let currentConfirmCallback = null;

        function showGlobalConfirmModal({ title, message, confirmText = 'Ya, Hapus', isDanger = true, onConfirm }) {
            const modal = document.getElementById('globalConfirmModal');
            const content = document.getElementById('globalConfirmContent');
            const titleEl = document.getElementById('globalConfirmTitle');
            const msgEl = document.getElementById('globalConfirmMessage');
            const okBtn = document.getElementById('btnGlobalConfirmOk');
            const iconBg = document.getElementById('globalConfirmIconBg');
            const iconEl = document.getElementById('globalConfirmIcon');

            if (!modal || !content) return;

            titleEl.textContent = title || 'Konfirmasi Hapus';
            msgEl.textContent = message || 'Apakah Anda yakin ingin menghapus data ini?';
            okBtn.textContent = confirmText;
            currentConfirmCallback = onConfirm;

            if (isDanger) {
                okBtn.className = "flex-1 py-2.5 rounded-xl bg-error text-white font-bold text-sm hover:bg-error/90 transition-all shadow-md active:scale-95";
                iconBg.className = "w-16 h-16 rounded-full bg-error-container/30 text-error flex items-center justify-center mx-auto transition-colors";
                iconEl.textContent = "delete_forever";
            } else {
                okBtn.className = "flex-1 py-2.5 rounded-xl bg-primary text-white font-bold text-sm hover:bg-primary/90 transition-all shadow-md active:scale-95";
                iconBg.className = "w-16 h-16 rounded-full bg-primary/10 text-primary flex items-center justify-center mx-auto transition-colors";
                iconEl.textContent = "check_circle";
            }

            modal.classList.remove('opacity-0', 'pointer-events-none');
            modal.classList.add('opacity-100');
            content.classList.remove('scale-95');
            content.classList.add('scale-100');
            document.body.style.overflow = 'hidden';
        }

        function closeGlobalConfirmModal() {
            const modal = document.getElementById('globalConfirmModal');
            const content = document.getElementById('globalConfirmContent');
            if (!modal || !content) return;

            modal.classList.add('opacity-0', 'pointer-events-none');
            modal.classList.remove('opacity-100');
            content.classList.add('scale-95');
            content.classList.remove('scale-100');
            document.body.style.overflow = '';
            currentConfirmCallback = null;
        }

        document.getElementById('btnGlobalConfirmOk')?.addEventListener('click', () => {
            const cb = currentConfirmCallback;
            closeGlobalConfirmModal();
            if (cb && typeof cb === 'function') cb();
        });

        document.getElementById('globalConfirmModal')?.addEventListener('click', (e) => {
            if (e.target === document.getElementById('globalConfirmModal')) closeGlobalConfirmModal();
        });

        function confirmSubmit(event, title, message, confirmText = 'Ya, Hapus', isDanger = true) {
            event.preventDefault();
            const target = event.currentTarget || event.target;
            const form = target.closest('form') || target;

            showGlobalConfirmModal({
                title: title,
                message: message,
                confirmText: confirmText,
                isDanger: isDanger,
                onConfirm: () => {
                    if (form && typeof form.submit === 'function') {
                        form.submit();
                    } else if (form && form.tagName === 'FORM') {
                        HTMLFormElement.prototype.submit.call(form);
                    } else if (target && target.href) {
                        window.location.href = target.href;
                    }
                }
            });
            return false;
        }
    </script>
    @stack('scripts')
</body>
</html>
