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
//写表用post 读表用get
Route::get('/','ArticleController@index');
Route::get('articles/{id}','ArticleController@show')
->where('id', '[0-9]+');
Route::get('articles/{slug}','ArticleController@showSlug')
->where('slug', '[A-Za-z/-]+');
Route::get('article/create','ArticleController@create');
Route::post('article/store','ArticleController@store');
Route::get('article/edit/{id}','ArticleController@edit');
Route::post('article/update','ArticleController@update');


// Admin area
Route::get('admin', function () {
    return redirect('/admin/post');
});

//路由群组： namespace 命名空间、middleware 中间件
$router->group(['namespace' => 'Admin', 'middleware' => 'auth'], function () {
    Route::resource('admin/post', 'PostController');
    Route::resource('admin/tag', 'TagController');
    Route::get('admin/upload', 'UploadController@index');
});

//Logging in and out
Route::get('/login', 'Auth\AuthController@getLogin');
Route::post('/login', 'Auth\AuthController@postLogin');
Route::get('/logout', 'Auth\AuthController@getLogout');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
