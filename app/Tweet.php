<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tweet extends Model
{
    protected $table = 'tweets';
    protected $fillable = [
        'id',
        'tweet_id',
        'tweet_created_at',
        'tweet_text',
        'user_id',
        'user_created_at',
        'user_screen_name',
        'user_name',
        'profile_image_url',
        'city',
        'location',
        'url',
        'description',
        'verified',
        'followers_count',
        'friends_count',
        'statuses_count',
        'lang',
        'geo',
        'coordinates',
        'place',
        'json'
      ];

}
