<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\DryingSession;

$sessions = DryingSession::latest()->take(10)->get();

echo "ID | Status | Start Time | End Time | Target Hours | Actual Mins" . PHP_EOL;
echo "-------------------------------------------------------------------" . PHP_EOL;
foreach ($sessions as $s) {
    echo "{$s->id} | {$s->status} | {$s->start_time} | {$s->end_time} | {$s->target_duration_hours} | {$s->actual_duration_minutes}" . PHP_EOL;
}
