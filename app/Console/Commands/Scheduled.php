<?php

namespace App\Console\Commands;

use App\Schedule;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\App;
use Twitter;

class Scheduled extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Scheduled';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Post scheduled tweets';

    /**
     * Scheduled constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $twitter_dg = new Twitter(config('ttwitter.CONSUMER_KEY'), config('ttwitter.CONSUMER_SECRET'), config('ttwitter.ACCESS_TOKEN'), config('ttwitter.ACCESS_TOKEN_SECRET'));

        $date = Carbon::now()->format('Y-m-d');
        $time = Carbon::now();
        $time->setTimezone('Asia/Riyadh');
        $time = $time->format('H:i');

        $schedules = Schedule::where('date', $date)->where('time', $time)->get();
        foreach ($schedules as $schedule) {
            if (!$schedule->disable) {
                try {
                    $twitter_dg->send($schedule->text);

                    $schedule->sent = true;
                    $schedule->save();
                } catch (\Exception $e) {
                    dd($e->getMessage());
                }
            }
        }
    }
}
