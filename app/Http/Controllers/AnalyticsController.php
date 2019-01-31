<?php

namespace App\Http\Controllers;

use App\ChatTweet;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AnalyticsController extends Controller
{
    public function index()
    {
        $top_chat_keywords_data = DB::table('chat_tweets')
            ->select(DB::raw('keyword'), DB::raw('count(*) as count'))
            ->groupBy('keyword')
            ->orderBy('count', 'desc')
            ->take(10)
            ->get();

        $top_chat_keywords = [];
        foreach ($top_chat_keywords_data as $keyword){
            array_push($top_chat_keywords,[$keyword->keyword,$keyword->count]);
        }

        $top_chat_users_data = DB::table('chat_tweets')
            ->select(DB::raw('user_screen_name'), DB::raw('count(*) as count'))
            ->groupBy('user_screen_name')
            ->orderBy('count', 'desc')
            ->take(10)
            ->get();

        $top_chat_users = [];
        foreach ($top_chat_users_data as $user){
            array_push($top_chat_users,[$user->user_screen_name,$user->count]);
        }

        $top_stream_users_data = DB::table('tweets')
            ->select(DB::raw('user_screen_name'), DB::raw('count(*) as count'))
            ->groupBy('user_screen_name')
            ->orderBy('count', 'desc')
            ->take(10)
            ->get();

        $top_stream_users = [];
        foreach ($top_stream_users_data as $user){
            array_push($top_stream_users,[$user->user_screen_name,$user->count]);
        }

        $daily_chat_tweets_data = ChatTweet::select([
            DB::raw('DATE(created_at) AS date'),
            DB::raw('COUNT(id) AS count'),
        ])
            ->whereBetween('created_at', [Carbon::now()->subDays(30), Carbon::now()])
            ->groupBy('date')
            ->orderBy('date', 'ASC')
            ->get()
            ->toArray();

        $daily_chat_tweets = [];
        foreach ($daily_chat_tweets_data as $tweet){
            array_push($daily_chat_tweets,[substr($tweet['date'],8),$tweet['count']]);
        }

        $top_dm_users_data = DB::table('dm')
            ->select(DB::raw('screen_name'), DB::raw('count(*) as count'))
            ->groupBy('screen_name')
            ->orderBy('count', 'desc')
            ->take(10)
            ->get();

        $top_dm_users = [];
        foreach ($top_dm_users_data as $user){
            array_push($top_dm_users,[$user->screen_name,$user->count]);
        }

        return view('analytics.index',compact('top_chat_keywords','top_chat_users','top_stream_users','daily_chat_tweets','top_dm_users'));
    }
}
