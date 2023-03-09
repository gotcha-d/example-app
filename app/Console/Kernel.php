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
        $schedule->command('mail:send-daily-tweet-count-mail')
            ->dailyAt('11:00');
            
        // 毎分
        // $schedule->command('sample-command')->everyMinute()
        //     ->emailOutputTo('info@exmaple.com'); // スケジューラの実行結果はデフォルトだと捨てられてしまうので、メールで送付する。
        // // 毎時
        // $schedule->command('sample-command')->hourly();
        // // 毎時8分
        // $schedule->command('sample-command')->hourlyAt(8);
        // // 毎日
        // $schedule->command('sample-command')->daily();
        // // 毎日13時
        // $schedule->command('sample-command')->dailyAt(13);
        // // 毎日3:15(Cron表記)
        // $schedule->command('sample-command')->cron('15 3 * * *');
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
