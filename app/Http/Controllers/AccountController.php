<?php

namespace App\Http\Controllers;

use App\Conf;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class AccountController extends Controller
{
//    public function redirectToProvider() {
//        return Socialite::with('twitter')->redirect();
//    }
//
//    public function handleProviderCallback() {
//        $user = Socialite::with('twitter')->user();
//
//        $conf_exist = Conf::where('user_id',Auth::user()->id)->first();
//        if ($conf_exist){
//            $conf_exist->user_id = Auth::user()->id;
//            $conf_exist->twitter_id = $user->id;
//            $conf_exist->name = $user->name;
//            $conf_exist->screen_name = $user->nickname;
//            $conf_exist->TWITTER_ACCESS_TOKEN = $user->token;
//            $conf_exist->TWITTER_ACCESS_TOKEN_SECRET = $user->tokenSecret;
//            $conf_exist->save();
//        }
//        else{
//            $conf = new Conf();
//            $conf->user_id = Auth::user()->id;
//            $conf->twitter_id = $user->id;
//            $conf->name = $user->name;
//            $conf->screen_name = $user->nickname;
//            $conf->TWITTER_ACCESS_TOKEN = $user->token;
//            $conf->TWITTER_ACCESS_TOKEN_SECRET = $user->tokenSecret;
//            $conf->save();
//        }
//        return redirect('/home');
//    }
}
