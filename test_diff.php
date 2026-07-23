<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\DryingSession;
use Carbon\Carbon;

$s = DryingSession::find(3);
echo "Session ID: " . $s->id . PHP_EOL;
echo "Start Time: " . $s->start_time . PHP_EOL;
echo "End Time: " . $s->end_time . PHP_EOL;
$actualMinutes = (int) round($s->end_time->diffInMinutes($s->start_time));
echo "diffInMinutes: " . $actualMinutes . PHP_EOL;
echo "diffInSeconds: " . $s->end_time->diffInSeconds($s->start_time) . PHP_EOL;
