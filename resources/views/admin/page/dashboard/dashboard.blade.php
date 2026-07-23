@extends('admin.layout.master')

@section('content')
<!-- Welcome Banner -->
<section class="relative overflow-hidden rounded-card bg-primary p-xl text-on-primary flex flex-col md:flex-row justify-between items-center gap-8 shadow-xl shadow-primary/10">
    <div class="relative z-10 text-center md:text-left space-y-4">
        <h2 class="text-3xl font-black tracking-tight">Selamat datang kembali, {{ auth()->user()->name }}</h2>
        <p class="text-lg text-primary-fixed opacity-90 max-w-md">Sistem Smart Dryer berjalan pada kapasitas optimal.</p>
        <div class="pt-4 flex flex-wrap justify-center md:justify-start gap-4">
            <button type="button" onclick="openStartDryingModal()"
               class="inline-flex items-center gap-2 px-8 py-3 bg-white text-primary rounded-xl font-black text-label-md hover:bg-surface-container-lowest transition-all shadow-lg shadow-black/10 active:scale-95 cursor-pointer">
                <span class="material-symbols-outlined text-base">timer</span>
                Mulai Jam Pengeringan
            </button>
            <a href="{{ route('admin.pemantauan') }}"
               class="inline-flex items-center gap-2 px-8 py-3 bg-white/20 text-white border border-white/30 rounded-xl font-bold text-label-md hover:bg-white/30 transition-all backdrop-blur-sm active:scale-95">
                <span class="material-symbols-outlined text-base">thermostat</span>
                Monitoring Suhu & Timer
            </a>
        </div>
    </div>
    <div class="relative w-full md:w-2/5 flex justify-center">
        <img class="h-56 md:h-64 object-contain" data-alt="Ilustrasi sistem pengering jagung pintar modern" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDymiH7TdgxUiggd1QulpfnU9hQ6zFijUt8TN42F-v294Qs-O4ZNzyaQBVkUUJm9PeuR6_4OnZyEHw1lkuWxUBHDuVHJd2kzs7Q5Sv8jSvu74F0aALBBr74rsOy0KDaPRsla-2xzLBAycBlTOsb-0oCmjpuUMMh423OXCX0eJlNd7U6E2UyA2P1R8TzO0-9Mp0IcwOgqeE3QaWimGfOQZcbGu1eI80XpKqiO8fIDXRjhMQTUwGLWF2GMQ"/>
    </div>
</section>

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
                <span class="text-label-md font-medium text-on-surface-variant">Suhu Kompor saat ini</span>
                <div class="text-3xl font-black text-on-surface" id="realtime-temp">{{ $currentTemperature }}°C</div>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-orange-50 flex items-center justify-center text-orange-600">
                <span class="material-symbols-outlined text-2xl">thermostat</span>
            </div>
        </div>
        <div class="mt-6 flex items-center gap-2 text-primary font-bold text-xs uppercase tracking-widest">
            <span class="material-symbols-outlined text-[18px]">verified</span>
            <span>Safety Monitor Terjaga</span>
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
                <span class="text-label-md font-medium text-on-surface-variant">Total Berat (Kg)</span>
                <div class="text-3xl font-black text-on-surface">{{ $totalTonnageFormatted }}<span class="text-sm font-normal text-outline ml-1">Kg</span></div>
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

