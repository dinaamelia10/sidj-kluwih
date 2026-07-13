@extends('admin.layout.master')

@push('styles')
<style>
    .material-symbols-outlined {
        font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        vertical-align: middle;
    }
    .bento-card {
        background: #ffffff;
        border: 1px solid #E2E8F0;
        border-radius: 1.25rem;
        box-shadow: 0 12px 34px rgba(15, 23, 42, 0.06);
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    .bento-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 18px 45px rgba(15, 23, 42, 0.1);
    }
    .hide-scrollbar::-webkit-scrollbar { display: none; }
    .hide-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
</style>
@endpush

@section('content')
<div class="space-y-lg">
    <div class="flex flex-col gap-4 md:flex-row md:items-end md:justify-between">
        <div>
            <nav class="flex flex-wrap items-center gap-2 text-on-surface-variant font-label-sm text-label-sm mb-2">
                <a class="hover:text-primary" href="#">Dashboard</a>
                <span class="material-symbols-outlined text-[14px]">chevron_right</span>
                <span class="text-primary font-bold">Harga Beli</span>
            </nav>
            <h1 class="font-headline-lg text-headline-lg font-extrabold text-on-surface">Harga Beli Resmi</h1>
            <p class="text-on-surface-variant font-body-md text-body-md mt-2">Lihat harga jagung terbaru dan riwayat transaksi dengan tata letak yang konsisten di mobile maupun laptop.</p>
        </div>
        <button class="inline-flex items-center gap-sm rounded-2xl bg-primary-container px-lg py-3 text-on-primary-container font-bold transition hover:bg-primary active:scale-95 shadow-md">
            <span class="material-symbols-outlined">add</span>
            Tambah Harga Baru
        </button>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-lg">
        <div class="bento-card p-lg">
            <div class="flex items-start justify-between gap-4">
                <div>
                    <p class="font-label-md text-label-md text-on-surface-variant">Harga Saat Ini</p>
                    <h2 class="font-display text-[32px] font-bold text-primary">Rp 4.850<span class="text-title-lg">/kg</span></h2>
                </div>
                <div class="w-12 h-12 rounded-full bg-secondary-container flex items-center justify-center text-on-secondary-container">
                    <span class="material-symbols-outlined">trending_up</span>
                </div>
            </div>
            <p class="mt-md inline-flex items-center gap-xs text-secondary font-bold text-label-sm">
                <span class="material-symbols-outlined text-sm">trending_up</span>
                +Rp 50 dari kemarin
            </p>
            <p class="mt-4 text-label-sm text-on-surface-variant">Terakhir diupdate 24 Okt 2023</p>
        </div>

        <div class="bento-card p-lg">
            <div class="flex items-start justify-between gap-4">
                <div>
                    <p class="font-label-md text-label-md text-on-surface-variant">Harga Tertinggi</p>
                    <h2 class="font-display text-[32px] font-bold text-primary">Rp 5.100<span class="text-title-lg">/kg</span></h2>
                </div>
                <div class="w-12 h-12 rounded-full bg-tertiary-fixed flex items-center justify-center text-on-tertiary-fixed">
                    <span class="material-symbols-outlined">vertical_align_top</span>
                </div>
            </div>
            <div class="mt-md w-full h-2 rounded-full bg-surface-container-high overflow-hidden">
                <div class="h-full w-4/5 rounded-full bg-tertiary"></div>
            </div>
            <p class="mt-4 text-label-sm text-on-surface-variant">Bulan ini adalah rekor tertinggi untuk harga jagung.</p>
        </div>

        <div class="bento-card p-lg">
            <div class="flex items-start justify-between gap-4">
                <div>
                    <p class="font-label-md text-label-md text-on-surface-variant">Harga Terendah</p>
                    <h2 class="font-display text-[32px] font-bold text-primary">Rp 4.600<span class="text-title-lg">/kg</span></h2>
                </div>
                <div class="w-12 h-12 rounded-full bg-error-container flex items-center justify-center text-error">
                    <span class="material-symbols-outlined">vertical_align_bottom</span>
                </div>
            </div>
            <div class="mt-md w-full h-2 rounded-full bg-surface-container-high overflow-hidden">
                <div class="h-full w-1/3 rounded-full bg-error"></div>
            </div>
            <p class="mt-4 text-label-sm text-on-surface-variant">Harga minimum terjadi pada kondisi pasokan tinggi.</p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-[minmax(0,2fr)_1fr] gap-lg">
        <div class="bento-card p-lg space-y-lg">
            <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
                <div>
                    <h2 class="font-title-lg text-title-lg font-bold">Tren Perubahan Harga</h2>
                    <p class="text-on-surface-variant font-body-md text-body-md">Analisis selisih harga dan pola pembelian dalam rentang waktu yang mudah dipahami.</p>
                </div>
                <div class="flex items-center gap-3">
                    <label for="harga-range" class="sr-only">Pilih rentang harga</label>
                    <select id="harga-range" class="rounded-xl border border-outline-variant bg-surface-container-low px-4 py-2 text-label-md focus:ring-2 focus:ring-primary">
                        <option>30 Hari Terakhir</option>
                        <option>90 Hari Terakhir</option>
                        <option>Tahun Ini</option>
                    </select>
                </div>
            </div>
            <div class="overflow-x-auto hide-scrollbar">
                <div class="h-64 min-w-full flex items-end gap-4 pt-4 px-1">
                    <div class="flex-1 min-w-[56px] flex flex-col items-center gap-3" data-value="25">
                        <div class="chart-bar w-full rounded-t-lg bg-primary-container/30 transition-all duration-300" style="height: 25%"></div>
                        <p class="text-label-sm opacity-60">01 Okt</p>
                    </div>
                    <div class="flex-1 min-w-[56px] flex flex-col items-center gap-3" data-value="40">
                        <div class="chart-bar w-full rounded-t-lg bg-primary-container/30 transition-all duration-300" style="height: 40%"></div>
                        <p class="text-label-sm opacity-60">07 Okt</p>
                    </div>
                    <div class="flex-1 min-w-[56px] flex flex-col items-center gap-3" data-value="55">
                        <div class="chart-bar w-full rounded-t-lg bg-primary-container/30 transition-all duration-300" style="height: 55%"></div>
                        <p class="text-label-sm opacity-60">14 Okt</p>
                    </div>
                    <div class="flex-1 min-w-[56px] flex flex-col items-center gap-3" data-value="65">
                        <div class="chart-bar w-full rounded-t-lg bg-primary-container/30 transition-all duration-300" style="height: 65%"></div>
                        <p class="text-label-sm opacity-60">21 Okt</p>
                    </div>
                    <div class="flex-1 min-w-[56px] flex flex-col items-center gap-3" data-value="80">
                        <div class="chart-bar w-full rounded-t-lg bg-primary-container/30 transition-all duration-300" style="height: 80%"></div>
                        <p class="text-label-sm opacity-60">28 Okt</p>
                    </div>
                </div>
            </div>
            <p id="harga-summary" class="text-label-sm text-on-surface-variant">Data untuk 30 hari terakhir — pergerakan harga jagung.</p>
        </div>

        <div class="bento-card p-lg bg-primary text-on-primary">
            <div>
                <span class="inline-flex items-center rounded-full bg-on-primary/20 px-3 py-1 text-label-sm font-bold">Insight Pasar</span>
                <h2 class="mt-4 font-title-lg text-title-lg font-bold">Prediksi Harga</h2>
                <p class="mt-3 text-body-md leading-relaxed text-on-primary/80">Harga diprediksi mengalami kenaikan ringan karena permintaan terus meningkat sementara pasokan lokal stabil.</p>
            </div>
            <button class="mt-6 w-full rounded-2xl border border-on-primary/30 bg-on-primary/10 px-lg py-3 font-bold transition hover:bg-on-primary/20">Lihat Detail Laporan</button>
        </div>
    </div>

    <div class="bento-card overflow-hidden">
        <div class="border-b border-outline-variant px-lg py-lg">
            <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
                <div>
                    <h2 class="font-title-lg text-title-lg font-bold">Riwayat Perubahan Harga</h2>
                    <p class="text-on-surface-variant text-body-md">Cari dan filter entri harga jagung dengan mudah di semua ukuran layar.</p>
                </div>
                <div class="flex flex-col gap-3 sm:flex-row sm:items-center">
                    <div class="relative w-full sm:w-72">
                        <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-outline">search</span>
                        <input data-search-target="prices" type="text" placeholder="Cari varietas..."
                               class="w-full rounded-xl border border-outline-variant bg-surface px-10 py-2 text-label-md focus:border-transparent focus:ring-2 focus:ring-primary" />
                    </div>
                    <button id="toggle-filter" type="button"
                            class="inline-flex items-center gap-sm rounded-2xl border border-outline-variant bg-surface px-lg py-3 text-label-md font-bold transition hover:bg-surface-variant"
                            aria-expanded="false" aria-controls="filter-panel">
                        <span class="material-symbols-outlined">filter_list</span>
                        Filter
                    </button>
                </div>
            </div>
            <div id="filter-panel" class="mt-4 hidden rounded-[1.5rem] border border-outline-variant bg-surface-container-lowest p-lg">
                <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
                    <label class="flex flex-col gap-2">
                        <span class="font-label-sm text-label-sm text-on-surface-variant">Periode</span>
                        <input type="date" class="rounded-xl border border-outline-variant bg-white px-4 py-2 focus:ring-2 focus:ring-primary" />
                    </label>
                    <label class="flex flex-col gap-2">
                        <span class="font-label-sm text-label-sm text-on-surface-variant">Varietas</span>
                        <select class="rounded-xl border border-outline-variant bg-white px-4 py-2 focus:ring-2 focus:ring-primary">
                            <option>Semua Varietas</option>
                            <option>Pioneer P35</option>
                            <option>NK Sumo</option>
                            <option>Bisi 18</option>
                        </select>
                    </label>
                    <div class="flex items-end justify-end">
                        <button id="reset-filters" type="button"
                                class="rounded-2xl border border-outline-variant bg-surface px-lg py-3 font-bold transition hover:bg-surface-variant">Reset</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="hidden md:block overflow-x-auto">
            <table class="w-full min-w-[720px] text-left">
                <thead class="bg-surface-container-low text-on-surface-variant font-label-md text-label-md uppercase tracking-wide">
                    <tr>
                        <th class="px-lg py-md font-semibold">Tanggal</th>
                        <th class="px-lg py-md font-semibold">Harga</th>
                        <th class="px-lg py-md font-semibold">Varietas</th>
                        <th class="px-lg py-md font-semibold">Status</th>
                        <th class="px-lg py-md font-semibold text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-outline-variant" data-table="prices">
                    <tr class="hover:bg-surface-variant transition-colors">
                        <td class="px-lg py-md">24 Okt 2023, 08:30</td>
                        <td class="px-lg py-md font-bold text-primary">Rp 4.850</td>
                        <td class="px-lg py-md">Pioneer P35</td>
                        <td class="px-lg py-md"><span class="inline-flex items-center px-sm py-1 rounded-full bg-secondary-container/30 text-secondary text-[12px] font-bold">Aktif</span></td>
                        <td class="px-lg py-md text-right">
                            <div class="flex items-center justify-end gap-sm">
                                <button class="p-xs hover:bg-surface-container-high rounded text-on-surface-variant"><span class="material-symbols-outlined">edit</span></button>
                                <button class="p-xs hover:bg-error-container/20 rounded text-error"><span class="material-symbols-outlined">delete</span></button>
                            </div>
                        </td>
                    </tr>
                    <tr class="hover:bg-surface-variant transition-colors">
                        <td class="px-lg py-md">22 Okt 2023, 14:15</td>
                        <td class="px-lg py-md font-bold text-primary">Rp 4.800</td>
                        <td class="px-lg py-md">NK Sumo</td>
                        <td class="px-lg py-md"><span class="inline-flex items-center px-sm py-1 rounded-full bg-surface-container-highest text-on-surface-variant/70 text-[12px] font-bold">Arsip</span></td>
                        <td class="px-lg py-md text-right">
                            <div class="flex items-center justify-end gap-sm">
                                <button class="p-xs hover:bg-surface-container-high rounded text-on-surface-variant"><span class="material-symbols-outlined">edit</span></button>
                                <button class="p-xs hover:bg-error-container/20 rounded text-error"><span class="material-symbols-outlined">delete</span></button>
                            </div>
                        </td>
                    </tr>
                    <tr class="hover:bg-surface-variant transition-colors">
                        <td class="px-lg py-md">20 Okt 2023, 09:00</td>
                        <td class="px-lg py-md font-bold text-primary">Rp 4.750</td>
                        <td class="px-lg py-md">Pioneer P35</td>
                        <td class="px-lg py-md"><span class="inline-flex items-center px-sm py-1 rounded-full bg-surface-container-highest text-on-surface-variant/70 text-[12px] font-bold">Arsip</span></td>
                        <td class="px-lg py-md text-right">
                            <div class="flex items-center justify-end gap-sm">
                                <button class="p-xs hover:bg-surface-container-high rounded text-on-surface-variant"><span class="material-symbols-outlined">edit</span></button>
                                <button class="p-xs hover:bg-error-container/20 rounded text-error"><span class="material-symbols-outlined">delete</span></button>
                            </div>
                        </td>
                    </tr>
                    <tr class="hover:bg-surface-variant transition-colors">
                        <td class="px-lg py-md">18 Okt 2023, 11:45</td>
                        <td class="px-lg py-md font-bold text-primary">Rp 4.700</td>
                        <td class="px-lg py-md">Bisi 18</td>
                        <td class="px-lg py-md"><span class="inline-flex items-center px-sm py-1 rounded-full bg-surface-container-highest text-on-surface-variant/70 text-[12px] font-bold">Arsip</span></td>
                        <td class="px-lg py-md text-right">
                            <div class="flex items-center justify-end gap-sm">
                                <button class="p-xs hover:bg-surface-container-high rounded text-on-surface-variant"><span class="material-symbols-outlined">edit</span></button>
                                <button class="p-xs hover:bg-error-container/20 rounded text-error"><span class="material-symbols-outlined">delete</span></button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="md:hidden divide-y divide-outline-variant" data-card="prices">
            <div class="transaction-card space-y-md rounded-[1.25rem] border border-outline-variant bg-surface-container-lowest p-lg">
                <div class="flex items-start justify-between gap-4">
                    <div class="flex items-center gap-sm">
                        <div class="w-10 h-10 rounded-full bg-secondary-container text-on-secondary-container flex items-center justify-center font-bold text-xs">AS</div>
                        <div>
                            <p class="font-bold text-body-md">Agus Santoso</p>
                            <p class="text-label-sm text-on-surface-variant">24 Okt 2023</p>
                        </div>
                    </div>
                    <span class="rounded-full bg-primary/10 px-3 py-1 text-label-sm font-bold text-primary">Rp 4.850</span>
                </div>
                <div class="grid grid-cols-2 gap-sm text-label-sm">
                    <div class="rounded-xl bg-surface-container-low px-3 py-3">
                        <p class="text-on-surface-variant">Varietas</p>
                        <p class="font-bold">Pioneer P35</p>
                    </div>
                    <div class="rounded-xl bg-surface-container-low px-3 py-3">
                        <p class="text-on-surface-variant">Status</p>
                        <p class="font-bold">Aktif</p>
                    </div>
                </div>
                <div class="flex flex-wrap justify-end gap-3 pt-sm">
                    <button class="inline-flex items-center gap-xs text-primary font-bold"><span class="material-symbols-outlined text-sm">edit</span> Edit</button>
                    <button class="inline-flex items-center gap-xs text-error font-bold"><span class="material-symbols-outlined text-sm">delete</span> Hapus</button>
                </div>
            </div>
        </div>
    </div>

    <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
        <p class="text-label-md text-on-surface-variant">Menampilkan 4 dari 48 data</p>
        <div class="flex flex-wrap items-center gap-2">
            <button class="h-10 w-10 rounded-xl border border-outline-variant bg-white text-on-surface hover:bg-surface-variant disabled:opacity-50" disabled>
                <span class="material-symbols-outlined">chevron_left</span>
            </button>
            <button class="h-10 w-10 rounded-xl bg-primary text-on-primary font-bold">1</button>
            <button class="h-10 w-10 rounded-xl border border-outline-variant bg-white text-on-surface hover:bg-surface-variant">2</button>
            <button class="h-10 w-10 rounded-xl border border-outline-variant bg-white text-on-surface hover:bg-surface-variant">3</button>
            <button class="h-10 w-10 rounded-xl border border-outline-variant bg-white text-on-surface hover:bg-surface-variant">
                <span class="material-symbols-outlined">chevron_right</span>
            </button>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.querySelectorAll('input[data-search-target="prices"]').forEach(search => {
        search.addEventListener('input', event => {
            const value = event.target.value.toLowerCase();
            document.querySelectorAll('[data-table="prices"] tbody tr, [data-card="prices"] .transaction-card').forEach(item => {
                const text = item.innerText.toLowerCase();
                item.style.display = text.includes(value) ? '' : 'none';
            });
        });
    });

    const filterToggle = document.getElementById('toggle-filter');
    const filterPanel = document.getElementById('filter-panel');
    if (filterToggle && filterPanel) {
        filterToggle.addEventListener('click', () => {
            const isOpen = !filterPanel.classList.contains('hidden');
            filterPanel.classList.toggle('hidden', isOpen);
            filterToggle.setAttribute('aria-expanded', String(!isOpen));
        });
    }

    const resetFilters = document.getElementById('reset-filters');
    if (resetFilters && filterPanel) {
        resetFilters.addEventListener('click', () => {
            filterPanel.querySelectorAll('input, select').forEach(field => {
                if (field.tagName.toLowerCase() === 'select') {
                    field.selectedIndex = 0;
                } else {
                    field.value = '';
                }
            });
        });
    }

    const hargaRange = document.getElementById('harga-range');
    const hargaSummary = document.getElementById('harga-summary');
    const chartBars = document.querySelectorAll('.chart-bar');

    if (hargaRange && hargaSummary) {
        hargaRange.addEventListener('change', event => {
            hargaSummary.textContent = `Data untuk ${event.target.value} — pergerakan harga jagung.`;
        });
    }

    chartBars.forEach(bar => {
        const parent = bar.closest('[data-value]');
        if (!parent) return;
        const value = parent.getAttribute('data-value');
        parent.addEventListener('mouseenter', () => {
            bar.classList.add('bg-primary-container');
            hargaSummary.textContent = `${parent.querySelector('p').innerText}: ${value}% dari target.`;
        });
        parent.addEventListener('mouseleave', () => {
            bar.classList.remove('bg-primary-container');
            if (hargaRange && hargaSummary) {
                hargaSummary.textContent = `Data untuk ${hargaRange.value} — pergerakan harga jagung.`;
            }
        });
    });
</script>
@endpush
