<?php

namespace App\Console;

use App\Console\Commands\ConnectToStreamingAPI;
use App\Console\Commands\Twitter;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        Twitter::class,
        ConnectToStreamingAPI::class
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
//         $schedule->command('inspire')
//                  ->everyMinute();
        $schedule->command('twitter')
            ->everyMinute();

//        $schedule->command('connect_to_streaming_api')
//            ->daily();
    }

    /**
     * Register the Closure based commands for the appli   cation.
     *
     * @return void
     */
    protected function commands()
    {
        require base_path('routes/console.php');
    }
}
