<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Arachive extends Model
{
    protected $table = 'keywords';

    protected $fillable = [
        'str',
        'disable'
    ];
}
