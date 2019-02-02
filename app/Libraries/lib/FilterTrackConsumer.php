<?php
namespace App\Library\lib;

use App\Tweet;

class FilterTrackConsumer extends OauthPhirehose
{
    public function enqueueStatus($data)
    {
        $tweet = json_decode($data, true);
        $user_screen_name = isset($tweet['user']['screen_name']) ? $tweet['user']['screen_name'] : null;

        if (isset($tweet['id'])) {
            $city = null;
            $geo = null;
            $coordinates = null;
            $place = null;
            if (isset($tweet['user']['city'])) {
                $city = $tweet['user']['city'];
            }
            if (isset($tweet['user']['geo'])) {
                $geo = $tweet['user']['geo'];
            }
            if (isset($tweet['user']['coordinates'])) {
                $geo = $tweet['user']['coordinates'];
            }
            if (isset($tweet['user']['place'])) {
                $geo = $tweet['user']['place'];
            }

            Tweet::create([
                'tweet_id' => $tweet['id_str'],
                'tweet_created_at' => $tweet['created_at'],
                'tweet_text' => $tweet['text'],
                'json' => json_encode($tweet),
                'user_id' => $tweet['user']['id_str'],
                'user_created_at' => $tweet['user']['created_at'],
                'user_screen_name' => $tweet['user']['screen_name'],
                'user_name' => $tweet['user']['name'],
                'profile_image_url' => $tweet['user']['profile_image_url'],
                'city' => $city,
                'location' => $tweet['user']['location'],
                'url' => $tweet['user']['url'],
                'description' => $tweet['user']['description'],
                'verified' => $tweet['user']['verified'],
                'followers_count' => $tweet['user']['followers_count'],
                'friends_count' => $tweet['user']['friends_count'],
                'statuses_count' => $tweet['user']['statuses_count'],
                'lang' => $tweet['user']['lang'],
                'geo' => $geo,
                'coordinates' => $coordinates,
                'place' => $place,
            ]);
        }
    }
}