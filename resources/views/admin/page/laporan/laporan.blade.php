@extends('admin.layout.master')

@section('content')
<!-- Filter & Action Section -->
<div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-md bg-white p-md rounded-2xl shadow-sm border border-outline-variant/20">
    <div class="flex flex-wrap items-center gap-sm w-full md:w-auto">
        <div class="flex flex-col gap-1 w-full sm:w-auto">
            <label class="text-[10px] font-bold text-on-surface-variant uppercase tracking-widest pl-1">Filter Tanggal</label>
            <div class="flex items-center gap-2 bg-surface-container-low px-4 py-2 rounded-lg border border-outline-variant/30">
                <span class="material-symbols-outlined text-sm text-on-surface-variant">calendar_today</span>
                <input class="bg-transparent border-none p-0 text-sm focus:ring-0 w-full sm:w-48 font-medium" type="text" value="01 Jan 2026 - 31 Jan 2026">
            </div>
        </div>
    </div>
    <!-- Ditambahkan no-scrollbar & overflow-x-auto agar tombol bisa digeser di mobile -->
    <div class="flex items-center gap-sm w-full md:w-auto overflow-x-auto no-scrollbar pb-1 md:pb-0 pt-2 md:pt-0">
        <button class="flex items-center gap-2 px-4 py-2 bg-primary text-on-primary font-semibold rounded-xl hover:bg-primary/90 transition-all whitespace-nowrap active:scale-95">
            <span class="material-symbols-outlined text-lg">add</span>
            <span class="text-sm">Tambah Laporan Baru</span>
        </button>
        <button class="flex items-center gap-2 px-4 py-2 bg-surface-container-high hover:bg-surface-container-highest text-primary font-semibold rounded-xl transition-all whitespace-nowrap active:scale-95">
            <span class="material-symbols-outlined text-lg">print</span>
            <span class="text-sm">Cetak</span>
        </button>
        <button class="flex items-center gap-2 px-4 py-2 bg-error-container text-on-error-container font-semibold rounded-xl hover:bg-error/10 transition-all whitespace-nowrap active:scale-95">
            <span class="material-symbols-outlined text-lg">picture_as_pdf</span>
            <span class="text-sm">Ekspor PDF</span>
        </button>
        <button class="flex items-center gap-2 px-4 py-2 bg-secondary-container text-on-secondary-container font-semibold rounded-xl hover:bg-secondary/10 transition-all whitespace-nowrap active:scale-95">
            <span class="material-symbols-outlined text-lg">description</span>
            <span class="text-sm">Ekspor Excel</span>
        </button>
    </div>
</div>

<!-- Summary Cards -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-lg">
    <!-- Card 1 -->
    <div class="bg-white p-lg rounded-2xl shadow-sm border border-outline-variant/20 relative overflow-hidden group hover:shadow-md transition-shadow">
        <div class="flex justify-between items-start mb-md">
            <div>
                <p class="text-sm font-medium text-on-surface-variant mb-1">Total Laporan Dibuat</p>
                <h3 class="text-3xl font-bold text-on-background">1,284</h3>
            </div>
            <div class="w-12 h-12 rounded-full bg-secondary-container/30 flex items-center justify-center text-primary">
                <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">analytics</span>
            </div>
        </div>
        <div class="flex items-center gap-1 text-primary text-xs font-bold">
            <span class="material-symbols-outlined text-sm">trending_up</span>
            <span>+12% dari bulan lalu</span>
        </div>
    </div>
    <!-- Card 2 -->
    <div class="bg-white p-lg rounded-2xl shadow-sm border border-outline-variant/20 relative overflow-hidden group hover:shadow-md transition-shadow">
        <div class="flex justify-between items-start mb-md">
            <div>
                <p class="text-sm font-medium text-on-surface-variant mb-1">Total Tonase Terlapor</p>
                <h3 class="text-3xl font-bold text-on-background">4,850 <span class="text-lg font-medium text-on-surface-variant">Ton</span></h3>
            </div>
            <div class="w-12 h-12 rounded-full bg-tertiary-fixed/30 flex items-center justify-center text-tertiary">
                <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">weight</span>
            </div>
        </div>
        <div class="flex items-center gap-1 text-primary text-xs font-bold">
            <span class="material-symbols-outlined text-sm">trending_up</span>
            <span>+5.2k Ton Estimasi Akhir</span>
        </div>
    </div>
    <!-- Card 3 -->
    <div class="bg-white p-lg rounded-2xl shadow-sm border border-outline-variant/20 relative overflow-hidden group hover:shadow-md transition-shadow">
        <div class="flex justify-between items-start mb-md">
            <div>
                <p class="text-sm font-medium text-on-surface-variant mb-1">Rata-rata Harga</p>
                <h3 class="text-3xl font-bold text-on-background">Rp 5,420 <span class="text-lg font-medium text-on-surface-variant">/kg</span></h3>
            </div>
            <div class="w-12 h-12 rounded-full bg-primary-fixed/30 flex items-center justify-center text-primary">
                <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">payments</span>
            </div>
        </div>
        <div class="flex items-center gap-1 text-error text-xs font-bold">
            <span class="material-symbols-outlined text-sm">trending_down</span>
            <span>-2.1% Fluktuasi Pasar</span>
        </div>
    </div>
