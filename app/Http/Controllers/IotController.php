<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;
use App\Models\DryingMonitor;
use App\Services\WhatsAppService;
use Illuminate\Support\Facades\Log;

class IotController extends Controller
{
    /**
     * Endpoint untuk menerima data dari Sensor (ESP32/NodeMCU)
     * Method: POST
     * Payload: { "suhu": 86.5, "kadar_air": 16.0, "batch_id": "BATCH-001" }
     */
    public function receiveData(Request $request)
    {
        // 1. Validasi Data dari Sensor Yesaya
        $request->validate([
            'suhu' => 'required|numeric',
            'kadar_air' => 'nullable|numeric',
            'batch_id' => 'nullable|string'
        ]);

        $suhu = $request->suhu;
        $kadarAir = $request->kadar_air ?? 0.0;
        $batchId = $request->batch_id ?? 'Tungku Utama';
        $waktu = now()->format('H:i');

        // Simpan data IoT langsung ke database DryingMonitor
        $dryingMonitor = DryingMonitor::create([
            'temperature' => $suhu,
            'moisture'    => $kadarAir,
        ]);

        Log::info("Data IoT Masuk & Tersimpan: ID={$dryingMonitor->id}, Suhu={$suhu}°C, KadarAir={$kadarAir}%");

        // 2. Ambil Parameter Pengaturan
        $suhuMax = (float) Setting::getVal('suhu_max', 60);
        $kadarTarget = (float) Setting::getVal('kadar_air_target', 15);
        $kadarWarning = (float) Setting::getVal('kadar_air_warning', 17);

        // --- Cek Aturan Notifikasi ---

        // A. Peringatan Suhu Tinggi
        if (Setting::getVal('notif_suhu_tinggi') == '1' && $suhu > $suhuMax) {
            // Gunakan template darurat atau fallback hardcoded
            $pesan = "⚠️ *PERINGATAN KRITIS: SUHU TERLALU PANAS* ⚠️\n\nSuhu pada $batchId saat ini mencapai *$suhu °C* (Batas maksimal: $suhuMax °C).\nBisa merusak jagung! Segera turunkan api kompor.\n\n_SIJALU-Kluwih_";
            WhatsAppService::sendToAdmins($pesan);
        }

        // B. Risiko Jamur
        // Asumsi kita mengirim peringatan jamur jika kadar air tertahan antara batas target (15) dan batas warning (17)
        if (Setting::getVal('notif_jamur') == '1' && $kadarAir > 0 && $kadarAir <= $kadarWarning && $kadarAir > $kadarTarget) {
            $pesan = WhatsAppService::compileTemplate('template_jamur', [
                'batch_id' => $batchId,
                'kadar_air' => $kadarAir,
                'waktu' => $waktu
            ]);
            WhatsAppService::sendToAdmins($pesan);
        }

        // C. Pengeringan Selesai Berdasarkan Timer (DryingSession)
        $activeSession = \App\Models\DryingSession::where('status', 'Berjalan')->first();
        if ($activeSession && $activeSession->remaining_seconds <= 0 && !$activeSession->wa_notified) {
            $activeSession->finishAndNotify();
        }

        // D. Waktu Balik Jagung (Simulasi: kita asumsikan jika selisih > tertentu atau berdasar timer)
        // Karena ini bergantung pada waktu dan sensor statis, biasanya trigger balik 
        // dilakukan manual oleh admin di dashboard, atau otomatis jika suhu dan kadar terindikasi perlu diaduk.

        return response()->json([
            'status' => 'success',
            'message' => 'Data diterima dan dievaluasi'
        ]);
    }
}
