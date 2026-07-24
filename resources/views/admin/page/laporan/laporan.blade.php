@extends('admin.layout.master')

@section('content')
<div class="space-y-lg">
    <!-- Page Header -->
    <div class="flex flex-col gap-4 md:flex-row md:items-end md:justify-between">
        <div>
            <nav class="flex flex-wrap items-center gap-2 text-on-surface-variant font-label-sm text-label-sm mb-2">
                <a class="hover:text-primary" href="{{ route('admin.dashboard') }}">Dashboard</a>
                <span class="material-symbols-outlined text-[14px]">chevron_right</span>
                <span class="text-primary font-bold">Laporan</span>
            </nav>
            <h1 class="font-headline-lg text-headline-lg font-extrabold text-on-surface">Laporan Transaksi</h1>
            <p class="text-on-surface-variant font-body-md text-body-md mt-2">Lihat dan kelola seluruh riwayat transaksi serta ekspor laporan.</p>
        </div>
        <button type="button" id="btnTambahLaporan" class="inline-flex items-center justify-center gap-sm rounded-2xl bg-primary-container px-lg py-3 text-on-primary-container font-bold transition hover:bg-primary active:scale-95 shadow-md">
            <span class="material-symbols-outlined">add_circle</span>
            Tambah Laporan
        </button>
    </div>

<!-- Filter & Action Section -->
<form method="GET" action="{{ route('admin.laporan') }}" id="filterForm">
<div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-md bg-white p-md rounded-2xl shadow-sm border border-outline-variant/20">
    <div class="flex flex-wrap items-center gap-sm w-full md:w-auto">
        <div class="flex flex-col sm:flex-row items-start sm:items-center gap-2 w-full sm:w-auto">
            <div class="flex flex-col gap-1 w-full sm:w-auto">
                <label class="text-[10px] font-bold text-on-surface-variant uppercase tracking-widest pl-1">Dari Tanggal</label>
                <div class="flex items-center gap-2 bg-surface-container-low px-3 py-2 rounded-xl border border-outline-variant/30">
                    <span class="material-symbols-outlined text-sm text-on-surface-variant">calendar_today</span>
                    <input type="date"
                           name="start_date"
                           value="{{ $startDate->format('Y-m-d') }}"
                           class="bg-transparent border-none p-0 text-sm focus:ring-0 font-medium text-on-surface cursor-pointer">
                </div>
            </div>
            <span class="text-on-surface-variant font-bold hidden sm:inline pt-4">-</span>
            <div class="flex flex-col gap-1 w-full sm:w-auto">
                <label class="text-[10px] font-bold text-on-surface-variant uppercase tracking-widest pl-1">Sampai Tanggal</label>
                <div class="flex items-center gap-2 bg-surface-container-low px-3 py-2 rounded-xl border border-outline-variant/30">
                    <span class="material-symbols-outlined text-sm text-on-surface-variant">event</span>
                    <input type="date"
                           name="end_date"
                           value="{{ $endDate->format('Y-m-d') }}"
                           class="bg-transparent border-none p-0 text-sm focus:ring-0 font-medium text-on-surface cursor-pointer">
                </div>
            </div>
        </div>
        <div class="flex items-center gap-2 self-end pt-2 sm:pt-0">
            <button type="submit" class="flex items-center gap-2 px-4 py-2 bg-primary text-on-primary font-semibold rounded-xl transition-all whitespace-nowrap active:scale-95 shadow-sm hover:bg-primary/90">
                <span class="material-symbols-outlined text-lg">filter_list</span>
                <span class="text-sm">Terapkan</span>
            </button>
            <a href="{{ route('admin.laporan') }}" class="flex items-center gap-2 px-3 py-2 bg-surface-container-high hover:bg-surface-container-highest text-on-surface-variant font-semibold rounded-xl transition-all whitespace-nowrap active:scale-95" title="Reset Filter">
                <span class="material-symbols-outlined text-lg">refresh</span>
            </a>
        </div>
    </div>
    <!-- Tombol aksi: scrollable horizontal di mobile -->
    <div class="flex items-center gap-sm w-full md:w-auto overflow-x-auto no-scrollbar pb-1 md:pb-0 pt-2 md:pt-0">

        {{-- Trigger tersembunyi untuk FAB mobile --}}
        <button type="button" id="btnTambahLaporanHidden" class="sr-only" aria-hidden="true"></button>
        <button type="button" onclick="window.print()" class="flex items-center gap-2 px-4 py-2 bg-surface-container-high hover:bg-surface-container-highest text-primary font-semibold rounded-xl transition-all whitespace-nowrap active:scale-95 flex-shrink-0">
            <span class="material-symbols-outlined text-lg">print</span>
            <span class="text-sm hidden sm:inline">Cetak</span>
        </button>
        <a href="{{ route('admin.laporan', array_merge(request()->query(), ['export' => 'pdf'])) }}"
           target="_blank"
           class="flex items-center gap-2 px-4 py-2 bg-error-container text-on-error-container font-semibold rounded-xl hover:bg-error/10 transition-all whitespace-nowrap active:scale-95 flex-shrink-0">
            <span class="material-symbols-outlined text-lg">picture_as_pdf</span>
            <span class="text-sm hidden sm:inline">Ekspor PDF</span>
        </a>
        <a href="{{ route('admin.laporan', array_merge(request()->query(), ['export' => 'csv'])) }}"
           class="flex items-center gap-2 px-4 py-2 bg-secondary-container text-on-secondary-container font-semibold rounded-xl hover:bg-secondary/10 transition-all whitespace-nowrap active:scale-95 flex-shrink-0">
            <span class="material-symbols-outlined text-lg">table_view</span>
            <span class="text-sm hidden sm:inline">Ekspor CSV</span>
        </a>
    </div>
