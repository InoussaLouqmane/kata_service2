<?php

namespace App\Console;

use App\Jobs\AddFeesPayments;
use App\Models\Fees;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Log;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // $schedule->command('inspire')->hourly();

        $schedule->call(function () {
            $fees = Fees::whereNotNull(Fees::LAST_CHARGED_AT)
            ->where(function ($query) {
                $query->where(Fees::LAST_CHARGED_AT, '<=', now()->subMinutes());
            })
            ->get();

            Log::info('Il y a '. $fees->count(). ' frais concernés en cours.');
            foreach ($fees as $fee) {
                AddFeesPayments::dispatch($fee);

            }
        })->everyMinute();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
