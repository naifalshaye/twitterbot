<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Conf extends Model
{
    protected $table = 'conf';

    protected $fillable = [
        'twitter_id',
        'screen_name',
        'name',
        'mobile',
        'expire',
        'TWITTER_ACCESS_TOKEN',
        'TWITTER_ACCESS_TOKEN_SECRET',
    ];
}
