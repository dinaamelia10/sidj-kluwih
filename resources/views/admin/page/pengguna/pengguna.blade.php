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

    .transaction-card {
        background: #f8fbff;
    }
</style>
@endpush

@section('content')
<div class="space-y-lg">
    <div class="flex flex-col gap-4 md:flex-row md:items-end md:justify-between">
        <div>
            <nav class="flex flex-wrap items-center gap-2 text-on-surface-variant font-label-sm text-label-sm mb-2">
                <a class="hover:text-primary" href="#">Dashboard</a>
                <span class="material-symbols-outlined text-[14px]">chevron_right</span>
                <span class="text-primary font-bold">Pengguna</span>
            </nav>
            <h1 class="font-headline-lg text-headline-lg font-extrabold text-on-surface">Data Petani</h1>
            <p class="text-on-surface-variant font-body-md text-body-md mt-2">Kelola data petani dengan tampilan responsif yang konsisten di mobile dan laptop.</p>
        </div>
        <button class="inline-flex items-center gap-sm rounded-2xl bg-primary-container px-lg py-3 text-on-primary-container font-bold transition hover:bg-primary active:scale-95 shadow-md">
            <span class="material-symbols-outlined">person_add</span>
            Tambah Petani Baru
        </button>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-lg">
        <div class="bento-card p-lg">
            <p class="font-label-md text-label-md text-on-surface-variant">Total Petani Terdaftar</p>
            <h2 class="font-display text-[40px] font-bold text-primary">1.284</h2>
            <p class="mt-4 inline-flex items-center gap-xs text-secondary font-bold text-label-sm">
                <span class="material-symbols-outlined text-sm">trending_up</span>
                +12% dari bulan lalu
            </p>
        </div>
        <div class="bento-card p-lg">
            <p class="font-label-md text-label-md text-on-surface-variant">Petani Aktif Bulan Ini</p>
            <h2 class="font-display text-[40px] font-bold text-tertiary">942</h2>
            <p class="mt-4 text-label-sm text-on-surface-variant">73.4% aktivitas dari total mitra.</p>
        </div>
        <div class="bento-card p-lg">
            <p class="font-label-md text-label-md text-on-surface-variant">Wilayah Terluas</p>
            <h2 class="font-headline-md text-headline-md font-bold text-on-surface">Kluwih Selatan</h2>
            <p class="mt-4 text-label-sm text-on-surface-variant">420.5 hektar lahan terdaftar.</p>
        </div>
    </div>

    <div class="bento-card overflow-hidden">
        <div class="border-b border-outline-variant px-lg py-lg">
            <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
                <div>
                    <h2 class="font-title-lg text-title-lg font-bold">Database Petani</h2>
                    <p class="text-on-surface-variant text-body-md">Cari dan filter data petani untuk melihat detail wilayah, luas lahan, dan komoditas.</p>
                </div>
                <div class="flex flex-col gap-3 sm:flex-row sm:items-center">
                    <div class="relative w-full sm:w-72">
                        <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-outline">search</span>
                        <input data-search-target="farmers" type="text" placeholder="Cari nama petani..."
                               class="w-full rounded-2xl border border-outline-variant bg-surface px-10 py-2 text-label-md focus:border-transparent focus:ring-2 focus:ring-primary" />
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
                        <span class="font-label-sm text-label-sm text-on-surface-variant">Wilayah</span>
                        <select class="rounded-xl border border-outline-variant bg-white px-4 py-2 focus:ring-2 focus:ring-primary">
                            <option>Semua Wilayah</option>
                            <option>Kluwih Utara</option>
                            <option>Kluwih Selatan</option>
                            <option>Kluwih Barat</option>
                            <option>Kluwih Timur</option>
                        </select>
                    </label>
                    <label class="flex flex-col gap-2">
                        <span class="font-label-sm text-label-sm text-on-surface-variant">Komoditas</span>
                        <select class="rounded-xl border border-outline-variant bg-white px-4 py-2 focus:ring-2 focus:ring-primary">
                            <option>Semua Komoditas</option>
                            <option>Jagung Hibrida</option>
                            <option>Jagung Manis</option>
                            <option>Kedelai</option>
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
                        <th class="px-lg py-md font-semibold">ID Petani</th>
                        <th class="px-lg py-md font-semibold">Nama Petani</th>
                        <th class="px-lg py-md font-semibold">Wilayah</th>
                        <th class="px-lg py-md font-semibold">Luas Lahan</th>
                        <th class="px-lg py-md font-semibold">Komoditas</th>
                        <th class="px-lg py-md font-semibold text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-outline-variant" data-table="farmers">
                    <tr class="hover:bg-surface-variant transition-colors">
                        <td class="px-lg py-md font-body-md text-body-md text-on-surface font-medium">PKL-001</td>
                        <td class="px-lg py-md">
                            <div class="flex items-center gap-sm">
                                <div class="w-8 h-8 rounded-full bg-secondary-container text-on-secondary-container flex items-center justify-center font-bold text-xs">S</div>
                                <span class="font-bold text-body-md">Sugeng Raharjo</span>
                            </div>
                        </td>
                        <td class="px-lg py-md font-body-md text-body-md text-on-surface-variant">Kluwih Selatan</td>
                        <td class="px-lg py-md font-body-md text-body-md text-on-surface">2.5 Ha</td>
                        <td class="px-lg py-md">
                            <span class="rounded-full bg-primary-fixed text-on-primary-fixed-variant px-3 py-1 text-label-sm font-bold">Jagung Hibrida</span>
                        </td>
                        <td class="px-lg py-md text-right">
                            <div class="flex items-center justify-end gap-sm">
                                <button class="p-xs text-on-surface-variant hover:text-primary transition-colors"><span class="material-symbols-outlined">visibility</span></button>
                                <button class="p-xs text-on-surface-variant hover:text-tertiary transition-colors"><span class="material-symbols-outlined">edit</span></button>
                                <button class="p-xs text-on-surface-variant hover:text-error transition-colors"><span class="material-symbols-outlined">delete</span></button>
                            </div>
                        </td>
                    </tr>
                    <tr class="hover:bg-surface-variant transition-colors">
                        <td class="px-lg py-md font-body-md text-body-md text-on-surface font-medium">PKL-002</td>
                        <td class="px-lg py-md">
                            <div class="flex items-center gap-sm">
                                <div class="w-8 h-8 rounded-full bg-tertiary-fixed-dim text-on-tertiary-fixed flex items-center justify-center font-bold text-xs">A</div>
                                <span class="font-bold text-body-md">Aminah Wijaya</span>
                            </div>
                        </td>
                        <td class="px-lg py-md font-body-md text-body-md text-on-surface-variant">Kluwih Utara</td>
                        <td class="px-lg py-md font-body-md text-body-md text-on-surface">1.8 Ha</td>
                        <td class="px-lg py-md">
                            <span class="rounded-full bg-tertiary-container text-on-tertiary-container px-3 py-1 text-label-sm font-bold">Jagung Manis</span>
                        </td>
                        <td class="px-lg py-md text-right">
                            <div class="flex items-center justify-end gap-sm">
                                <button class="p-xs text-on-surface-variant hover:text-primary transition-colors"><span class="material-symbols-outlined">visibility</span></button>
                                <button class="p-xs text-on-surface-variant hover:text-tertiary transition-colors"><span class="material-symbols-outlined">edit</span></button>
                                <button class="p-xs text-on-surface-variant hover:text-error transition-colors"><span class="material-symbols-outlined">delete</span></button>
                            </div>
                        </td>
                    </tr>
                    <tr class="hover:bg-surface-variant transition-colors">
                        <td class="px-lg py-md font-body-md text-body-md text-on-surface font-medium">PKL-003</td>
                        <td class="px-lg py-md">
                            <div class="flex items-center gap-sm">
                                <div class="w-8 h-8 rounded-full bg-primary-fixed text-on-primary-fixed-variant flex items-center justify-center font-bold text-xs">B</div>
                                <span class="font-bold text-body-md">Bambang S.</span>
                            </div>
                        </td>
                        <td class="px-lg py-md font-body-md text-body-md text-on-surface-variant">Kluwih Timur</td>
                        <td class="px-lg py-md font-body-md text-body-md text-on-surface">4.2 Ha</td>
                        <td class="px-lg py-md">
                            <span class="rounded-full bg-primary-fixed text-on-primary-fixed-variant px-3 py-1 text-label-sm font-bold">Jagung Hibrida</span>
                        </td>
                        <td class="px-lg py-md text-right">
                            <div class="flex items-center justify-end gap-sm">
                                <button class="p-xs text-on-surface-variant hover:text-primary transition-colors"><span class="material-symbols-outlined">visibility</span></button>
                                <button class="p-xs text-on-surface-variant hover:text-tertiary transition-colors"><span class="material-symbols-outlined">edit</span></button>
                                <button class="p-xs text-on-surface-variant hover:text-error transition-colors"><span class="material-symbols-outlined">delete</span></button>
                            </div>
                        </td>
                    </tr>
                    <tr class="hover:bg-surface-variant transition-colors">
                        <td class="px-lg py-md font-body-md text-body-md text-on-surface font-medium">PKL-004</td>
                        <td class="px-lg py-md">
                            <div class="flex items-center gap-sm">
                                <div class="w-8 h-8 rounded-full bg-surface-dim flex items-center justify-center font-bold text-on-surface">R</div>
                                <span class="font-bold text-body-md">Ratna Sari</span>
                            </div>
                        </td>
                        <td class="px-lg py-md font-body-md text-body-md text-on-surface-variant">Kluwih Barat</td>
                        <td class="px-lg py-md font-body-md text-body-md text-on-surface">0.9 Ha</td>
                        <td class="px-lg py-md">
                            <span class="rounded-full bg-outline-variant text-on-surface-variant px-3 py-1 text-label-sm font-bold">Kedelai</span>
                        </td>
                        <td class="px-lg py-md text-right">
                            <div class="flex items-center justify-end gap-sm">
                                <button class="p-xs text-on-surface-variant hover:text-primary transition-colors"><span class="material-symbols-outlined">visibility</span></button>
                                <button class="p-xs text-on-surface-variant hover:text-tertiary transition-colors"><span class="material-symbols-outlined">edit</span></button>
                                <button class="p-xs text-on-surface-variant hover:text-error transition-colors"><span class="material-symbols-outlined">delete</span></button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="md:hidden divide-y divide-outline-variant" data-card="farmers">
            <div class="transaction-card space-y-md rounded-[1.25rem] border border-outline-variant bg-surface-container-lowest p-lg">
                <div class="flex items-start justify-between gap-4">
                    <div class="flex items-center gap-sm">
                        <div class="w-10 h-10 rounded-full bg-secondary-container text-on-secondary-container flex items-center justify-center font-bold">S</div>
                        <div>
                            <p class="font-bold text-body-md">Sugeng Raharjo</p>
                            <p class="text-label-sm text-on-surface-variant">Kluwih Selatan • Jagung Hibrida</p>
                        </div>
                    </div>
                    <span class="rounded-full bg-primary/10 px-3 py-1 text-label-sm font-bold text-primary">2.5 Ha</span>
                </div>
                <div class="flex flex-wrap justify-end gap-3 pt-sm">
                    <button class="inline-flex items-center gap-xs text-primary font-bold"><span class="material-symbols-outlined text-sm">visibility</span> Lihat</button>
                    <button class="inline-flex items-center gap-xs text-tertiary font-bold"><span class="material-symbols-outlined text-sm">edit</span> Edit</button>
                </div>
            </div>
        </div>

        <div class="p-lg flex flex-col gap-4 md:flex-row md:items-center md:justify-between border-t border-outline-variant">
            <span class="font-label-md text-label-md text-on-surface-variant">Menampilkan 1-4 dari 1.284 petani</span>
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
</div>
@endsection

@push('scripts')
<script>
    document.querySelectorAll('input[data-search-target="farmers"]').forEach(search => {
        search.addEventListener('input', event => {
            const value = event.target.value.toLowerCase();
            document.querySelectorAll('[data-table="farmers"] tbody tr, [data-card="farmers"] .transaction-card').forEach(item => {
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
</script>
@endpush
