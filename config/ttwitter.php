<?php

// You can find the keys here : https://apps.twitter.com/

return [
	'debug'               => function_exists('env') ? env('APP_DEBUG', false) : false,

	'API_URL'             => 'api.twitter.com',
	'UPLOAD_URL'          => 'upload.twitter.com',
	'API_VERSION'         => '1.1',
	'AUTHENTICATE_URL'    => 'https://api.twitter.com/oauth/authenticate',
	'AUTHORIZE_URL'       => 'https://api.twitter.com/oauth/authorize',
	'ACCESS_TOKEN_URL'    => 'https://api.twitter.com/oauth/access_token',
	'REQUEST_TOKEN_URL'   => 'https://api.twitter.com/oauth/request_token',
	'USE_SSL'             => true,

    'CONSUMER_KEY'        => env('TWITTER_CONSUMER_KEY'),
    'CONSUMER_SECRET'     => env('TWITTER_CONSUMER_SECRET'),
    'ACCESS_TOKEN'        => env('TWITTER_ACCESS_TOKEN'),
    'ACCESS_TOKEN_SECRET' => env('TWITTER_ACCESS_TOKEN_SECRET'),

    'STREAM_CONSUMER_KEY'        => env('STREAM_TWITTER_CONSUMER_KEY'),
    'STREAM_CONSUMER_SECRET'     => env('STREAM_TWITTER_CONSUMER_SECRET'),
    'STREAM_ACCESS_TOKEN'        => env('STREAM_TWITTER_ACCESS_TOKEN'),
    'STREAM_ACCESS_TOKEN_SECRET' => env('STREAM_TWITTER_ACCESS_TOKEN_SECRET')
];