<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tweet extends Model
{
    protected $fillable = ['id','json','tweet_text','user_id','user_screen_name','user_avatar_url','public','approved'];

}
