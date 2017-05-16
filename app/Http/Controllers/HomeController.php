<?php

namespace App\Http\Controllers;

use App\Conf;
use App\FAQ;
use App\Keyword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
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
         $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        $faqs = FAQ::all();
//
//        $mentions = \Twitter::getMentionsTimeline();
//        $collection = collect($mentions);
//        foreach ($collection as $mention) {
//            foreach ($faqs as $faq) {
//                if (mb_strpos($mention->text, $faq->keyword) != false || mb_strpos($mention->text,
//                        $faq->keyword) > 0 || strpos($mention->text, $faq->keyword) > 0
//                ) {
//                    dd(true);
//                } else {
//                    dd(false);
//                }
//            }
//        }

        $trends = \Twitter::getTrendsPlace(['id'=>23424938]);
        $trends = $trends[0]->trends;

        exec("ps aux | grep 'artisan'",$ps);
        return view('home',compact('ps','trends'));
    }

    public function test()
    {
        Artisan::call('twitter');
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
        Artisan::call("TwitterStream:start");
    }
}
