<?php

namespace App\Console\Commands;

use App\Conf;
use App\Library\lib\FilterTrackConsumer;
use App\Streaming;
use Illuminate\Console\Command;
use App\Library\lib\Phirehose;

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

        $conf = Conf::findOrNew(1);

        $this->killStream();
        if ($conf->turn_off) {
            return;
        }

        $keywords = Streaming::where('disable', false)->pluck('str')->toArray();
        if (sizeof($keywords) > 0) {

            define("TWITTER_CONSUMER_KEY", config('ttwitter.STREAM_CONSUMER_KEY'));
            define("TWITTER_CONSUMER_SECRET", config('ttwitter.STREAM_CONSUMER_SECRET'));
            define("OAUTH_TOKEN", config('ttwitter.STREAM_ACCESS_TOKEN'));
            define("OAUTH_SECRET", config('ttwitter.STREAM_ACCESS_TOKEN_SECRET'));

            $sc = new FilterTrackConsumer(OAUTH_TOKEN, OAUTH_SECRET, Phirehose::METHOD_FILTER);
            $sc->setTrack($keywords);
            $sc->consume();
        }

    }

    public function killStream(){
        exec("ps aux | grep -v grep | grep twitterbot:streaming", $psOutput);
        if (count($psOutput) > 0) {
            foreach ($psOutput as $ps) {
                $ps = preg_split('/ +/', $ps);
                $pid = $ps[1];
                posix_kill($pid, 9);
            }
        }
    }
}
