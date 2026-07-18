@extends('admin.layout.master')

@section('content')
<!-- Welcome Banner -->
<section class="relative overflow-hidden rounded-card bg-primary p-xl text-on-primary flex flex-col md:flex-row justify-between items-center gap-8 shadow-xl shadow-primary/10">
    <div class="relative z-10 text-center md:text-left space-y-4">
        <h2 class="text-3xl font-black tracking-tight">Selamat datang kembali, {{ auth()->user()->name }}</h2>
        <p class="text-lg text-primary-fixed opacity-90 max-w-md">Sistem Smart Dryer berjalan pada kapasitas optimal.</p>
        <div class="pt-4 flex flex-wrap justify-center md:justify-start gap-4">
            <button class="px-8 py-3 bg-white text-primary rounded-xl font-bold text-label-md hover:bg-opacity-90 transition-all shadow-lg shadow-black/5">Unduh Laporan</button>
            <button class="px-8 py-3 bg-white/20 text-white border border-white/30 rounded-xl font-bold text-label-md hover:bg-white/30 transition-all backdrop-blur-sm">Lihat Peringatan</button>
        </div>
    </div>
    <div class="relative w-full md:w-2/5 flex justify-center">
        <img class="h-56 md:h-64 object-contain" data-alt="Ilustrasi sistem pengering jagung pintar modern" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDymiH7TdgxUiggd1QulpfnU9hQ6zFijUt8TN42F-v294Qs-O4ZNzyaQBVkUUJm9PeuR6_4OnZyEHw1lkuWxUBHDuVHJd2kzs7Q5Sv8jSvu74F0aALBBr74rsOy0KDaPRsla-2xzLBAycBlTOsb-0oCmjpuUMMh423OXCX0eJlNd7U6E2UyA2P1R8TzO0-9Mp0IcwOgqeE3QaWimGfOQZcbGu1eI80XpKqiO8fIDXRjhMQTUwGLWF2GMQ"/>
    </div>
</section>

<!-- Notification Section -->
@if($showNotification)
<div class="p-lg bg-orange-50 border-l-4 border-l-orange-500 text-orange-900 rounded-[20px] shadow-md flex items-start gap-4 transition-all">
    <span class="material-symbols-outlined text-orange-600 text-2xl">warning</span>
    <div>
        <h4 class="font-bold text-base">Instruksi Pembalikan Jagung</h4>
        <p class="text-label-md mt-1 opacity-90">{{ $notificationMessage }}</p>
    </div>
</div>
@endif

<!-- Stats Grid -->
<section class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-gutter">
    <!-- Current Temperature -->
    <div class="soft-card p-lg border-l-4 border-l-orange-500 bg-white border border-black/5 rounded-[20px] shadow-md">
        <div class="flex justify-between items-start">
            <div class="space-y-1">
                <span class="text-label-md font-medium text-on-surface-variant">Suhu Saat Ini</span>
                <div class="text-3xl font-black text-on-surface">{{ $currentTemperature }}°C</div>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-orange-50 flex items-center justify-center text-orange-600">
                <span class="material-symbols-outlined text-2xl">thermostat</span>
            </div>
        </div>
        <div class="mt-6 flex items-center gap-2 text-primary font-bold text-xs uppercase tracking-widest">
            <span class="material-symbols-outlined text-[18px]">verified</span>
            <span>Rentang Optimal</span>
        </div>
    </div>
    <!-- Price -->
    <div class="soft-card p-lg border-l-4 border-l-primary bg-white border border-black/5 rounded-[20px] shadow-md">
        <div class="flex justify-between items-start">
            <div class="space-y-1">
                <span class="text-label-md font-medium text-on-surface-variant">Harga Pasar</span>
                <div class="text-3xl font-black text-on-surface">Rp {{ $marketPrice }}<span class="text-sm font-normal text-outline ml-1">/kg</span></div>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-secondary-container flex items-center justify-center text-secondary">
                <span class="material-symbols-outlined text-2xl">payments</span>
            </div>
        </div>
        <div class="mt-6 flex items-center gap-2 text-outline font-bold text-xs uppercase tracking-widest">
            <span class="material-symbols-outlined text-[18px]">history</span>
            <span>Diperbarui: {{ $priceUpdatedTime }}</span>
        </div>
    </div>
    <!-- Farmers -->
    <div class="soft-card p-lg border-l-4 border-l-tertiary bg-white border border-black/5 rounded-[20px] shadow-md">
        <div class="flex justify-between items-start">
            <div class="space-y-1">
                <span class="text-label-md font-medium text-on-surface-variant">Total Petani</span>
                <div class="text-3xl font-black text-on-surface">{{ $totalFarmers }}<span class="text-sm font-normal text-outline ml-1">petani</span></div>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-tertiary-fixed flex items-center justify-center text-tertiary">
                <span class="material-symbols-outlined text-2xl">groups</span>
            </div>
        </div>
        <div class="mt-6 flex items-center gap-2 text-primary font-bold text-xs uppercase tracking-widest">
            <span class="material-symbols-outlined text-[18px]">person_add</span>
            <span>+{{ $farmersThisWeek }} minggu ini</span>
        </div>
    </div>
    <!-- Tonnage -->
    <div class="soft-card p-lg border-l-4 border-l-secondary bg-white border border-black/5 rounded-[20px] shadow-md">
        <div class="flex justify-between items-start">
            <div class="space-y-1">
                <span class="text-label-md font-medium text-on-surface-variant">Total Tonase</span>
                <div class="text-3xl font-black text-on-surface">{{ $totalTonnageFormatted }}<span class="text-sm font-normal text-outline ml-1">MT</span></div>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-secondary-container flex items-center justify-center text-on-secondary-container">
                <span class="material-symbols-outlined text-2xl">weight</span>
            </div>
        </div>
        <div class="mt-6 flex items-center gap-2 text-primary font-bold text-xs uppercase tracking-widest">
            <span class="material-symbols-outlined text-[18px]">trending_up</span>
            <span>{{ $momGrowthFormatted }}</span>
        </div>
    </div>
