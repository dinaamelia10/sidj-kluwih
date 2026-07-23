@extends('admin.layout.master')

@section('content')
<div class="space-y-lg">
    <div class="flex flex-col gap-4 md:flex-row md:items-end md:justify-between">
        <div>
            <nav class="flex flex-wrap items-center gap-2 text-on-surface-variant font-label-sm text-label-sm mb-2">
                <a class="hover:text-primary" href="{{ route('admin.dashboard') }}">Dashboard</a>
                <span class="material-symbols-outlined text-[14px]">chevron_right</span>
                <span class="text-primary font-bold">Berat Jagung</span>
            </nav>
            <h1 class="font-headline-lg text-headline-lg font-extrabold text-on-surface">Data Berat Jagung</h1>
            <p class="text-on-surface-variant font-body-md text-body-md mt-2">Pantau pencapaian dan performa berat jagung secara real-time dengan tampilan yang responsif di desktop dan mobile.</p>
        </div>
        <a href="{{ route('admin.tonase.add_tonase') }}" class="inline-flex items-center gap-sm rounded-2xl bg-primary-container px-lg py-3 text-on-primary-container font-bold transition hover:bg-primary active:scale-95 shadow-md">
            <span class="material-symbols-outlined">add_circle</span>
            Tambah Data Baru
        </a>
    </div>

    <!-- Bento Card Statistik Dinamis -->
    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-lg">
        <!-- Tonase Hari Ini -->
        <div class="bento-card p-lg flex flex-col justify-between relative overflow-hidden group">
            <div class="flex items-start justify-between gap-4">
                <div>
                    <p class="font-label-md text-label-md text-on-surface-variant">Berat Hari Ini</p>
                    <h2 class="font-display text-[32px] font-bold text-primary">{{ number_format($tonnageToday, 1) }} <span class="text-title-lg">Kg</span></h2>
                </div>
                <div class="w-12 h-12 rounded-full bg-secondary-container flex items-center justify-center text-on-secondary-container">
                    <span class="material-symbols-outlined">today</span>
                </div>
            </div>
            <div class="mt-md inline-flex items-center gap-xs {{ $dailyGrowth >= 0 ? 'text-primary' : 'text-error' }} font-bold text-label-sm">
                <span class="material-symbols-outlined text-sm">{{ $dailyGrowth >= 0 ? 'trending_up' : 'trending_down' }}</span>
                {{ $dailyGrowth >= 0 ? '+' : '' }}{{ number_format($dailyGrowth, 1) }}% dari kemarin
            </div>
        </div>

        <!-- Tonase Bulan Ini -->
        <div class="bento-card p-lg flex flex-col justify-between relative overflow-hidden group">
            <div class="flex items-start justify-between gap-4">
                <div>
                    <p class="font-label-md text-label-md text-on-surface-variant">Berat Bulan Ini</p>
                    <h2 class="font-display text-[32px] font-bold text-primary">{{ number_format($tonnageThisMonth, 1) }} <span class="text-title-lg">Kg</span></h2>
                </div>
                <div class="w-12 h-12 rounded-full bg-tertiary-fixed flex items-center justify-center text-on-tertiary-fixed">
                    <span class="material-symbols-outlined">calendar_month</span>
                </div>
            </div>
            <div class="mt-md inline-flex items-center gap-xs {{ $monthlyGrowth >= 0 ? 'text-primary' : 'text-error' }} font-bold text-label-sm">
                <span class="material-symbols-outlined text-sm">{{ $monthlyGrowth >= 0 ? 'trending_up' : 'trending_down' }}</span>
                {{ $monthlyGrowth >= 0 ? '+' : '' }}{{ number_format($monthlyGrowth, 1) }}% dari bulan lalu
            </div>
        </div>

        <!-- Tonase Tahun Ini -->
        <div class="bento-card p-lg flex flex-col justify-between relative overflow-hidden group">
            <div class="flex items-start justify-between gap-4">
                <div>
                    <p class="font-label-md text-label-md text-on-surface-variant">Berat Tahun Ini</p>
                    <h2 class="font-display text-[32px] font-bold text-primary">{{ number_format($tonnageThisYear, 0, '.', ',') }} <span class="text-title-lg">Kg</span></h2>
                </div>
                <div class="w-12 h-12 rounded-full bg-primary-fixed flex items-center justify-center text-on-primary-fixed">
                    <span class="material-symbols-outlined">analytics</span>
                </div>
            </div>
            <div class="mt-md inline-flex items-center gap-xs text-primary font-bold text-label-sm">
                <span class="material-symbols-outlined text-sm">verified</span>
                Target: {{ number_format($yearlyTarget, 0, '.', ',') }} Kg
            </div>
        </div>
    </div>

    <!-- Grafik Batang Mingguan Dinamis -->
    <div class="bento-card p-lg space-y-lg">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <div class="flex flex-col gap-3">
                <h2 class="font-title-lg text-title-lg font-bold">Tren Berat Mingguan</h2>
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
                @foreach($weeklyTonnageData as $index => $volume)
                @php
                    $heightPercent = max(5, round(($volume / $maxWeeklyVolume) * 100));
                @endphp
                <div class="flex-1 min-w-[56px] flex flex-col items-center gap-3" data-value="{{ number_format($volume, 1) }}">
                    <div class="chart-bar w-full rounded-t-lg bg-secondary-container/40 transition-all duration-300" style="height: {{ $heightPercent }}%"></div>
                    <p class="text-label-sm text-label-sm opacity-60">{{ $daysLabels[$index] }}</p>
                </div>
                @endforeach
            </div>
        </div>
        <p id="chart-summary" class="text-label-sm text-on-surface-variant">Data untuk 7 Hari Terakhir — volume berat dibandingkan tren.</p>
    </div>

    <!-- Panel Filter & Pencarian -->
    <div class="bento-card overflow-hidden">
        <div class="border-b border-outline-variant px-lg py-lg">
            <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
                <h2 class="font-title-lg text-title-lg font-bold">Rincian Transaksi Berat Jagung</h2>
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

        <!-- Desktop View Table (Looping Dinamis) -->
        <div class="hidden md:block overflow-x-auto">
            <table class="w-full text-left min-w-[720px]">
                <thead class="bg-surface-container-low text-on-surface-variant font-label-md text-label-md uppercase tracking-wider">
                    <tr>
                        <th class="px-lg py-md font-semibold">Tanggal</th>
                        <th class="px-lg py-md font-semibold">Nama Petani</th>
                        <th class="px-lg py-md font-semibold">Varietas</th>
                        <th class="px-lg py-md font-semibold text-right">Berat Kotor (Kg)</th>
                        <th class="px-lg py-md font-semibold text-center">Kadar Air (%)</th>
                        <th class="px-lg py-md font-semibold text-right">Berat Bersih (Kg)</th>
                        <th class="px-lg py-md font-semibold text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-outline-variant" data-table="transactions">
                    @forelse($transactions as $transaction)
                    @php
                        // Menentukan inisial nama petani untuk avatar lingkaran
                        $words = explode(' ', $transaction->farmer_name);
                        $initials = strtoupper(substr($words[0], 0, 1) . (isset($words[1]) ? substr($words[1], 0, 1) : ''));
                        
                        // Menghitung perkiraan berat kotor simulasi berbasis tonase bersih pengeringan
                        $grossWeight = $transaction->tonnage * 1.05; 
                    @endphp
                    <tr class="hover:bg-surface-variant transition-colors group">
                        <td class="px-lg py-md font-body-md text-body-md">{{ $transaction->created_at->format('d M Y') }}</td>
                        <td class="px-lg py-md">
                            <div class="flex items-center gap-sm">
                                <div class="w-8 h-8 rounded-full bg-secondary-container text-on-secondary-container flex items-center justify-center font-bold text-xs">{{ $initials }}</div>
                                <span class="font-bold text-body-md">{{ $transaction->farmer_name }}</span>
                            </div>
                        </td>
                        <td class="px-lg py-md font-body-md text-body-md">{{ $transaction->variety ?? 'Pioneer P35' }}</td>
                        <td class="px-lg py-md font-body-md text-body-md text-right">{{ number_format($grossWeight, 3) }}</td>
                        <td class="px-lg py-md text-center">
                            <span class="rounded-full bg-tertiary-fixed px-3 py-1 text-label-sm font-bold text-on-tertiary-fixed">{{ $transaction->moisture ?? '14.0' }}%</span>
                        </td>
                        <td class="px-lg py-md font-bold text-body-md text-right text-primary">{{ number_format($transaction->tonnage, 3) }}</td>
                        <td class="px-lg py-md">
                            <div class="flex justify-center gap-sm">                                 
                                @if($transaction->status === 'Proses')
                                 <form action="{{ route('admin.tonase.update_status', $transaction->id) }}" method="POST" class="inline">
                                     @csrf
                                     @method('PATCH')
                                     <input type="hidden" name="status" value="Selesai">
                                     <button type="submit"
                                             class="p-xs text-primary hover:bg-primary/10 rounded-lg transition-colors"
                                             title="Tandai Selesai"
                                             onclick="return confirmSubmit(event, 'Selesaikan Transaksi', 'Tandai transaksi {{ addslashes($transaction->farmer_name) }} sebagai Selesai?', 'Ya, Selesaikan', false)">
                                         <span class="material-symbols-outlined">check_circle</span>
                                     </button>
                                 </form>
                                 @else
                                 <span class="p-xs text-primary/40" title="Sudah Selesai">
                                     <span class="material-symbols-outlined" style="font-variation-settings:'FILL' 1">check_circle</span>
                                 </span>
                                 @endif
                                 <form action="{{ route('admin.tonase.destroy', $transaction->id) }}" method="POST" class="inline">
                                     @csrf
                                     @method('DELETE')
                                     <button type="submit"
                                             class="p-xs text-error hover:bg-error/10 rounded-lg transition-colors"
                                             title="Hapus"
                                             onclick="return confirmSubmit(event, 'Hapus Transaksi', 'Apakah Anda yakin ingin menghapus data transaksi {{ addslashes($transaction->farmer_name) }}? Data tidak bisa dipulihkan.')">
                                         <span class="material-symbols-outlined">delete</span>
                                     </button>
                                 </form>
                             </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-lg py-md text-center text-on-surface-variant italic">Belum ada riwayat transaksi berat jagung.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Mobile Responsive Card View (Looping Dinamis) -->
        <div class="md:hidden divide-y divide-outline-variant" data-card="transactions">
            @foreach($transactions as $transaction)
            @php
                $words = explode(' ', $transaction->farmer_name);
                $initials = strtoupper(substr($words[0], 0, 1) . (isset($words[1]) ? substr($words[1], 0, 1) : ''));
            @endphp
            <div class="transaction-card space-y-md rounded-[1.25rem] border border-outline-variant bg-surface-container-lowest p-lg">
                <div class="flex items-start justify-between gap-4">
                    <div class="flex items-center gap-sm">
                        <div class="w-10 h-10 rounded-full bg-secondary-container text-on-secondary-container flex items-center justify-center font-bold">{{ $initials }}</div>
                        <div>
                            <p class="font-bold text-body-md">{{ $transaction->farmer_name }}</p>
                            <p class="text-label-sm text-on-surface-variant">{{ $transaction->created_at->format('d M Y') }}</p>
                        </div>
                    </div>
                    <span class="rounded-full bg-primary/10 px-3 py-1 text-label-sm font-bold text-primary">{{ number_format($transaction->tonnage, 3) }} Kg</span>
                </div>
                <div class="grid grid-cols-2 gap-sm text-label-sm">
                    <div class="rounded-xl bg-surface-container-low px-3 py-3">
                        <p class="text-on-surface-variant">Varietas</p>
                        <p class="font-bold">{{ $transaction->variety ?? 'Pioneer P35' }}</p>
                    </div>
                    <div class="rounded-xl bg-surface-container-low px-3 py-3">
                        <p class="text-on-surface-variant">Kadar Air</p>
                        <p class="font-bold">{{ $transaction->moisture ?? '14.0' }}%</p>
                    </div>
                </div>
                <div class="flex flex-wrap justify-end gap-3 pt-sm">
                    @if($transaction->status === 'Proses')
                    <form action="{{ route('admin.tonase.update_status', $transaction->id) }}" method="POST" class="inline">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="status" value="Selesai">
                        <button type="submit"
                                class="inline-flex items-center gap-xs text-primary font-bold"
                                onclick="return confirmSubmit(event, 'Selesaikan Transaksi', 'Tandai transaksi {{ addslashes($transaction->farmer_name) }} sebagai Selesai?', 'Ya, Selesaikan', false)">
                            <span class="material-symbols-outlined text-sm">check_circle</span> Selesai
                        </button>
                    </form>
                    @endif
                    <form action="{{ route('admin.tonase.destroy', $transaction->id) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="inline-flex items-center gap-xs text-error font-bold"
                                onclick="return confirmSubmit(event, 'Hapus Transaksi', 'Apakah Anda yakin ingin menghapus transaksi {{ addslashes($transaction->farmer_name) }}?')">
                            <span class="material-symbols-outlined text-sm">delete</span> Hapus
                        </button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <!-- Pagination Laravel Standar (Menyesuaikan Total Data Riil) -->
    <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
        <p class="text-label-md text-on-surface-variant">
            Menampilkan {{ $transactions->firstItem() ?? 0 }}-{{ $transactions->lastItem() ?? 0 }} dari {{ $transactions->total() }} data
        </p>
        <div class="flex flex-wrap items-center gap-2">
            {{ $transactions->links('pagination::tailwind') }}
        </div>
    </div>

    {{-- Success Toast --}}
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

@push('scripts')
<script>
    document.querySelectorAll('input[data-search-target="transactions"]').forEach(search => {
        search.addEventListener('input', event => {
            const value = event.target.value.toLowerCase();
            document.querySelectorAll('[data-table="transactions"] tr, [data-card="transactions"] .transaction-card').forEach(item => {
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
            chartSummary.textContent = `Data untuk ${event.target.value} — volume berat dibandingkan tren.`;
        });
    }

    chartBars.forEach(bar => {
        const parent = bar.closest('[data-value]');
        if (!parent) return;
        const value = parent.getAttribute('data-value');
        parent.addEventListener('mouseenter', () => {
            bar.classList.add('bg-primary-container');
            chartSummary.textContent = `${parent.querySelector('p').innerText}: ${value} Kg volume berat minggu ini.`;
        });
        parent.addEventListener('mouseleave', () => {
            bar.classList.remove('bg-primary-container');
            if (trendRange && chartSummary) {
                chartSummary.textContent = `Data untuk ${trendRange.value} — volume berat dibandingkan tren.`;
            }
        });
    });
</script>
@endpush