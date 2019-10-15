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

Route::get('/', 'HomeController@index');

Route::get('video/search', 'VideosController@search')->name('video.search');
Route::post('video/vote', 'VideosController@vote')->name('video.vote');
Route::resource('video', 'VideosController');

Route::resource('comment', 'CommentsController');

Route::get('channel/{userId}', 'ChannelController@index');

Auth::routes();
