<?php

namespace App\Console\Commands;

use App\Library\TwitterBot;
use App\Schedule;
use App\Setting;
use Carbon\Carbon;
use Illuminate\Console\Command;
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
        $settings = Setting::findOrNew(1);
        if (!$settings->bot_power || !$settings->schedule_power || !$settings->consumer_key || !$settings->consumer_secret || !$settings->access_token || !$settings->access_secret) {
            return;
        }

        $twitter_dg = new Twitter($settings->consumer_key, $settings->consumer_secret, $settings->access_token, $settings->access_secret);

        $date = Carbon::now()->format('Y-m-d');
        $time = Carbon::now();
        if (!$settings->timezone) {
            $time->setTimezone($settings->timezone);
        }
        $time = $time->format('H:i');

        $schedules = Schedule::where('date', $date)->where('time', $time)->get();
        foreach ($schedules as $schedule) {
            if (!$schedule->sent && !$schedule->disable && !empty($schedule->text)) {
                try {
                    $twitter_dg->send($schedule->text);
                    $schedule->sent = true;
                    $schedule->save();
                } catch (\Exception $e) {}
            }
        }
    }
}
