<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->text('value')->nullable();
            $table->string('group')->default('general'); // wa_api, pengeringan, notifikasi, penerima
            $table->string('label')->nullable();
            $table->timestamps();
        });

        // Seed default settings CV Fian Putra
        $defaults = [
            // === WhatsApp API ===
            ['key' => 'wa_api_token',       'value' => '',              'group' => 'wa_api',      'label' => 'API Token Fonnte'],
            ['key' => 'wa_sender_number',   'value' => '',              'group' => 'wa_api',      'label' => 'Nomor Pengirim (WhatsApp)'],
            ['key' => 'wa_enabled',         'value' => '1',             'group' => 'wa_api',      'label' => 'Aktifkan Notifikasi WA'],

            // === Penerima Notifikasi ===
            ['key' => 'admin_wa_number',    'value' => '',              'group' => 'penerima',    'label' => 'Nomor WA Admin Utama'],
            ['key' => 'admin_wa_name',      'value' => 'Admin Utama',   'group' => 'penerima',    'label' => 'Nama Admin Utama'],
            ['key' => 'supervisor_wa_number','value' => '',             'group' => 'penerima',    'label' => 'Nomor WA Supervisor'],
            ['key' => 'supervisor_wa_name', 'value' => 'Supervisor',    'group' => 'penerima',    'label' => 'Nama Supervisor'],

            // === Parameter Pengeringan (sesuai CV Fian Putra) ===
            ['key' => 'suhu_target',        'value' => '82',            'group' => 'pengeringan', 'label' => 'Suhu Operasional Target (°C)'],
            ['key' => 'suhu_max',           'value' => '85',            'group' => 'pengeringan', 'label' => 'Suhu Maksimum (°C)'],
            ['key' => 'kadar_air_target',   'value' => '15',            'group' => 'pengeringan', 'label' => 'Target Kadar Air Standar (%)'],
            ['key' => 'kadar_air_warning',  'value' => '17',            'group' => 'pengeringan', 'label' => 'Batas Kadar Air Risiko Jamur (%)'],
            ['key' => 'durasi_estimasi',    'value' => '6',             'group' => 'pengeringan', 'label' => 'Estimasi Durasi Pengeringan (Jam)'],
            ['key' => 'grup_a_min',         'value' => '18',            'group' => 'pengeringan', 'label' => 'Kelompok A - Kadar Air Min (%)'],
            ['key' => 'grup_a_max',         'value' => '25',            'group' => 'pengeringan', 'label' => 'Kelompok A - Kadar Air Max (%)'],
            ['key' => 'grup_b_min',         'value' => '25',            'group' => 'pengeringan', 'label' => 'Kelompok B - Kadar Air Min (%)'],
            ['key' => 'grup_b_max',         'value' => '38',            'group' => 'pengeringan', 'label' => 'Kelompok B - Kadar Air Max (%)'],

            // === Aturan Notifikasi ===
            ['key' => 'notif_balik',        'value' => '1',             'group' => 'notifikasi',  'label' => 'Notifikasi Jagung Perlu Dibalik'],
            ['key' => 'notif_selesai',      'value' => '1',             'group' => 'notifikasi',  'label' => 'Notifikasi Pengeringan Selesai'],
            ['key' => 'notif_jamur',        'value' => '1',             'group' => 'notifikasi',  'label' => 'Notifikasi Risiko Jamur (≤17%)'],
            ['key' => 'notif_suhu_tinggi',  'value' => '1',             'group' => 'notifikasi',  'label' => 'Notifikasi Suhu Melebihi Batas'],
            ['key' => 'notif_kirim_ke_petani', 'value' => '0',          'group' => 'notifikasi',  'label' => 'Kirim Notifikasi ke Petani'],

            // === Template Pesan ===
            ['key' => 'template_balik',     'value' => "🌽 *JAGUNG PERLU DIBALIK* 🌽\n\nHalo {nama_petani},\n\nJagung milik Anda (Batch {batch_id}) sudah {durasi} jam dalam proses pengeringan.\nKadar air saat ini: *{kadar_air}%*\nSuhu pengering: *{suhu}°C*\n\nMohon segera lakukan pembalikan agar pengeringan merata.\n\n_CV Fian Putra - SIDJ Kluwih_", 'group' => 'template', 'label' => 'Template: Jagung Perlu Dibalik'],
            ['key' => 'template_selesai',   'value' => "✅ *PENGERINGAN SELESAI* ✅\n\nHalo {nama_petani},\n\nProses pengeringan jagung Anda (Batch {batch_id}) telah selesai!\nKadar air akhir: *{kadar_air}%* (standar 15%)\nTotal tonase: *{tonase} Kg*\nDurasi: *{durasi} Jam*\n\nJagung siap diambil. Terima kasih! 🤝\n\n_CV Fian Putra - SIDJ Kluwih_", 'group' => 'template', 'label' => 'Template: Pengeringan Selesai'],
            ['key' => 'template_jamur',     'value' => "⚠️ *PERINGATAN RISIKO JAMUR* ⚠️\n\nKadar air jagung pada Batch {batch_id} terdeteksi *{kadar_air}%*.\n\nKadar air ≤17% memiliki potensi jamur lebih tinggi. Segera proses pengeringan lanjutan hingga mencapai 15%.\n\nWaktu deteksi: {waktu}\n\n_SIDJ Kluwih - CV Fian Putra_", 'group' => 'template', 'label' => 'Template: Risiko Jamur'],
        ];

        foreach ($defaults as $row) {
            DB::table('settings')->insert(array_merge($row, [
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
