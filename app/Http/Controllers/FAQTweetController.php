<?php

namespace App\Http\Controllers;

use App\FAQTweet;
use Illuminate\Http\Request;

class FAQTweetController extends Controller
{
    public function index()
    {
        $tweets = FAQTweet::OrderBy('id','desc')->paginate(15);
        return view('faq.tweets',compact('tweets'));
    }

}
