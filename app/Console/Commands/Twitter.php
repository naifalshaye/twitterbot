<?php

namespace App\Console\Commands;

use App\Conf;
use App\FAQ;
use Illuminate\Console\Command;
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
        $conf = Conf::findOrFail(1);
        $faqs = FAQ::all();

        $mentions = \Twitter::getMentionsTimeline(['since_id'=>$conf->since_id]);
        $collection = collect($mentions);

        foreach ($collection as $mention){
            foreach ($faqs as $faq){
                if (mb_strpos($mention->text, $faq->keyword) != false || strpos($mention->text, $faq->keyword) > 0) {
                    try {
                        $reply = \Twitter::postTweet([
                            'in_reply_to_status_id' => $mention->id,
                            'status' => '@' . $mention->user->screen_name . ' ' . $faq->reply. ' '.$mention->user->name
                        ]);

                        if (isset($collection->first()->id) && $collection->first()->id > 0) {
                            if ($conf->since_id != $collection->first()->id) {
                                $conf->since_id = $collection->first()->id;
                                $conf->save();
                            }
                        }

                    } catch (\Exception $e){
                         //dd($e->getMessage());
                    }

                }
                else{
                     //dd('No Tweets Found!');
                }
            }
        }
    }
}
