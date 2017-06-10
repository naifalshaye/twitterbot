<?php

namespace App\Console\Commands;

use App\Conf;
use App\Keyword;
use App\TwitterStream;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\App;

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
    public function __construct(TwitterStream $twitterStream)
    {
        parent::__construct();
        $this->twitterStream = $twitterStream;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $keywords = Keyword::where('disable', false)->pluck('str')->toArray();
        $conf = Conf::findOrFail(1);

        $this->twitterStream->consumerKey = $conf->STREAM_TWITTER_CONSUMER_KEY;
        $this->twitterStream->consumerSecret = $conf->STREAM_TWITTER_CONSUMER_SECRET;
        $this->twitterStream->setTrack($keywords);
        $this->twitterStream->consume();
    }
}
