<?php

namespace App\Console\Commands;

use App\Conf;
use App\Library\TwitterBot;
use App\Streaming;
use App\Tweet;
use Illuminate\Console\Command;

class StreamTwitter extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'twitterbot:streaming';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Stream twitter';

    private $twitter;


    /**
     * StreamTwitter constructor.
     * @param TwitterStream $twitterStream
     */
    public function __construct()
    {
        parent::__construct();
        $this->twitter = new TwitterBot();
    }


    public function handle()
    {
        if (version_compare(PHP_VERSION, '7.2.0', '>=')) {
            error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
        }

        $conf = Conf::findOrNew(1);

        if ($conf->turn_off) {
            return;
        }

        $keywords = Streaming::where('disable', false)->pluck('str')->toArray();
        if (sizeof($keywords) > 0) {
            $getfield = '?q=' . implode(',',$keywords) . '&result_type=recent&count=100&since_id=' . $conf->search_since_id;
            $response = json_decode($this->twitter->setGetfield($getfield)
                ->buildOauth('https://api.twitter.com/1.1/search/tweets.json', 'GET')
                ->performRequest());
            foreach ($response->statuses as $tweet) {
                if (isset($tweet->id)) {
                    $city = null;
                    $geo = null;
                    $coordinates = null;
                    $place = null;
                    if (isset($tweet->user->city)) {
                        $city = $tweet->user->city;
                    }
                    if (isset($tweet->user->geo)) {
                        $geo = $tweet->user->geo;
                    }
                    if (isset($tweet->user->coordinates)) {
                        $geo = $tweet->user->coordinates;
                    }
                    if (isset($tweet->user->place)) {
                        $geo = $tweet->user->place;
                    }

                    Tweet::create([
                        'tweet_id' => $tweet->id_str,
                        'tweet_created_at' => $tweet->created_at,
                        'tweet_text' => $tweet->text,
                        'json' => json_encode($tweet),
                        'user_id' => $tweet->user->id_str,
                        'user_created_at' => $tweet->user->created_at,
                        'user_screen_name' => $tweet->user->screen_name,
                        'user_name' => $tweet->user->name,
                        'profile_image_url' => $tweet->user->profile_image_url,
                        'city' => $city,
                        'location' => $tweet->user->location,
                        'url' => $tweet->user->url,
                        'description' => $tweet->user->description,
                        'verified' => $tweet->user->verified,
                        'followers_count' => $tweet->user->followers_count,
                        'friends_count' => $tweet->user->friends_count,
                        'statuses_count' => $tweet->user->statuses_count,
                        'lang' => $tweet->user->lang,
                        'geo' => $geo,
                        'coordinates' => $coordinates,
                        'place' => $place,
                    ]);
                }
            }
            $conf->search_since_id = end($response->statuses)->id_str;
            $conf->save();
        }
    }
}