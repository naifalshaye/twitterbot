<?php

namespace App\Providers;

use App\Conf;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
//        $this->app->bind('App\TwitterStream', function ($app) {
////        $conf = Conf::findOrFail(1);
//            return new TwitterStream(config('twitter_bot.STREAM_TWITTER_ACCESS_TOKEN'), config('twitter_bot.STREAM_TWITTER_ACCESS_TOKEN_SECRET'), Phirehose::METHOD_FILTER);
//        });
    }
}
