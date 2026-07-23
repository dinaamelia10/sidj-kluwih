@extends('admin.layout.master')

@section('content')
        <div class="space-y-lg">
            <!-- Page Header -->
            <div class="flex flex-col gap-4 md:flex-row md:items-end md:justify-between">
                <div>
                    <nav class="flex flex-wrap items-center gap-2 text-on-surface-variant font-label-sm text-label-sm mb-2">
                        <a class="hover:text-primary" href="{{ route('admin.dashboard') }}">Dashboard</a>
                        <span class="material-symbols-outlined text-[14px]">chevron_right</span>
                        <span class="text-primary font-bold">Monitoring & Timer Pengeringan</span>
                    </nav>
                    <h1 class="font-headline-lg text-headline-lg font-extrabold text-on-surface">Monitoring Suhu & Timer Pengeringan</h1>
                    <p class="text-on-surface-variant font-body-md text-body-md mt-2">Pantau kinerja kompor, timer jam pengeringan, dan riwayat operasional alat secara real-time.</p>
                </div>
                <div class="flex flex-wrap items-center gap-sm">
                    <button type="button" onclick="openStartDryingModal()" class="inline-flex items-center gap-sm rounded-2xl bg-primary px-lg py-3 text-white font-black transition hover:bg-primary/90 shadow-md active:scale-95 cursor-pointer">
                        <span class="material-symbols-outlined">timer</span>
                        🚀 Start Jam Pengeringan
                    </button>
                    <button type="button" onclick="window.print()" class="inline-flex items-center gap-sm rounded-2xl bg-surface-container-lowest px-lg py-3 text-on-surface font-bold transition border border-outline-variant hover:bg-surface-container-low shadow-sm active:scale-95">
                        <span class="material-symbols-outlined">print</span>
                        Cetak Grafik
                    </button>
                    <a href="{{ route('admin.pemantauan.export') }}" class="inline-flex items-center gap-sm rounded-2xl bg-primary-container px-lg py-3 text-on-primary-container font-bold transition hover:bg-primary active:scale-95 shadow-md">
                        <span class="material-symbols-outlined">download</span>
                        Export Data CSV
                    </a>
                </div>
            </div>

            <!-- Flash Success Message -->
            @if(session('success'))
            <div class="p-lg bg-emerald-50 border-l-4 border-l-emerald-500 text-emerald-900 rounded-[20px] shadow-md flex items-center justify-between gap-4 transition-all">
                <div class="flex items-center gap-3">
                    <span class="material-symbols-outlined text-emerald-600 text-2xl">check_circle</span>
                    <p class="font-bold text-body-md">{{ session('success') }}</p>
                </div>
                <button onclick="this.parentElement.remove()" class="text-emerald-700 hover:text-emerald-900">
                    <span class="material-symbols-outlined">close</span>
                </button>
            </div>
            @endif
            
            <!-- Status Highlight Cards (Bento style) -->
            <div class="grid grid-cols-1 gap-lg md:grid-cols-3">
                <!-- Suhu Saat Ini -->
                <div
                    class="bg-surface-container-lowest p-lg rounded-[20px] border border-outline-variant shadow-sm relative overflow-hidden group">
                    <div class="flex justify-between items-start mb-md">
                        <div class="space-y-1">
                            <p class="text-on-surface-variant font-label-md">Suhu Kompor</p>
                            <h3 class="text-[40px] font-bold text-primary leading-none" id="realtime-temp">{{ $currentTemperature }}°C</h3>
                        </div>
                        <div
                            class="w-10 h-10 rounded-full bg-secondary-container text-on-secondary-container flex items-center justify-center text-on-secondary-container">
                            <span class="material-symbols-outlined" data-icon="thermostat">thermostat</span>
                        </div>
                    </div>
                    <div class="flex items-center gap-sm">
                        <span
                            class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full {{ $statusClass }} text-[10px] font-bold uppercase tracking-wider">
                            <span class="w-1.5 h-1.5 rounded-full bg-current animate-pulse"></span>
                            {{ $statusMesin }}
                        </span>
                        <span class="text-[12px] text-on-surface-variant">Safety monitor kompor</span>
                    </div>
                </div>

                <!-- Durasi & Progres Pengeringan -->
                <div
                    class="bg-surface-container-lowest p-lg rounded-[20px] border border-outline-variant shadow-sm relative overflow-hidden group">
                    <div class="flex justify-between items-start mb-md">
                        <div class="space-y-1">
                            <p class="text-on-surface-variant font-label-md">Timer Pengeringan</p>
                            <h3 class="text-[40px] font-bold text-on-surface leading-none tabular-nums" id="timer">{{ $timerString }}</h3>
                        </div>
                        <div
                            class="w-10 h-10 rounded-full bg-tertiary-fixed text-on-tertiary-fixed flex items-center justify-center">
                            <span class="material-symbols-outlined" data-icon="schedule">schedule</span>
                        </div>
                    </div>
                    <div class="flex items-center gap-sm">
                        <div class="flex-1 bg-surface-container-high h-2 rounded-full overflow-hidden">
                            <div class="bg-primary h-full" style="width: {{ $progressPercent }}%; transition: width 1s ease-in-out;"></div>
                        </div>
                        <span class="font-label-md text-on-surface-variant">{{ $progressPercent }}%</span>
                    </div>
                    <div class="flex justify-between mt-2 text-[11px] text-on-surface-variant font-medium">
                        <span>Status: {{ $statusMesin }}</span>
                        <span>Target: {{ $activeSession ? $activeSession->formatted_target_hours : '3 Jam' }}</span>
                    </div>
                </div>

                <!-- Sesi Pengeringan Active -->
                <div
                    class="bg-surface-container-lowest p-lg rounded-[20px] border border-outline-variant shadow-sm relative overflow-hidden group flex flex-col justify-between">
                    <div class="flex justify-between items-start">
                        <div class="space-y-1">
                            <p class="text-on-surface-variant font-label-md">Sesi Pengeringan</p>
                            <h3 class="text-lg font-bold text-primary truncate max-w-[170px]">{{ $activeSession ? $activeSession->batch_name : 'Tidak Ada Sesi' }}</h3>
                            <p class="text-xs text-outline">{{ $activeSession ? $activeSession->farmer_name : 'Klik tombol start di atas' }}</p>
                        </div>
                        <div
                            class="w-10 h-10 rounded-full bg-secondary-container text-on-secondary-container flex items-center justify-center text-on-secondary-container">
                            <span class="material-symbols-outlined">grain</span>
                        </div>
                    </div>
                    <div class="mt-3">
                        @if($activeSession)
                        <form action="{{ route('admin.drying.stop', $activeSession->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghentikan pengeringan ini?');">
                            @csrf
                            <button type="submit" class="w-full py-2 px-3 bg-red-50 text-red-700 hover:bg-red-100 border border-red-200 font-bold rounded-xl text-xs transition-all flex items-center justify-center gap-1">
                                <span class="material-symbols-outlined text-sm">stop_circle</span>
                                Hentikan Sesi
                            </button>
                        </form>
                        @else
                        <button type="button" onclick="openStartDryingModal()" class="w-full py-2 px-3 bg-primary text-white hover:bg-primary/90 font-bold rounded-xl text-xs transition-all flex items-center justify-center gap-1 cursor-pointer">
                            <span class="material-symbols-outlined text-sm">play_arrow</span>
                            Start Pengeringan
                        </button>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Main Chart Area -->
            <div class="bg-surface-container-lowest rounded-[20px] border border-outline-variant shadow-sm p-lg relative" id="chart-print-area">
                <div class="hidden print-header mb-4 p-4 border-b border-gray-300">
                    <h2 class="text-xl font-bold text-gray-900">🌽 SIDJ-Kluwih — Grafik Monitoring Suhu Smart Dryer</h2>
                    <p class="text-xs text-gray-600">Unit Pengeringan 01 • Tanggal Cetak: {{ \Carbon\Carbon::now()->translatedFormat('d F Y, H:i') }} WIB</p>
                </div>
                <div class="flex items-center justify-between mb-lg">
                    <div class="flex items-center gap-md">
                        <div class="w-1.5 h-6 bg-primary rounded-full"></div>
                        <h3 class="font-title-lg text-title-lg text-on-surface">Grafik Suhu Realtime Kompor</h3>
                    </div>
                    <div class="flex items-center gap-sm">
                        <span class="flex items-center gap-1.5 text-label-md text-on-surface-variant">
                            <span class="w-3 h-3 rounded-full bg-primary"></span>
                            Suhu Dryer
                        </span>
                    </div>
                </div>
                <!-- SVG Chart Dinamis Menggunakan Jalur Koordinat ($svgPoints) & Titik Per 30 Menit -->
                <div class="h-64 md:h-80 w-full relative">
                    <svg class="w-full h-full preserve-3d" preserveAspectRatio="none" viewBox="0 0 1000 300">
                        <line stroke="#e2e8f0" stroke-dasharray="4" stroke-width="1" x1="0" x2="1000" y1="50" y2="50"></line>
                        <line stroke="#e2e8f0" stroke-dasharray="4" stroke-width="1" x1="0" x2="1000" y1="125" y2="125"></line>
                        <line stroke="#e2e8f0" stroke-dasharray="4" stroke-width="1" x1="0" x2="1000" y1="200" y2="200"></line>
                        <line stroke="#e2e8f0" stroke-dasharray="4" stroke-width="1" x1="0" x2="1000" y1="275" y2="275"></line>
                        
                        <path d="{{ $svgPoints }} L1000,300 L0,300 Z" fill="url(#chartGradient)"></path>
                        <path d="{{ $svgPoints }}" fill="none" stroke="#0d631b" stroke-linecap="round" stroke-width="3"></path>
                        
                        <!-- Loop titik interval per 30 menit (misal 08:00, 08:30, 09:00, dst) -->
                        @foreach($chartTicks as $tk)
                        <circle cx="{{ $tk['x'] ?? 0 }}" cy="{{ $tk['y'] ?? 200 }}" r="6" fill="{{ $tk['is_past'] ? '#0d631b' : '#94a3b8' }}" stroke="#ffffff" stroke-width="2" class="{{ $loop->last && $activeSession ? 'animate-pulse' : '' }}">
                            <title>Jam {{ $tk['time'] }} — Suhu: {{ $tk['temp'] }}°C</title>
                        </circle>
                        @endforeach

                        <defs>
                            <linearGradient id="chartGradient" x1="0" x2="0" y1="0" y2="1">
                                <stop offset="0%" stop-color="#0d631b" stop-opacity="0.2"></stop>
                                <stop offset="100%" stop-color="#0d631b" stop-opacity="0"></stop>
                            </linearGradient>
                        </defs>
                    </svg>
                    <div class="absolute top-0 left-0 h-full flex flex-col justify-between text-[10px] text-on-surface-variant font-bold pb-2">
                        <span>100°C</span>
                        <span>75°C</span>
                        <span>50°C</span>
                        <span>25°C</span>
                        <span>0°C</span>
                    </div>
                </div>
                <!-- Sumbu X: Titik Jam Per 30 Menit (Setengah Jam) -->
                <div class="flex justify-between mt-4 text-[11px] text-on-surface-variant font-bold px-2 border-t border-slate-100 pt-3">
                    @foreach($chartTicks as $tk)
                    <div class="text-center">
                        <span class="block {{ $tk['is_past'] ? 'text-primary font-black' : 'text-slate-400' }}">{{ $tk['time'] }}</span>
                        <span class="text-[9px] text-slate-400 font-normal">{{ $tk['temp'] }}°C</span>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Machine Usage History Section (Riwayat Penggunaan Alat Lengkap) -->
            <div class="bg-surface-container-lowest rounded-[20px] border border-outline-variant shadow-sm overflow-hidden">
                <div class="p-lg border-b border-outline-variant">
                    <div class="flex flex-col md:flex-row md:items-center justify-between gap-md">
                        <div class="flex items-center gap-md">
                            <div class="w-1.5 h-6 bg-primary rounded-full"></div>
                            <div>
                                <h3 class="font-title-lg text-title-lg text-on-surface font-extrabold">Riwayat Penggunaan Alat (Operasional Mesin)</h3>
                                <p class="text-xs text-on-surface-variant">Pencatatan sesi pengeringan, durasi jam operasional, dan notifikasi WA.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="overflow-x-auto hide-scrollbar">
                    <table class="w-full text-left border-collapse">
                        <thead class="bg-surface-container-low">
                            <tr>
                                <th class="px-lg py-md font-label-md text-on-surface-variant">Nama Batch / Mitra</th>
                                <th class="px-lg py-md font-label-md text-on-surface-variant">Waktu Mulai</th>
                                <th class="px-lg py-md font-label-md text-on-surface-variant">Jam Selesai</th>
                                <th class="px-lg py-md font-label-md text-on-surface-variant">Target Jam</th>
                                <th class="px-lg py-md font-label-md text-on-surface-variant">Total Durasi</th>
                                <th class="px-lg py-md font-label-md text-on-surface-variant">Status Sesi</th>
                                <th class="px-lg py-md font-label-md text-on-surface-variant">Notif WA</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-outline-variant text-sm">
                            @forelse($historySessions as $session)
                            <tr class="hover:bg-surface-container-low/30 transition-colors">
                                <td class="px-lg py-md font-bold text-on-surface">
                                    {{ $session->batch_name }}
                                    <span class="block text-xs font-normal text-on-surface-variant">{{ $session->farmer_name }}</span>
                                </td>
                                <td class="px-lg py-md text-on-surface-variant">
                                    {{ $session->start_time ? $session->start_time->format('d M Y, H:i') : '-' }}
                                </td>
                                <td class="px-lg py-md text-on-surface-variant">
                                    {{ $session->end_time ? $session->end_time->format('H:i') : '-' }}
                                </td>
                                <td class="px-lg py-md font-bold text-on-surface">
                                    {{ $session->formatted_target_hours }}
                                </td>
                                <td class="px-lg py-md text-on-surface-variant">
                                    {{ $session->formatted_actual_duration }}
                                </td>
                                <td class="px-lg py-md">
                                    @if($session->status === 'Berjalan')
                                    <span class="px-3 py-1 rounded-full bg-primary/10 text-primary border border-primary/20 text-xs font-bold inline-flex items-center gap-1.5">
                                        <span class="w-1.5 h-1.5 rounded-full bg-primary animate-pulse"></span>
                                        Berjalan
                                    </span>
                                    @elseif($session->status === 'Selesai')
                                    <span class="px-3 py-1 rounded-full bg-emerald-50 text-emerald-700 border border-emerald-200 text-xs font-bold inline-flex items-center gap-1.5">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                        Selesai
                                    </span>
                                    @else
                                    <span class="px-3 py-1 rounded-full bg-gray-100 text-gray-600 border border-gray-300 text-xs font-bold">
                                        Dibatalkan
                                    </span>
                                    @endif
                                </td>
                                <td class="px-lg py-md">
                                    @if($session->wa_notified)
                                    <span class="text-xs font-bold text-emerald-600 flex items-center gap-1">
                                        <span class="material-symbols-outlined text-base">check_circle</span>
                                        Terkirim
                                    </span>
                                    @else
                                    <span class="text-xs text-on-surface-variant italic">Menunggu</span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="px-lg py-md text-center text-on-surface-variant italic">Belum ada data riwayat penggunaan alat.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="p-lg border-t border-outline-variant">
                    {{ $historySessions->links() }}
                </div>
            </div>
        </div>

