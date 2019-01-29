<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FAQ extends Model
{
    protected $table = 'faq';

    protected $fillable = [
        'user_id',
        'keyword',
        'reply',
        'disable'
    ];
}
