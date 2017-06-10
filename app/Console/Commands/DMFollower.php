<?php

namespace App\Console\Commands;

use App\Conf;
use App\DM;
use App\DMConfig;
use Exception;
use Illuminate\Console\Command;

class DMFollower extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'DMFollower';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send DM to new follower';

    /**
     * Create a new command instance.
     *
     * @return void
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
        $dm_conf = DMConfig::findOrFail(1);
        if (!$dm_conf->disable) {
            $user_id = Conf::findOrFail(1)->pluck('user_id')->first();

            $response = \Twitter::getFollowers([
                'user_id' => $user_id,
                'cursor' => '-1',
                'count' => 500,
            ]);
            foreach ($response->users as $user) {
                $exist = DM::where('follower_id', $user->id)->exists();
                if (!$exist) {
                    try {
                        $send = \Twitter::postDm([
                            'user_id' => $user->id,
                            'text' => $dm_conf->text
                        ]);

                        $dm = new DM();
                        $dm->follower_id = $user->id;
                        $dm->screen_name = $user->screen_name;
                        $dm->name = $user->name;
                        $dm->msg = $dm_conf->text;
                        $dm->sent = true;
                        $dm->save();
                    } catch (Exception $e) {
                        dd($e->getMessage());
                    }
                }
            }
        }
    }
}