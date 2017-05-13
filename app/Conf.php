<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Conf extends Model
{
    protected $table = 'config';

    protected $fillable = [
        'TWITTER_CONSUMER_KEY',
        'TWITTER_CONSUMER_SECRET',
        'TWITTER_ACCESS_TOKEN',
        'TWITTER_ACCESS_TOKEN_SECRET',
        'STREAM_TWITTER_CONSUMER_KEY',
        'STREAM_TWITTER_CONSUMER_SECRET',
        'STREAM_TWITTER_ACCESS_TOKEN',
        'STREAM_TWITTER_ACCESS_TOKEN_SECRET',
        'since_id',
    ];
}
