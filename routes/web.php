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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/conf', 'ConfController@index');

Route::get('twitter', function () {
    return view('twitterAuth');
});

Route::get('/twitter', 'AccountController@redirectToProvider');
Route::get('/callback', 'AccountController@handleProviderCallback');

Route::resource('faq', 'FAQController');
Route::resource('keyword', 'KeywordController');

Route::get('/faq/status/{id}',  'FAQController@status');
Route::get('/keyword/status/{id}',  'KeywordController@status');

Route::get('/test',  'HomeController@test');
Route::get('/register', function(){
    return redirect('/');
});
Route::post('/register', function(){
    return redirect('/');
});

Route::post('/kill', 'HomeController@kill');
Route::post('/killall', 'HomeController@killAll');


