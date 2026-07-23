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
                    <div class="flex flex-wrap items-center gap-3">
                        <h1 class="font-headline-lg text-headline-lg font-extrabold text-on-surface">Monitoring Suhu & Timer Pengeringan</h1>
                        <!-- MQTT Connection Status Pill -->
                        <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full border border-red-300 text-red-600 bg-red-50 text-xs font-bold transition-all shadow-sm animate-pulse" id="mqtt-status-pill">
                            <span class="w-2 h-2 rounded-full bg-red-600 shadow animate-pulse" id="mqtt-status-dot"></span>
                            <span id="mqtt-status-text">DISCONNECTED</span>
                        </div>
                    </div>
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
                <div class="bg-surface-container-lowest p-lg rounded-[20px] border border-outline-variant shadow-sm relative overflow-hidden group flex flex-col justify-between">
                    <div class="flex justify-between items-start mb-2">
                        <div class="space-y-1">
                            <p class="text-on-surface-variant font-label-md">Suhu Kompor</p>
                            <h3 class="text-[32px] font-bold text-primary leading-none" id="realtime-temp">{{ $currentTemperature }}°C</h3>
                        </div>
                        <div class="w-10 h-10 rounded-full bg-secondary-container text-on-secondary-container flex items-center justify-center">
                            <span class="material-symbols-outlined">thermostat</span>
                        </div>
                    </div>
                    
                    <!-- Gauge Wrapper -->
                    <div class="relative h-28 flex justify-center items-end mb-2">
                        <canvas id="gaugeChart" class="max-w-[160px] max-h-[80px]"></canvas>
                        <div class="absolute bottom-2 text-center">
                            <div class="text-2xl font-black text-on-surface font-mono" id="gauge-val">{{ $currentTemperature }}</div>
                            <div class="text-[8px] text-on-surface-variant uppercase tracking-wider font-bold">CELSIUS</div>
                        </div>
                    </div>
                    <div class="flex justify-between px-6 text-[10px] font-bold text-on-surface-variant mt-[-10px] mb-4">
                        <span>0</span>
                        <span>70</span>
                    </div>

                    <div class="flex items-center gap-sm">
                        <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full {{ $statusClass }} text-[10px] font-bold uppercase tracking-wider" id="status-mesin-badge">
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
            </div>            <!-- Main Chart Area -->
            <div class="bg-surface-container-lowest rounded-[20px] border border-outline-variant shadow-sm p-lg relative" id="chart-print-area">
                <div class="hidden print-header mb-4 p-4 border-b border-gray-300">
                    <h2 class="text-xl font-bold text-gray-900">🌽 SIDJ-Kluwih — Grafik Monitoring Suhu Smart Dryer</h2>
                    <p class="text-xs text-gray-600">Unit Pengeringan 01 • Tanggal Cetak: {{ \Carbon\Carbon::now()->translatedFormat('d F Y, H:i') }} WIB</p>
                </div>
                <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between mb-lg">
                    <div class="flex items-center gap-md">
                        <div class="w-1.5 h-6 bg-primary rounded-full"></div>
                        <h3 class="font-title-lg text-title-lg text-on-surface font-extrabold">Grafik Riwayat Suhu (Real-time)</h3>
                    </div>
                    <div class="flex flex-wrap items-center gap-3">
                        <div class="flex items-center gap-2">
                            <label for="timeRange" class="text-xs text-on-surface-variant font-bold">Rentang Waktu:</label>
                            <select id="timeRange" class="rounded-xl border border-outline-variant bg-surface-container-lowest px-3 py-1.5 text-xs font-bold text-on-surface outline-none cursor-pointer hover:bg-surface-container-low transition">
                                <option value="10">10 Menit</option>
                                <option value="30">30 Menit</option>
                                <option value="60" selected>1 Jam</option>
                                <option value="120">2 Jam</option>
                                <option value="180">3 Jam</option>
                                <option value="240">4 Jam</option>
                                <option value="300">5 Jam</option>
                                <option value="360">6 Jam</option>
                            </select>
                        </div>
                        
                        <button type="button" onclick="clearDashboardData()" class="inline-flex items-center gap-sm rounded-xl bg-red-50 hover:bg-red-100 border border-red-200 px-3 py-1.5 text-xs text-red-700 font-bold transition shadow-sm cursor-pointer">
                            <span class="material-symbols-outlined text-sm">delete_sweep</span>
                            Hapus Data Firebase
                        </button>
                    </div>
                </div>

                <!-- Canvas Chart.js -->
                <div class="h-64 md:h-80 w-full relative">
                    <canvas id="tempChart"></canvas>
                </div>
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
    <!-- MQTT.js library -->
    <script src="https://unpkg.com/mqtt/dist/mqtt.min.js"></script>
    
    <!-- Chart.js library -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Firebase SDK & Real-time Client Module -->
    <script type="module">
        import { initializeApp } from "https://www.gstatic.com/firebasejs/10.8.1/firebase-app.js";
        import { getDatabase, ref, get, remove, child } from "https://www.gstatic.com/firebasejs/10.8.1/firebase-database.js";

        const firebaseConfig = {
            apiKey: "AIzaSyABrUnTyBhYrV6nF85gRrKlzAYJ2ZFLAGw",
            authDomain: "dryerjagung-63ad6.firebaseapp.com",
            databaseURL: "https://dryerjagung-63ad6-default-rtdb.asia-southeast1.firebasedatabase.app",
            projectId: "dryerjagung-63ad6",
            storageBucket: "dryerjagung-63ad6.firebasestorage.app",
            messagingSenderId: "289609597211",
            appId: "1:289609597211:web:ed099c191423e2c06553be",
            measurementId: "G-QMETET7CL3"
        };

        const app = initializeApp(firebaseConfig);
        const database = getDatabase(app);

        const MAX_TEMP = 70.0;
        const CRITICAL_TEMP = 60.0;
        Chart.defaults.color = '#40493d';
        Chart.defaults.font.family = "'Inter', sans-serif";

        let masterDataHistory = [];
        let selectedMinutes = 60;
        let lastPostTime = 0; // for local sync throttle

        // 1. Line Chart initialization
        const ctxTemp = document.getElementById('tempChart').getContext('2d');
        const tempChart = new Chart(ctxTemp, {
            type: 'line',
            data: { 
                labels: [], 
                datasets: [{ 
                    data: [], 
                    borderColor: '#0d631b', 
                    backgroundColor: 'rgba(13, 99, 27, 0.1)', 
                    borderWidth: 2, 
                    fill: true, 
                    tension: 0.4 
                }] 
            },
            options: { 
                responsive: true, 
                maintainAspectRatio: false, 
                plugins: { legend: { display: false } }, 
                scales: { 
                    x: { grid: { color: 'rgba(0, 0, 0, 0.05)', drawBorder: false } }, 
                    y: { min: 20, max: MAX_TEMP, grid: { color: 'rgba(0, 0, 0, 0.05)', drawBorder: false } } 
                }, 
                elements: { point: { radius: 0 } } 
            }
        });

        // 2. Gauge Chart initialization
        const ctxGauge = document.getElementById('gaugeChart').getContext('2d');
        const gaugeChart = new Chart(ctxGauge, {
            type: 'doughnut',
            data: { 
                datasets: [{ 
                    data: [0, MAX_TEMP], 
                    backgroundColor: ['#0d631b', '#f1f5f9'], 
                    borderWidth: 0, 
                    circumference: 180, 
                    rotation: 270, 
                    cutout: '82%' 
                }] 
            },
            options: { 
                responsive: true, 
                maintainAspectRatio: false, 
                plugins: { legend: { display: false }, tooltip: { enabled: false } } 
            }
        });

        function updateGaugeColor(val) {
            let color = '#0d631b'; // Green (Safe)
            if (val >= 60) {
                color = '#ba1a1a'; // Red (Danger/Error in master palette)
            } else if (val >= 55) {
                color = '#eab308'; // Yellow (Warning)
            }
            gaugeChart.data.datasets[0].backgroundColor[0] = color;
        }

        // 3. Load historical data from Firebase Realtime Database
        function loadHistoryFromFirebase() {
            const dbRef = ref(database);
            get(child(dbRef, 'Suhu_Mesin/Atas')).then((snapshot) => {
                if (snapshot.exists()) {
                    const dataObj = snapshot.val();
                    masterDataHistory = [];
                    const keys = Object.keys(dataObj);
                    const totalItems = keys.length;
                    const now = new Date().getTime();

                    keys.forEach((key, index) => {
                        const val = parseFloat(dataObj[key]);
                        if (!isNaN(val)) {
                            // Calculate timestamps relative to now, 1 minute per log point
                            const timeOffset = (totalItems - 1 - index) * 60000;
                            const itemTime = new Date(now - timeOffset);

                            masterDataHistory.push({
                                timestamp: itemTime,
                                timeStr: itemTime.getHours().toString().padStart(2, '0') + ':' + itemTime.getMinutes().toString().padStart(2, '0') + ':' + itemTime.getSeconds().toString().padStart(2, '0'),
                                value: val
                            });
                        }
                    });

                    renderFilteredChart();

                    if (masterDataHistory.length > 0) {
                        const lastVal = masterDataHistory[masterDataHistory.length - 1].value;
                        document.getElementById('gauge-val').innerText = lastVal.toFixed(1);
                        document.getElementById('realtime-temp').innerText = lastVal.toFixed(1) + '°C';
                        let gaugeValue = lastVal > MAX_TEMP ? MAX_TEMP : lastVal;
                        updateGaugeColor(lastVal);
                        gaugeChart.data.datasets[0].data = [gaugeValue, MAX_TEMP - gaugeValue];
                        gaugeChart.update();
                    }
                }
            }).catch((error) => {
                console.error("Gagal mengambil riwayat Firebase: ", error);
            });
        }

        loadHistoryFromFirebase();

        // Expose time range filter change to window
        window.changeTimeRange = function () {
            const selectEl = document.getElementById('timeRange');
            selectedMinutes = parseInt(selectEl.value);
            renderFilteredChart();
        };
        // bind change handler to element if exists
        document.getElementById('timeRange')?.addEventListener('change', window.changeTimeRange);

        function renderFilteredChart() {
            const now = new Date();
            const limitTime = new Date(now.getTime() - (selectedMinutes * 60 * 1000));

            const filtered = masterDataHistory.filter(item => item.timestamp >= limitTime);

            tempChart.data.labels = filtered.map(item => item.timeStr);
            tempChart.data.datasets[0].data = filtered.map(item => item.value);
            tempChart.update();
        }

        function updateChartsUI(timeStr, value) {
            const now = new Date();
            masterDataHistory.push({
                timestamp: now,
                timeStr: timeStr,
                value: value
            });

            renderFilteredChart();

            let gaugeValue = value > MAX_TEMP ? MAX_TEMP : value;
            let gaugeRem = MAX_TEMP - gaugeValue;
            updateGaugeColor(value);
            gaugeChart.data.datasets[0].data = [gaugeValue, gaugeRem];
            gaugeChart.update();
        }

        function checkWarningCondition(val) {
            const pill = document.getElementById('mqtt-status-pill');
            const dot = document.getElementById('mqtt-status-dot');
            const text = document.getElementById('mqtt-status-text');
            const statusBadge = document.getElementById('status-mesin-badge');
            
            if (val >= CRITICAL_TEMP) {
                // High temperature warning!
                pill.className = "inline-flex items-center gap-1.5 px-3 py-1 rounded-full border border-red-300 text-red-600 bg-red-50 text-xs font-bold transition-all shadow-sm animate-pulse";
                dot.className = "w-2 h-2 rounded-full bg-red-600 shadow animate-pulse";
                text.innerText = "WARNING: SUHU >= 60°C!";
                if (statusBadge) {
                    statusBadge.innerText = "CRITICAL SUHU";
                    statusBadge.className = "inline-flex items-center gap-1 px-2 py-0.5 rounded-full bg-red-600 text-white text-[10px] font-bold uppercase tracking-wider animate-pulse";
                }
            } else {
                // Connected normal state
                pill.className = "inline-flex items-center gap-1.5 px-3 py-1 rounded-full border border-emerald-300 text-emerald-600 bg-emerald-50 text-xs font-bold transition-all shadow-sm";
                dot.className = "w-2 h-2 rounded-full bg-emerald-600 shadow";
                text.innerText = "CONNECTED";
            }
        }

        // 4. MQTT Connection over WebSockets
        const brokerUrl = 'wss://test.mosquitto.org:8081/mqtt';
        const topicSuhu = 'pabrik/mesin/suhu_atas';
        const client = mqtt.connect(brokerUrl);

        client.on('connect', function () {
            checkWarningCondition(0);
            client.subscribe(topicSuhu);
        });

        client.on('close', function () {
            const pill = document.getElementById('mqtt-status-pill');
            const dot = document.getElementById('mqtt-status-dot');
            const text = document.getElementById('mqtt-status-text');
            
            pill.className = "inline-flex items-center gap-1.5 px-3 py-1 rounded-full border border-red-300 text-red-600 bg-red-50 text-xs font-bold transition-all shadow-sm animate-pulse";
            dot.className = "w-2 h-2 rounded-full bg-red-600 shadow";
            text.innerText = "DISCONNECTED";
        });

        client.on('message', function (topic, message) {
            if (topic === topicSuhu) {
                const val = parseFloat(message.toString());
                if (!isNaN(val)) {
                    document.getElementById('gauge-val').innerText = val.toFixed(1);
                    document.getElementById('realtime-temp').innerText = val.toFixed(1) + '°C';
                    const now = new Date();
                    const timeStr = now.getHours().toString().padStart(2, '0') + ':' + now.getMinutes().toString().padStart(2, '0') + ':' + now.getSeconds().toString().padStart(2, '0');
                    updateChartsUI(timeStr, val);
                    checkWarningCondition(val);

                    // Local database sync throttling (max once every 10 seconds)
                    const currentTime = Date.now();
                    if (currentTime - lastPostTime >= 10000) {
                        lastPostTime = currentTime;
                        fetch('/api/iot/sensor', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({
                                suhu: val,
                                kadar_air: {{ $currentMoisture }},
                                batch_id: {!! json_encode($activeSession ? $activeSession->batch_name : 'Tungku Utama') !!}
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            console.log('Sync data lokal sukses:', data);
                        })
                        .catch(err => {
                            console.error('Sync data lokal gagal:', err);
                        });
                    }
                }
            }
        });

        // 5. Clear Dashboard data (Both Firebase & Local)
        window.clearDashboardData = function () {
            if (!confirm("Apakah kamu yakin ingin menghapus data grafik di layar, Firebase, DAN database lokal?")) return;

            masterDataHistory = [];
            tempChart.data.labels = [];
            tempChart.data.datasets[0].data = [];
            tempChart.update();

            const dbRef = ref(database, 'Suhu_Mesin/Atas');
            remove(dbRef).then(() => {
                // Clear local Laravel database logs
                fetch("{{ route('admin.pemantauan.clear') }}", {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json'
                    }
                })
                .then(res => res.json())
                .then(data => {
                    alert("Berhasil! Riwayat data di Firebase dan database lokal telah dibersihkan.");
                    window.location.reload();
                })
                .catch(err => {
                    alert("Gagal menghapus data lokal: " + err);
                });
            }).catch((error) => {
                alert("Gagal menghapus data di Firebase: " + error);
                console.error(error);
            });
        };
    </script>

    <!-- Standard UI Scripts -->
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