</div>

<!-- Bento Visualization -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-lg">
    <!-- Main Chart -->
    <div class="lg:col-span-2 bg-white p-lg rounded-2xl shadow-sm border border-outline-variant/20">
        <div class="flex items-center justify-between mb-xl">
            <div>
                <h4 class="font-title-lg text-title-lg text-on-background">Tren Produktivitas Bulanan</h4>
                <p class="text-sm text-on-surface-variant">Analisis tonase jagung periode Januari - Juni 2026</p>
            </div>
            <select class="text-sm border-outline-variant/30 rounded-lg bg-surface-container-low px-4 focus:ring-primary/20">
                <option>Tahun 2026</option>
                <option>Tahun 2025</option>
            </select>
        </div>
        <!-- Area Chart Graphic -->
        <div class="h-64 relative flex items-end justify-between gap-4 px-4 border-b border-outline-variant/20 mb-8">
            <div class="absolute inset-0 grid grid-rows-4 pointer-events-none">
                <div class="border-t border-dashed border-outline-variant/20"></div>
                <div class="border-t border-dashed border-outline-variant/20"></div>
                <div class="border-t border-dashed border-outline-variant/20"></div>
                <div class="border-t border-dashed border-outline-variant/20"></div>
            </div>
            <div class="relative w-full h-full">
                <svg class="w-full h-full overflow-visible" viewBox="0 0 800 200">
                    <defs>
                        <linearGradient id="chartGradient" x1="0" x2="0" y1="0" y2="1">
                            <stop offset="0%" stop-color="var(--primary)" stop-opacity="0.3"></stop>
                            <stop offset="100%" stop-color="var(--primary)" stop-opacity="0"></stop>
                        </linearGradient>
                    </defs>
                    <path class="text-primary" d="M0,180 Q100,140 200,160 T400,100 T600,120 T800,40 V200 H0 Z" fill="url(#chartGradient)" style="--primary: #2e7d32; stroke-dasharray: 1000; stroke-dashoffset: 0; transition: stroke-dashoffset 2s ease-in-out;"></path>
                    <path d="M0,180 Q100,140 200,160 T400,100 T600,120 T800,40" fill="none" stroke="#2e7d32" stroke-linecap="round" stroke-width="4"></path>
                    <circle cx="200" cy="160" fill="#2e7d32" r="6" stroke="white" stroke-width="2"></circle>
                    <circle cx="400" cy="100" fill="#2e7d32" r="6" stroke="white" stroke-width="2"></circle>
                    <circle cx="800" cy="40" fill="#2e7d32" r="6" stroke="white" stroke-width="2"></circle>
                </svg>
            </div>
        </div>
        <div class="flex justify-between px-2 text-xs text-on-surface-variant font-bold uppercase tracking-widest">
            <span>Jan</span><span>Feb</span><span>Mar</span><span>Apr</span><span>Mei</span><span>Jun</span>
        </div>
    </div>
    <!-- Side Info Card -->
    <div class="bg-primary p-lg rounded-2xl shadow-sm relative overflow-hidden flex flex-col justify-between">
        <div class="absolute -right-12 -top-12 w-48 h-48 bg-white/10 rounded-full blur-3xl"></div>
        <div class="relative z-10">
            <h4 class="text-white font-title-lg text-title-lg mb-2">Insight Mingguan</h4>
            <p class="text-white/80 text-sm leading-relaxed">Produktivitas meningkat 18% di wilayah Kluwih Selatan dikarenakan musim panen raya serentak.</p>
        </div>
        <div class="relative z-10 bg-white/10 backdrop-blur-md rounded-xl p-md mt-lg border border-white/20">
            <div class="flex items-center justify-between mb-2">
                <span class="text-xs text-white/70">Target Bulanan</span>
                <span class="text-xs font-bold text-white">82%</span>
            </div>
            <div class="w-full bg-white/20 rounded-full h-2 overflow-hidden">
                <div class="bg-secondary-fixed-dim h-full w-[82%] rounded-full shadow-lg"></div>
            </div>
        </div>
        <button class="relative z-10 w-full mt-lg py-3 bg-white text-primary font-bold rounded-xl hover:bg-secondary-container transition-colors text-sm">
            Lihat Detail Laporan
        </button>
    </div>
</div>