</div>
</form>

<!-- Summary Cards -->
<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-lg">
    <!-- Card 1 -->
    <div class="bg-white p-lg rounded-2xl shadow-sm border border-outline-variant/20 relative overflow-hidden group hover:shadow-md transition-shadow">
        <div class="flex justify-between items-start mb-md">
            <div>
                <p class="text-sm font-medium text-on-surface-variant mb-1">Total Laporan Dibuat</p>
                <h3 class="text-3xl font-bold text-on-background">{{ number_format($totalLaporan, 0, ',', '.') }}</h3>
            </div>
            <div class="w-12 h-12 rounded-full bg-secondary-container/30 flex items-center justify-center text-primary flex-shrink-0">
                <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">analytics</span>
            </div>
        </div>
        <div class="flex items-center gap-1 text-xs font-bold {{ $laporanGrowth >= 0 ? 'text-primary' : 'text-error' }}">
            <span class="material-symbols-outlined text-sm">{{ $laporanGrowth >= 0 ? 'trending_up' : 'trending_down' }}</span>
            <span>{{ $laporanGrowth >= 0 ? '+' : '' }}{{ $laporanGrowth }}% dari bulan lalu</span>
        </div>
    </div>
    <!-- Card 2 -->
    <div class="bg-white p-lg rounded-2xl shadow-sm border border-outline-variant/20 relative overflow-hidden group hover:shadow-md transition-shadow">
        <div class="flex justify-between items-start mb-md">
            <div>
                <p class="text-sm font-medium text-on-surface-variant mb-1">Total Berat Terlapor</p>
                <h3 class="text-3xl font-bold text-on-background">{{ $totalTonaseFormatted }} <span class="text-lg font-medium text-on-surface-variant">Kg</span></h3>
            </div>
            <div class="w-12 h-12 rounded-full bg-tertiary-fixed/30 flex items-center justify-center text-tertiary flex-shrink-0">
                <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">weight</span>
            </div>
        </div>
        <div class="flex items-center gap-1 text-primary text-xs font-bold">
            <span class="material-symbols-outlined text-sm">info</span>
            <span>Bulan lalu: {{ $tonaseLastMonthFormatted }} Kg</span>
        </div>
    </div>
    <!-- Card 3 (full width on 2-col sm, normal on md) -->
    <div class="bg-white p-lg rounded-2xl shadow-sm border border-outline-variant/20 relative overflow-hidden group hover:shadow-md transition-shadow sm:col-span-2 md:col-span-1">
        <div class="flex justify-between items-start mb-md">
            <div>
                <p class="text-sm font-medium text-on-surface-variant mb-1">Rata-rata Harga</p>
                <h3 class="text-3xl font-bold text-on-background">Rp {{ $avgPriceFormatted }} <span class="text-lg font-medium text-on-surface-variant">/kg</span></h3>
            </div>
            <div class="w-12 h-12 rounded-full bg-primary-fixed/30 flex items-center justify-center text-primary flex-shrink-0">
                <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">payments</span>
            </div>
        </div>
        <div class="flex items-center gap-1 text-xs font-bold {{ $priceTrend >= 0 ? 'text-primary' : 'text-error' }}">
            <span class="material-symbols-outlined text-sm">{{ $priceTrend >= 0 ? 'trending_up' : 'trending_down' }}</span>
            <span>{{ $priceTrend >= 0 ? '+' : '' }}{{ $priceTrend }}% Fluktuasi Pasar</span>
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
                <p class="text-sm text-on-surface-variant">Analisis berat jagung 6 bulan terakhir</p>
            </div>
        </div>
        <!-- Area Chart Graphic -->
        <div class="h-48 sm:h-64 relative flex items-end justify-between gap-4 px-4 border-b border-outline-variant/20 mb-8">
            <div class="absolute inset-0 grid grid-rows-4 pointer-events-none">
                <div class="border-t border-dashed border-outline-variant/20"></div>
                <div class="border-t border-dashed border-outline-variant/20"></div>
                <div class="border-t border-dashed border-outline-variant/20"></div>
                <div class="border-t border-dashed border-outline-variant/20"></div>
            </div>
            <div class="relative w-full h-full">
                <svg class="w-full h-full overflow-visible" viewBox="0 0 800 200" preserveAspectRatio="none">
                    <defs>
                        <linearGradient id="chartGradient" x1="0" x2="0" y1="0" y2="1">
                            <stop offset="0%" stop-color="var(--primary)" stop-opacity="0.3"></stop>
                            <stop offset="100%" stop-color="var(--primary)" stop-opacity="0"></stop>
                        </linearGradient>
                    </defs>
                    @php $areaPath = $svgPoints . ' L800,200 L0,200 Z'; @endphp
                    <path d="{{ $areaPath }}" fill="url(#chartGradient)" style="--primary: #2e7d32;"></path>
                    <path id="chartLine" d="{{ $svgPoints }}" fill="none" stroke="#2e7d32" stroke-linecap="round" stroke-width="4"></path>
                    @php
                        for ($i = 0; $i < 6; $i++) {
                            $x = ($i / 5) * 800;
                            $y = 200 - (($monthlyTonase[$i] / $maxMonthlyTonase) * 180);
                            echo "<circle cx=\"" . round($x,1) . "\" cy=\"" . round($y,1) . "\" r=\"6\" fill=\"#2e7d32\" stroke=\"white\" stroke-width=\"2\"><title>{$monthLabels[$i]}: {$monthlyTonase[$i]} Kg</title></circle>";
                        }
                    @endphp
                </svg>
            </div>
        </div>
        <div class="flex justify-between px-2 text-xs text-on-surface-variant font-bold uppercase tracking-widest">
            @foreach($monthLabels as $label)
                <span>{{ $label }}</span>
            @endforeach
        </div>
    </div>
    <!-- Side Info Card -->
    <div class="bg-primary p-lg rounded-2xl shadow-sm relative overflow-hidden flex flex-col justify-between min-h-[220px]">
        <div class="absolute -right-12 -top-12 w-48 h-48 bg-white/10 rounded-full blur-3xl"></div>
        <div class="relative z-10">
            <h4 class="text-white font-title-lg text-title-lg mb-2">Insight Mingguan</h4>
            @if($weeklyGrowth > 0)
                <p class="text-white/80 text-sm leading-relaxed">Produktivitas meningkat <strong>{{ $weeklyGrowth }}%</strong> minggu ini dibandingkan minggu lalu.</p>
            @elseif($weeklyGrowth < 0)
                <p class="text-white/80 text-sm leading-relaxed">Produktivitas turun <strong>{{ abs($weeklyGrowth) }}%</strong> minggu ini. Perlu perhatian lebih.</p>
            @else
                <p class="text-white/80 text-sm leading-relaxed">Belum ada data transaksi minggu ini untuk dibandingkan.</p>
            @endif
        </div>
        <div class="relative z-10 bg-white/10 backdrop-blur-md rounded-xl p-md mt-lg border border-white/20">
            <div class="flex items-center justify-between mb-2">
                <span class="text-xs text-white/70">Target Bulanan</span>
                <span class="text-xs font-bold text-white">{{ $monthlyProgress }}%</span>
            </div>
            <div class="w-full bg-white/20 rounded-full h-2 overflow-hidden">
                <div class="bg-secondary-fixed-dim h-full rounded-full shadow-lg transition-all duration-700"
                     style="width: {{ $monthlyProgress }}%"></div>
            </div>
            <p class="text-white/60 text-[10px] mt-2">{{ $totalTonaseFormatted }} Kg / {{ number_format($monthlyTarget, 0, ',', '.') }} Kg target</p>
        </div>
        <a href="#riwayat-laporan" class="relative z-10 w-full mt-lg py-3 bg-white text-primary font-bold rounded-xl hover:bg-secondary-container transition-colors text-sm text-center block">
            Lihat Detail Laporan
        </a>
    </div>
