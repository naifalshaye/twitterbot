<?php

namespace App\Http\Controllers;

use App\Conf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ConfController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $conf = Conf::findOrFail(1);
        return view('conf',compact('conf'));
    }

    public function update(Request $request)
    {
        $user = \Twitter::getCredentials();
        $conf = Conf::findOrFail(1);
        $conf->user_id = $user->id;
        $conf->screen_name = $user->screen_name;
        $conf->name = $user->name;
        $conf->TWITTER_CONSUMER_KEY = $request->TWITTER_CONSUMER_KEY;
        $conf->TWITTER_CONSUMER_SECRET = $request->TWITTER_CONSUMER_SECRET;
        $conf->TWITTER_ACCESS_TOKEN = $request->TWITTER_ACCESS_TOKEN;
        $conf->TWITTER_ACCESS_TOKEN_SECRET = $request->TWITTER_ACCESS_TOKEN_SECRET;
        $conf->STREAM_TWITTER_CONSUMER_KEY = $request->STREAM_TWITTER_CONSUMER_KEY;
        $conf->STREAM_TWITTER_CONSUMER_SECRET = $request->STREAM_TWITTER_CONSUMER_SECRET;
        $conf->STREAM_TWITTER_ACCESS_TOKEN = $request->STREAM_TWITTER_ACCESS_TOKEN;
        $conf->STREAM_TWITTER_ACCESS_TOKEN_SECRET = $request->STREAM_TWITTER_ACCESS_TOKEN_SECRET;

        $conf->save();
        return redirect()->back()->with('success', 'Settings Updated');
    }
}
