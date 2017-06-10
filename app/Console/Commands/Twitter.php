<?php

namespace App\Console\Commands;

use App\Conf;
use App\FAQ;
use App\FAQTweet;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class Twitter extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'twitter';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        if (App::environment('production')) {
            $conf = Conf::findOrFail(1);
            $faqs = FAQ::all();

            $mentions = \Twitter::getMentionsTimeline(['since_id' => $conf->since_id]);
            $collection = collect($mentions);

            if ($collection->count() > 0) {
                foreach ($collection as $mention) {
                    foreach ($faqs as $faq) {
                        if (mb_strpos($mention->text, $faq->keyword) != false || mb_strpos($mention->text,
                                $faq->keyword) > 0 || strpos($mention->text, $faq->keyword) > 0
                        ) {
                            try {
                                $reply_text = '@' . $mention->user->screen_name . ' ' . $faq->reply . ' ' . $mention->user->name;
                                $reply = \Twitter::postTweet([
                                    'in_reply_to_status_id' => $mention->id,
                                    'status' => $reply_text
                                ]);

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
            } else {
                dd('No Tweets Found!');
            }
        }
    }
}