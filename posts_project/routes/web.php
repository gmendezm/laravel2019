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
    return redirect('/posts');
});

Route::resource('posts', 'PostController');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/user/{user_id}', 'PostController@by_user')->name('dashboard');