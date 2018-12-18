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

Route::get('/', 'RootController@index');
Route::get('term', 'RootController@term');

Route::get('video/search', 'VideosController@search');
Route::resource('video', 'VideosController');

Route::resource('comment', 'CommentsController');


Auth::routes();
