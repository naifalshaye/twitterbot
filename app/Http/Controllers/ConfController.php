<?php

namespace App\Http\Controllers;

use App\Conf;
use App\Library\TwitterBot;
use Illuminate\Database\Eloquent\ModelNotFoundException;
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
        $conf = Conf::findOrNew(1);

        return view('config.index', compact('conf'));
    }

    public function update(Request $request)
    {
        try{
            $conf = Conf::findOrNew(1);
        } catch(ModelNotFoundException $e) {
            $conf = new Conf();
        }

        if ($request->stop_register == 'on'){
            $request['stop_register'] = true;
        } else {
            $request['stop_register']  = false;
        }

        if ($request->turn_off == 'on'){
            $request['turn_off'] = true;
            exec("pkill -f twitterbot:streaming");
        } else {
            $request['turn_off']  = false;
        }

        $conf->stop_register = $request->stop_register;
        $conf->turn_off = $request->turn_off;
        $conf->save();
        return redirect()->back()->with('success', 'Bot Configuration Updated');
    }

    public function getTwitterUser()
    {
        $twitter = new TwitterBot();
        $user = json_decode($twitter->buildOauth('https://api.twitter.com/1.1/account/settings.json',
            'GET')->performRequest());

        if (isset($user->screen_name)) {
            $getfield = '?screen_name=' . $user->screen_name;
            $info = json_decode($twitter->setGetfield($getfield)
                ->buildOauth('https://api.twitter.com/1.1/users/lookup.json', 'GET')
                ->performRequest());
            return $info[0];
        }
    }
}
