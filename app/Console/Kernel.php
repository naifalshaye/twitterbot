<?php

namespace App\Console;

use App\Conf;
use App\Console\Commands\DMFollower;
use App\Console\Commands\Scheduled;
use App\Console\Commands\StopStreaming;
use App\Console\Commands\StreamTwitter;
use App\Console\Commands\TwitterStream;
use App\Console\Commands\ChatCommand;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\App;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        StreamTwitter::class,
        ChatCommand::class,
        Scheduled::class,
        DMFollower::class,
        StopStreaming::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        if (App::environment('production')) {
            $conf = Conf::findOrNew(1);
            if (!$conf->turn_off) {

                $schedule->command('twitterbot:chat')
                    ->everyMinute();

                $schedule->command('twitterbot:streaming')
                    ->everyThirtyMinutes();

                $schedule->command('twitterbot:scheduled')
                    ->everyMinute();

                $schedule->command('twitterbot:dmfollower')
                    ->everyMinute();
            }
        }
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
