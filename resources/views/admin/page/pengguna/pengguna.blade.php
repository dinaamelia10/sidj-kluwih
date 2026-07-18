@extends('admin.layout.master')

@section('content')
    <!-- Header & Action -->
    <div class="flex flex-col md:flex-row md:items-end justify-between gap-md">
        <div>
            <h2 class="font-headline-lg text-headline-lg text-on-surface">Data Petani</h2>
            <p class="font-body-md text-body-md text-on-surface-variant">Kelola basis data mitra petani di wilayah Kluwih secara real-time.</p>
        </div>
        <button class="bg-primary-container text-white px-lg py-md rounded-xxl font-label-md flex items-center gap-2 hover:bg-primary transition-all shadow-md active:scale-95">
            <span class="material-symbols-outlined">person_add</span>
            Tambah Petani Baru
        </button>
    </div>
    <!-- Summary Bento Grid -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-lg">
        <!-- Card 1 -->
        <div class="bento-card p-lg rounded-xxl relative overflow-hidden group">
            <div class="flex flex-col">
                <span class="font-label-md text-label-md text-on-surface-variant mb-1">Total Petani Terdaftar</span>
                <span class="font-display text-display text-primary">1,284</span>
                <div class="mt-4 flex items-center gap-1 text-on-secondary-container bg-secondary-container/30 px-2 py-1 rounded-full w-fit">
                    <span class="material-symbols-outlined text-[16px]">trending_up</span>
                    <span class="font-label-sm text-label-sm">+12% dari bulan lalu</span>
                </div>
            </div>
            <div class="absolute top-lg right-lg w-10 h-10 rounded-full bg-secondary-container flex items-center justify-center text-primary">
                <span class="material-symbols-outlined">groups</span>
            </div>
        </div>
        <!-- Card 2 -->
        <div class="bento-card p-lg rounded-xxl relative overflow-hidden group">
            <div class="flex flex-col">
                <span class="font-label-md text-label-md text-on-surface-variant mb-1">Petani Aktif Bulan Ini</span>
                <span class="font-display text-display text-tertiary">942</span>
                <div class="mt-4 flex items-center gap-1 text-on-surface-variant bg-surface-container px-2 py-1 rounded-full w-fit">
                    <span class="material-symbols-outlined text-[16px]">sync</span>
                    <span class="font-label-sm text-label-sm">73.4% Aktivitas</span>
                </div>
            </div>
            <div class="absolute top-lg right-lg w-10 h-10 rounded-full bg-tertiary-fixed-dim flex items-center justify-center text-tertiary">
                <span class="material-symbols-outlined">monitoring</span>
            </div>
        </div>
        <!-- Card 3 -->
        <div class="bento-card p-lg rounded-xxl relative overflow-hidden group">
            <div class="flex flex-col">
                <span class="font-label-md text-label-md text-on-surface-variant mb-1">Wilayah Terluas</span>
                <span class="font-headline-md text-headline-md text-on-surface mt-1">Kluwih Selatan</span>
                <span class="font-body-md text-body-md text-on-surface-variant">420.5 Hektar</span>
            </div>
            <div class="absolute top-lg right-lg w-10 h-10 rounded-full bg-primary-fixed flex items-center justify-center text-primary">
                <span class="material-symbols-outlined">map</span>
            </div>
            <div class="mt-4 h-1.5 w-full bg-surface-container rounded-full overflow-hidden">
                <div class="h-full bg-primary-container w-[65%] rounded-full"></div>
            </div>
        </div>
    </div>
    <!-- Database Table Section -->
    <div class="bento-card rounded-xxl overflow-hidden bg-white">
        <!-- Filter Header -->
        <div class="p-lg border-b border-outline-variant flex flex-col lg:flex-row justify-between gap-lg items-center">
            <h3 class="font-title-lg text-title-lg text-on-surface">Database Petani</h3>
            <div class="flex flex-wrap items-center gap-md w-full lg:w-auto">
                <div class="flex-1 lg:flex-none">
                    <select class="w-full bg-surface-container-low border-outline-variant rounded-xl font-label-md py-2 px-4 focus:ring-primary focus:border-primary">
                        <option value="">Semua Wilayah</option>
                        <option>Kluwih Utara</option>
                        <option>Kluwih Selatan</option>
                        <option>Kluwih Barat</option>
                        <option>Kluwih Timur</option>
                    </select>
                </div>
                <div class="flex-1 lg:flex-none">
                    <select class="w-full bg-surface-container-low border-outline-variant rounded-xl font-label-md py-2 px-4 focus:ring-primary focus:border-primary">
                        <option value="">Semua Komoditas</option>
                        <option>Jagung Hibrida</option>
                        <option>Jagung Manis</option>
                        <option>Kedelai</option>
                    </select>
                </div>
                <button class="p-2 border border-outline-variant rounded-xl hover:bg-surface-container-low transition-colors">
                    <span class="material-symbols-outlined">tune</span>
                </button>
            </div>
        </div>
        <!-- Table Content -->
        <div class="overflow-x-auto w-full">
            <table class="w-full text-left border-collapse" style="min-width: 800px;">
                <thead class="bg-surface-container-low">
                    <tr>
                        <th class="px-lg py-4 font-label-md text-label-md text-on-surface-variant border-b border-outline-variant">ID Petani</th>
                        <th class="px-lg py-4 font-label-md text-label-md text-on-surface-variant border-b border-outline-variant">Nama Petani</th>
                        <th class="px-lg py-4 font-label-md text-label-md text-on-surface-variant border-b border-outline-variant">Lokasi/Wilayah</th>
                        <th class="px-lg py-4 font-label-md text-label-md text-on-surface-variant border-b border-outline-variant">Luas Lahan (Ha)</th>
                        <th class="px-lg py-4 font-label-md text-label-md text-on-surface-variant border-b border-outline-variant">Komoditas</th>
                        <th class="px-lg py-4 font-label-md text-label-md text-on-surface-variant border-b border-outline-variant text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-outline-variant">
                    <!-- Row 1 -->
                    <tr class="hover:bg-surface-container-low transition-colors group">
                        <td class="px-lg py-4 font-body-md text-body-md text-on-surface font-medium">PKL-001</td>
                        <td class="px-lg py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full bg-secondary-container flex items-center justify-center font-bold text-on-secondary-container">S</div>
                                <span class="font-body-md text-body-md text-on-surface">Sugeng Raharjo</span>
                            </div>
                        </td>
                        <td class="px-lg py-4 font-body-md text-body-md text-on-surface-variant">Kluwih Selatan</td>
                        <td class="px-lg py-4 font-body-md text-body-md text-on-surface">2.5 Ha</td>
                        <td class="px-lg py-4">
                            <span class="bg-primary-fixed text-on-primary-fixed-variant px-3 py-1 rounded-full font-label-sm text-label-sm whitespace-nowrap">Jagung Hibrida</span>
                        </td>
                        <td class="px-lg py-4 text-right flex items-center justify-end gap-3 whitespace-nowrap">
                            <button class="p-2 text-on-surface-variant hover:text-primary transition-colors"><span class="material-symbols-outlined">visibility</span></button>
                            <button class="p-2 text-on-surface-variant hover:text-tertiary transition-colors"><span class="material-symbols-outlined">edit</span></button>
                            <button class="p-2 text-on-surface-variant hover:text-error transition-colors"><span class="material-symbols-outlined">delete</span></button>
                        </td>
                    </tr>
                    <!-- Row 2 -->
                    <tr class="hover:bg-surface-container-low transition-colors group">
                        <td class="px-lg py-4 font-body-md text-body-md text-on-surface font-medium">PKL-002</td>
                        <td class="px-lg py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full bg-tertiary-fixed-dim flex items-center justify-center font-bold text-on-tertiary-fixed-variant">A</div>
                                <span class="font-body-md text-body-md text-on-surface">Aminah Wijaya</span>
                            </div>
                        </td>
                        <td class="px-lg py-4 font-body-md text-body-md text-on-surface-variant">Kluwih Utara</td>
                        <td class="px-lg py-4 font-body-md text-body-md text-on-surface">1.8 Ha</td>
                        <td class="px-lg py-4">
                            <span class="bg-tertiary-container text-on-tertiary-container px-3 py-1 rounded-full font-label-sm text-label-sm whitespace-nowrap">Jagung Manis</span>
                        </td>
                        <td class="px-lg py-4 text-right flex items-center justify-end gap-3 whitespace-nowrap">
                            <button class="p-2 text-on-surface-variant hover:text-primary transition-colors"><span class="material-symbols-outlined">visibility</span></button>
                            <button class="p-2 text-on-surface-variant hover:text-tertiary transition-colors"><span class="material-symbols-outlined">edit</span></button>
                            <button class="p-2 text-on-surface-variant hover:text-error transition-colors"><span class="material-symbols-outlined">delete</span></button>
                        </td>
                    </tr>
                    <!-- Row 3 -->
                    <tr class="hover:bg-surface-container-low transition-colors group">
                        <td class="px-lg py-4 font-body-md text-body-md text-on-surface font-medium">PKL-003</td>
                        <td class="px-lg py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full bg-primary-fixed flex items-center justify-center font-bold text-on-primary-fixed-variant">B</div>
                                <span class="font-body-md text-body-md text-on-surface">Bambang S.</span>
                            </div>
                        </td>
                        <td class="px-lg py-4 font-body-md text-body-md text-on-surface-variant">Kluwih Timur</td>
                        <td class="px-lg py-4 font-body-md text-body-md text-on-surface">4.2 Ha</td>
                        <td class="px-lg py-4">
                            <span class="bg-primary-fixed text-on-primary-fixed-variant px-3 py-1 rounded-full font-label-sm text-label-sm whitespace-nowrap">Jagung Hibrida</span>
                        </td>
                        <td class="px-lg py-4 text-right flex items-center justify-end gap-3 whitespace-nowrap">
                            <button class="p-2 text-on-surface-variant hover:text-primary transition-colors"><span class="material-symbols-outlined">visibility</span></button>
                            <button class="p-2 text-on-surface-variant hover:text-tertiary transition-colors"><span class="material-symbols-outlined">edit</span></button>
                            <button class="p-2 text-on-surface-variant hover:text-error transition-colors"><span class="material-symbols-outlined">delete</span></button>
                        </td>
                    </tr>
                    <!-- Row 4 -->
                    <tr class="hover:bg-surface-container-low transition-colors group">
                        <td class="px-lg py-4 font-body-md text-body-md text-on-surface font-medium">PKL-004</td>
                        <td class="px-lg py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full bg-surface-dim flex items-center justify-center font-bold text-on-surface">R</div>
                                <span class="font-body-md text-body-md text-on-surface">Ratna Sari</span>
                            </div>
                        </td>
                        <td class="px-lg py-4 font-body-md text-body-md text-on-surface-variant">Kluwih Barat</td>
                        <td class="px-lg py-4 font-body-md text-body-md text-on-surface">0.9 Ha</td>
                        <td class="px-lg py-4">
                            <span class="bg-outline-variant text-on-surface-variant px-3 py-1 rounded-full font-label-sm text-label-sm whitespace-nowrap">Kedelai</span>
                        </td>
                        <td class="px-lg py-4 text-right flex items-center justify-end gap-3 whitespace-nowrap">
                            <button class="p-2 text-on-surface-variant hover:text-primary transition-colors"><span class="material-symbols-outlined">visibility</span></button>
                            <button class="p-2 text-on-surface-variant hover:text-tertiary transition-colors"><span class="material-symbols-outlined">edit</span></button>
                            <button class="p-2 text-on-surface-variant hover:text-error transition-colors"><span class="material-symbols-outlined">delete</span></button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <!-- Pagination -->
        <div class="p-lg flex items-center justify-between border-t border-outline-variant">
            <span class="font-label-md text-label-md text-on-surface-variant">Menampilkan 1-4 dari 1,284 petani</span>
            <div class="flex items-center gap-sm">
                <button class="p-2 border border-outline-variant rounded-lg hover:bg-surface-container transition-colors disabled:opacity-50" disabled="">
                    <span class="material-symbols-outlined">chevron_left</span>
                </button>
                <button class="w-10 h-10 bg-primary-container text-white rounded-lg font-bold font-label-md">1</button>
                <button class="w-10 h-10 border border-outline-variant rounded-lg font-label-md hover:bg-surface-container transition-all">2</button>
                <button class="w-10 h-10 border border-outline-variant rounded-lg font-label-md hover:bg-surface-container transition-all">3</button>
                <button class="p-2 border border-outline-variant rounded-lg hover:bg-surface-container transition-colors">
                    <span class="material-symbols-outlined">chevron_right</span>
                </button>
            </div>
        </div>
    </div>
    <!-- Visualization Overlay (Agro-Modernist Detail) -->
@endsection
