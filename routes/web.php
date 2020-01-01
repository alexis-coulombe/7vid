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

// Images CDN
Route::get('/img/{path?}', 'ImageController@show')->where('path', '.*')->name('cdn.img');
Route::get('/avatar/{path?}', 'ImageController@showAvatar')->where('path', '.*')->name('cdn.img.avatar');

// Ajax routes
Route::post('/', 'HomeController@scroll')->name('home.scroll');
Route::post('video/vote', 'VideosController@vote')->name('video.vote')->middleware('auth');
Route::post('comment/vote', 'CommentsController@vote')->name('comment.vote')->middleware('auth');
Route::post('channel/subscribe', 'ChannelController@subscribe')->name('channel.subscribe')->middleware('auth');

// Home routes
Route::get('/', 'HomeController@index')->name('home');
Route::any('/liked', 'HomeController@liked')->name('home.liked')->middleware('auth');
Route::get('/history', 'HomeController@history')->name('home.history')->middleware('auth');
Route::get('/privacy', 'HomeController@privacy')->name('home.privacy')->middleware('cache');
Route::any('/settings', 'HomeController@settings')->name('home.settings')->middleware('auth');

// Video routes
Route::get('video/search', 'VideosController@search')->name('video.search');
Route::resource('video', 'VideosController', ['except' => ['index','show']])->middleware('auth');
Route::resource('video', 'VideosController', ['only' => ['index']]);
Route::resource('video', 'VideosController', ['only' => ['show']])->middleware('checkAuthorisation', 'viewsCounter');

// Comment routes
Route::resource('comment', 'CommentsController', ['only' => ['index','show']]);
Route::resource('comment', 'CommentsController', ['except' => ['index','show']])->middleware('auth');

// Channel routes
Route::post('channel/', 'ChannelController@scroll')->name('channel.scroll');
Route::delete('channel/delete', 'ChannelController@delete')->name('channel.delete');
Route::get('channel/{userId}', 'ChannelController@index')->where('userId', '[0-9]+')->name('channel.index');
Route::post('channel/subscribe', 'ChannelController@subscribe')->name('channel.subscribe')->middleware('auth');
Route::any('channel/{userId}/about', 'ChannelController@about')->where('userId', '[0-9]+')->name('channel.about');
Route::get('channel/{userId}/videos', 'ChannelController@videos')->where('userId', '[0-9]+')->name('channel.videos');
Route::post('channel/{userId}/search', 'ChannelController@search')->where('userId', '[0-9]+')->name('channel.search');

// category routes
Route::get('category/{name}', 'CategoryController@index')->name('category.index');

Auth::routes();

//OAuth routes
Route::get('/redirect/google', 'SocialAuthGoogleController@redirect')->name('oauth.redirect.google');
Route::get('/callback/google', 'SocialAuthGoogleController@callback')->name('oauth.callback.google');

// Front assets preview
Route::get('/front', static function(){
    return view('front-preview');
});
