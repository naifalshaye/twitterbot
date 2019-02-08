<?php

namespace App\Http\Controllers;

use App\Chat;
use App\ChatTweet;
use App\Arachive;
use App\DM;
use App\Setting;
use App\Library\TwitterBot;
use App\Schedule;
use App\Tweet;
use App\UserInfo;

class HomeController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Exception
     */
    public function index()
    {
        $settings = Setting::findOrNew(1);

        $twitter = new TwitterBot();

        $requestMethod = 'GET';
        $url = 'https://api.twitter.com/1.1/trends/place.json';
        $getfield = '?id=' . 1;

        $trends = json_decode($twitter->setGetfield($getfield)
            ->buildOauth($url, $requestMethod)
            ->performRequest());

        if (isset($trends->errors) && !empty($trends->errors)) {
            $trends = null;
        }
        if ($trends) {
            $trends = array_slice($trends[0]->trends, 0, 28);
        }

        $chat_tweet = ChatTweet::orderBy('created_at', 'desc')->take(1)->first();
        $archive_tweet = Tweet::orderBy('created_at', 'desc')->take(1)->first();

        $numbers = new \stdClass();
        $numbers->chat = Chat::count();
        $numbers->dm = DM::count();
        $numbers->schedules = Schedule::count();
        $numbers->archive = Arachive::count();
        $numbers->chat_tweets = ChatTweet::count();

        $user_info = UserInfo::findOrNew(1);

        return view('home',
            compact('trends', 'chat_tweet', 'archive_tweet', 'top_chat_chart', 'numbers', 'settings', 'user_info'));
    }
}