</div>

<!-- History Table -->
<div id="riwayat-laporan" class="bg-white rounded-2xl shadow-sm border border-outline-variant/20 overflow-hidden mb-xl scroll-mt-20">
    <div class="px-lg py-md border-b border-outline-variant/20 flex justify-between items-center">
        <h4 class="font-title-lg text-title-lg text-on-background">Riwayat Laporan</h4>
        <span class="text-sm text-on-surface-variant">{{ $laporan->total() }} data ditemukan</span>
    </div>

    {{-- DESKTOP TABLE (hidden on mobile) --}}
    <div class="hidden md:block overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-surface-container-low/50">
                    <th class="px-lg py-4 text-xs font-bold text-on-surface-variant uppercase tracking-widest">Tanggal Laporan</th>
                    <th class="px-lg py-4 text-xs font-bold text-on-surface-variant uppercase tracking-widest">Nama Petani</th>
                    <th class="px-lg py-4 text-xs font-bold text-on-surface-variant uppercase tracking-widest">Total Berat</th>
                    <th class="px-lg py-4 text-xs font-bold text-on-surface-variant uppercase tracking-widest">Status</th>
                    <th class="px-lg py-4 text-xs font-bold text-on-surface-variant uppercase tracking-widest text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-outline-variant/10">
                @forelse($laporan as $item)
                <tr class="hover:bg-surface-container-low/30 transition-colors group">
                    <td class="px-lg py-4">
                        <div class="flex flex-col">
                            <span class="font-semibold text-on-background">{{ $item->created_at->format('d M Y') }}</span>
                            <span class="text-[10px] text-on-surface-variant">{{ $item->created_at->format('H:i') }} WIB</span>
                        </div>
                    </td>
                    <td class="px-lg py-4">
                        <span class="px-3 py-1 bg-surface-container-high rounded-full text-xs font-bold text-on-surface-variant">
                            {{ $item->farmer_name }}
                        </span>
                    </td>
                    <td class="px-lg py-4 font-semibold text-on-background">{{ number_format($item->tonnage, 0, ',', '.') }} Kg</td>
                    <td class="px-lg py-4">
                        @if($item->status === 'Selesai')
                            <div class="flex items-center gap-2">
                                <div class="w-2 h-2 rounded-full bg-primary"></div>
                                <span class="text-xs font-bold text-primary">Selesai</span>
                            </div>
                        @elseif($item->status === 'Proses')
                            <div class="flex items-center gap-2">
                                <div class="w-2 h-2 rounded-full bg-tertiary animate-pulse"></div>
                                <span class="text-xs font-bold text-tertiary">Proses</span>
                            </div>
                        @else
                            <div class="flex items-center gap-2">
                                <div class="w-2 h-2 rounded-full bg-on-surface-variant"></div>
                                <span class="text-xs font-bold text-on-surface-variant">{{ $item->status }}</span>
                            </div>
                        @endif
                    </td>
                    <td class="px-lg py-4 text-center">
                        <div class="flex justify-center items-center gap-2">
                            @if($item->status === 'Selesai')
                                <a href="{{ route('admin.laporan.download', $item->id) }}" target="_blank"
                                   class="p-2 hover:bg-primary/10 rounded-lg text-primary transition-colors" title="Download / Cetak PDF Laporan">
                                    <span class="material-symbols-outlined text-lg">download</span>
                                </a>
                            @else
                                <button class="p-2 text-on-surface-variant cursor-not-allowed opacity-50" disabled title="Belum selesai">
                                    <span class="material-symbols-outlined text-lg">download</span>
                                </button>
                            @endif
                            <button onclick="showDetailModal({{ $item->id }}, '{{ addslashes($item->farmer_name) }}', '{{ $item->created_at->format('d M Y') }}', {{ $item->tonnage }}, '{{ $item->status }}', '{{ addslashes($item->keterangan ?? '-') }}', '{{ $item->jenis_laporan ?? '-' }}', '{{ $item->kategori ?? '-' }}')"
                                    class="p-2 hover:bg-primary/10 rounded-lg text-primary transition-colors" title="Lihat Detail">
                                <span class="material-symbols-outlined text-lg">visibility</span>
                            </button>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-lg py-12 text-center">
                        <div class="flex flex-col items-center gap-3 text-on-surface-variant">
                            <span class="material-symbols-outlined text-5xl opacity-30">inbox</span>
                            <p class="font-medium">Tidak ada data laporan pada periode ini.</p>
                            <p class="text-sm">Coba ubah filter tanggal atau tambahkan transaksi baru.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- MOBILE CARD LIST (visible only on mobile) --}}
    <div class="md:hidden divide-y divide-outline-variant/10">
        @forelse($laporan as $item)
        <div class="p-md flex flex-col gap-2 hover:bg-surface-container-low/30 transition-colors">
            <div class="flex justify-between items-start">
                <div class="flex flex-col">
                    <span class="font-semibold text-on-background text-sm">{{ $item->created_at->format('d M Y') }}</span>
                    <span class="text-[10px] text-on-surface-variant">{{ $item->created_at->format('H:i') }} WIB</span>
                </div>
                @if($item->status === 'Selesai')
                    <div class="flex items-center gap-1.5 bg-primary/10 px-2 py-1 rounded-full">
                        <div class="w-1.5 h-1.5 rounded-full bg-primary"></div>
                        <span class="text-[10px] font-bold text-primary">Selesai</span>
                    </div>
                @elseif($item->status === 'Proses')
                    <div class="flex items-center gap-1.5 bg-tertiary/10 px-2 py-1 rounded-full">
                        <div class="w-1.5 h-1.5 rounded-full bg-tertiary animate-pulse"></div>
                        <span class="text-[10px] font-bold text-tertiary">Proses</span>
                    </div>
                @else
                    <div class="flex items-center gap-1.5 bg-surface-container-high px-2 py-1 rounded-full">
                        <div class="w-1.5 h-1.5 rounded-full bg-on-surface-variant"></div>
                        <span class="text-[10px] font-bold text-on-surface-variant">{{ $item->status }}</span>
                    </div>
                @endif
            </div>
            <div class="flex justify-between items-center">
                <div class="flex flex-col gap-1">
                    <span class="text-[10px] text-on-surface-variant uppercase tracking-wider">Petani</span>
                    <span class="text-sm font-semibold text-on-background">{{ $item->farmer_name }}</span>
                </div>
                <div class="flex flex-col gap-1 text-right">
                    <span class="text-[10px] text-on-surface-variant uppercase tracking-wider">Berat</span>
                    <span class="text-sm font-bold text-primary">{{ number_format($item->tonnage, 0, ',', '.') }} Kg</span>
                </div>
            </div>
            <div class="flex gap-2 pt-1">
                @if($item->status === 'Selesai')
                    <a href="{{ route('admin.laporan.download', $item->id) }}" target="_blank"
                       class="flex-1 flex items-center justify-center gap-1 py-2 bg-primary/10 rounded-lg text-primary text-xs font-semibold transition-colors active:scale-95">
                        <span class="material-symbols-outlined text-base">download</span> Unduh
                    </a>
                @else
                    <button class="flex-1 flex items-center justify-center gap-1 py-2 bg-surface-container rounded-lg text-on-surface-variant text-xs font-semibold opacity-50 cursor-not-allowed" disabled>
                        <span class="material-symbols-outlined text-base">download</span> Unduh
                    </button>
                @endif
                <button onclick="showDetailModal({{ $item->id }}, '{{ addslashes($item->farmer_name) }}', '{{ $item->created_at->format('d M Y') }}', {{ $item->tonnage }}, '{{ $item->status }}', '{{ addslashes($item->keterangan ?? '-') }}', '{{ $item->jenis_laporan ?? '-' }}', '{{ $item->kategori ?? '-' }}')"
                        class="flex-1 flex items-center justify-center gap-1 py-2 bg-surface-container-high rounded-lg text-primary text-xs font-semibold transition-colors active:scale-95">
                    <span class="material-symbols-outlined text-base">visibility</span> Lihat
                </button>
            </div>
        </div>
        @empty
        <div class="p-lg text-center">
            <div class="flex flex-col items-center gap-3 text-on-surface-variant">
                <span class="material-symbols-outlined text-5xl opacity-30">inbox</span>
                <p class="font-medium text-sm">Tidak ada data laporan pada periode ini.</p>
            </div>
        </div>
        @endforelse
    </div>

    <!-- Pagination Footer -->
    <div class="px-lg py-4 bg-surface-container-low/30 border-t border-outline-variant/20 flex flex-col sm:flex-row justify-between items-center gap-4">
        <p class="text-sm text-on-surface-variant font-medium text-center sm:text-left">
            Menampilkan {{ $laporan->firstItem() ?? 0 }}-{{ $laporan->lastItem() ?? 0 }} dari {{ number_format($laporan->total(), 0, ',', '.') }} laporan
        </p>
        <div class="flex items-center gap-2 flex-wrap justify-center">
            {{-- Prev --}}
            @if($laporan->onFirstPage())
                <button class="w-9 h-9 flex items-center justify-center border border-outline-variant/30 rounded-lg hover:bg-white transition-colors disabled:opacity-50" disabled>
                    <span class="material-symbols-outlined text-base">chevron_left</span>
                </button>
            @else
                <a href="{{ $laporan->previousPageUrl() }}" class="w-9 h-9 flex items-center justify-center border border-outline-variant/30 rounded-lg hover:bg-white transition-colors">
                    <span class="material-symbols-outlined text-base">chevron_left</span>
                </a>
            @endif

            {{-- Page Numbers --}}
            @foreach($laporan->getUrlRange(max(1, $laporan->currentPage()-1), min($laporan->lastPage(), $laporan->currentPage()+1)) as $page => $url)
                @if($page == $laporan->currentPage())
                    <button class="w-9 h-9 flex items-center justify-center bg-primary text-white rounded-lg font-bold text-sm">{{ $page }}</button>
                @else
                    <a href="{{ $url }}" class="w-9 h-9 flex items-center justify-center border border-outline-variant/30 rounded-lg hover:bg-white transition-colors font-bold text-sm">{{ $page }}</a>
                @endif
            @endforeach

            @if($laporan->lastPage() > $laporan->currentPage() + 1)
                <span class="px-1 text-on-surface-variant">...</span>
                <a href="{{ $laporan->url($laporan->lastPage()) }}" class="w-9 h-9 flex items-center justify-center border border-outline-variant/30 rounded-lg hover:bg-white transition-colors font-bold text-sm">{{ $laporan->lastPage() }}</a>
            @endif

            {{-- Next --}}
            @if($laporan->hasMorePages())
                <a href="{{ $laporan->nextPageUrl() }}" class="w-9 h-9 flex items-center justify-center border border-outline-variant/30 rounded-lg hover:bg-white transition-colors">
                    <span class="material-symbols-outlined text-base">chevron_right</span>
                </a>
            @else
                <button class="w-9 h-9 flex items-center justify-center border border-outline-variant/30 rounded-lg hover:bg-white transition-colors disabled:opacity-50" disabled>
                    <span class="material-symbols-outlined text-base">chevron_right</span>
                </button>
            @endif
        </div>
    </div>
