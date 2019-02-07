<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserInfo extends Model
{
    protected $table = 'user_info';

    protected $fillable = [
        'id_str',
        'name',
        'screen_name',
        'followers_count',
        'friends_count',
        'statuses_count',
        'profile_image_url',
    ];
}
