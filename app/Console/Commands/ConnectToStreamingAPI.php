<?php

namespace App\Console\Commands;

use App\Keyword;
use App\TwitterStream;
use Illuminate\Console\Command;

class ConnectToStreamingAPI extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'connect_to_streaming_api';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Connect to the Twitter Streaming API';

    protected $twitterStream;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(TwitterStream $twitterStream)
    {
        $this->twitterStream = $twitterStream;

        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $keywords = Keyword::where('disable',false)->pluck('str')->toArray();

        $twitter_consumer_key = env('STREAM_TWITTER_CONSUMER_KEY', '');
        $twitter_consumer_secret = env('STREAM_TWITTER_CONSUMER_SECRET', '');

        $this->twitterStream->consumerKey = $twitter_consumer_key;
        $this->twitterStream->consumerSecret = $twitter_consumer_secret;
        $this->twitterStream->setTrack($keywords);
        $this->twitterStream->consume();
    }
}