<!-- MODAL START JAM PENGERINGAN -->
<div id="startDryingModal" class="fixed inset-0 z-50 hidden bg-black/60 backdrop-blur-sm flex items-center justify-center p-4">
    <div class="bg-white rounded-3xl max-w-md w-full p-xl shadow-2xl space-y-6 relative animate-in fade-in zoom-in duration-200">
        <div class="flex items-center justify-between border-b border-slate-100 pb-4">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-2xl bg-primary/10 text-primary flex items-center justify-center font-bold">
                    <span class="material-symbols-outlined">timer</span>
                </div>
                <div>
                    <h3 class="text-lg font-extrabold text-slate-900">Start Jam Pengeringan</h3>
                    <p class="text-xs text-slate-500">Atur durasi jam operasional mesin</p>
                </div>
            </div>
            <button type="button" onclick="closeStartDryingModal()" class="text-slate-400 hover:text-slate-700 p-1">
                <span class="material-symbols-outlined">close</span>
            </button>
        </div>

        <form action="{{ route('admin.drying.start') }}" method="POST" class="space-y-5">
            @csrf
            <div>
                <label class="block text-xs uppercase font-bold text-slate-700 mb-2">Input Durasi Pengeringan (Jam) <span class="text-red-500">*</span></label>
                <div class="relative">
                    <input type="number" step="0.1" name="target_duration_hours" value="3.0" min="0.1" max="48" required
                           class="w-full text-xl font-bold bg-slate-50 border border-slate-200 rounded-2xl px-4 py-3.5 outline-none focus:border-primary focus:bg-white transition-all text-slate-900 pr-16" placeholder="Misal: 3">
                    <span class="absolute right-4 top-1/2 -translate-y-1/2 font-bold text-slate-400">Jam</span>
                </div>
                <p class="text-[11px] text-slate-500 mt-1">Notifikasi WA otomatis dikirim saat durasi ini tercapai.</p>
            </div>

            <!-- Quick Duration Selection Buttons -->
            <div>
                <label class="block text-xs font-bold text-slate-600 mb-1.5">Pilihan Cepat:</label>
                <div class="flex gap-2">
                    <button type="button" onclick="setDuration(1)" class="px-3 py-1.5 bg-slate-100 hover:bg-primary/10 hover:text-primary text-slate-700 font-bold rounded-xl text-xs transition-all">1 Jam</button>
                    <button type="button" onclick="setDuration(2)" class="px-3 py-1.5 bg-slate-100 hover:bg-primary/10 hover:text-primary text-slate-700 font-bold rounded-xl text-xs transition-all">2 Jam</button>
                    <button type="button" onclick="setDuration(3)" class="px-3 py-1.5 border border-primary bg-primary/10 text-primary font-bold rounded-xl text-xs transition-all">3 Jam</button>
                    <button type="button" onclick="setDuration(4)" class="px-3 py-1.5 bg-slate-100 hover:bg-primary/10 hover:text-primary text-slate-700 font-bold rounded-xl text-xs transition-all">4 Jam</button>
                </div>
            </div>

            <div>
                <label class="block text-xs uppercase font-bold text-slate-700 mb-1">Nama Batch / Catatan (Opsional)</label>
                <input type="text" name="batch_name" placeholder="Misal: Batch 01 Kompor Utama"
                       class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-4 py-3 text-sm outline-none focus:border-primary focus:bg-white transition-all text-slate-900">
            </div>

            <div>
                <label class="block text-xs uppercase font-bold text-slate-700 mb-1">Nama Petani / Mitra (Opsional)</label>
                <input type="text" name="farmer_name" placeholder="Misal: Pak Budi - Kluwih"
                       class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-4 py-3 text-sm outline-none focus:border-primary focus:bg-white transition-all text-slate-900">
            </div>

            <div class="pt-2 flex justify-end gap-3">
                <button type="button" onclick="closeStartDryingModal()" class="px-5 py-3 rounded-2xl font-bold text-slate-600 hover:bg-slate-100 transition-all text-sm">
                    Batal
                </button>
                <button type="submit" class="px-6 py-3 bg-primary hover:bg-primary/90 text-white rounded-2xl font-bold transition-all shadow-md text-sm flex items-center gap-2">
                    <span class="material-symbols-outlined text-base">play_arrow</span>
                    Mulai Sesi
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('styles')
<style>
    @media print {
        body * {
            visibility: hidden !important;
        }
        #chart-print-area, #chart-print-area * {
            visibility: visible !important;
        }
        #chart-print-area .print-header {
            display: block !important;
        }
        #chart-print-area {
            position: absolute !important;
            left: 0 !important;
            top: 0 !important;
            width: 100% !important;
            background: white !important;
            border: none !important;
            box-shadow: none !important;
            padding: 20px !important;
        }
        @page {
            size: landscape;
            margin: 1.5cm;
        }
    }
