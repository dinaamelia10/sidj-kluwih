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

        /* Toggle Switch CSS */
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
<form action="{{ route('admin.pengaturan.update') }}" method="POST">
    @csrf
    <div class="space-y-lg pb-24">
        {{-- ========== HEADER ========== --}}
        <div class="flex flex-col gap-4 md:flex-row md:items-end md:justify-between sticky top-0 z-40 bg-surface/90 backdrop-blur-md pb-4 pt-2 -mx-4 px-4 sm:-mx-6 sm:px-6 md:mx-0 md:px-0">
            <div>
                <nav class="flex flex-wrap items-center gap-2 text-on-surface-variant font-label-sm text-label-sm mb-2">
                    <a class="hover:text-primary" href="{{ route('admin.dashboard') }}">Dashboard</a>
                    <span class="material-symbols-outlined text-[14px]">chevron_right</span>
                    <span class="text-primary font-bold">Pengaturan</span>
                </nav>
                <h1 class="font-headline-lg text-headline-lg font-extrabold text-on-surface">Pengaturan Sistem & Pengeringan</h1>
                <p class="text-on-surface-variant font-body-md text-body-md mt-2">
                    Sesuaikan parameter mesin pengering sekam, notifikasi WhatsApp, dan aturan suhu/kadar air.
                </p>
            </div>
            <button type="submit"
                class="inline-flex items-center justify-center gap-sm rounded-2xl bg-primary px-lg py-3 text-on-primary font-bold transition hover:bg-primary/90 active:scale-95 shadow-md flex-shrink-0">
                <span class="material-symbols-outlined">save</span>
                Simpan Pengaturan
            </button>
        </div>

        {{-- Flash Message --}}
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-xl relative" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-[minmax(0,5fr)_minmax(0,7fr)] gap-lg">
            
            {{-- ========== KOLOM KIRI (Integrasi & Notifikasi) ========== --}}
            <div class="space-y-lg">
                
                {{-- 1. Pengaturan WhatsApp API --}}
                <div class="glass-card custom-shadow rounded-3xl p-lg">
                    <div class="flex items-start justify-between gap-4 mb-4">
                        <div>
                            <h2 class="font-title-lg text-title-lg font-bold text-on-surface">Integrasi WhatsApp</h2>
                            <p class="text-label-sm text-on-surface-variant">Konfigurasi API pihak ketiga (misal: Fonnte)</p>
                        </div>
                        <div class="w-12 h-12 rounded-full bg-secondary-container flex items-center justify-center text-on-secondary-container">
                            <span class="material-symbols-outlined">forum</span>
                        </div>
                    </div>

                    <div class="space-y-4">
                        <div class="flex items-center justify-between p-4 bg-surface-container-lowest rounded-2xl border border-outline-variant/50">
                            <div>
                                <p class="font-bold text-body-md">Aktifkan Notifikasi WA</p>
                                <p class="text-[10px] text-on-surface-variant">Master switch untuk semua notifikasi</p>
                            </div>
                            <label class="switch">
                                <input type="checkbox" name="wa_enabled" value="1" {{ ($settings['wa_enabled'] ?? '0') == '1' ? 'checked' : '' }} />
                                <span class="slider"></span>
                            </label>
                        </div>
                        
                        <div>
                            <label class="text-[10px] uppercase font-bold text-on-surface-variant block mb-1">API Token</label>
                            <input type="text" name="wa_api_token" value="{{ $settings['wa_api_token'] ?? '' }}" 
                                placeholder="Masukkan token API WA"
                                class="w-full rounded-2xl border border-outline-variant bg-surface px-4 py-2 text-sm focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all">
                        </div>
                        
                        <div>
                            <label class="text-[10px] uppercase font-bold text-on-surface-variant block mb-1">Nomor Pengirim (Sender)</label>
                            <input type="text" name="wa_sender_number" value="{{ $settings['wa_sender_number'] ?? '' }}" 
                                placeholder="Contoh: 08123456789"
                                class="w-full rounded-2xl border border-outline-variant bg-surface px-4 py-2 text-sm focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all">
                        </div>
                    </div>
                </div>

                {{-- 2. Penerima Notifikasi Internal --}}
                <div class="glass-card custom-shadow rounded-3xl p-lg">
                    <div class="mb-4">
                        <h2 class="font-title-lg text-title-lg font-bold">Penerima Notifikasi Internal</h2>
                        <p class="text-label-sm text-on-surface-variant">Staf yang akan menerima peringatan sistem.</p>
                    </div>
                    
                    <div class="space-y-4">
                        {{-- Admin Utama --}}
                        <div class="p-4 bg-white border border-outline-variant rounded-2xl">
                            <div class="flex items-center gap-3 mb-3 border-b border-outline-variant/30 pb-3">
                                <div class="h-8 w-8 rounded-full bg-primary-container flex items-center justify-center text-on-primary-container">
                                    <span class="material-symbols-outlined text-sm">admin_panel_settings</span>
                                </div>
                                <h3 class="font-bold text-sm">Admin Utama</h3>
                            </div>
                            <div class="grid gap-3 sm:grid-cols-2">
                                <div>
                                    <label class="text-[10px] text-on-surface-variant block">Nama</label>
                                    <input type="text" name="admin_wa_name" value="{{ $settings['admin_wa_name'] ?? '' }}" 
                                        class="w-full border-b border-outline-variant bg-transparent py-1 text-sm outline-none focus:border-primary">
                                </div>
                                <div>
                                    <label class="text-[10px] text-on-surface-variant block">Nomor WA</label>
                                    <input type="text" name="admin_wa_number" value="{{ $settings['admin_wa_number'] ?? '' }}" 
                                        placeholder="08..."
                                        class="w-full border-b border-outline-variant bg-transparent py-1 text-sm outline-none focus:border-primary">
                                </div>
                            </div>
                        </div>

                        {{-- Supervisor --}}
                        <div class="p-4 bg-white border border-outline-variant rounded-2xl">
                            <div class="flex items-center gap-3 mb-3 border-b border-outline-variant/30 pb-3">
                                <div class="h-8 w-8 rounded-full bg-secondary-container flex items-center justify-center text-on-secondary-container">
                                    <span class="material-symbols-outlined text-sm">engineering</span>
                                </div>
                                <h3 class="font-bold text-sm">Supervisor Lapangan</h3>
                            </div>
                            <div class="grid gap-3 sm:grid-cols-2">
                                <div>
                                    <label class="text-[10px] text-on-surface-variant block">Nama</label>
                                    <input type="text" name="supervisor_wa_name" value="{{ $settings['supervisor_wa_name'] ?? '' }}" 
                                        class="w-full border-b border-outline-variant bg-transparent py-1 text-sm outline-none focus:border-primary">
                                </div>
                                <div>
                                    <label class="text-[10px] text-on-surface-variant block">Nomor WA</label>
                                    <input type="text" name="supervisor_wa_number" value="{{ $settings['supervisor_wa_number'] ?? '' }}" 
                                        placeholder="08..."
                                        class="w-full border-b border-outline-variant bg-transparent py-1 text-sm outline-none focus:border-primary">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ========== KOLOM KANAN (Parameter & Aturan) ========== --}}
            <div class="space-y-lg">
                
                {{-- 3. Parameter Pengeringan --}}
                <div class="glass-card custom-shadow rounded-3xl p-lg">
                    <div class="mb-6">
                        <h2 class="font-title-lg text-title-lg font-bold">Parameter Mesin Pengering</h2>
                        <p class="text-on-surface-variant text-body-md">Kalibrasi suhu tungku sekam dan standar kadar air.</p>
                    </div>

                    <div class="grid gap-6 sm:grid-cols-2">
                        {{-- Suhu Operasional --}}
                        <div class="p-4 bg-surface-container-lowest border border-outline-variant/50 rounded-2xl">
                            <div class="flex items-center gap-2 mb-4">
                                <span class="material-symbols-outlined text-error">thermostat</span>
                                <h3 class="font-bold text-sm">Suhu Tungku Sekam</h3>
                            </div>
                            <div class="space-y-3">
                                <div>
                                    <label class="text-[10px] uppercase font-bold text-on-surface-variant">Suhu Target Operasional</label>
                                    <div class="flex items-center gap-2 mt-1">
                                        <input type="number" name="suhu_target" value="{{ $settings['suhu_target'] ?? '82' }}" 
                                            class="w-full rounded-xl border border-outline-variant px-3 py-2 text-sm outline-none focus:border-primary">
                                        <span class="text-label-sm font-bold">°C</span>
                                    </div>
                                </div>
                                <div>
                                    <label class="text-[10px] uppercase font-bold text-on-surface-variant">Suhu Maksimal (Kritis)</label>
                                    <div class="flex items-center gap-2 mt-1">
                                        <input type="number" name="suhu_max" value="{{ $settings['suhu_max'] ?? '60' }}" 
                                            class="w-full rounded-xl border border-error px-3 py-2 text-sm outline-none focus:ring-1 focus:ring-error">
                                        <span class="text-label-md font-bold">°C</span>
                                    </div>
                                    <p class="text-[10px] text-error mt-1">Jika suhu > batas maks, kualitas jagung bisa rusak.</p>
                                </div>
                            </div>
                        </div>

                        {{-- Standar Kadar Air --}}
                        <div class="p-4 bg-surface-container-lowest border border-outline-variant/50 rounded-2xl">
                            <div class="flex items-center justify-between gap-2 mb-4">
                                <div class="flex items-center gap-2">
                                    <span class="material-symbols-outlined text-secondary">water_drop</span>
                                    <h3 class="font-bold text-sm">Standar Kadar Air</h3>
                                </div>
                                <span class="px-2 py-0.5 rounded bg-amber-100 text-amber-800 text-[9px] font-extrabold uppercase tracking-wider">Simulasi</span>
                            </div>
                            <div class="space-y-3">
                                <div>
                                    <label class="text-[10px] uppercase font-bold text-on-surface-variant">Kadar Air Target (Standar CV)</label>
                                    <div class="flex items-center gap-2 mt-1">
                                        <input type="number" name="kadar_air_target" value="{{ $settings['kadar_air_target'] ?? '15' }}" step="0.1"
                                            class="w-full rounded-xl border border-outline-variant px-3 py-2 text-sm outline-none focus:border-primary">
                                        <span class="text-label-sm font-bold">%</span>
                                    </div>
                                </div>
                                <div>
                                    <label class="text-[10px] uppercase font-bold text-on-surface-variant">Batas Risiko Jamur</label>
                                    <div class="flex items-center gap-2 mt-1">
                                        <input type="number" name="kadar_air_warning" value="{{ $settings['kadar_air_warning'] ?? '17' }}" step="0.1"
                                            class="w-full rounded-xl border border-warning px-3 py-2 text-sm outline-none focus:ring-1 focus:ring-warning">
                                        <span class="text-label-sm font-bold">%</span>
                                    </div>
                                    <p class="text-[10px] text-warning mt-1">Jagung kadar air ≤ 17% rentan jamur, harus dikebut ke 15%.</p>
                                </div>
                            </div>
                        </div>

                        {{-- Batas Penerimaan Jagung --}}
                        <div class="sm:col-span-2 p-4 bg-surface-container-lowest border border-outline-variant/50 rounded-2xl">
                            <div class="flex items-center gap-2 mb-2">
                                <span class="material-symbols-outlined text-primary">input</span>
                                <h3 class="font-bold text-sm">Batas Penerimaan Jagung</h3>
                            </div>
                            <p class="text-xs text-on-surface-variant mb-4">Tentukan rentang kadar air jagung yang boleh diterima masuk ke mesin pengering. Di luar rentang ini, jagung perlu penanganan khusus terlebih dahulu.</p>

                            <div class="grid sm:grid-cols-2 gap-4">
                                {{-- Minimum --}}
                                <div class="p-3 border border-outline-variant/30 rounded-xl bg-white">
                                    <div class="flex items-center gap-2 mb-2">
                                        <span class="material-symbols-outlined text-sm text-secondary">arrow_downward</span>
                                        <span class="font-bold text-sm">Kadar Air Minimum</span>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <input type="number" name="ka_masuk_min" value="{{ $settings['ka_masuk_min'] ?? '18' }}" step="0.1"
                                            class="w-full rounded-lg border border-outline-variant px-2 py-2 text-sm text-center outline-none focus:border-primary">
                                        <span class="text-sm font-bold text-on-surface-variant">%</span>
                                    </div>
                                    <p class="text-[10px] text-on-surface-variant mt-2">Jagung di bawah nilai ini dianggap sudah cukup kering, tidak perlu masuk mesin.</p>
                                </div>

                                {{-- Maksimum --}}
                                <div class="p-3 border border-outline-variant/30 rounded-xl bg-white">
                                    <div class="flex items-center gap-2 mb-2">
                                        <span class="material-symbols-outlined text-sm text-error">arrow_upward</span>
                                        <span class="font-bold text-sm">Kadar Air Maksimum</span>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <input type="number" name="ka_masuk_max" value="{{ $settings['ka_masuk_max'] ?? '38' }}" step="0.1"
                                            class="w-full rounded-lg border border-error px-2 py-2 text-sm text-center outline-none focus:ring-1 focus:ring-error">
                                        <span class="text-sm font-bold text-on-surface-variant">%</span>
                                    </div>
                                    <p class="text-[10px] text-error mt-2">Jagung di atas nilai ini terlalu basah, butuh pra-pengeringan manual dulu.</p>
                                </div>
                        </div>

                        {{-- Target Tonase --}}
                        <div class="sm:col-span-2 p-4 bg-surface-container-lowest border border-outline-variant/50 rounded-2xl">
                            <div class="flex items-center gap-2 mb-2">
                                <span class="material-symbols-outlined text-primary">scale</span>
                                <h3 class="font-bold text-sm">Target Tonase Pengeringan</h3>
                            </div>
                            <p class="text-xs text-on-surface-variant mb-4">Tentukan target volume tonase jagung yang ingin dicapai untuk skala bulanan dan tahunan.</p>

                            <div class="grid sm:grid-cols-2 gap-4">
                                {{-- Bulanan --}}
                                <div class="p-3 border border-outline-variant/30 rounded-xl bg-white">
                                    <label class="text-[10px] uppercase font-bold text-on-surface-variant">Target Bulanan (Laporan)</label>
                                    <div class="flex items-center gap-2 mt-1">
                                        <input type="number" name="target_tonase_bulanan" value="{{ $settings['target_tonase_bulanan'] ?? '500' }}" 
                                            class="w-full rounded-lg border border-outline-variant px-3 py-2 text-sm outline-none focus:border-primary">
                                        <span class="text-sm font-bold text-on-surface-variant">Kg</span>
                                    </div>
                                </div>

                                {{-- Tahunan --}}
                                <div class="p-3 border border-outline-variant/30 rounded-xl bg-white">
                                    <label class="text-[10px] uppercase font-bold text-on-surface-variant">Target Tahunan (Timbangan)</label>
                                    <div class="flex items-center gap-2 mt-1">
                                        <input type="number" name="target_tonase_tahunan" value="{{ $settings['target_tonase_tahunan'] ?? '1500' }}" 
                                            class="w-full rounded-lg border border-outline-variant px-3 py-2 text-sm outline-none focus:border-primary">
                                        <span class="text-sm font-bold text-on-surface-variant">Kg</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- 4. Aturan Notifikasi & Trigger --}}
                <div class="glass-card custom-shadow rounded-3xl p-lg">
                    <div class="mb-6">
                        <h2 class="font-title-lg text-title-lg font-bold">Aturan Trigger Notifikasi</h2>
                        <p class="text-on-surface-variant text-body-md">Pilih kondisi mana saja yang akan memicu pengiriman pesan WA.</p>
                    </div>

                    <div class="space-y-4">
                        {{-- Notif Balik --}}
                        <div class="flex items-center justify-between p-4 bg-white border border-outline-variant rounded-2xl">
                            <div>
                                <h3 class="font-bold text-sm">Peringatan: Waktu Balik Jagung</h3>
                                <p class="text-xs text-on-surface-variant">Ingatkan admin/petani saat jagung perlu dibalik merata.</p>
                            </div>
                            <label class="switch">
                                <input type="checkbox" name="notif_balik" value="1" {{ ($settings['notif_balik'] ?? '1') == '1' ? 'checked' : '' }} />
                                <span class="slider"></span>
                            </label>
                        </div>
                        
                        {{-- Notif Suhu --}}
                        <div class="flex items-center justify-between p-4 bg-white border border-outline-variant rounded-2xl border-l-4 border-l-error">
                            <div>
                                <h3 class="font-bold text-sm">Peringatan Kritis: Suhu Maksimal</h3>
                                <p class="text-xs text-on-surface-variant">Kirim peringatan jika suhu tungku melewati suhu maksimal ({{ $settings['suhu_max'] ?? 60 }}°C).</p>
                            </div>
                            <label class="switch">
                                <input type="checkbox" name="notif_suhu_tinggi" value="1" {{ ($settings['notif_suhu_tinggi'] ?? '1') == '1' ? 'checked' : '' }} />
                                <span class="slider"></span>
                            </label>
                        </div>

                        {{-- Notif Jamur --}}
                        <div class="flex items-center justify-between p-4 bg-white border border-outline-variant rounded-2xl border-l-4 border-l-warning opacity-70">
                            <div>
                                <div class="flex items-center gap-2">
                                    <h3 class="font-bold text-sm">Peringatan Kritis: Risiko Jamur</h3>
                                    <span class="px-1.5 py-0.5 rounded bg-red-100 text-red-800 text-[9px] font-extrabold uppercase tracking-wider">Bypass (Tanpa Sensor)</span>
                                </div>
                                <p class="text-xs text-on-surface-variant">Kirim peringatan jika kadar air tertahan di ≤ {{ $settings['kadar_air_warning'] ?? 17 }}% (risiko jamur tinggi).</p>
                            </div>
                            <label class="switch">
                                <input type="checkbox" name="notif_jamur" value="1" {{ ($settings['notif_jamur'] ?? '0') == '1' ? 'checked' : '' }} />
                                <span class="slider"></span>
                            </label>
                        </div>

                        {{-- Notif Selesai --}}
                        <div class="flex items-center justify-between p-4 bg-white border border-outline-variant rounded-2xl border-l-4 border-l-primary">
                            <div>
                                <h3 class="font-bold text-sm">Informasi: Timer Pengeringan Selesai</h3>
                                <p class="text-xs text-on-surface-variant">Notifikasi otomatis ke WhatsApp saat durasi timer pengeringan kompor (misal: 1 jam, 3 jam) telah habis.</p>
                            </div>
                            <label class="switch">
                                <input type="checkbox" name="notif_selesai" value="1" {{ ($settings['notif_selesai'] ?? '1') == '1' ? 'checked' : '' }} />
                                <span class="slider"></span>
                            </label>
                        </div>
                        
                        {{-- Broadcast ke Petani --}}
                        <div class="flex items-center justify-between p-4 bg-primary/5 border border-primary/20 rounded-2xl mt-6">
                            <div>
                                <div class="flex items-center gap-2">
                                    <span class="material-symbols-outlined text-primary">campaign</span>
                                    <h3 class="font-bold text-sm text-primary">Tembuskan ke Petani Terkait?</h3>
                                </div>
                                <p class="text-xs text-on-surface-variant mt-1">Jika aktif, notifikasi (Balik Jagung & Selesai) juga akan dikirim ke nomor WA Petani pemilik batch tersebut.</p>
                            </div>
                            <label class="switch">
                                <input type="checkbox" name="notif_kirim_ke_petani" value="1" {{ ($settings['notif_kirim_ke_petani'] ?? '0') == '1' ? 'checked' : '' }} />
                                <span class="slider"></span>
                            </label>
                        </div>
                    </div>
                </div>

                {{-- 5. Editor Template Pesan --}}
                <div class="glass-card custom-shadow rounded-3xl p-lg">
                    <div class="mb-6">
                        <h2 class="font-title-lg text-title-lg font-bold">Template Pesan Notifikasi</h2>
                        <p class="text-on-surface-variant text-body-md">Atur redaksi pesan yang akan dikirim via WhatsApp.</p>
                    </div>

                    <div class="space-y-6">
                        {{-- Template Selesai --}}
                        <div>
                            <label class="font-bold text-sm text-on-surface block mb-2">Template: Pengeringan Selesai</label>
                            <textarea name="template_selesai" rows="6" 
                                class="w-full rounded-2xl border border-outline-variant bg-surface px-4 py-3 text-sm focus:border-primary focus:ring-1 outline-none">{{ $settings['template_selesai'] ?? '' }}</textarea>
                            <p class="text-[10px] text-on-surface-variant mt-1">Tag tersedia: <code>{nama_petani}</code>, <code>{batch_id}</code>, <code>{kadar_air}</code>, <code>{tonase}</code>, <code>{durasi}</code></p>
                        </div>

                        {{-- Template Balik Jagung --}}
                        <div>
                            <label class="font-bold text-sm text-on-surface block mb-2">Template: Waktu Balik Jagung</label>
                            <textarea name="template_balik" rows="6" 
                                class="w-full rounded-2xl border border-outline-variant bg-surface px-4 py-3 text-sm focus:border-primary focus:ring-1 outline-none">{{ $settings['template_balik'] ?? '' }}</textarea>
                            <p class="text-[10px] text-on-surface-variant mt-1">Tag tersedia: <code>{nama_petani}</code>, <code>{batch_id}</code>, <code>{kadar_air}</code>, <code>{suhu}</code>, <code>{durasi}</code></p>
                        </div>

                        {{-- Template Risiko Jamur --}}
                        <div>
                            <label class="font-bold text-sm text-on-surface block mb-2">Template: Risiko Jamur</label>
                            <textarea name="template_jamur" rows="5" 
                                class="w-full rounded-2xl border border-outline-variant bg-surface px-4 py-3 text-sm focus:border-primary focus:ring-1 outline-none">{{ $settings['template_jamur'] ?? '' }}</textarea>
                            <p class="text-[10px] text-on-surface-variant mt-1">Tag tersedia: <code>{batch_id}</code>, <code>{kadar_air}</code>, <code>{waktu}</code></p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</form>
@endsection
