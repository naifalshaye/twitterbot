<?php

namespace App\Http\Controllers;

use App\ChatTweet;
use Illuminate\Http\Request;

class ChatTweetController extends Controller
{
    public function index()
    {
        $tweets = ChatTweet::OrderBy('id','desc')->paginate(15);
        return view('chat.tweets',compact('tweets'));
    }

}
