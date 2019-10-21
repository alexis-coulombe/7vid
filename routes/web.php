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

Route::get('/', 'HomeController@index')->name('home');

// Video routes
Route::get('video/search', 'VideosController@search')->name('video.search');
Route::post('video/vote', 'VideosController@vote')->name('video.vote')->middleware('auth');
Route::post('video', 'VideosController@store')->name('video.store')->middleware('auth');
Route::get('video', 'VideosController@index')->name('video.index');
Route::get('video/create', 'VideosController@create')->name('video.create')->middleware('auth');
Route::delete('video/{video}', 'VideosController@destroy')->name('video.destroy')->middleware('auth');
Route::get('video/{video}', 'VideosController@show')->name('video.show');
Route::put('video/{video}', 'VideosController@update')->name('video.update')->middleware('auth');
Route::get('video/{video}/edit', 'VideosController@edit')->name('video.edit')->middleware('auth');

// Comment routes
Route::resource('comment', 'CommentsController');

// Channel routes
Route::get('channel/{userId}', 'ChannelController@index')->name('channel.index');

Auth::routes();
