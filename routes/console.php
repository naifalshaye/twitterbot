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

Artisan::command('ChatCommand', function () {
    $this->comment(\App\Console\Commands\ChatCommand::class);
})->describe('Check mentions for chat keywords and reply');

Artisan::command('StreamTwitter', function () {
    $this->comment(\App\Console\Commands\StreamTwitter::class);
})->describe('Stream & archive');

Artisan::command('Scheduled', function () {
    $this->comment(\App\Console\Commands\Scheduled::class);
})->describe('Post scheduled tweets');

Artisan::command('DMFollower', function () {
    $this->comment(\App\Console\Commands\DMFollower::class);
})->describe('Send Direct Message to new follower');