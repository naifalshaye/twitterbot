<?php

namespace App\Console\Commands;

use App\Schedule;
use Carbon\Carbon;
use Illuminate\Console\Command;

class Scheduled extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scheduled';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'this command to handle scheduled tweets';

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
        $date = Carbon::now()->format('Y-m-d');
        $time = Carbon::now();
        $time->setTimezone('Asia/Riyadh');
        $time = $time->format('H:i');

        $schedules = Schedule::where('date', $date)->where('time', $time)->get();
        foreach ($schedules as $schedule) {
            try {
                $reply = \Twitter::postTweet([
                    'status' => $schedule->text
                ]);
                $schedule->sent = true;
                $schedule->save();
            } catch (\Exception $e) {
                dd($e->getMessage());
            }
        }
    }
}
