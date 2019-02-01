<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Streaming extends Model
{
    protected $table = 'keywords';

    protected $fillable = [
        'str',
        'disable'
    ];
}
