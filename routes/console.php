<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('twitter', function () {
    $this->comment(\App\Console\Commands\Twitter::class);
})->describe('run twitter');

//Artisan::command('connect_to_streaming_api', function () {
//    $this->comment(\App\Console\Commands\ConnectToStreamingAPI::class);
//})->describe('run connect_to_streaming_api');