<?php

namespace App\Http\Controllers;

use App\Tweet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class ArchiveTweetsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tweets = Tweet::query();

        if (Input::get('user_screen_name')){
            $tweets->where('user_screen_name','like','%'.Input::get('user_screen_name').'%');
        }

        if (Input::get('user_name')){
            $tweets->where('user_name','like','%'.Input::get('user_name').'%');
        }


        if (Input::get('tweet_text')){
            $tweets->where('tweet_text','like','%'.Input::get('tweet_text').'%');
        }

        if (Input::get('bio')){
            $tweets->where('description','like','%'.Input::get('bio').'%');
        }

        if (Input::get('date')){
            $tweets->where('created_at','like','%'.Input::get('date').'%');
        }

        $tweets = $tweets->OrderBy('created_at','desc')->paginate(50);

        return view('streaming.tweets',compact('tweets'));
    }

}
