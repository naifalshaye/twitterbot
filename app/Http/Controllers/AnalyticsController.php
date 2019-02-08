<?php

namespace App\Http\Controllers;

use App\ChatTweet;
use App\DM;
use App\Schedule;
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
            array_push($top_chat_keywords,[$keyword->keyword, (int)$keyword->count]);
        }

        $top_chat_users_data = DB::table('chat_tweets')
            ->select(DB::raw('user_screen_name'), DB::raw('count(*) as count'))
            ->groupBy('user_screen_name')
            ->orderBy('count', 'desc')
            ->take(10)
            ->get();

        $top_chat_users = [];
        foreach ($top_chat_users_data as $user){
            array_push($top_chat_users,[$user->user_screen_name, (int)$user->count]);
        }

        $top_archive_users_data = DB::table('tweets')
            ->select(DB::raw('user_screen_name'), DB::raw('count(*) as count'))
            ->groupBy('user_screen_name')
            ->orderBy('count', 'desc')
            ->take(10)
            ->get();

        $top_archive_users = [];
        foreach ($top_archive_users_data as $user){
            array_push($top_archive_users,[$user->user_screen_name, (int)$user->count]);
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
            array_push($daily_chat_tweets,[substr($tweet['date'],8), (int)$tweet['count']]);
        }

        $daily_dm_data = DM::select([
            DB::raw('DATE(created_at) AS date'),
            DB::raw('COUNT(id) AS count'),
            ])
            ->whereBetween('created_at', [Carbon::now()->subDays(30), Carbon::now()])
            ->groupBy('date')
            ->orderBy('date', 'ASC')
            ->get()
            ->toArray();


        $daily_dm = [];
        foreach ($daily_dm_data as $dm){
            array_push($daily_dm,[$dm['date'], (int)$dm['count']]);
        }
        $current_year_schedule_data = Schedule::select([
            DB::raw('MONTH(created_at) AS month'),
            DB::raw('COUNT(id) AS count'),
        ])
            ->whereBetween('created_at', [Carbon::now()->subYear(1), Carbon::now()])
            ->groupBy('month')
            ->orderBy('month', 'ASC')
            ->get()
            ->toArray();

        $current_year_schedules = [];
        foreach ($current_year_schedule_data as $dm){
            array_push($current_year_schedules,[$dm['month'], (int)$dm['count']]);
        }

        return view('analytics.index',compact('top_chat_keywords','top_chat_users','top_archive_users','daily_chat_tweets','daily_dm','current_year_schedules'));
    }
}
