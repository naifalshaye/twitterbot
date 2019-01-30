<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Library\TwitterBot;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        view()->share('twitter_user', $this->getTwitterUser());

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