<!-- Charts and Central Timer Section -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-gutter">
    <!-- Progress Chart -->
    <div class="lg:col-span-2 bg-white border border-black/5 rounded-[20px] shadow-md p-xl flex flex-col">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-xl gap-4">
            <div>
                <h3 class="text-xl font-bold text-on-surface">Kurva Suhu Pengeringan</h3>
                <p class="text-label-md text-outline mt-1">Riwayat perkembangan suhu kompor (°C) dari sensor IoT</p>
            </div>
            <div class="px-4 py-1.5 bg-primary/10 text-primary rounded-full font-bold text-xs">
                Sesi Aktif: {{ $activeFarmerName }}
            </div>
        </div>
        <div class="flex-1 min-h-[350px]">
            <canvas id="tempChart"></canvas>
        </div>
    </div>

    <!-- Central Monitoring Section (Timer & Machine Status) -->
    <div class="bg-white border border-black/5 rounded-[20px] shadow-md p-xl flex flex-col gap-lg justify-between">
        <div class="flex items-center justify-between">
            <h3 class="text-xl font-bold text-on-surface">Status Mesin & Timer</h3>
            @if($activeSession)
            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-emerald-100 text-emerald-800 text-xs font-bold animate-pulse">
                <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                BERJALAN
            </span>
            @else
            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-gray-100 text-gray-700 text-xs font-bold">
                STANDBY
            </span>
            @endif
        </div>

        <div class="flex flex-col items-center justify-center py-4 space-y-6">
            <!-- Gauge & Timer Display -->
            <div class="relative w-52 h-52 flex items-center justify-center">
                <svg class="w-full h-full transform -rotate-90">
                    <circle class="text-surface-container" cx="104" cy="104" fill="transparent" r="88" stroke="currentColor" stroke-width="12"></circle>
                    @php
                        $percentVal = $activeSession ? $activeSession->progress_percent : 0;
                        $dashoffset = 553 - (553 * $percentVal / 100);
                    @endphp
                    <circle class="text-primary transition-all duration-1000" cx="104" cy="104" fill="transparent" r="88" stroke="currentColor" stroke-dasharray="553" stroke-dashoffset="{{ $dashoffset }}" stroke-linecap="round" stroke-width="12"></circle>
                </svg>
                <div class="absolute inset-0 flex flex-col items-center justify-center text-center">
                    <span class="text-3xl font-black text-on-surface tracking-tight" id="dash-timer">
                        {{ $activeSession ? $activeSession->formatted_elapsed : '00:00:00' }}
                    </span>
                    <span class="text-[10px] text-outline font-black uppercase tracking-widest mt-1">
                        @if($activeSession)
                        Target: {{ $activeSession->formatted_target_hours }}
                        @else
                        Mesin Siap
                        @endif
                    </span>
                    <span class="text-xs font-bold text-primary mt-1">
                        {{ $percentVal }}% Selesai
                    </span>
                </div>
            </div>

            <!-- Button Action -->
            <div class="w-full text-center">
                @if($activeSession)
                <form action="{{ route('admin.drying.stop', $activeSession->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghentikan pengeringan ini? Notifikasi WA akan dikirim.');">
                    @csrf
                    <button type="submit" class="w-full py-3 px-4 bg-red-50 text-red-700 hover:bg-red-100 border border-red-200 font-bold rounded-2xl transition-all flex items-center justify-center gap-2">
                        <span class="material-symbols-outlined text-lg">stop_circle</span>
                        Hentikan Pengeringan
                    </button>
                </form>
                @else
                <button type="button" onclick="openStartDryingModal()" class="w-full py-3 px-4 bg-primary text-white hover:bg-primary/90 font-bold rounded-2xl transition-all shadow-md flex items-center justify-center gap-2 cursor-pointer">
                    <span class="material-symbols-outlined text-lg">play_arrow</span>
                    Start Jam Pengeringan
                </button>
                @endif
            </div>

            <!-- Parameters (Suhu) -->
            <div class="w-full">
                <div class="p-4 bg-surface-container-low rounded-2xl text-center border border-outline-variant/30">
                    <p class="text-[11px] font-bold text-outline mb-1 uppercase tracking-wider">Suhu Kompor</p>
                    <p class="text-lg font-black text-on-surface" id="param-temp">{{ $currentTemperature }}°C</p>
                    <span class="text-[10px] text-emerald-600 font-medium" id="temp-safety">Safety Normal</span>
                </div>
            </div>
        </div>

        <div class="p-4 bg-primary/5 rounded-2xl border border-primary/10 flex items-center gap-3">
            <div class="w-10 h-10 bg-primary/10 rounded-xl flex items-center justify-center text-primary">
                <span class="material-symbols-outlined">info</span>
            </div>
            <div class="text-xs">
                <p class="font-bold text-on-surface">Pemberitahuan WhatsApp</p>
                <p class="text-outline">Pesan WA dikirim otomatis ketika timer jam selesai.</p>
            </div>
        </div>
    </div>
