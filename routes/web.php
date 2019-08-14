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
Route::redirect('/','blog');

Route::prefix('blog')->group(function () {
    Route::get('/', 'Blog\Controller@index')->name('blog.home');
    Route::get('{slug}', 'Blog\PostController@show')->name('blog.detail');
});
Route::get('/',function(){
    return view('welcome');
});
