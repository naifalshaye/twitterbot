<?php

namespace App\Console\Commands;

use App\Conf;
use App\Library\TwitterBot;
use App\Schedule;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\App;
use Settings;
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

    private $twitter;

    /**
     * Scheduled constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->twitter = new TwitterBot();
    }

    /**
     * @throws \TwitterException
     */
    public function handle()
    {
        $settings = Settings::findOrNew(1);
        if (!$settings->bot_power || !$settings->schedule_power) {
            return;
        }

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
                    $this->twitter->send($schedule->text);

                    $schedule->sent = true;
                    $schedule->save();
                } catch (\Exception $e) {}
            }
        }
    }
}
