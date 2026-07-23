<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Carbon\Carbon;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Carbon::setLocale('id');

        // View Composer untuk Notifikasi Dinamis di Header Admin
        \Illuminate\Support\Facades\View::composer('admin.layout.header', function ($view) {
            $notifications = [];

            // 1. Cek Data IoT Terbaru untuk Alert Suhu / Kelembaban Kritis
            $latestSensor = \App\Models\DryingMonitor::latest()->first();
            if ($latestSensor && ($latestSensor->temperature >= 45.0 || $latestSensor->moisture >= 18.0)) {
                $notifications[] = (object)[
                    'id'      => 'notif_sensor_' . $latestSensor->id,
                    'title'   => 'Peringatan Kondisi Kritis!',
                    'message' => "Suhu {$latestSensor->temperature}°C, Kadar Air {$latestSensor->moisture}%. Segera lakukan pembalikan jagung!",
                    'time'    => $latestSensor->created_at->diffForHumans(),
                    'icon'    => 'warning',
                    'bg'      => 'bg-error-container text-error',
                    'link'    => route('admin.pemantauan')
                ];
            }

            // 2. Pesan Masuk Terbaru dari Pengunjung yang Belum Dibaca
            $latestMessage = \App\Models\ContactMessage::where('is_read', false)->latest()->first();
            if ($latestMessage) {
                $notifications[] = (object)[
                    'id'      => 'notif_msg_' . $latestMessage->id,
                    'title'   => 'Pesan Pengunjung Baru',
                    'message' => "Dari {$latestMessage->name}: \"" . \Illuminate\Support\Str::limit($latestMessage->message, 40) . "\"",
                    'time'    => $latestMessage->created_at->diffForHumans(),
                    'icon'    => 'mail',
                    'bg'      => 'bg-tertiary-fixed text-on-tertiary-fixed',
                    'link'    => route('admin.pesan')
                ];
            }

            // 3. Transaksi Selesai Terbaru
            $latestDone = \App\Models\Transaction::where('status', 'Selesai')->latest()->first();
            if ($latestDone) {
                $notifications[] = (object)[
                    'id'      => 'notif_done_' . $latestDone->id,
                    'title'   => 'Pengeringan Selesai',
                    'message' => "Batch \"{$latestDone->farmer_name}\" ({$latestDone->tonnage} Kg) telah selesai dikeringkan.",
                    'time'    => $latestDone->created_at->diffForHumans(),
                    'icon'    => 'check_circle',
                    'bg'      => 'bg-secondary-container text-secondary',
                    'link'    => route('admin.laporan')
                ];
            }

            // 4. Transaksi Dalam Proses (Antrean Aktif)
            $latestProcess = \App\Models\Transaction::where('status', 'Proses')->latest()->first();
            if ($latestProcess) {
                $notifications[] = (object)[
                    'id'      => 'notif_proc_' . $latestProcess->id,
                    'title'   => 'Pengeringan Berjalan',
                    'message' => "Petani {$latestProcess->farmer_name} sedang dalam proses pengeringan.",
                    'time'    => $latestProcess->created_at->diffForHumans(),
                    'icon'    => 'sync',
                    'bg'      => 'bg-primary-fixed text-primary',
                    'link'    => route('admin.tonase-jagung')
                ];
            }

            $view->with('notificationsList', $notifications);
        });
    }
}
