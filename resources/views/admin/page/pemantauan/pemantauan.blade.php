@extends('admin.layout.master')

@section('content')
        <section class="p-lg md:p-xl space-y-lg">
            <!-- Breadcrumbs & Title Section -->
            <div class="flex flex-col lg:flex-row lg:items-end justify-between gap-md">
                <div class="space-y-1">
                    <div class="flex items-center gap-2 text-on-surface-variant font-label-md">
                        <span class="hover:text-primary cursor-pointer">Dashboard</span>
                        <span class="material-symbols-outlined text-sm">chevron_right</span>
                        <span class="text-primary font-bold">Monitoring Suhu</span>
                    </div>
                    <h2 class="font-headline-md text-headline-md text-on-surface">Monitoring Suhu Smart Dryer</h2>
                    <p class="font-body-md text-on-surface-variant">Pantau kinerja unit pengeringan secara real-time.
                    </p>
                </div>
                <div class="flex flex-wrap items-center gap-sm">
                    <button
                        class="flex items-center gap-sm px-lg py-md bg-surface-container-lowest border border-outline-variant text-on-surface rounded-xl hover:bg-surface-container-low transition-all shadow-sm">
                        <span class="material-symbols-outlined">calendar_today</span>
                        <span class="font-label-md">Filter Tanggal</span>
                    </button>
                    <button
                        class="flex items-center gap-sm px-lg py-md bg-primary text-on-primary rounded-xl hover:bg-primary-container transition-all shadow-md active:scale-95">
                        <span class="material-symbols-outlined">download</span>
                        <span class="font-label-md">Export Data</span>
                        <span class="material-symbols-outlined">expand_more</span>
                    </button>
                </div>
            </div>
            <!-- Status Highlight Cards (Bento style) -->
            <div class="grid grid-cols-1 gap-lg md:grid-cols-4">
                <!-- Suhu Saat Ini -->
                <div
                    class="bg-surface-container-lowest p-lg rounded-[20px] border border-outline-variant shadow-sm relative overflow-hidden group">
                    <div class="flex justify-between items-start mb-md">
                        <div class="space-y-1">
                            <p class="text-on-surface-variant font-label-md">Suhu Saat Ini</p>
                            <h3 class="text-[40px] font-bold text-primary leading-none">45.5°C</h3>
                        </div>
                        <div
                            class="w-10 h-10 rounded-full bg-secondary-container flex items-center justify-center text-on-secondary-container">
                            <span class="material-symbols-outlined" data-icon="thermostat">thermostat</span>
                        </div>
                    </div>
                    <div class="flex items-center gap-sm">
                        <span
                            class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full bg-secondary-container text-on-secondary-container text-[10px] font-bold uppercase tracking-wider">
                            <span class="w-1.5 h-1.5 rounded-full bg-secondary animate-pulse"></span>
                            Stable
                        </span>
                        <span class="text-[12px] text-on-surface-variant">Sesuai target pengeringan</span>
                    </div>
                </div>
                <!-- Status Mesin -->
                <div
                    class="bg-surface-container-lowest p-lg rounded-[20px] border border-outline-variant shadow-sm relative overflow-hidden group">
                    <div class="flex justify-between items-start mb-md">
                        <div class="space-y-1">
                            <p class="text-on-surface-variant font-label-md">Status Mesin</p>
                            <h3 class="font-title-lg text-title-lg text-on-surface">Unit 01</h3>
                        </div>
                        <div
                            class="w-10 h-10 rounded-full bg-primary-fixed text-on-primary-fixed flex items-center justify-center">
                            <span class="material-symbols-outlined animate-spin" data-icon="settings"
                                style="animation-duration: 3s;">settings</span>
                        </div>
                    </div>
                    <div class="flex items-center gap-sm">
                        <span class="font-label-md text-primary font-bold">Sedang Berjalan</span>
                        <span class="text-[12px] text-on-surface-variant">• Heat Exchanger Aktif</span>
                    </div>
                </div>
                <!-- Durasi Pengeringan -->
                <div
                    class="bg-surface-container-lowest p-lg rounded-[20px] border border-outline-variant shadow-sm relative overflow-hidden group">
                    <div class="flex justify-between items-start mb-md">
                        <div class="space-y-1">
                            <p class="text-on-surface-variant font-label-md">Progres Pengeringan</p>
                            <h3 class="text-[40px] font-bold text-on-surface leading-none tabular-nums"
                                id="timer">02:48:38</h3>
                        </div>
                        <div
                            class="w-10 h-10 rounded-full bg-tertiary-fixed text-on-tertiary-fixed flex items-center justify-center">
                            <span class="material-symbols-outlined" data-icon="schedule">schedule</span>
                        </div>
                    </div>
                    <div class="flex items-center gap-sm">
                        <div class="flex-1 bg-surface-container-high h-2 rounded-full overflow-hidden">
                            <div class="bg-primary h-full w-[65%]" style="transition: width 1s ease-in-out;"></div>
                        </div>
                        <span class="font-label-md text-on-surface-variant">65%</span>
                    </div>
                    <div class="flex justify-between mt-2 text-[11px] text-on-surface-variant font-medium">
                        <span class="">Awal: 25%</span>
                        <span class="">Target: 14%</span>
                    </div>
                </div>
                <div
                    class="bg-surface-container-lowest p-lg rounded-[20px] border border-outline-variant shadow-sm relative overflow-hidden group">
                    <div class="flex justify-between items-start mb-md">
                        <div class="space-y-1">
                            <p class="text-on-surface-variant font-label-md">Kadar Air Saat Ini</p>
                            <h3 class="text-[40px] font-bold text-primary leading-none">18.5%</h3>
                        </div>
                        <div
                            class="w-10 h-10 rounded-full bg-secondary-container flex items-center justify-center text-on-secondary-container">
                            <span class="material-symbols-outlined">water_drop</span>
                        </div>
                    </div>
                    <div class="flex items-center gap-sm">
                        <span
                            class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full bg-tertiary-fixed text-on-tertiary-fixed text-[10px] font-bold uppercase tracking-wider">
                            <span class="w-1.5 h-1.5 rounded-full bg-tertiary animate-pulse"></span>
                            PROSES
                        </span>
                        <span class="text-[12px] text-on-surface-variant">Menuju target 14%</span>
                    </div>
                </div>
            </div>
            <!-- Main Chart Area -->
            <div class="bg-surface-container-lowest rounded-[20px] border border-outline-variant shadow-sm p-lg">
                <div class="flex items-center justify-between mb-lg">
                    <div class="flex items-center gap-md">
                        <div class="w-1.5 h-6 bg-primary rounded-full"></div>
                        <h3 class="font-title-lg text-title-lg text-on-surface">Grafik Suhu Realtime</h3>
                    </div>
                    <div class="flex items-center gap-sm">
                        <span class="flex items-center gap-1.5 text-label-md text-on-surface-variant">
                            <span class="w-3 h-3 rounded-full bg-primary"></span>
                            Suhu Dryer
                        </span>
                        <select
                            class="bg-surface-container-low border-none text-label-md rounded-lg py-1 px-3 focus:ring-1 focus:ring-primary">
                            <option>Realtime (5s)</option>
                            <option>Per 15 Menit</option>
                            <option>Per Jam</option>
                        </select>
                    </div>
                </div>
                <!-- Mock Chart Visualization -->
                <div class="h-64 md:h-80 w-full relative">
                    <svg class="w-full h-full preserve-3d" preserveAspectRatio="none" viewBox="0 0 1000 300">
                        <!-- Background Grid -->
                        <line stroke="#e2e8f0" stroke-dasharray="4" stroke-width="1" x1="0" x2="1000"
                            y1="50" y2="50"></line>
                        <line stroke="#e2e8f0" stroke-dasharray="4" stroke-width="1" x1="0" x2="1000"
                            y1="125" y2="125"></line>
                        <line stroke="#e2e8f0" stroke-dasharray="4" stroke-width="1" x1="0" x2="1000"
                            y1="200" y2="200"></line>
                        <line stroke="#e2e8f0" stroke-dasharray="4" stroke-width="1" x1="0" x2="1000"
                            y1="275" y2="275"></line>
                        <!-- Area Fill -->
                        <path d="M0,300 L0,150 Q100,120 200,160 T400,140 T600,180 T800,130 T1000,150 L1000,300 Z"
                            fill="url(#chartGradient)"></path>
                        <!-- Line -->
                        <path d="M0,150 Q100,120 200,160 T400,140 T600,180 T800,130 T1000,150" fill="none"
                            stroke="#0d631b" stroke-linecap="round" stroke-width="3"></path>
                        <!-- Current Point -->
                        <circle class="animate-pulse" cx="1000" cy="150" fill="#0d631b" r="6"></circle>
                        <defs>
                            <linearGradient id="chartGradient" x1="0" x2="0" y1="0"
                                y2="1">
                                <stop offset="0%" stop-color="#0d631b" stop-opacity="0.2"></stop>
                                <stop offset="100%" stop-color="#0d631b" stop-opacity="0"></stop>
                            </linearGradient>
                        </defs>
                    </svg>
                    <!-- Y-Axis Labels -->
                    <div
                        class="absolute top-0 left-0 h-full flex flex-col justify-between text-[10px] text-on-surface-variant font-bold pb-2">
                        <span class="">60°C</span>
                        <span class="">45°C</span>
                        <span class="">30°C</span>
                        <span class="">15°C</span>
                        <span class="">0°C</span>
                    </div>
                </div>
                <!-- X-Axis Labels -->
                <div class="flex justify-between mt-4 text-[11px] text-on-surface-variant font-medium px-2">
                    <span class="">08:00</span>
                    <span class="">08:15</span>
                    <span class="">08:30</span>
                    <span class="">08:45</span>
                    <span class="">09:00</span>
                    <span class="">09:15</span>
                    <span class="">09:30</span>
                    <span class="">09:45</span>
                    <span class="">Sekarang</span>
                </div>
            </div>
            <!-- History Table Section -->
            <div
                class="bg-surface-container-lowest rounded-[20px] border border-outline-variant shadow-sm overflow-hidden">
                <div class="p-lg border-b border-outline-variant">
                    <div class="flex flex-col md:flex-row md:items-center justify-between gap-md">
                        <div class="flex items-center gap-md">
                            <div class="w-1.5 h-6 bg-tertiary-fixed-dim rounded-full"></div>
                            <h3 class="font-title-lg text-title-lg text-on-surface">Riwayat Suhu</h3>
                        </div>
                        <div class="flex flex-col sm:flex-row gap-sm items-center">
                            <div class="relative w-full sm:w-auto">
                                <span
                                    class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-on-surface-variant text-sm">search</span>
                                <input
                                    class="pl-10 pr-4 py-2 w-full sm:w-64 bg-surface-container-low border border-outline-variant rounded-xl focus:ring-2 focus:ring-primary text-body-md transition-all"
                                    placeholder="Cari data..." type="text">
                            </div>
                            <button
                                class="w-full sm:w-auto px-md py-2 border border-outline-variant rounded-xl hover:bg-surface-container-low flex items-center justify-center gap-2">
                                <span class="material-symbols-outlined text-sm">tune</span>
                                <span class="font-label-md">Filter Lanjut</span>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="overflow-x-auto hide-scrollbar">
                    <table class="w-full text-left border-collapse">
                        <thead class="bg-surface-container-low">
                            <tr>
                                <th class="px-lg py-md font-label-md text-on-surface-variant">Waktu</th>
                                <th class="px-lg py-md font-label-md text-on-surface-variant">Suhu</th>
                                <th class="px-lg py-md font-label-md text-on-surface-variant">Kelembaban</th>
                                <th class="px-lg py-md font-label-md text-on-surface-variant">Kadar Air (%)</th>
                                <th class="px-lg py-md font-label-md text-on-surface-variant">Status</th>
                                <th class="px-lg py-md font-label-md text-on-surface-variant">Keterangan</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-outline-variant">
                            <tr class="hover:bg-surface-container-lowest transition-colors cursor-default">
                                <td class="px-lg py-md font-body-md">10:45:02</td>
                                <td class="px-lg py-md font-body-md font-semibold text-primary">45.5°C</td>
                                <td class="px-lg py-md font-body-md">12.5%</td>
                                <td class="px-lg py-md font-body-md font-semibold text-primary">18.5%</td>
                                <td class="px-lg py-md">
                                    <span
                                        class="px-2.5 py-1 rounded-full bg-secondary-container text-on-secondary-container text-[12px] font-bold">OPTIMAL</span>
                                </td>
                                <td class="px-lg py-md text-on-surface-variant font-label-md italic">Suhu stabil
                                    terkendali</td>
                            </tr>
                            <tr class="hover:bg-surface-container-lowest transition-colors cursor-default">
                                <td class="px-lg py-md font-body-md">10:40:00</td>
                                <td class="px-lg py-md font-body-md font-semibold text-primary">44.8°C</td>
                                <td class="px-lg py-md font-body-md">13.1%</td>
                                <td class="px-lg py-md font-body-md font-semibold text-primary">19.2%</td>
                                <td class="px-lg py-md">
                                    <span
                                        class="px-2.5 py-1 rounded-full bg-secondary-container text-on-secondary-container text-[12px] font-bold">OPTIMAL</span>
                                </td>
                                <td class="px-lg py-md text-on-surface-variant font-label-md italic">Pemanasan awal
                                    selesai</td>
                            </tr>
                            <tr class="hover:bg-surface-container-lowest transition-colors cursor-default">
                                <td class="px-lg py-md font-body-md">10:35:01</td>
                                <td class="px-lg py-md font-body-md font-semibold text-tertiary">42.2°C</td>
                                <td class="px-lg py-md font-body-md">14.8%</td>
                                <td class="px-lg py-md font-body-md font-semibold text-tertiary">20.1%</td>
                                <td class="px-lg py-md">
                                    <span
                                        class="px-2.5 py-1 rounded-full bg-tertiary-fixed text-on-tertiary-fixed text-[12px] font-bold">WARMING</span>
                                </td>
                                <td class="px-lg py-md text-on-surface-variant font-label-md italic">Proses kenaikan
                                    suhu</td>
                            </tr>
                            <tr class="hover:bg-surface-container-lowest transition-colors cursor-default">
                                <td class="px-lg py-md font-body-md">10:30:00</td>
                                <td class="px-lg py-md font-body-md font-semibold text-error">52.1°C</td>
                                <td class="px-lg py-md font-body-md">16.2%</td>
                                <td class="px-lg py-md font-body-md font-semibold text-error">21.5%</td>
                                <td class="px-lg py-md">
                                    <span
                                        class="px-2.5 py-1 rounded-full bg-error-container text-on-error-container text-[12px] font-bold">WARNING</span>
                                </td>
                                <td class="px-lg py-md text-on-surface-variant font-label-md italic">Suhu melebihi
                                    batas (Upper Threshold)</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="p-lg flex items-center justify-between border-t border-outline-variant">
                    <p class="font-label-md text-on-surface-variant">Menampilkan 4 dari 150 data</p>
                    <div class="flex items-center gap-xs">
                        <button
                            class="p-2 hover:bg-surface-container-low rounded-lg transition-colors border border-outline-variant disabled:opacity-30"
                            disabled="">
                            <span class="material-symbols-outlined">chevron_left</span>
                        </button>
                        <button
                            class="w-8 h-8 flex items-center justify-center bg-primary text-on-primary rounded-lg font-label-md">1</button>
                        <button
                            class="w-8 h-8 flex items-center justify-center hover:bg-surface-container-low rounded-lg font-label-md">2</button>
                        <button
                            class="w-8 h-8 flex items-center justify-center hover:bg-surface-container-low rounded-lg font-label-md">3</button>
                        <button
                            class="p-2 hover:bg-surface-container-low rounded-lg transition-colors border border-outline-variant">
                            <span class="material-symbols-outlined">chevron_right</span>
                        </button>
                    </div>
                </div>
            </div>
        </section>
    @endsection

    @push('scripts')
    <script>
        // Simple Real-time Suhu Update Simulation
        setInterval(() => {
            const baseTemp = 45.5;
            const fluctuation = (Math.random() - 0.5) * 0.4;
            const newTemp = (baseTemp + fluctuation).toFixed(1);
            const tempDisplay = document.querySelector('h3.text-\[40px\]');
            if (tempDisplay && tempDisplay.innerText.includes('°C')) {
                tempDisplay.innerText = newTemp + '°C';
            }
        }, 5000);

        // Timer Simulation
        let seconds = 9910; // Starting from 02:45:10
        setInterval(() => {
            seconds++;
            const h = Math.floor(seconds / 3600).toString().padStart(2, '0');
            const m = Math.floor((seconds % 3600) / 60).toString().padStart(2, '0');
            const s = (seconds % 60).toString().padStart(2, '0');
            const timerElement = document.getElementById('timer');
            if (timerElement) {
                timerElement.innerText = `${h}:${m}:${s}`;
            }
        }, 1000);
    </script>
    @endpush