</div>


{{-- Include Modal Tambah Laporan --}}
@include('admin.page.laporan.add_laporan')

{{-- Modal Detail Laporan --}}
<div id="modalDetailLaporan"
     class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-on-surface/40 backdrop-blur-sm
            opacity-0 pointer-events-none transition-all duration-300"
     onclick="if(event.target===this)closeDetailModal()">
    <div class="w-full max-w-lg bg-white rounded-2xl shadow-2xl overflow-hidden transform transition-all duration-300 scale-95" id="detailModalContent">
        <div class="bg-primary px-lg py-md flex justify-between items-center">
            <div class="flex items-center gap-sm">
                <span class="material-symbols-outlined text-white" style="font-variation-settings:'FILL' 1">receipt_long</span>
                <h3 class="font-bold text-white">Detail Laporan #<span id="dId"></span></h3>
            </div>
            <button onclick="closeDetailModal()" class="p-1 hover:bg-white/20 rounded-full transition-colors text-white">
                <span class="material-symbols-outlined">close</span>
            </button>
        </div>
        <div class="p-lg space-y-4">
            <div class="grid grid-cols-2 gap-4">
                <div class="space-y-1">
                    <p class="text-xs text-on-surface-variant uppercase tracking-wider font-bold">Nama Petani</p>
                    <p class="font-semibold text-on-surface" id="dName"></p>
                </div>
                <div class="space-y-1">
                    <p class="text-xs text-on-surface-variant uppercase tracking-wider font-bold">Tanggal</p>
                    <p class="font-semibold text-on-surface" id="dDate"></p>
                </div>
                <div class="space-y-1">
                    <p class="text-xs text-on-surface-variant uppercase tracking-wider font-bold">Jenis Laporan</p>
                    <p class="font-semibold text-on-surface" id="dJenis"></p>
                </div>
                <div class="space-y-1">
                    <p class="text-xs text-on-surface-variant uppercase tracking-wider font-bold">Kategori</p>
                    <p class="font-semibold text-on-surface" id="dKategori"></p>
                </div>
                <div class="space-y-1">
                    <p class="text-xs text-on-surface-variant uppercase tracking-wider font-bold">Berat</p>
                    <p class="font-bold text-primary text-lg" id="dTonnage"></p>
                </div>
                <div class="space-y-1">
                    <p class="text-xs text-on-surface-variant uppercase tracking-wider font-bold">Status</p>
                    <p id="dStatus"></p>
                </div>
            </div>
            <div class="space-y-1 border-t border-outline-variant/20 pt-3">
                <p class="text-xs text-on-surface-variant uppercase tracking-wider font-bold">Keterangan</p>
                <p class="text-sm text-on-surface" id="dKet"></p>
            </div>
        </div>
        <div class="px-lg py-md bg-surface-container-low border-t border-outline-variant/20 flex justify-between items-center">
            <a id="dDownloadLink" href="#" target="_blank" class="flex items-center gap-2 px-4 py-2 bg-primary text-on-primary rounded-xl font-semibold text-sm hover:bg-primary/90 transition-all active:scale-95">
                <span class="material-symbols-outlined text-base">download</span> Unduh Laporan
            </a>
            <button onclick="closeDetailModal()" class="px-4 py-2 border border-outline-variant text-on-surface-variant rounded-xl font-semibold text-sm hover:bg-surface-container transition-all">
                Tutup
            </button>
        </div>
    </div>