<!-- History Table -->
<div class="bg-white rounded-2xl shadow-sm border border-outline-variant/20 overflow-hidden mb-xl">
    <div class="px-lg py-md border-b border-outline-variant/20 flex justify-between items-center">
        <h4 class="font-title-lg text-title-lg text-on-background">Riwayat Laporan</h4>
        <button class="text-primary font-bold text-sm hover:underline">Lihat Semua</button>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-surface-container-low/50">
                    <th class="px-lg py-4 text-xs font-bold text-on-surface-variant uppercase tracking-widest">Tanggal Laporan</th>
                    <th class="px-lg py-4 text-xs font-bold text-on-surface-variant uppercase tracking-widest">Jenis Laporan</th>
                    <th class="px-lg py-4 text-xs font-bold text-on-surface-variant uppercase tracking-widest">Total Tonase</th>
                    <th class="px-lg py-4 text-xs font-bold text-on-surface-variant uppercase tracking-widest">Rata-rata Harga</th>
                    <th class="px-lg py-4 text-xs font-bold text-on-surface-variant uppercase tracking-widest">Status</th>
                    <th class="px-lg py-4 text-xs font-bold text-on-surface-variant uppercase tracking-widest text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-outline-variant/10">
                <!-- Row 1 -->
                <tr class="hover:bg-surface-container-low/30 transition-colors group">
                    <td class="px-lg py-4">
                        <div class="flex flex-col">
                            <span class="font-semibold text-on-background">24 Mei 2026</span>
                            <span class="text-[10px] text-on-surface-variant">14:32 WIB</span>
                        </div>
                    </td>
                    <td class="px-lg py-4">
                        <span class="px-3 py-1 bg-surface-container-high rounded-full text-xs font-bold text-on-surface-variant">Bulanan</span>
                    </td>
                    <td class="px-lg py-4 font-semibold text-on-background">842 Ton</td>
                    <td class="px-lg py-4 font-semibold text-primary">Rp 5.200</td>
                    <td class="px-lg py-4">
                        <div class="flex items-center gap-2">
                            <div class="w-2 h-2 rounded-full bg-primary"></div>
                            <span class="text-xs font-bold text-primary">Selesai</span>
                        </div>
                    </td>
                    <td class="px-lg py-4 text-center">
                        <div class="flex justify-center items-center gap-2">
                            <button class="p-2 hover:bg-primary/10 rounded-lg text-primary transition-colors" title="Download">
                                <span class="material-symbols-outlined text-lg">download</span>
                            </button>
                            <button class="p-2 hover:bg-primary/10 rounded-lg text-primary transition-colors" title="Lihat">
                                <span class="material-symbols-outlined text-lg">visibility</span>
                            </button>
                        </div>
                    </td>
                </tr>
                <!-- Row 2 -->
                <tr class="hover:bg-surface-container-low/30 transition-colors group">
                    <td class="px-lg py-4">
                        <div class="flex flex-col">
                            <span class="font-semibold text-on-background">17 Mei 2026</span>
                            <span class="text-[10px] text-on-surface-variant">09:15 WIB</span>
                        </div>
                    </td>
                    <td class="px-lg py-4">
                        <span class="px-3 py-1 bg-surface-container-high rounded-full text-xs font-bold text-on-surface-variant">Mingguan</span>
                    </td>
                    <td class="px-lg py-4 font-semibold text-on-background">210 Ton</td>
                    <td class="px-lg py-4 font-semibold text-primary">Rp 5.450</td>
                    <td class="px-lg py-4">
                        <div class="flex items-center gap-2">
                            <div class="w-2 h-2 rounded-full bg-tertiary animate-pulse"></div>
                            <span class="text-xs font-bold text-tertiary">Proses</span>
                        </div>
                    </td>
                    <td class="px-lg py-4 text-center">
                        <div class="flex justify-center items-center gap-2">
                            <button class="p-2 text-on-surface-variant cursor-not-allowed opacity-50" disabled="">
                                <span class="material-symbols-outlined text-lg">download</span>
                            </button>
                            <button class="p-2 hover:bg-primary/10 rounded-lg text-primary transition-colors">
                                <span class="material-symbols-outlined text-lg">visibility</span>
                            </button>
                        </div>
                    </td>
                </tr>
                <!-- Row 3 -->
                <tr class="hover:bg-surface-container-low/30 transition-colors group">
                    <td class="px-lg py-4">
                        <div class="flex flex-col">
                            <span class="font-semibold text-on-background">10 Mei 2026</span>
                            <span class="text-[10px] text-on-surface-variant">16:45 WIB</span>
                        </div>
                    </td>
                    <td class="px-lg py-4">
                        <span class="px-3 py-1 bg-surface-container-high rounded-full text-xs font-bold text-on-surface-variant">Mingguan</span>
                    </td>
                    <td class="px-lg py-4 font-semibold text-on-background">185 Ton</td>
                    <td class="px-lg py-4 font-semibold text-primary">Rp 5.380</td>
                    <td class="px-lg py-4">
                        <div class="flex items-center gap-2">
                            <div class="w-2 h-2 rounded-full bg-primary"></div>
                            <span class="text-xs font-bold text-primary">Selesai</span>
                        </div>
                    </td>
                    <td class="px-lg py-4 text-center">
                        <div class="flex justify-center items-center gap-2">
                            <button class="p-2 hover:bg-primary/10 rounded-lg text-primary transition-colors">
                                <span class="material-symbols-outlined text-lg">download</span>
                            </button>
                            <button class="p-2 hover:bg-primary/10 rounded-lg text-primary transition-colors">
                                <span class="material-symbols-outlined text-lg">visibility</span>
                            </button>
                        </div>
                    </td>
                </tr>
                <!-- Row 4 -->
                <tr class="hover:bg-surface-container-low/30 transition-colors group">
                    <td class="px-lg py-4">
                        <div class="flex flex-col">
                            <span class="font-semibold text-on-background">03 Mei 2026</span>
                            <span class="text-[10px] text-on-surface-variant">11:00 WIB</span>
                        </div>
                    </td>
                    <td class="px-lg py-4">
                        <span class="px-3 py-1 bg-surface-container-high rounded-full text-xs font-bold text-on-surface-variant">Mingguan</span>
                    </td>
                    <td class="px-lg py-4 font-semibold text-on-background">198 Ton</td>
                    <td class="px-lg py-4 font-semibold text-primary">Rp 5.500</td>
                    <td class="px-lg py-4">
                        <div class="flex items-center gap-2">
                            <div class="w-2 h-2 rounded-full bg-primary"></div>
                            <span class="text-xs font-bold text-primary">Selesai</span>
                        </div>
                    </td>
                    <td class="px-lg py-4 text-center">
                        <div class="flex justify-center items-center gap-2">
                            <button class="p-2 hover:bg-primary/10 rounded-lg text-primary transition-colors">
                                <span class="material-symbols-outlined text-lg">download</span>
                            </button>
                            <button class="p-2 hover:bg-primary/10 rounded-lg text-primary transition-colors">
                                <span class="material-symbols-outlined text-lg">visibility</span>
                            </button>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <!-- Pagination Footer -->
    <div class="px-lg py-4 bg-surface-container-low/30 border-t border-outline-variant/20 flex flex-col md:flex-row justify-between items-center gap-4">
        <p class="text-sm text-on-surface-variant font-medium">Menampilkan 1-4 dari 1,284 laporan</p>
        <div class="flex items-center gap-2">
            <button class="w-10 h-10 flex items-center justify-center border border-outline-variant/30 rounded-lg hover:bg-white transition-colors disabled:opacity-50" disabled="">
                <span class="material-symbols-outlined">chevron_left</span>
            </button>
            <button class="w-10 h-10 flex items-center justify-center bg-primary text-white rounded-lg font-bold">1</button>
            <button class="w-10 h-10 flex items-center justify-center border border-outline-variant/30 rounded-lg hover:bg-white transition-colors font-bold">2</button>
            <button class="w-10 h-10 flex items-center justify-center border border-outline-variant/30 rounded-lg hover:bg-white transition-colors font-bold">3</button>
            <span class="px-2">...</span>
            <button class="w-10 h-10 flex items-center justify-center border border-outline-variant/30 rounded-lg hover:bg-white transition-colors font-bold">321</button>
            <button class="w-10 h-10 flex items-center justify-center border border-outline-variant/30 rounded-lg hover:bg-white transition-colors">
                <span class="material-symbols-outlined">chevron_right</span>
            </button>
        </div>
    </div>
</div>

<!-- Floating Mobile FAB -->
<button class="md:hidden fixed bottom-24 right-6 w-14 h-14 bg-primary text-on-primary rounded-full shadow-xl flex items-center justify-center z-50 active:scale-90 transition-transform">
    <span class="material-symbols-outlined text-3xl">add</span>
</button>
@endsection

@push('styles')
<style>
    .chart-area-gradient { fill: url(#chartGradient); fill-opacity: 0.15; }
    /* Menghilangkan scrollbar default bawaan browser pada tombol filter mobile agar tetap clean */
    .no-scrollbar::-webkit-scrollbar { display: none; }
    .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const chartPath = document.querySelector('path.text-primary');
        if (chartPath) {
            chartPath.style.strokeDasharray = '1000';
            chartPath.style.strokeDashoffset = '1000';
            chartPath.style.transition = 'stroke-dashoffset 2s ease-in-out';
            setTimeout(() => {
                chartPath.style.strokeDashoffset = '0';
            }, 500);
        }
    });
</script>
@endpush