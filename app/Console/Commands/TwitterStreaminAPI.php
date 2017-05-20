<?php

namespace App\Console\Commands;

use App\Keyword;
use App\TwitterStream;
use Illuminate\Console\Command;

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
        $keywords = Keyword::where('disable',false)->pluck('str')->toArray();

        $this->twitterStream->consumerKey = '5WRsOr7xwHdiSs0701HDoVLo7';
        $this->twitterStream->consumerSecret = 'DVJx9wCPGYr2jULSzV8Zf2SfiZY69chHTbLHQdkY2K4F4yohK9';
        $this->twitterStream->setTrack($keywords);
        $this->twitterStream->consume();
    }
}
