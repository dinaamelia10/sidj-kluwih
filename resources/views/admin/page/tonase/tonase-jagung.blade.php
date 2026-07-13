@extends('admin.layout.master')

@section('content')
<div class="space-y-lg">
    <div class="flex flex-col gap-4 md:flex-row md:items-end md:justify-between">
        <div>
            <nav class="flex flex-wrap items-center gap-2 text-on-surface-variant font-label-sm text-label-sm mb-2">
                <a class="hover:text-primary" href="#">Dashboard</a>
                <span class="material-symbols-outlined text-[14px]">chevron_right</span>
                <span class="text-primary font-bold">Tonase</span>
            </nav>
            <h1 class="font-headline-lg text-headline-lg font-extrabold text-on-surface">Data Tonase Jagung</h1>
            <p class="text-on-surface-variant font-body-md text-body-md mt-2">Pantau pencapaian dan performa tonase jagung secara real-time dengan tampilan yang responsif di desktop dan mobile.</p>
        </div>
        <button class="inline-flex items-center gap-sm rounded-2xl bg-primary-container px-lg py-3 text-on-primary-container font-bold transition hover:bg-primary active:scale-95 shadow-md">
            <span class="material-symbols-outlined">add_circle</span>
            Tambah Data Baru
        </button>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-lg">
        <div class="bento-card p-lg flex flex-col justify-between relative overflow-hidden group">
            <div class="flex items-start justify-between gap-4">
                <div>
                    <p class="font-label-md text-label-md text-on-surface-variant">Tonase Hari Ini</p>
                    <h2 class="font-display text-[32px] font-bold text-primary">4.2 <span class="text-title-lg">MT</span></h2>
                </div>
                <div class="w-12 h-12 rounded-full bg-secondary-container flex items-center justify-center text-on-secondary-container">
                    <span class="material-symbols-outlined">today</span>
                </div>
            </div>
            <div class="mt-md inline-flex items-center gap-xs text-primary font-bold text-label-sm">
                <span class="material-symbols-outlined text-sm">trending_up</span>
                +12% dari kemarin
            </div>
        </div>
        <div class="bento-card p-lg flex flex-col justify-between relative overflow-hidden group">
            <div class="flex items-start justify-between gap-4">
                <div>
                    <p class="font-label-md text-label-md text-on-surface-variant">Tonase Bulan Ini</p>
                    <h2 class="font-display text-[32px] font-bold text-primary">125.8 <span class="text-title-lg">MT</span></h2>
                </div>
                <div class="w-12 h-12 rounded-full bg-tertiary-fixed flex items-center justify-center text-on-tertiary-fixed">
                    <span class="material-symbols-outlined">calendar_month</span>
                </div>
            </div>
            <div class="mt-md inline-flex items-center gap-xs text-error font-bold text-label-sm">
                <span class="material-symbols-outlined text-sm">trending_down</span>
                -3.5% dari bulan lalu
            </div>
        </div>
        <div class="bento-card p-lg flex flex-col justify-between relative overflow-hidden group">
            <div class="flex items-start justify-between gap-4">
                <div>
                    <p class="font-label-md text-label-md text-on-surface-variant">Tonase Tahun Ini</p>
                    <h2 class="font-display text-[32px] font-bold text-primary">1,240 <span class="text-title-lg">MT</span></h2>
                </div>
                <div class="w-12 h-12 rounded-full bg-primary-fixed flex items-center justify-center text-on-primary-fixed">
                    <span class="material-symbols-outlined">analytics</span>
                </div>
            </div>
            <div class="mt-md inline-flex items-center gap-xs text-primary font-bold text-label-sm">
                <span class="material-symbols-outlined text-sm">verified</span>
                Target: 1,500 MT
            </div>
        </div>
    </div>

    <div class="bento-card p-lg space-y-lg">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <div class="flex flex-col gap-3">
                <h2 class="font-title-lg text-title-lg font-bold">Tren Tonase Mingguan</h2>
                <span class="inline-flex items-center rounded-full bg-tertiary-fixed px-3 py-1 text-label-sm font-bold text-on-tertiary-fixed">Kualitas: Premium</span>
            </div>
            <div class="flex items-center gap-3">
                <label for="trend-range" class="sr-only">Pilih rentang waktu</label>
                <select id="trend-range" class="rounded-xl border border-outline-variant bg-surface-container-low px-4 py-2 text-label-md focus:ring-2 focus:ring-primary">
                    <option>7 Hari Terakhir</option>
                    <option>30 Hari Terakhir</option>
                    <option>Tahun Ini</option>
                </select>
            </div>
        </div>
        <div class="overflow-x-auto hide-scrollbar">
            <div class="h-64 min-w-full flex items-end gap-3 pt-4 px-1">
                <div class="flex-1 min-w-[56px] flex flex-col items-center gap-3" data-value="40">
                    <div class="chart-bar w-full rounded-t-lg bg-secondary-container/40 transition-all duration-300" style="height: 40%"></div>
                    <p class="text-label-sm text-label-sm opacity-60">Sen</p>
                </div>
                <div class="flex-1 min-w-[56px] flex flex-col items-center gap-3" data-value="65">
                    <div class="chart-bar w-full rounded-t-lg bg-secondary-container/40 transition-all duration-300" style="height: 65%"></div>
                    <p class="text-label-sm text-label-sm opacity-60">Sel</p>
                </div>
                <div class="flex-1 min-w-[56px] flex flex-col items-center gap-3" data-value="55">
                    <div class="chart-bar w-full rounded-t-lg bg-secondary-container/40 transition-all duration-300" style="height: 55%"></div>
                    <p class="text-label-sm text-label-sm opacity-60">Rab</p>
                </div>
                <div class="flex-1 min-w-[56px] flex flex-col items-center gap-3" data-value="85">
                    <div class="chart-bar w-full rounded-t-lg bg-secondary-container/40 transition-all duration-300" style="height: 85%"></div>
                    <p class="text-label-sm text-label-sm opacity-60">Kam</p>
                </div>
                <div class="flex-1 min-w-[56px] flex flex-col items-center gap-3" data-value="95">
                    <div class="chart-bar w-full rounded-t-lg bg-secondary-container/40 transition-all duration-300" style="height: 95%"></div>
                    <p class="text-label-sm text-label-sm opacity-60">Jum</p>
                </div>
                <div class="flex-1 min-w-[56px] flex flex-col items-center gap-3" data-value="45">
                    <div class="chart-bar w-full rounded-t-lg bg-secondary-container/40 transition-all duration-300" style="height: 45%"></div>
                    <p class="text-label-sm text-label-sm opacity-60">Sab</p>
                </div>
                <div class="flex-1 min-w-[56px] flex flex-col items-center gap-3" data-value="30">
                    <div class="chart-bar w-full rounded-t-lg bg-secondary-container/40 transition-all duration-300" style="height: 30%"></div>
                    <p class="text-label-sm text-label-sm opacity-60">Min</p>
                </div>
            </div>
        </div>
        <p id="chart-summary" class="text-label-sm text-on-surface-variant">Data untuk 7 Hari Terakhir — volume tonase dibandingkan tren.</p>
    </div>

    <div class="bento-card overflow-hidden">
        <div class="border-b border-outline-variant px-lg py-lg">
            <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
                <h2 class="font-title-lg text-title-lg font-bold">Rincian Transaksi Tonase</h2>
                <div class="flex flex-col gap-3 sm:flex-row sm:items-center">
                    <div class="relative w-full sm:w-72">
                        <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-outline">search</span>
                        <input data-search-target="transactions" type="text" placeholder="Cari transaksi..."
                            class="w-full rounded-xl border border-outline-variant bg-surface px-10 py-2 text-label-md focus:border-transparent focus:ring-2 focus:ring-primary" />
                    </div>
                    <button id="toggle-filter" type="button"
                        class="inline-flex items-center gap-sm rounded-xl border border-outline-variant bg-surface px-lg py-2 text-label-md font-bold transition hover:bg-surface-variant"
                        aria-expanded="false" aria-controls="filter-panel">
                        <span class="material-symbols-outlined">filter_list</span>
                        Filter
                    </button>
                </div>
            </div>
            <div id="filter-panel" class="mt-4 hidden rounded-3xl border border-outline-variant bg-surface-container-lowest p-lg">
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
                            class="rounded-xl border border-outline-variant bg-surface px-lg py-2 font-bold transition hover:bg-surface-variant">Reset</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="hidden md:block overflow-x-auto">
            <table class="w-full text-left min-w-[720px]">
                <thead class="bg-surface-container-low text-on-surface-variant font-label-md text-label-md uppercase tracking-wider">
                    <tr>
                        <th class="px-lg py-md font-semibold">Tanggal</th>
                        <th class="px-lg py-md font-semibold">Nama Petani</th>
                        <th class="px-lg py-md font-semibold">Varietas</th>
                        <th class="px-lg py-md font-semibold text-right">Berat Kotor (MT)</th>
                        <th class="px-lg py-md font-semibold text-center">Kadar Air (%)</th>
                        <th class="px-lg py-md font-semibold text-right">Tonase Bersih (MT)</th>
                        <th class="px-lg py-md font-semibold text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-outline-variant" data-table="transactions">
                    <tr class="hover:bg-surface-variant transition-colors group">
                        <td class="px-lg py-md font-body-md text-body-md">24 Okt 2023</td>
                        <td class="px-lg py-md">
                            <div class="flex items-center gap-sm">
                                <div class="w-8 h-8 rounded-full bg-secondary-container text-on-secondary-container flex items-center justify-center font-bold text-xs">AS</div>
                                <span class="font-bold text-body-md">Agus Santoso</span>
                            </div>
                        </td>
                        <td class="px-lg py-md font-body-md text-body-md">Pioneer P35</td>
                        <td class="px-lg py-md font-body-md text-body-md text-right">2.500</td>
                        <td class="px-lg py-md text-center">
                            <span class="rounded-full bg-tertiary-fixed px-3 py-1 text-label-sm font-bold text-on-tertiary-fixed">14.2%</span>
                        </td>
                        <td class="px-lg py-md font-bold text-body-md text-right text-primary">2.410</td>
                        <td class="px-lg py-md">
                            <div class="flex justify-center gap-sm">
                                <button class="p-xs text-on-surface hover:text-primary transition-colors"><span class="material-symbols-outlined">edit</span></button>
                                <button class="p-xs text-error hover:text-error-container transition-colors"><span class="material-symbols-outlined">delete</span></button>
                            </div>
                        </td>
                    </tr>
                    <tr class="hover:bg-surface-variant transition-colors group">
                        <td class="px-lg py-md font-body-md text-body-md">24 Okt 2023</td>
                        <td class="px-lg py-md">
                            <div class="flex items-center gap-sm">
                                <div class="w-8 h-8 rounded-full bg-primary-fixed text-on-primary-fixed flex items-center justify-center font-bold text-xs">SW</div>
                                <span class="font-bold text-body-md">Siti Wahyuni</span>
                            </div>
                        </td>
                        <td class="px-lg py-md font-body-md text-body-md">NK Sumo</td>
                        <td class="px-lg py-md font-body-md text-body-md text-right">1.850</td>
                        <td class="px-lg py-md text-center">
                            <span class="rounded-full bg-secondary-container px-3 py-1 text-label-sm font-bold text-on-secondary-container">12.5%</span>
                        </td>
                        <td class="px-lg py-md font-bold text-body-md text-right text-primary">1.820</td>
                        <td class="px-lg py-md">
                            <div class="flex justify-center gap-sm">
                                <button class="p-xs text-on-surface hover:text-primary transition-colors"><span class="material-symbols-outlined">edit</span></button>
                                <button class="p-xs text-error hover:text-error-container transition-colors"><span class="material-symbols-outlined">delete</span></button>
                            </div>
                        </td>
                    </tr>
                    <tr class="hover:bg-surface-variant transition-colors group">
                        <td class="px-lg py-md font-body-md text-body-md">23 Okt 2023</td>
                        <td class="px-lg py-md">
                            <div class="flex items-center gap-sm">
                                <div class="w-8 h-8 rounded-full bg-tertiary-fixed text-on-tertiary-fixed flex items-center justify-center font-bold text-xs">BT</div>
                                <span class="font-bold text-body-md">Bambang Tri</span>
                            </div>
                        </td>
                        <td class="px-lg py-md font-body-md text-body-md">Bisi 18</td>
                        <td class="px-lg py-md font-body-md text-body-md text-right">3.200</td>
                        <td class="px-lg py-md text-center">
                            <span class="rounded-full bg-error-container px-3 py-1 text-label-sm font-bold text-on-error-container">17.8%</span>
                        </td>
                        <td class="px-lg py-md font-bold text-body-md text-right text-primary">2.950</td>
                        <td class="px-lg py-md">
                            <div class="flex justify-center gap-sm">
                                <button class="p-xs text-on-surface hover:text-primary transition-colors"><span class="material-symbols-outlined">edit</span></button>
                                <button class="p-xs text-error hover:text-error-container transition-colors"><span class="material-symbols-outlined">delete</span></button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="md:hidden divide-y divide-outline-variant" data-card="transactions">
            <div class="transaction-card space-y-md rounded-[1.25rem] border border-outline-variant bg-surface-container-lowest p-lg">
                <div class="flex items-start justify-between gap-4">
                    <div class="flex items-center gap-sm">
                        <div class="w-10 h-10 rounded-full bg-secondary-container text-on-secondary-container flex items-center justify-center font-bold">AS</div>
                        <div>
                            <p class="font-bold text-body-md">Agus Santoso</p>
                            <p class="text-label-sm text-on-surface-variant">24 Okt 2023</p>
                        </div>
                    </div>
                    <span class="rounded-full bg-primary/10 px-3 py-1 text-label-sm font-bold text-primary">2.410 MT</span>
                </div>
                <div class="grid grid-cols-2 gap-sm text-label-sm">
                    <div class="rounded-xl bg-surface-container-low px-3 py-3">
                        <p class="text-on-surface-variant">Varietas</p>
                        <p class="font-bold">Pioneer P35</p>
                    </div>
                    <div class="rounded-xl bg-surface-container-low px-3 py-3">
                        <p class="text-on-surface-variant">Kadar Air</p>
                        <p class="font-bold">14.2%</p>
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
        <p class="text-label-md text-on-surface-variant">Menampilkan 1-10 dari 1,240 data</p>
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
    document.querySelectorAll('input[data-search-target="transactions"]').forEach(search => {
        search.addEventListener('input', event => {
            const value = event.target.value.toLowerCase();
            document.querySelectorAll('[data-table="transactions"] tbody tr, [data-card="transactions"] .transaction-card').forEach(item => {
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
    if (resetFilters) {
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

    const trendRange = document.getElementById('trend-range');
    const chartSummary = document.getElementById('chart-summary');
    const chartBars = document.querySelectorAll('.chart-bar');
    if (trendRange && chartSummary) {
        trendRange.addEventListener('change', event => {
            chartSummary.textContent = `Data untuk ${event.target.value} — volume tonase dibandingkan tren.`;
        });
    }

    chartBars.forEach(bar => {
        const parent = bar.closest('[data-value]');
        if (!parent) return;
        const value = parent.getAttribute('data-value');
        parent.addEventListener('mouseenter', () => {
            bar.classList.add('bg-primary-container');
            chartSummary.textContent = `${parent.querySelector('p').innerText}: ${value}% dari target mingguan.`;
        });
        parent.addEventListener('mouseleave', () => {
            bar.classList.remove('bg-primary-container');
            if (trendRange && chartSummary) {
                chartSummary.textContent = `Data untuk ${trendRange.value} — volume tonase dibandingkan tren.`;
            }
        });
    });
</script>
@endpush
