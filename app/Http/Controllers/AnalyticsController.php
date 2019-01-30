<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AnalyticsController extends Controller
{
    public function index()
    {
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


        return view('analytics.index',compact('top_chat_chart'));
    }
}
