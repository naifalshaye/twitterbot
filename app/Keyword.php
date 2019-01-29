<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Keyword extends Model
{
    protected $table = 'keywords';

    protected $fillable = [
        'str',
        'disable'
    ];
}
