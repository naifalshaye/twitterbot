<?php

namespace App\Http\Controllers;

use App\Conf;
use App\FAQ;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use whoisServerList\WhoisApi;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $conf_exist = Conf::where('user_id',Auth::user()->id)->exists();

        if ($conf_exist){
            $conf = Conf::where('user_id',Auth::user()->id)->first();
            if (isset($conf->screen_name) && $conf->screen_name != ''){
                return view('home',compact('conf','conf_exist'));
            }
        }
        else {
            return view('home',compact('conf_exist'));
        }

    }

    public function test()
    {
        $conf = Conf::where('user_id',Auth::user()->id)->first();
        $faqs = FAQ::all();

        $mentions = \Twitter::getMentionsTimeline();
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
                       //  dd($e->getMessage());
                    }

                }
                else{
                 //   dd('No Tweets Found!');
                }
            }
        }


    }
}
