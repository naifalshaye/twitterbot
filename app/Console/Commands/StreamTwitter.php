<?php

namespace App\Console\Commands;

use App\Keyword;
use App\Tweet;
use Illuminate\Console\Command;
use Spatie\TwitterStreamingApi\PublicStream;

class StreamTwitter extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'StreamTwitter';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Stream twitter';

    protected $twitterStream;

    /**
     * StreamTwitter constructor.
     * @param TwitterStream $twitterStream
     */
    public function __construct()
    {
        parent::__construct();
    }


    public function handle()
    {
        if(version_compare(PHP_VERSION, '7.2.0', '>=')) {
            error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
        }

        $keywords = Keyword::where('disable', false)->pluck('str')->toArray();
        if (sizeof($keywords) > 0) {
            PublicStream::create(
                config('ttwitter.STREAM_ACCESS_TOKEN'),
                config('ttwitter.STREAM_ACCESS_TOKEN_SECRET'),
                config('ttwitter.STREAM_CONSUMER_KEY'),
                config('ttwitter.STREAM_CONSUMER_SECRET')
            )->whenHears($keywords, function (array $tweet) {
                $tweet_text = isset($tweet['text']) ? $tweet['text'] : null;
                $user_id = isset($tweet['user']['id_str']) ? $tweet['user']['id_str'] : null;
                $user_screen_name = isset($tweet['user']['screen_name']) ? $tweet['user']['screen_name'] : null;

                if (isset($tweet['id'])) {
                    Tweet::create([
                        'id' => $tweet['id_str'],
                        'json' => $tweet,
                        'tweet_text' => $tweet_text,
                        'user_id' => $user_id,
                        'user_screen_name' => $user_screen_name,
                        'approved' => 0
                   ]);
                }
            })->startListening();
        }
    }
}
