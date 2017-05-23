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

//        $this->app->bind('App\TwitterStream', function ($app) {
//            return new TwitterStream('862286150278500352-ARCXcJ5bwn6GuXMaPoJTgOz7XmUCOU5', '77tLvEe4bC4UuqYGEWv4Uaya9Tmv8OPZ4ilm0PQli3IPh', Phirehose::METHOD_FILTER);
//        });
    }
}
