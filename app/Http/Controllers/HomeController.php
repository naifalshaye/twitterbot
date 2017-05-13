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
        $conf = Conf::findOrFail(1);
        $faqs = FAQ::all();

        $mentions = \Twitter::getMentionsTimeline(['since_id'=>$conf->since_id]);
        $collection = collect($mentions);
        dd($collection);
//


    }
}
