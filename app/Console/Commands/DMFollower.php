<?php

namespace App\Console\Commands;

use App\Conf;
use App\DM;
use App\DMConfig;
use App\Library\TwitterBot;
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
     * @throws Exception
     */
    public function handle()
    {
        $twitter = new TwitterBot();

        $dm_conf = DMConfig::findOrFail(1);
        if (isset($dm_conf)) {
            if (!$dm_conf->disable) {
                $user_id = Conf::findOrFail(1)->pluck('user_id')->first();

                    $response = json_decode($twitter->buildOauth('https://api.twitter.com/1.1/followers/list.json', 'GET')->performRequest());

                    foreach ($response->users as $user) {
                        $exist = DM::where('follower_id', $user->id)->exists();
                        if (!$exist) {
                            try {
                                $postfields = array (
                                    'event' =>
                                        array(
                                            'type' => 'message_create',
                                            'message_create' =>
                                                array(
                                                    'target' => array('recipient_id' => $user->id),
                                                    'message_data' => array('text' => $dm_conf->text)
                                                )
                                        )
                                );
                                $url = 'https://api.twitter.com/1.1/direct_messages/events/new.json';
                                $requestMethod = 'POST';

                                $twitter->appjson = true;
                                $twitter->buildOauth($url, $requestMethod)->performRequest(true,
                                    [
                                        CURLOPT_POSTFIELDS => json_encode($postfields)
                                    ]
                                );

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
}