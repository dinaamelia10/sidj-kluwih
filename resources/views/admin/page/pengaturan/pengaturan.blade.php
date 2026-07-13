@extends('admin.layout.master')

@push('styles')
    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
            vertical-align: middle;
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.84);
            backdrop-filter: blur(18px);
            border: 1px solid #E2E8F0;
        }

        .custom-shadow {
            box-shadow: 0 18px 40px rgba(15, 23, 42, 0.08);
        }

        .switch {
            position: relative;
            display: inline-block;
            width: 44px;
            height: 24px;
        }

        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #CBD5E1;
            transition: .4s;
            border-radius: 9999px;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 18px;
            width: 18px;
            left: 3px;
            bottom: 3px;
            background-color: white;
            transition: .4s;
            border-radius: 50%;
        }

        input:checked+.slider {
            background-color: #0d631b;
        }

        input:checked+.slider:before {
            transform: translateX(20px);
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
                    <span class="text-primary font-bold">Pengaturan</span>
                </nav>
                <h1 class="font-headline-lg text-headline-lg font-extrabold text-on-surface">Pengaturan Integrasi</h1>
                <p class="text-on-surface-variant font-body-md text-body-md mt-2">Atur notifikasi WhatsApp dan aturan alert
                    untuk SIDJ-Kluwih dengan tampilan dashboard yang responsif.</p>
            </div>
            <button
                class="inline-flex items-center gap-sm rounded-2xl bg-primary-container px-lg py-3 text-on-primary-container font-bold transition hover:bg-primary active:scale-95 shadow-md">
                <span class="material-symbols-outlined">settings</span>
                Simpan Pengaturan
            </button>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-[minmax(0,5fr)_minmax(0,7fr)] gap-lg">
            <div class="space-y-lg">
                <div class="glass-card custom-shadow rounded-3xl p-lg">
                    <div class="flex items-start justify-between gap-4">
                        <div>
                            <p class="font-label-md text-label-md text-on-surface-variant">Status Integrasi</p>
                            <h2 class="font-title-lg text-title-lg font-bold text-on-surface">Terhubung</h2>
                        </div>
                        <div
                            class="w-12 h-12 rounded-full bg-secondary-container flex items-center justify-center text-on-secondary-container">
                            <span class="material-symbols-outlined">cell_tower</span>
                        </div>
                    </div>
                    <div class="mt-6 rounded-3xl border border-surface-container-high bg-surface-container-low p-lg">
                        <div class="flex items-center gap-4">
                            <div
                                class="h-12 w-12 rounded-full bg-green-100 flex items-center justify-center text-green-700">
                                <span class="material-symbols-outlined">check_circle</span>
                            </div>
                            <div>
                                <p class="font-bold text-body-md">Terhubung</p>
                                <p class="text-label-sm text-on-surface-variant">Terakhir sinkronisasi 5 menit lalu</p>
                            </div>
                        </div>
                    </div>
                    <div class="mt-6 flex flex-col gap-3 sm:flex-row">
                        <button
                            class="w-full sm:w-auto py-3 px-5 bg-primary text-on-primary rounded-2xl font-bold transition hover:bg-primary-container">Sinkronisasi
                            Ulang</button>
                        <button
                            class="w-full sm:w-auto py-3 px-5 border border-error text-error rounded-2xl font-bold transition hover:bg-error/10">Putuskan
                            Koneksi</button>
                    </div>
                </div>

                <div class="glass-card custom-shadow rounded-3xl p-lg">
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="font-title-lg text-title-lg font-bold">Penerima Notifikasi</h2>
                        <button
                            class="inline-flex items-center gap-xs rounded-2xl border border-outline-variant px-4 py-3 text-label-md font-bold transition hover:bg-surface-variant">
                            <span class="material-symbols-outlined">add</span>
                            Tambah
                        </button>
                    </div>
                    <div class="space-y-3">
                        <div
                            class="flex items-center justify-between gap-4 p-4 bg-white border border-outline-variant rounded-3xl group hover:border-primary transition-all">
                            <div class="flex items-center gap-3">
                                <div
                                    class="h-10 w-10 rounded-full bg-surface-container-highest flex items-center justify-center">
                                    <span class="material-symbols-outlined text-on-surface-variant">person</span>
                                </div>
                                <div>
                                    <p class="font-bold">Admin Utama (Bapak Suhardi)</p>
                                    <p class="text-label-sm text-on-surface-variant">+62 812-3456-7890</p>
                                </div>
                            </div>
                            <button
                                class="opacity-0 group-hover:opacity-100 p-2 text-on-surface-variant hover:text-primary transition-all">
                                <span class="material-symbols-outlined">edit</span>
                            </button>
                        </div>
                        <div
                            class="flex items-center justify-between gap-4 p-4 bg-white border border-outline-variant rounded-3xl group hover:border-primary transition-all">
                            <div class="flex items-center gap-3">
                                <div
                                    class="h-10 w-10 rounded-full bg-surface-container-highest flex items-center justify-center">
                                    <span class="material-symbols-outlined text-on-surface-variant">person</span>
                                </div>
                                <div>
                                    <p class="font-bold">Supervisor Lapangan</p>
                                    <p class="text-label-sm text-on-surface-variant">+62 856-9876-5432</p>
                                </div>
                            </div>
                            <button
                                class="opacity-0 group-hover:opacity-100 p-2 text-on-surface-variant hover:text-primary transition-all">
                                <span class="material-symbols-outlined">edit</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="space-y-lg">
                <div class="glass-card custom-shadow rounded-3xl p-lg">
                    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between mb-6">
                        <div>
                            <h2 class="font-title-lg text-title-lg font-bold">Aturan Peringatan Sensor</h2>
                            <p class="text-on-surface-variant text-body-md">Atur trigger notifikasi untuk kondisi suhu,
                                kelembaban, dan koneksi perangkat.</p>
                        </div>
                        <button
                            class="inline-flex items-center gap-xs rounded-2xl border border-outline-variant px-4 py-3 text-label-md font-bold transition hover:bg-surface-variant">
                            <span class="material-symbols-outlined">add_alert</span>
                            Tambah Aturan
                        </button>
                    </div>
                    <div class="space-y-4">
                        <div
                            class="flex flex-col gap-4 rounded-3xl border border-outline-variant p-4 hover:border-primary transition-all sm:flex-row sm:items-center sm:justify-between">
                            <div class="flex-1">
                                <div class="flex items-center gap-2 mb-2">
                                    <h3 class="font-bold text-body-md">Jagung Perlu Dibalik</h3>
                                    <span
                                        class="rounded-full bg-tertiary-fixed px-2 py-1 text-[10px] font-bold uppercase text-on-tertiary-fixed-variant">Kritis</span>
                                </div>
                                <p class="text-label-sm text-on-surface-variant mb-4">Kirim notifikasi jika suhu melebihi
                                    ambang batas selama periode tertentu.</p>
                                <div class="grid gap-3 sm:grid-cols-2">
                                    <div>
                                        <span class="text-[10px] uppercase font-bold text-on-surface-variant">Ambang
                                            Batas</span>
                                        <div
                                            class="mt-2 flex items-center gap-2 rounded-2xl border border-outline-variant bg-surface px-3 py-2">
                                            <input class="w-full bg-transparent outline-none text-label-md" type="number"
                                                value="65" />
                                            <span class="text-label-sm">°C</span>
                                        </div>
                                    </div>
                                    <div>
                                        <span class="text-[10px] uppercase font-bold text-on-surface-variant">Durasi</span>
                                        <div
                                            class="mt-2 flex items-center gap-2 rounded-2xl border border-outline-variant bg-surface px-3 py-2">
                                            <input class="w-full bg-transparent outline-none text-label-md" type="number"
                                                value="30" />
                                            <span class="text-label-sm">Menit</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <label class="switch self-start">
                                <input checked type="checkbox" />
                                <span class="slider"></span>
                            </label>
                        </div>
                        <div class="flex flex-col gap-4 rounded-3xl border-t border-outline-variant pt-6">
                            <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                                <div>
                                    <h3 class="font-bold text-body-md">Proses Pengeringan Selesai</h3>
                                    <p class="text-label-sm text-on-surface-variant">Notifikasi ketika kadar air mencapai
                                        target ideal.</p>
                                </div>
                                <label class="switch">
                                    <input checked type="checkbox" />
                                    <span class="slider"></span>
                                </label>
                            </div>
                            <div>
                                <span class="text-[10px] uppercase font-bold text-on-surface-variant">Target Kadar
                                    Air</span>
                                <div
                                    class="mt-2 flex max-w-[12rem] items-center gap-2 rounded-2xl border border-outline-variant bg-surface px-3 py-2">
                                    <input class="w-full bg-transparent outline-none text-label-md" step="0.1"
                                        type="number" value="13.5" />
                                    <span class="text-label-sm">%</span>
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center justify-between rounded-3xl border-t border-outline-variant pt-6">
                            <div>
                                <h3 class="font-bold text-body-md">Peringatan Malfungsi Alat</h3>
                                <p class="text-label-sm text-on-surface-variant">Alert saat sensor kehilangan daya atau
                                    sinyal terputus.</p>
                            </div>
                            <label class="switch">
                                <input checked type="checkbox" />
                                <span class="slider"></span>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="glass-card custom-shadow rounded-3xl p-lg">
                    <div class="flex flex-col gap-6 md:flex-row md:items-start md:justify-between">
                        <div>
                            <h2 class="font-title-lg text-title-lg font-bold">Editor Template Pesan</h2>
                            <p class="text-on-surface-variant text-body-md">Ubah format pesan WhatsApp untuk notifikasi
                                kritis di lapangan.</p>
                        </div>
                        <button
                            class="inline-flex items-center gap-xs rounded-2xl border border-outline-variant px-4 py-3 text-label-md font-bold transition hover:bg-surface-variant">
                            Simpan Template
                        </button>
                    </div>
                    <div class="grid gap-lg lg:grid-cols-[1.3fr_0.9fr] mt-6">
                        <div class="space-y-4">
                            <div>
                                <label class="font-bold text-label-sm text-on-surface-variant block mb-2">Pilih
                                    Kejadian</label>
                                <select
                                    class="w-full rounded-2xl border border-outline-variant bg-white px-4 py-3 text-label-md">
                                    <option>Peringatan Suhu Tinggi (Jagung)</option>
                                    <option>Pengeringan Selesai</option>
                                    <option>Sensor Offline</option>
                                </select>
                            </div>
                            <div>
                                <label class="font-bold text-label-sm text-on-surface-variant block mb-2">Isi Pesan</label>
                                <textarea class="w-full rounded-2xl border border-outline-variant bg-white px-4 py-3 text-label-md leading-relaxed" rows="8">⚠️ *PERINGATAN KRITIS* ⚠️ Suhu pada Bed @{{ bed_id }} terdeteksi @{{ temperature }}°C. Segera lakukan pembalikan jagung untuk mencegah kerusakan kualitas. Waktu: @{{ timestamp }} SIDJ-Kluwih</textarea>
                                <p class="text-[10px] text-on-surface-variant mt-2">Gunakan tag seperti
                                    @{{ bed_id }}, @{{ temperature }}, dan @{{ timestamp }} untuk konten dinamis.
                                </p>
                            </div>
                        </div>
                        <div class="rounded-3xl bg-[#e5ddd5] p-4 relative min-h-[300px]">
                            <div
                                class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-10 pointer-events-none">
                            </div>
                            <div class="bg-[#075e54] p-3 -mx-4 -mt-4 rounded-t-3xl flex items-center gap-2 text-white">
                                <div class="w-8 h-8 rounded-full bg-white/20 flex items-center justify-center">
                                    <span class="material-symbols-outlined text-sm">agriculture</span>
                                </div>
                                <span class="font-bold text-label-sm">SIDJ-Kluwih Bot</span>
                            </div>
                            <div class="mt-4 rounded-3xl bg-white p-4 text-slate-800 shadow-sm relative">
                                <p class="whitespace-pre-line text-sm">⚠️ *PERINGATAN KRITIS*
                                    Suhu pada Bed 04 terdeteksi 67.2°C.
                                    Segera lakukan pembalikan jagung untuk mencegah kerusakan kualitas.
                                    Waktu: 14:30 WIB
                                    SIDJ-Kluwih</p>
                                <span class="text-[10px] text-slate-400 absolute bottom-3 right-3">14:31</span>
                            </div>
                            <div class="mt-auto pt-4 border-t border-black/10">
                                <button
                                    class="w-full rounded-2xl bg-white text-primary border border-primary py-3 font-bold hover:bg-primary/5 transition-all">Simpan
                                    Preview</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        const filterToggle = document.getElementById('toggle-filter');
        const filterPanel = document.getElementById('filter-panel');
        if (filterToggle && filterPanel) {
            filterToggle.addEventListener('click', () => {
                const isOpen = !filterPanel.classList.contains('hidden');
                filterPanel.classList.toggle('hidden', isOpen);
                filterToggle.setAttribute('aria-expanded', String(!isOpen));
            });
        }
    </script>
@endpush
