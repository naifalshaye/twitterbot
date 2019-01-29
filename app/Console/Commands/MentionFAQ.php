<?php

namespace App\Console\Commands;

use App\Conf;
use App\FAQ;
use App\FAQTweet;
use App\Library\TwitterBot;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Twitter;

class MentionFAQ extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'MentionFAQ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check mentions for FAQ and reply';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**c
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        try {
            $conf = Conf::findOrFail(1);
        } catch (\Exception $e){
            $conf = new Conf();
        }

        $faqs = FAQ::all();
        if (isset($conf)) {
            $twitter = new TwitterBot();
            $twitter_dg = new Twitter(config('ttwitter.CONSUMER_KEY'), config('ttwitter.CONSUMER_SECRET'), config('ttwitter.ACCESS_TOKEN'), config('ttwitter.ACCESS_TOKEN_SECRET'));
            $requestMethod = 'GET';

            $url = 'https://api.twitter.com/1.1/statuses/mentions_timeline.json';
            if ($conf->since_id) {
                $getfield = '?since_id=' . $conf->since_id;
                $mentions = json_decode($twitter->setGetfield($getfield)
                    ->buildOauth($url, $requestMethod)
                    ->performRequest());
            } else{
                $mentions = json_decode($twitter->buildOauth($url, $requestMethod)->performRequest());
            }


            $collection = collect($mentions);

            if ($collection->count() > 0) {
                foreach ($collection as $mention) {
                    foreach ($faqs as $faq) {
                        if (!$faq->disable) {
                            if (mb_strpos($mention->text, $faq->keyword) != false || mb_strpos($mention->text,
                                    $faq->keyword) > 0 || strpos($mention->text, $faq->keyword) > 0
                            ) {
                                try {
                                    $reply_text = '@' . $mention->user->screen_name . ' ' . $faq->reply;

                                    $twitter_dg->send($reply_text,null,['in_reply_to_status_id' => $mention->id]);


                                    if (isset($collection->first()->id) && $collection->first()->id > 0) {
                                        if ($conf->since_id != $collection->first()->id) {
                                            $conf->since_id = $collection->first()->id;
                                            $conf->save();
                                        }
                                    }

                                    $faq_tweet = new FAQTweet();
                                    $faq_tweet->keyword = $faq->keyword;
                                    $faq_tweet->tweet_id = $collection->first()->id;
                                    $faq_tweet->user_id = $collection->first()->user->id;
                                    $faq_tweet->user_screen_name = $collection->first()->user->screen_name;
                                    $faq_tweet->user_name = $collection->first()->user->name;
                                    $faq_tweet->tweet_text = $collection->first()->text;
                                    $faq_tweet->reply = $reply_text;
                                    $faq_tweet->save();

                                } catch (\Exception $e) {
                                    dd($e->getMessage());
                                }
                            }
                        }
                    }
                }
            } else {
                dd('No Tweets Found!');
            }
        }
    }
}