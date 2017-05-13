<?php

namespace App\Providers;

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
            $twitter_access_token = env('STREAM_TWITTER_ACCESS_TOKEN', '');
            $twitter_access_token_secret = env('STREAM_TWITTER_ACCESS_TOKEN_SECRET', null);
            return new TwitterStream($twitter_access_token, $twitter_access_token_secret, Phirehose::METHOD_FILTER);
        });
    }
}