</div>

<!-- Machine Usage History Section (Riwayat Penggunaan Alat) -->
<section class="bg-white border border-black/5 rounded-[20px] shadow-md overflow-hidden">
    <div class="px-xl py-lg border-b border-outline-variant/50 flex justify-between items-center bg-white">
        <div>
            <h3 class="text-xl font-bold text-on-surface">Riwayat Penggunaan Alat (Operasional Mesin)</h3>
            <p class="text-xs text-outline mt-0.5">Catatan penggunaan jam pengeringan mesin kompor</p>
        </div>
        <a href="{{ route('admin.pemantauan') }}" class="text-primary font-bold text-label-md hover:underline flex items-center gap-1">
            Lihat Semua <span class="material-symbols-outlined text-sm">arrow_forward_ios</span>
        </a>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-left mobile-table-card">
            <thead class="bg-surface-container-low/50 text-on-surface-variant">
                <tr>
                    <th class="px-xl py-4 text-[11px] font-black uppercase tracking-widest">Nama Batch / Mitra</th>
                    <th class="px-xl py-4 text-[11px] font-black uppercase tracking-widest">Waktu Mulai</th>
                    <th class="px-xl py-4 text-[11px] font-black uppercase tracking-widest">Target Jam</th>
                    <th class="px-xl py-4 text-[11px] font-black uppercase tracking-widest">Durasi Berjalan</th>
                    <th class="px-xl py-4 text-[11px] font-black uppercase tracking-widest">Status</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-outline-variant/30 text-sm">
                @forelse($sessionHistory as $sess)
                <tr class="hover:bg-surface-container-low/30 transition-colors">
                    <td class="px-xl py-4 font-bold text-on-surface">
                        {{ $sess->batch_name }}
                        <span class="block text-xs font-normal text-outline">{{ $sess->farmer_name }}</span>
                    </td>
                    <td class="px-xl py-4 text-on-surface-variant">
                        {{ $sess->start_time ? $sess->start_time->format('d M H:i') : '-' }}
                    </td>
                    <td class="px-xl py-4 font-bold text-on-surface">
                        {{ $sess->formatted_target_hours }}
                    </td>
                    <td class="px-xl py-4 text-on-surface-variant">
                        {{ $sess->formatted_actual_duration }}
                    </td>
                    <td class="px-xl py-4">
                        @if($sess->status === 'Berjalan')
                        <span class="inline-flex items-center gap-1.5 bg-primary/10 text-primary text-[11px] font-black uppercase px-3 py-1 rounded-full border border-primary/20">
                            <span class="w-1.5 h-1.5 bg-primary rounded-full animate-pulse"></span>
                            Berjalan
                        </span>
                        @elseif($sess->status === 'Selesai')
                        <span class="inline-flex items-center gap-1.5 bg-emerald-50 text-emerald-700 text-[11px] font-black uppercase px-3 py-1 rounded-full border border-emerald-200">
                            <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full"></span>
                            Selesai
                        </span>
                        @else
                        <span class="inline-flex items-center gap-1.5 bg-gray-100 text-gray-600 text-[11px] font-black uppercase px-3 py-1 rounded-full border border-gray-300">
                            Dibatalkan
                        </span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-xl py-6 text-center text-outline font-medium">Belum ada riwayat sesi pengeringan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</section>

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

