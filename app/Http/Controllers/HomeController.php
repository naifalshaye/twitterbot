<?php

namespace App\Http\Controllers;

use App\Chat;
use App\ChatTweet;
use App\Conf;
use App\Keyword;
use App\Library\TwitterBot;
use App\Tweet;
use Illuminate\Support\Facades\DB;

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
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Exception
     */
    public function index()
    {
        $twitter = new TwitterBot();

        $requestMethod = 'GET';
        $url = 'https://api.twitter.com/1.1/trends/place.json';
        $getfield = '?id=' . 23424938;

        $trends = json_decode($twitter->setGetfield($getfield)
            ->buildOauth($url, $requestMethod)
            ->performRequest());

        $chat_tweet = ChatTweet::get()->last();
        $stream_tweet = Tweet::orderBy('created_at','desc')->take(1)->first();

        $top_chat = DB::table('chat_tweets')
            ->select(DB::raw('keyword'), DB::raw('count(*) as count'))
            ->groupBy('keyword')
            ->orderBy('count', 'desc')
            ->take(10)
            ->get();

        $top_chat_chart = [];
        foreach ($top_chat as $chat){
            array_push($top_chat_chart,[$chat->keyword,$chat->count]);
        }

        $numbers = new \stdClass();
        $numbers->chat = Chat::count();
        $numbers->stream = Keyword::count();
        $numbers->chat_tweets = ChatTweet::count();

        $conf = Conf::findOrNew(1);

        return view('home',compact('trends','chat_tweet','stream_tweet','top_chat_chart','numbers','conf'));
    }
}