</style>
@endpush

@push('scripts')
    <script>
        function openStartDryingModal() {
            const modal = document.getElementById('startDryingModal');
            if (modal) modal.classList.remove('hidden');
        }

        function closeStartDryingModal() {
            const modal = document.getElementById('startDryingModal');
            if (modal) modal.classList.add('hidden');
        }

        function setDuration(val) {
            const input = document.querySelector('input[name="target_duration_hours"]');
            if (input) input.value = val;
        }

        // Timer Realtime Local Increment & Auto Server Check
        let seconds = {{ (int) $durationInSeconds }}; 
        
        setInterval(() => {
            seconds++;
            const h = Math.floor(seconds / 3600).toString().padStart(2, '0');
            const m = Math.floor((seconds % 3600) / 60).toString().padStart(2, '0');
            const s = Math.floor(seconds % 60).toString().padStart(2, '0');
            
            const timerElement = document.getElementById('timer');
            if (timerElement) {
                timerElement.innerText = `${h}:${m}:${s}`;
            }
        }, 1000);

        // Auto check timer every 10 seconds to sync timer and trigger WA on completion
        setInterval(function() {
            fetch("{{ route('admin.drying.check_timer') }}")
                .then(res => res.json())
                .then(data => {
                    if (data.has_active) {
                        if (data.is_finished) {
                            window.location.reload();
                        }
                    }
                })
                .catch(err => console.error(err));
        }, 10000);
    </script>
@endpush