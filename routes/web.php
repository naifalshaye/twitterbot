<?php

Auth::routes();

Route::get('/', 'HomeController@login');

Route::group(['middleware' => 'auth'], function() {
    Route::post('/change_password', 'Auth\ChangePasswordController@update');

    Route::get('/home', 'HomeController@index')->name('home');

    Route::get('/setting', 'SettingController@index');
    Route::post('/setting', 'SettingController@update');

    Route::resource('chat', 'ChatController');
    Route::resource('archive', 'ArchiveController');
    Route::resource('schedule', 'ScheduleController');

    Route::get('/chat/status/{id}', 'ChatController@status');
    Route::get('/archive/status/{id}', 'ArchiveController@status');
    Route::get('/schedule/status/{id}', 'ScheduleController@status');

    Route::get('/chat_tweets', "ChatTweetController@index");
    Route::get('/tweets', "ArchiveTweetsController@index");

    Route::get('/dm', "DMController@index");
    Route::get('/dm_config', "DMController@dmConfig");
    Route::post('/dm_config', "DMController@updateConfig");

    Route::get('/analytics', "AnalyticsController@index");

    Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');

});

Route::get('storage/{filename}', "GuestController@showImage");