</section>

<!-- Charts and Data -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-gutter">
    <!-- Progress Chart -->
    <div class="lg:col-span-2 bg-white border border-black/5 rounded-[20px] shadow-md p-xl flex flex-col">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-xl gap-4">
            <div>
                <h3 class="text-xl font-bold text-on-surface">Kurva Pemrosesan Batch</h3>
                <p class="text-label-md text-outline mt-1">Penurunan kadar air untuk antrean aktif</p>
            </div>
            <!-- Menggunakan Nama Petani Aktif Secara Dinamis -->
            <div class="px-4 py-1.5 bg-primary/10 text-primary rounded-full font-bold text-xs">
                Aktif: {{ $activeFarmerName }}
            </div>
        </div>
        <div class="flex-1 min-h-[350px]">
            <canvas id="moistureChart"></canvas>
        </div>
    </div>
    <!-- Central Monitoring Section -->
    <div class="bg-white border border-black/5 rounded-[20px] shadow-md p-xl flex flex-col gap-lg">
        <h3 class="text-xl font-bold text-on-surface">Status Mesin</h3>
        <div class="flex-1 flex flex-col justify-center items-center py-8 space-y-8">
            <!-- Gauge Simulation -->
            <div class="relative w-56 h-56 flex items-center justify-center">
                <svg class="w-full h-full transform -rotate-90">
                    <circle class="text-surface-container" cx="112" cy="112" fill="transparent" r="95" stroke="currentColor" stroke-width="14"></circle>
                    @php
                        $percentage = max(0, min(100, $currentMoisture));
                        $dashoffset = 597 - (597 * $percentage / 100);
                    @endphp
                    <circle class="text-primary" cx="112" cy="112" fill="transparent" r="95" stroke="currentColor" stroke-dasharray="597" stroke-dashoffset="{{ $dashoffset }}" stroke-linecap="round" stroke-width="14"></circle>
                </svg>
                <div class="absolute inset-0 flex flex-col items-center justify-center text-center">
                    <span class="text-4xl font-black text-on-surface">{{ $currentMoisture }}%</span>
                    <span class="text-[10px] text-outline font-black uppercase tracking-[0.2em] mt-1">Kelembaban</span>
                </div>
            </div>
            <div class="grid grid-cols-2 gap-4 w-full">
                <div class="p-5 bg-surface-container-low rounded-2xl text-center border border-outline-variant/30">
                    <p class="text-xs font-bold text-outline mb-2 uppercase tracking-wider">Suhu</p>
                    <p class="text-xl font-black text-on-surface">{{ $currentTemperature }}°C</p>
                </div>
                <div class="p-5 bg-surface-container-low rounded-2xl text-center border border-outline-variant/30">
                    <p class="text-xs font-bold text-outline mb-2 uppercase tracking-wider">Kipas</p>
                    <!-- Menggunakan Kecepatan Kipas Dinamis -->
                    <p class="text-xl font-black text-on-surface">{{ $currentFanSpeed }}</p>
                </div>
            </div>
        </div>
        <div class="mt-auto p-6 bg-primary/5 rounded-2xl border border-primary/10">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 bg-primary rounded-xl flex items-center justify-center text-white shadow-lg shadow-primary/20">
                    <span class="material-symbols-outlined">memory</span>
                </div>
                <div>
                    <p class="text-label-md font-black text-on-surface">Unit Pintar 01</p>
                    <p class="text-xs text-primary font-bold">Siklus Pemanasan</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Recent Transactions Table -->
