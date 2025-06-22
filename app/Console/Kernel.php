<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // $schedule->command('inspire')->hourly();
        $schedule->command('transactions:create-recurring')->dailyAt('01:00'); // Jalankan setiap hari jam 1 pagi
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

// Langkah 4: Cara Kerja dan Pengujian
// Bagaimana Ini Bekerja di Server Asli?
// Agar penjadwalan ini berjalan otomatis di server hosting, Anda hanya perlu menambahkan satu baris Cron Job ke server Anda. Cron Job ini akan memicu scheduler Laravel setiap menit.

// * * * * * cd /path-to-your-project && php artisan schedule:run >> /dev/null 2>&1
