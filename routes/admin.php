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


use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

Route::redirect('/', 'admin/blog/post');

Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');


Route::middleware('admin:admin')->group(function () {
    Route::prefix('blog')->namespace('Blog')->name('blog.')->group(function () {

        //
        Route::resource('post', 'PostController');
        Route::resource('tag', 'TagController');
        Route::resource('upload', 'UploadController', ['only' => 'index']);


        //文件操作
        Route::post('upload/file', 'UploadController@uploadFile');
        Route::delete('upload/file', 'UploadController@deleteFile');
        Route::post('upload/folder', 'UploadController@createFolder');
        Route::delete('upload/folder', 'UploadController@deleteFolder');
    });

});

