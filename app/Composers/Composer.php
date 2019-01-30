<?php namespace App\Composers;

use App\Library\TwitterBot;

class Composer
{

    public function compose($view)
    {
        $view->with('twitter_user',$this->getTwitterUser());
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
