<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Support\Facades\Artisan;

Route::get('/', function () {
    return redirect('/login');
});

Auth::routes();

Route::post('/change_password', 'Auth\ChangePasswordController@update');


Route::get('/home', 'HomeController@index')->name('home');

Route::get('/setting', 'SettingController@index');
Route::post('/setting', 'SettingController@update');

//Route::get('twitter', function () {
//    return view('twitterAuth');
//});
//
//Route::get('/twitter', 'AccountController@redirectToProvider');
//Route::get('/callback', 'AccountController@handleProviderCallback');


Route::resource('chat', 'ChatController');
Route::resource('streaming', 'StreamingController');
Route::resource('schedule', 'ScheduleController');

Route::get('/chat/status/{id}',  'ChatController@status');
Route::get('/streaming/status/{id}',  'StreamingController@status');
Route::get('/schedule/status/{id}',  'ScheduleController@status');

Route::get('/tweets',  'StreamingTweetsController@index');

Route::get('/chat_tweets', "ChatTweetController@index");
Route::get('/tweets', "StreamingTweetsController@index");

Route::get('/dm', "DMController@index");
Route::get('/dm_config', "DMController@dmConfig");
Route::post('/dm_config', "DMController@updateConfig");

Route::get('/analytics', "AnalyticsController@index");

Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');
