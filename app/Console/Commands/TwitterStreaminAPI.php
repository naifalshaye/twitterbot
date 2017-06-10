<?php

namespace App\Console\Commands;

use App\Conf;
use App\Keyword;
use App\TwitterStream;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\App;

class    TwitterStreaminAPI extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'TwitterStreamAPI';
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
     * @param \App\Console\Commands\TwitterStreaminAPI $twitterStream
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
        if (App::environment('production')) {
            $keywords = Keyword::where('disable', false)->pluck('str')->toArray();
            $conf = Conf::findOrFail(1);

            $this->twitterStream->consumerKey = $conf->STREAM_TWITTER_CONSUMER_KEY;
            $this->twitterStream->consumerSecret = $conf->STREAM_TWITTER_CONSUMER_SECRET;
            $this->twitterStream->setTrack($keywords);
            $this->twitterStream->consume();
        }
    }
}
