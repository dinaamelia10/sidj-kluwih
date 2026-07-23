<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Services\WhatsAppService;
use App\Models\Setting;

echo "=== TEST NOTIFIKASI WHATSAPP SIDJ KLUWIH ===" . PHP_EOL;
echo "WA Enabled : " . Setting::getVal('wa_enabled', '0') . PHP_EOL;
echo "API Token  : " . (Setting::getVal('wa_api_token') ? 'ADA' : 'KOSONG') . PHP_EOL;
echo "Admin No.  : " . Setting::getVal('admin_wa_number', '-') . PHP_EOL;
echo "-------------------------------------------" . PHP_EOL;

$nomorTujuan = Setting::getVal('admin_wa_number');

if (empty($nomorTujuan)) {
    echo "ERROR: Nomor WA Admin belum diisi di pengaturan!" . PHP_EOL;
    exit(1);
}

echo "Mengirim pesan ke: $nomorTujuan ..." . PHP_EOL;

$result = WhatsAppService::sendMessage(
    $nomorTujuan,
    "*[TEST SIDJ Kluwih]* \n\nHalo! Ini pesan uji coba dari sistem. Notifikasi WhatsApp berfungsi normal. ✅"
);

if ($result) {
    echo "✅ SUKSES! Pesan berhasil dikirim ke $nomorTujuan" . PHP_EOL;
} else {
    echo "❌ GAGAL! Cek detail error di: storage/logs/laravel.log" . PHP_EOL;
}
