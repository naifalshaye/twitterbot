<?php

namespace App\Http\Controllers;

use App\Tweet;
use Illuminate\Http\Request;

class StreamingTweetsController extends Controller
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
        $tweets = Tweet::OrderBy('id','desc')->paginate(15);
        return view('tweets.index',compact('tweets'));
    }

}
