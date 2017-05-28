<?php

namespace App\Providers;

use App\Conf;
use App\TwitterStream;
use Illuminate\Support\ServiceProvider;
use Phirehose;

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

        $this->app->bind('App\TwitterStream', function ($app) {
            $conf = Conf::findOrFail(1);
            return new TwitterStream($conf->STREAM_TWITTER_ACCESS_TOKEN, $conf->STREAM_TWITTER_ACCESS_TOKEN_SECRET, Phirehose::METHOD_FILTER);
        });
    }
}
