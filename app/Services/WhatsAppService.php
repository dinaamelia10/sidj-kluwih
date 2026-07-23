<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use App\Models\Setting;
use Illuminate\Support\Facades\Log;

class WhatsAppService
{
    /**
     * Kirim pesan WhatsApp menggunakan API Fonnte
     */
    public static function sendMessage($targetNumber, $message)
    {
        $enabled = Setting::getVal('wa_enabled', '0');
        if ($enabled !== '1') {
            Log::info("WhatsAppService: Notifikasi dimatikan di pengaturan. Pesan tidak dikirim ke $targetNumber");
            return false;
        }

        $token = Setting::getVal('wa_api_token');
        if (empty($token)) {
            Log::error("WhatsAppService: API Token Fonnte belum diisi di Pengaturan!");
            return false;
        }

        try {
            $response = Http::withoutVerifying()->withHeaders([
                'Authorization' => $token
            ])->post('https://api.fonnte.com/send', [
                'target' => $targetNumber,
                'message' => $message,
                'countryCode' => '62', // Default Indonesia
            ]);

            if ($response->successful()) {
                Log::info("WhatsAppService: Berhasil mengirim WA ke $targetNumber");
                return true;
            } else {
                Log::error("WhatsAppService: Gagal mengirim WA ke $targetNumber. Response: " . $response->body());
                return false;
            }
        } catch (\Exception $e) {
            Log::error("WhatsAppService: Error - " . $e->getMessage());
            return false;
        }
    }

    /**
     * Kirim ke semua Admin / Supervisor yang aktif di Pengaturan
     */
    public static function sendToAdmins($message)
    {
        $adminWa = Setting::getVal('admin_wa_number');
        $supervisorWa = Setting::getVal('supervisor_wa_number');

        if (!empty($adminWa)) {
            self::sendMessage($adminWa, $message);
        }
        if (!empty($supervisorWa)) {
            self::sendMessage($supervisorWa, $message);
        }
    }

    /**
     * Compile template dengan array replacement
     * Contoh text: Halo {nama}, suhu sekarang {suhu}
     * replacements: ['nama' => 'Budi', 'suhu' => 85]
     */
    public static function compileTemplate($templateKey, $replacements = [])
    {
        $template = Setting::getVal($templateKey);
        if (!$template) return "";

        foreach ($replacements as $key => $value) {
            $template = str_replace('{' . $key . '}', $value, $template);
        }

        return $template;
    }
}
