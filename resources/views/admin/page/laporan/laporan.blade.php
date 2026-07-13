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

    .custom-scrollbar::-webkit-scrollbar { width: 8px; }
    .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
    .custom-scrollbar::-webkit-scrollbar-thumb { background: #bfcaba; border-radius: 9999px; }
</style>
@endpush

@section('content')
<div class="space-y-lg">
    <div class="flex flex-col gap-4 md:flex-row md:items-end md:justify-between">
        <div>
            <nav class="flex flex-wrap items-center gap-2 text-on-surface-variant font-label-sm text-label-sm mb-2">
                <a class="hover:text-primary" href="#">Dashboard</a>
                <span class="material-symbols-outlined text-[14px]">chevron_right</span>
                <span class="text-primary font-bold">Laporan</span>
            </nav>
            <h1 class="font-headline-lg text-headline-lg font-extrabold text-on-surface">Laporan Data Jagung</h1>
            <p class="text-on-surface-variant font-body-md text-body-md mt-2">Tampilan laporan yang konsisten untuk mobile dan laptop, dengan navigasi header/footer/navbar terkelola dari layout bersama.</p>
        </div>
        <button class="inline-flex items-center gap-sm rounded-2xl bg-primary-container px-lg py-3 text-on-primary-container font-bold transition hover:bg-primary active:scale-95 shadow-md">
            <span class="material-symbols-outlined">add</span>
            Buat Laporan Baru
        </button>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-lg">
        <div class="bento-card p-lg">
            <div class="flex items-start justify-between gap-4">
                <div>
                    <p class="font-label-md text-label-md text-on-surface-variant">Total Laporan</p>
                    <h2 class="font-display text-[32px] font-bold text-primary">1,284</h2>
                </div>
                <div class="w-12 h-12 rounded-full bg-secondary-container flex items-center justify-center text-on-secondary-container">
                    <span class="material-symbols-outlined">analytics</span>
                </div>
            </div>
            <p class="mt-md inline-flex items-center gap-xs text-primary font-bold text-label-sm">
                <span class="material-symbols-outlined text-sm">trending_up</span>
                +12% dari bulan lalu
            </p>
        </div>

        <div class="bento-card p-lg">
            <div class="flex items-start justify-between gap-4">
                <div>
                    <p class="font-label-md text-label-md text-on-surface-variant">Total Tonase</p>
                    <h2 class="font-display text-[32px] font-bold text-primary">4,850 <span class="text-title-lg">Ton</span></h2>
                </div>
                <div class="w-12 h-12 rounded-full bg-tertiary-fixed flex items-center justify-center text-tertiary">
                    <span class="material-symbols-outlined">weight</span>
                </div>
            </div>
            <p class="mt-md inline-flex items-center gap-xs text-primary font-bold text-label-sm">
                <span class="material-symbols-outlined text-sm">trending_up</span>
                Estimasi +5.2k Ton
            </p>
        </div>

        <div class="bento-card p-lg">
            <div class="flex items-start justify-between gap-4">
                <div>
                    <p class="font-label-md text-label-md text-on-surface-variant">Rata-rata Harga</p>
                    <h2 class="font-display text-[32px] font-bold text-primary">Rp 5.420<span class="text-title-lg">/kg</span></h2>
                </div>
                <div class="w-12 h-12 rounded-full bg-primary-fixed flex items-center justify-center text-on-primary-fixed">
                    <span class="material-symbols-outlined">payments</span>
                </div>
            </div>
            <p class="mt-md inline-flex items-center gap-xs text-error font-bold text-label-sm">
                <span class="material-symbols-outlined text-sm">trending_down</span>
                -2.1% fluktuasi pasar
            </p>
        </div>
    </div>

    <div class="grid grid-cols-1 xl:grid-cols-[minmax(0,2fr)_1fr] gap-lg">
        <div class="bento-card p-lg space-y-lg">
            <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
                <div>
                    <h2 class="font-title-lg text-title-lg font-bold">Tren Produktivitas Bulanan</h2>
                    <p class="text-on-surface-variant font-body-md">Analisis tonase jagung periode Januari - Juni 2024 dengan ringkasan yang mudah dibaca.</p>
                </div>
                <div class="flex items-center gap-3">
                    <label for="year-range" class="sr-only">Pilih tahun</label>
                    <select id="year-range" class="rounded-xl border border-outline-variant bg-surface-container-low px-4 py-2 text-label-md focus:ring-2 focus:ring-primary">
                        <option>2024</option>
                        <option>2023</option>
                    </select>
                </div>
            </div>
            <div class="overflow-x-auto hide-scrollbar">
                <div class="h-64 min-w-full flex items-end gap-4 pt-4 px-1">
                    <div class="flex-1 min-w-[56px] flex flex-col items-center gap-3" data-value="65">
                        <div class="chart-bar w-full rounded-t-lg bg-primary-container/30 transition-all duration-300" style="height: 65%"></div>
                        <p class="text-label-sm opacity-60">Jan</p>
                    </div>
                    <div class="flex-1 min-w-[56px] flex flex-col items-center gap-3" data-value="55">
                        <div class="chart-bar w-full rounded-t-lg bg-primary-container/30 transition-all duration-300" style="height: 55%"></div>
                        <p class="text-label-sm opacity-60">Feb</p>
                    </div>
                    <div class="flex-1 min-w-[56px] flex flex-col items-center gap-3" data-value="70">
                        <div class="chart-bar w-full rounded-t-lg bg-primary-container/30 transition-all duration-300" style="height: 70%"></div>
                        <p class="text-label-sm opacity-60">Mar</p>
                    </div>
                    <div class="flex-1 min-w-[56px] flex flex-col items-center gap-3" data-value="60">
                        <div class="chart-bar w-full rounded-t-lg bg-primary-container/30 transition-all duration-300" style="height: 60%"></div>
                        <p class="text-label-sm opacity-60">Apr</p>
                    </div>
                    <div class="flex-1 min-w-[56px] flex flex-col items-center gap-3" data-value="80">
                        <div class="chart-bar w-full rounded-t-lg bg-primary-container/30 transition-all duration-300" style="height: 80%"></div>
                        <p class="text-label-sm opacity-60">Mei</p>
                    </div>
                    <div class="flex-1 min-w-[56px] flex flex-col items-center gap-3" data-value="75">
                        <div class="chart-bar w-full rounded-t-lg bg-primary-container/30 transition-all duration-300" style="height: 75%"></div>
                        <p class="text-label-sm opacity-60">Jun</p>
                    </div>
                </div>
            </div>
            <p id="chart-summary" class="text-label-sm text-on-surface-variant">Data untuk 6 bulan terakhir — volume tonase berdasarkan bulan.</p>
        </div>

        <div class="bento-card p-lg bg-primary text-on-primary">
            <div>
                <span class="inline-flex items-center rounded-full bg-on-primary/20 px-3 py-1 text-label-sm font-bold">Insight Mingguan</span>
                <h2 class="mt-4 font-title-lg text-title-lg font-bold">Kondisi Panen</h2>
                <p class="mt-3 text-body-md leading-relaxed text-on-primary/80">Produktivitas meningkat 18% karena dukungan distribusi dan cuaca yang stabil di wilayah Kluwih Selatan.</p>
            </div>
            <button class="mt-6 w-full rounded-2xl border border-on-primary/30 bg-on-primary/10 px-lg py-3 font-bold transition hover:bg-on-primary/20">Lihat Detail Analitik</button>
        </div>
    </div>

    <div class="bento-card overflow-hidden">
        <div class="border-b border-outline-variant px-lg py-lg">
            <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
                <div>
                    <h2 class="font-title-lg text-title-lg font-bold">Riwayat Laporan</h2>
                    <p class="text-on-surface-variant text-body-md">Lihat dan kelola laporan jagung dengan mudah di perangkat apapun.</p>
                </div>
                <div class="flex flex-col gap-3 sm:flex-row sm:items-center">
                    <div class="relative w-full sm:w-72">
                        <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-outline">search</span>
                        <input data-search-target="reports" type="text" placeholder="Cari laporan..."
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
                        <span class="font-label-sm text-label-sm text-on-surface-variant">Jenis Laporan</span>
                        <select class="rounded-xl border border-outline-variant bg-white px-4 py-2 focus:ring-2 focus:ring-primary">
                            <option>Semua Laporan</option>
                            <option>Bulanan</option>
                            <option>Mingguan</option>
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
                        <th class="px-lg py-md font-semibold">Jenis</th>
                        <th class="px-lg py-md font-semibold">Tonase</th>
                        <th class="px-lg py-md font-semibold">Harga</th>
                        <th class="px-lg py-md font-semibold">Status</th>
                        <th class="px-lg py-md font-semibold text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-outline-variant" data-table="reports">
                    <tr class="hover:bg-surface-variant transition-colors">
                        <td class="px-lg py-md">24 Mei 2024</td>
                        <td class="px-lg py-md">Bulanan</td>
                        <td class="px-lg py-md font-bold text-on-background">842 Ton</td>
                        <td class="px-lg py-md font-bold text-primary">Rp 5.200</td>
                        <td class="px-lg py-md">
                            <span class="inline-flex items-center px-sm py-1 rounded-full bg-primary/10 text-primary text-[12px] font-bold">Selesai</span>
                        </td>
                        <td class="px-lg py-md text-center">
                            <div class="inline-flex items-center justify-center gap-sm">
                                <button class="p-xs hover:bg-surface-container-high rounded text-primary"><span class="material-symbols-outlined">download</span></button>
                                <button class="p-xs hover:bg-surface-container-high rounded text-primary"><span class="material-symbols-outlined">visibility</span></button>
                            </div>
                        </td>
                    </tr>
                    <tr class="hover:bg-surface-variant transition-colors">
                        <td class="px-lg py-md">17 Mei 2024</td>
                        <td class="px-lg py-md">Mingguan</td>
                        <td class="px-lg py-md font-bold text-on-background">210 Ton</td>
                        <td class="px-lg py-md font-bold text-primary">Rp 5.450</td>
                        <td class="px-lg py-md">
                            <span class="inline-flex items-center px-sm py-1 rounded-full bg-tertiary-fixed/10 text-tertiary text-[12px] font-bold">Proses</span>
                        </td>
                        <td class="px-lg py-md text-center">
                            <div class="inline-flex items-center justify-center gap-sm">
                                <button class="p-xs text-on-surface-variant opacity-50 rounded"><span class="material-symbols-outlined">download</span></button>
                                <button class="p-xs hover:bg-surface-container-high rounded text-primary"><span class="material-symbols-outlined">visibility</span></button>
                            </div>
                        </td>
                    </tr>
                    <tr class="hover:bg-surface-variant transition-colors">
                        <td class="px-lg py-md">10 Mei 2024</td>
                        <td class="px-lg py-md">Mingguan</td>
                        <td class="px-lg py-md font-bold text-on-background">185 Ton</td>
                        <td class="px-lg py-md font-bold text-primary">Rp 5.380</td>
                        <td class="px-lg py-md">
                            <span class="inline-flex items-center px-sm py-1 rounded-full bg-primary/10 text-primary text-[12px] font-bold">Selesai</span>
                        </td>
                        <td class="px-lg py-md text-center">
                            <div class="inline-flex items-center justify-center gap-sm">
                                <button class="p-xs hover:bg-surface-container-high rounded text-primary"><span class="material-symbols-outlined">download</span></button>
                                <button class="p-xs hover:bg-surface-container-high rounded text-primary"><span class="material-symbols-outlined">visibility</span></button>
                            </div>
                        </td>
                    </tr>
                    <tr class="hover:bg-surface-variant transition-colors">
                        <td class="px-lg py-md">03 Mei 2024</td>
                        <td class="px-lg py-md">Mingguan</td>
                        <td class="px-lg py-md font-bold text-on-background">198 Ton</td>
                        <td class="px-lg py-md font-bold text-primary">Rp 5.500</td>
                        <td class="px-lg py-md">
                            <span class="inline-flex items-center px-sm py-1 rounded-full bg-primary/10 text-primary text-[12px] font-bold">Selesai</span>
                        </td>
                        <td class="px-lg py-md text-center">
                            <div class="inline-flex items-center justify-center gap-sm">
                                <button class="p-xs hover:bg-surface-container-high rounded text-primary"><span class="material-symbols-outlined">download</span></button>
                                <button class="p-xs hover:bg-surface-container-high rounded text-primary"><span class="material-symbols-outlined">visibility</span></button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="md:hidden divide-y divide-outline-variant" data-card="reports">
            <div class="transaction-card space-y-md rounded-[1.25rem] border border-outline-variant bg-surface-container-lowest p-lg">
                <div class="flex items-start justify-between gap-4">
                    <div>
                        <p class="font-bold text-body-md">24 Mei 2024</p>
                        <p class="text-label-sm text-on-surface-variant">Bulanan • Selesai</p>
                    </div>
                    <span class="rounded-full bg-primary/10 px-3 py-1 text-label-sm font-bold text-primary">842 Ton</span>
                </div>
                <div class="grid grid-cols-2 gap-sm text-label-sm">
                    <div class="rounded-xl bg-surface-container-low px-3 py-3">
                        <p class="text-on-surface-variant">Harga</p>
                        <p class="font-bold">Rp 5.200</p>
                    </div>
                    <div class="rounded-xl bg-surface-container-low px-3 py-3">
                        <p class="text-on-surface-variant">Status</p>
                        <p class="font-bold">Selesai</p>
                    </div>
                </div>
                <div class="flex flex-wrap justify-end gap-3 pt-sm">
                    <button class="inline-flex items-center gap-xs text-primary font-bold"><span class="material-symbols-outlined text-sm">download</span> Unduh</button>
                    <button class="inline-flex items-center gap-xs text-primary font-bold"><span class="material-symbols-outlined text-sm">visibility</span> Lihat</button>
                </div>
            </div>
        </div>
    </div>

    <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
        <p class="text-label-md text-on-surface-variant">Menampilkan 4 dari 1,284 laporan</p>
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
    document.querySelectorAll('input[data-search-target="reports"]').forEach(search => {
        search.addEventListener('input', event => {
            const value = event.target.value.toLowerCase();
            document.querySelectorAll('[data-table="reports"] tbody tr, [data-card="reports"] .transaction-card').forEach(item => {
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

    const yearRange = document.getElementById('year-range');
    const chartSummary = document.getElementById('chart-summary');
    const chartBars = document.querySelectorAll('.chart-bar');

    if (yearRange && chartSummary) {
        yearRange.addEventListener('change', event => {
            chartSummary.textContent = `Data untuk ${event.target.value} — volume tonase berdasarkan bulan.`;
        });
    }

    chartBars.forEach(bar => {
        const parent = bar.closest('[data-value]');
        if (!parent) return;
        const value = parent.getAttribute('data-value');
        parent.addEventListener('mouseenter', () => {
            bar.classList.add('bg-primary-container');
            chartSummary.textContent = `${parent.querySelector('p').innerText}: ${value}% dari target.`;
        });
        parent.addEventListener('mouseleave', () => {
            bar.classList.remove('bg-primary-container');
            if (yearRange && chartSummary) {
                chartSummary.textContent = `Data untuk ${yearRange.value} — volume tonase berdasarkan bulan.`;
            }
        });
    });
</script>
@endpush
