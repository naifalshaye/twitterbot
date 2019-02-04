<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Conf extends Model
{
    protected $table = 'config';

    protected $fillable = [
        'since_id',
        'user_id',
        'search_since_id',
        'stop_register',
        'turn_off',
    ];
}