</div>

{{-- Success Toast setelah simpan --}}
@if(session('success'))
<div id="successToast"
     class="fixed bottom-6 right-6 z-[200] transition-all duration-500 opacity-0 translate-y-4">
    <div class="bg-on-background text-white px-lg py-sm rounded-xl shadow-2xl flex items-center gap-md">
        <span class="material-symbols-outlined text-secondary-fixed-dim" style="font-variation-settings: 'FILL' 1;">check_circle</span>
        <span class="text-sm font-medium">{{ session('success') }}</span>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const t = document.getElementById('successToast');
        if (t) {
            setTimeout(() => { t.classList.remove('opacity-0', 'translate-y-4'); }, 100);
            setTimeout(() => { t.classList.add('opacity-0', 'translate-y-4'); }, 3500);
        }
    });
</script>
@endif
</div>
@endsection

@push('styles')
<style>
    .chart-area-gradient { fill: url(#chartGradient); fill-opacity: 0.15; }
    .no-scrollbar::-webkit-scrollbar { display: none; }
    .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        // Animasi Chart Line
        const chartLine = document.getElementById('chartLine');
        if (chartLine) {
            const length = chartLine.getTotalLength ? chartLine.getTotalLength() : 1000;
            chartLine.style.strokeDasharray = length;
            chartLine.style.strokeDashoffset = length;
            chartLine.style.transition = 'stroke-dashoffset 1.5s ease-in-out';
            setTimeout(() => { chartLine.style.strokeDashoffset = '0'; }, 300);
        }

    });

    // ── Modal Detail Laporan ──────────────────────────────────────
    const baseDownloadUrl = "{{ url('/admin/laporan') }}";

    function showDetailModal(id, name, date, tonnage, status, ket, jenis, kategori) {
        document.getElementById('dId').textContent      = id;
        document.getElementById('dName').textContent    = name;
        document.getElementById('dDate').textContent    = date;
        document.getElementById('dTonnage').textContent = parseFloat(tonnage).toLocaleString('id-ID', {minimumFractionDigits: 2}) + ' Kg';
        document.getElementById('dJenis').textContent   = jenis;
        document.getElementById('dKategori').textContent = kategori;
        document.getElementById('dKet').textContent     = ket || '-';

        const statusEl = document.getElementById('dStatus');
        if (status === 'Selesai') {
            statusEl.innerHTML = '<span class="inline-flex items-center gap-1 px-2 py-1 bg-primary/10 rounded-full text-xs font-bold text-primary"><span class="w-1.5 h-1.5 rounded-full bg-primary inline-block"></span>Selesai</span>';
            document.getElementById('dDownloadLink').href = baseDownloadUrl + '/' + id + '/download';
            document.getElementById('dDownloadLink').classList.remove('opacity-50','pointer-events-none');
        } else {
            statusEl.innerHTML = '<span class="inline-flex items-center gap-1 px-2 py-1 bg-tertiary/10 rounded-full text-xs font-bold text-tertiary"><span class="w-1.5 h-1.5 rounded-full bg-tertiary animate-pulse inline-block"></span>Proses</span>';
            document.getElementById('dDownloadLink').href = '#';
            document.getElementById('dDownloadLink').classList.add('opacity-50','pointer-events-none');
        }

        const modal = document.getElementById('modalDetailLaporan');
        const content = document.getElementById('detailModalContent');
        modal.classList.remove('opacity-0', 'pointer-events-none');
        modal.classList.add('opacity-100');
        content.classList.remove('scale-95');
        content.classList.add('scale-100');
        document.body.style.overflow = 'hidden';
    }

    function closeDetailModal() {
        const modal = document.getElementById('modalDetailLaporan');
        const content = document.getElementById('detailModalContent');
        modal.classList.add('opacity-0', 'pointer-events-none');
        modal.classList.remove('opacity-100');
        content.classList.add('scale-95');
        content.classList.remove('scale-100');
        document.body.style.overflow = '';
    }

    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') closeDetailModal();
    });
</script>
@endpush