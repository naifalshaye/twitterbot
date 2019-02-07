<?php

namespace App\Console\Commands;

use App\Setting;
use Illuminate\Console\Command;
use Twitter;

class UserInfo extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'twitterbot:userinfo';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get User Info';

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
        $settings = Setting::findOrNew(1);
        if (!$settings->consumer_key || !$settings->consumer_secret || !$settings->access_token || !$settings->access_secret) {
            return;
        }

        $twitter = new Twitter($settings->consumer_key, $settings->consumer_secret, $settings->access_token, $settings->access_secret);
        $info = $twitter->load(Twitter::ME);

        $user_info = \App\UserInfo::findOrNew(1);
        $user_info->id_str = $info[0]->user->id_str;
        $user_info->name = $info[0]->user->name;
        $user_info->screen_name = $info[0]->user->screen_name;
        $user_info->followers_count = $info[0]->user->followers_count;
        $user_info->friends_count = $info[0]->user->friends_count;
        $user_info->statuses_count = $info[0]->user->statuses_count;
        $user_info->profile_image_url = $info[0]->user->profile_image_url;
        $user_info->save();

    }
}
