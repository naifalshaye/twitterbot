<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DM extends Model
{
    protected $table = 'dm';

    protected $fillable = [
        'friend_id',
        'screen_name',
        'name',
        'msg',
        'sent',
    ];
}