<section class="bg-white border border-black/5 rounded-[20px] shadow-md overflow-hidden">
    <div class="px-xl py-lg border-b border-outline-variant/50 flex justify-between items-center bg-white">
        <h3 class="text-xl font-bold text-on-surface">Transaksi & Log Terbaru</h3>
        <button class="text-primary font-bold text-label-md hover:underline flex items-center gap-1">
            Semua Log <span class="material-symbols-outlined text-sm">arrow_forward_ios</span>
        </button>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-left mobile-table-card">
            <thead class="bg-surface-container-low/50 text-on-surface-variant">
                <tr>
                    <th class="px-xl py-5 text-[11px] font-black uppercase tracking-widest">Nama Petani</th>
                    <th class="px-xl py-5 text-[11px] font-black uppercase tracking-widest">Tonase</th>
                    <th class="px-xl py-5 text-[11px] font-black uppercase tracking-widest">Waktu Masuk</th>
                    <th class="px-xl py-5 text-[11px] font-black uppercase tracking-widest">Status</th>
                    <th class="px-xl py-5 text-[11px] font-black uppercase tracking-widest text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-outline-variant/30">
                @forelse($recentTransactions as $transaction)
                <tr class="hover:bg-surface-container-low/30 transition-colors">
                    <td class="px-xl py-6 font-bold text-on-surface" data-label="Nama Petani">{{ $transaction->farmer_name }}</td>
                    <td class="px-xl py-6 text-on-surface-variant" data-label="Tonase">{{ $transaction->tonnage }} MT</td>
                    <td class="px-xl py-6 text-on-surface-variant" data-label="Waktu Masuk">{{ $transaction->created_at->format('H:i A') }}</td>
                    <td class="px-xl py-6" data-label="Status">
                        @if($transaction->status === 'Proses')
                        <span class="inline-flex items-center gap-2 bg-amber-50 text-amber-700 text-[11px] font-black uppercase px-4 py-1.5 rounded-full border border-amber-200">
                            <span class="w-1.5 h-1.5 bg-amber-500 rounded-full animate-pulse"></span>
                            Proses
                        </span>
                        @else
                        <span class="inline-flex items-center gap-2 bg-emerald-50 text-emerald-700 text-[11px] font-black uppercase px-4 py-1.5 rounded-full border border-emerald-200">
                            <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full"></span>
                            Selesai
                        </span>
                        @endif
                    </td>
                    <td class="px-xl py-6 text-center" data-label="Aksi">
                        <button class="text-outline hover:text-primary material-symbols-outlined p-2 hover:bg-primary/10 rounded-xl transition-all">visibility</button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-xl py-6 text-center text-outline font-medium">Belum ada log transaksi hari ini.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</section>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('moistureChart').getContext('2d');
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: {!! json_encode($chartLabels) !!},
            datasets: [{
                label: 'Kadar Air (%)',
                data: {!! json_encode($chartMoistureData) !!},
                borderColor: '#0d631b',
                backgroundColor: 'rgba(13, 99, 27, 0.05)',
                fill: true,
                tension: 0.4,
                borderWidth: 4,
                pointBackgroundColor: '#ffffff',
                pointBorderColor: '#0d631b',
                pointBorderWidth: 3,
                pointRadius: 6,
                pointHoverRadius: 8,
                pointHoverBorderWidth: 4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            interaction: {
                intersect: false,
                mode: 'index',
            },
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    backgroundColor: '#111c2d',
                    padding: 12,
                    titleFont: { family: 'Inter', size: 13, weight: '700' },
                    bodyFont: { family: 'Inter', size: 12 },
                    cornerRadius: 12,
                    displayColors: false,
                    callbacks: {
                        label: (item) => `Kadar Air: ${item.formattedValue}%`
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: false,
                    border: { display: false },
                    grid: {
                        color: 'rgba(0,0,0,0.03)',
                        drawTicks: false
                    },
                    ticks: {
                        font: { family: 'Inter', size: 11, weight: '500' },
                        padding: 15,
                        callback: function(value) { return value + '%'; }
                    }
                },
                x: {
                    border: { display: false },
                    grid: { display: false },
                    ticks: {
                        font: { family: 'Inter', size: 11, weight: '500' },
                        padding: 15
                    }
                }
            }
        }
    });
</script>
@endpush