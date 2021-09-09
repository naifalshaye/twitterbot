<?php

namespace App\Http\Controllers;

use App\Chat;
use App\ChatTweet;
use Illuminate\Support\Facades\Request as Input;

class ChatTweetController extends Controller
{
    public function index()
    {
        $chat = ChatTweet::query();

        if (Input::get('keyword')){
            $chat->where('keyword','like','%'.Input::get('keyword').'%');
        }

        if (Input::get('user_screen_name')){
            $chat->where('user_screen_name','like','%'.Input::get('user_screen_name').'%');
        }

        if (Input::get('user_name')){
            $chat->where('user_name','like','%'.Input::get('user_name').'%');
        }


        if (Input::get('tweet_text')){
            $chat->where('tweet_text','like','%'.Input::get('tweet_text').'%');
        }

        if (Input::get('reply')){
            $chat->where('reply','like','%'.Input::get('reply').'%');
        }

        if (Input::get('date')){
            $chat->where('created_at','like','%'.Input::get('date').'%');
        }

        $tweets = $chat->OrderBy('created_at','desc')->paginate(50);
        $keywords = Chat::get();

        return view('chat.tweets',compact('tweets','keywords'));
    }

}
