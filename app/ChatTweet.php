<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChatTweet extends Model
{
    protected $table = 'chat_tweets';

    protected $fillable = [
        'keyword',
        'tweet_id',
        'user_id',
        'user_screen_name',
        'user_name',
        'tweet_text',
        'reply',
        'json'
    ];
}