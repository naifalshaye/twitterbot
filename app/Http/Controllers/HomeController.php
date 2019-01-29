<?php

namespace App\Http\Controllers;

use App\Conf;
use App\FAQ;
use App\FAQTweet;
use App\Keyword;
use App\Tweet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
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
         $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        $trends = \Twitter::getTrendsPlace(['id'=>23424938]);
//        $trends = $trends[0]->trends;
        $trends = [];
        exec("ps aux | grep 'TwitterStream'",$ps);
        $faq_tweet = FAQTweet::get()->last();
        $stream_tweet = Tweet::orderBy('created_at','desc')->take(1)->first();

        $top_faq = DB::table('faq_tweets')
            ->select(DB::raw('keyword'), DB::raw('count(*) as count'))
            ->groupBy('keyword')
            ->orderBy('count', 'desc')
            ->take(10)
            ->get();

        $top_faq_chart = [];
        foreach ($top_faq as $faq){
            array_push($top_faq_chart,[$faq->keyword,$faq->count]);
        }

        $numbers = new \stdClass();
        $numbers->faq = FAQ::count();
        $numbers->stream = Keyword::count();
        $numbers->faq_tweets = FAQTweet::count();

        return view('home',compact('ps','trends','faq_tweet','stream_tweet','top_faq_chart','numbers'));
    }

    public function test()
    {
       // Artisan::call('twitter');
//        echo '<pre>';
//        print_r($output);
//        echo '</pre>';



//        exec("kill $pid");


//        $conf = Conf::findOrFail(1);
//        $faqs = FAQ::all();
//
//        $mentions = \Twitter::getMentionsTimeline(['since_id'=>$conf->since_id]);
//        $collection = collect($mentions);
//        dd($collection);
//


    }

    public function kill(Request $request)
    {
        try {
            exec("kill -9 $request->pid");
        } catch (\Exception $e){
            dd($e->getMessage());
        }
        return redirect()->back();
    }

    public function killAll()
    {
        try {
            exec("ps -ef | grep artisan | grep -v grep | xargs kill -9");
        } catch (\Exception $e){
            dd($e->getMessage());
        }
        return redirect()->back();
    }

    public function runTwitterCommand()
    {
         Artisan::call("TwitterStreamAPI");
         return redirect()->back();
    }
}
