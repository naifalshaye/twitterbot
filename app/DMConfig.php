<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DMConfig extends Model
{
    protected $table = 'dm_config';

    protected $fillable = [
        'text',
        'disable',
        'friend_id',
    ];
}