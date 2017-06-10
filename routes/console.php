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
})->describe('Check timeline and reply');

Artisan::command('TwitterStreamAPI', function () {
    $this->comment(\App\Console\Commands\TwitterStreaminAPI::class);
})->describe('Stream and archive');

Artisan::command('scheduled', function () {
    $this->comment(\App\Console\Commands\Scheduled::class);
})->describe('Post scheduled tweets');

Artisan::command('DMFollower', function () {
    $this->comment(\App\Console\Commands\Scheduled::class);
})->describe('Send Direct Message to new follower');