@push('scripts')
    <!-- MQTT.js library -->
    <script src="https://unpkg.com/mqtt/dist/mqtt.min.js"></script>

    <!-- Chart.js library -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Firebase SDK & Real-time Client Module -->
    <script type="module">
        import { initializeApp } from "https://www.gstatic.com/firebasejs/10.8.1/firebase-app.js";
        import { getDatabase, ref, get, child } from "https://www.gstatic.com/firebasejs/10.8.1/firebase-database.js";

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

        // Load historical/latest data from Firebase Realtime Database
        function loadHistoryFromFirebase() {
            const dbRef = ref(database);
            get(child(dbRef, 'Suhu_Mesin/Atas')).then((snapshot) => {
                if (snapshot.exists()) {
                    const dataObj = snapshot.val();
                    const keys = Object.keys(dataObj);
                    if (keys.length > 0) {
                        const lastKey = keys[keys.length - 1];
                        const lastVal = parseFloat(dataObj[lastKey]);
                        if (!isNaN(lastVal)) {
                            updateSuhuDisplay(lastVal);
                        }
                    }
                }
            }).catch((error) => {
                console.error("Gagal mengambil riwayat Firebase: ", error);
            });
        }

        loadHistoryFromFirebase();

        // MQTT Connection over WebSockets
        const brokerUrl = 'wss://test.mosquitto.org:8081/mqtt';
        const topicSuhu = 'pabrik/mesin/suhu_atas';
        const client = mqtt.connect(brokerUrl);
        let lastPostTime = 0;

        client.on('connect', function () {
            client.subscribe(topicSuhu);
        });

        client.on('message', function (topic, message) {
            if (topic === topicSuhu) {
                const val = parseFloat(message.toString());
                if (!isNaN(val)) {
                    updateSuhuDisplay(val);

                    // Sync to local database once every 10 seconds
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

        function updateSuhuDisplay(val) {
            const realtimeTempElem = document.getElementById('realtime-temp');
            const paramTempElem = document.getElementById('param-temp');
            const safetyElem = document.getElementById('temp-safety');

            if (realtimeTempElem) realtimeTempElem.innerText = val.toFixed(1) + '°C';
            if (paramTempElem) paramTempElem.innerText = val.toFixed(1) + '°C';
            
            if (safetyElem) {
                if (val >= 60.0) {
                    safetyElem.innerText = "CRITICAL SUHU";
                    safetyElem.className = "text-[10px] text-red-600 font-bold animate-pulse";
                } else if (val >= 55.0) {
                    safetyElem.innerText = "Suhu Tinggi (Peringatan)";
                    safetyElem.className = "text-[10px] text-yellow-600 font-bold";
                } else {
                    safetyElem.innerText = "Safety Normal";
                    safetyElem.className = "text-[10px] text-emerald-600 font-medium";
                }
            }
        }
    </script>

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

    // Auto check timer every 10 seconds to sync timer and trigger WA on completion
    setInterval(function() {
        fetch("{{ route('admin.drying.check_timer') }}")
            .then(res => res.json())
            .then(data => {
                if (data.has_active) {
                    const timerElem = document.getElementById('dash-timer');
                    if (timerElem && data.elapsed_formatted) {
                        timerElem.innerText = data.elapsed_formatted;
                    }
                    if (data.is_finished) {
                        window.location.reload();
                    }
                }
            })
            .catch(err => console.error(err));
    }, 10000);

    const ctx = document.getElementById('tempChart').getContext('2d');
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: {!! json_encode($chartLabels) !!},
            datasets: [{
                label: 'Suhu Kompor (°C)',
                data: {!! json_encode($chartTempData) !!},
                borderColor: '#ea580c',
                backgroundColor: 'rgba(234, 88, 12, 0.05)',
                fill: true,
                tension: 0.4,
                borderWidth: 4,
                pointBackgroundColor: '#ffffff',
                pointBorderColor: '#ea580c',
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