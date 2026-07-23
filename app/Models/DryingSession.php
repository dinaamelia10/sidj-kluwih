<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class DryingSession extends Model
{
    use HasFactory;

    protected $fillable = [
        'batch_name',
        'farmer_name',
        'start_time',
        'target_duration_hours',
        'end_time',
        'actual_duration_minutes',
        'status',
        'wa_notified',
        'notes',
    ];

    protected $casts = [
        'start_time' => 'datetime',
        'end_time' => 'datetime',
        'target_duration_hours' => 'float',
        'actual_duration_minutes' => 'integer',
        'wa_notified' => 'boolean',
    ];

    /**
     * Total target duration in seconds.
     */
    public function getTargetSecondsAttribute(): int
    {
        return (int) round(($this->target_duration_hours ?? 3.0) * 3600);
    }

    /**
     * Elapsed duration in seconds for running or completed session.
     */
    public function getElapsedSecondsAttribute(): int
    {
        if ($this->status === 'Berjalan') {
            return max(0, (int) Carbon::now()->diffInSeconds($this->start_time));
        }

        if ($this->end_time) {
            return max(0, (int) $this->end_time->diffInSeconds($this->start_time));
        }

        return ($this->actual_duration_minutes ?? 0) * 60;
    }

    /**
     * Remaining duration in seconds.
     */
    public function getRemainingSecondsAttribute(): int
    {
        if ($this->status !== 'Berjalan') {
            return 0;
        }

        return max(0, $this->target_seconds - $this->elapsed_seconds);
    }

    /**
     * Progress percentage (0 - 100).
     */
    public function getProgressPercentAttribute(): int
    {
        if ($this->status === 'Selesai') {
            return 100;
        }

        $target = $this->target_seconds;
        if ($target <= 0) return 100;

        $percent = round(($this->elapsed_seconds / $target) * 100);
        return (int) min(100, max(0, $percent));
    }

    /**
     * Formatted string of elapsed duration (HH:MM:SS or X jam Y menit).
     */
    public function getFormattedElapsedAttribute(): string
    {
        $seconds = $this->elapsed_seconds;
        $h = floor($seconds / 3600);
        $m = floor(($seconds % 3600) / 60);
        $s = $seconds % 60;

        return sprintf('%02d:%02d:%02d', $h, $m, $s);
    }

    /**
     * Formatted total duration display (e.g. "3 Jam" or "2.5 Jam").
     */
    public function getFormattedTargetHoursAttribute(): string
    {
        $val = $this->target_duration_hours;
        if (floor($val) == $val) {
            return (int)$val . ' Jam';
        }
        return number_format($val, 1) . ' Jam';
    }

    /**
     * Formatted actual duration display (e.g. "3 Jam 15 Menit" or "45 Menit").
     */
    public function getFormattedActualDurationAttribute(): string
    {
        $minutes = $this->actual_duration_minutes;
        if (!$minutes && $this->status === 'Berjalan') {
            $minutes = (int) round($this->elapsed_seconds / 60);
        }

        if (!$minutes) return '-';

        $h = floor($minutes / 60);
        $m = $minutes % 60;

        if ($h > 0 && $m > 0) {
            return "{$h} Jam {$m} Menit";
        } elseif ($h > 0) {
            return "{$h} Jam";
        } else {
            return "{$m} Menit";
        }
    }

    /**
     * Complete the session and send WhatsApp notification based on Settings.
     */
    public function finishAndNotify(): bool
    {
        if ($this->wa_notified && $this->status === 'Selesai') {
            return false;
        }

        $actualMinutes = (int) round(now()->diffInMinutes($this->start_time));
        $this->update([
            'status' => 'Selesai',
            'end_time' => now(),
            'actual_duration_minutes' => max(1, $actualMinutes),
            'wa_notified' => true,
        ]);

        if (Setting::getVal('notif_selesai', '1') == '1') {
            $template = Setting::getVal('template_selesai');
            if (!empty(trim($template ?? ''))) {
                $pesan = WhatsAppService::compileTemplate('template_selesai', [
                    'nama_petani' => $this->farmer_name,
                    'batch_id' => $this->batch_name,
                    'durasi' => $this->formatted_target_hours,
                    'kadar_air' => Setting::getVal('kadar_air_target', '15') . '%',
                    'tonase' => '-',
                ]);
            } else {
                $pesan = "✅ *PROSES PENGERINGAN SELESAI* ✅\n\nWaktu pengeringan untuk *{$this->batch_name}* ({$this->farmer_name}) selama *{$this->formatted_target_hours}* telah habis!\n\n_Silakan matikan kompor dan periksa hasil pengeringan._\n\n_SIDJ Kluwih - CV Fian Putra_";
            }

            WhatsAppService::sendToAdmins($pesan);

            if (Setting::getVal('notif_kirim_ke_petani', '0') == '1') {
                $petaniObj = Petani::where('nama', $this->farmer_name)->first();
                if ($petaniObj && !empty($petaniObj->no_telp)) {
                    WhatsAppService::sendMessage($petaniObj->no_telp, $pesan);
                }
            }
        }

        return true;
    }
}
