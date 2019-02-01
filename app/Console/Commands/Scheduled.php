<?php

namespace App\Console\Commands;

use App\Conf;
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
    protected $signature = 'twitterbot:scheduled';

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
     * @throws \TwitterException
     */
    public function handle()
    {
        $conf = Conf::findOrNew(1);
        if ($conf->turn_off){
            return;
        }

        $twitter_dg = new Twitter(config('ttwitter.CONSUMER_KEY'), config('ttwitter.CONSUMER_SECRET'), config('ttwitter.ACCESS_TOKEN'), config('ttwitter.ACCESS_TOKEN_SECRET'));

        $date = Carbon::now()->format('Y-m-d');
        $time = Carbon::now();
        if (!empty(config('bot.timezone'))) {
            $time->setTimezone(config('bot.timezone'));
        }
        $time = $time->format('H:i');

        $schedules = Schedule::where('date', $date)->where('time', $time)->get();
        foreach ($schedules as $schedule) {
            if (!$schedule->sent && !$schedule->disable && !empty($schedule->text)) {
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
