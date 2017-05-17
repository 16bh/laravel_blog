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
Route::get('/','ArticleController@index');
Route::get('articles/{id}','ArticleController@show');
Route::get('article/create','ArticleController@create');
Route::post('article/store','ArticleController@store');
Route::get('article/edit/{id}','ArticleController@edit');
Route::post('article/update','ArticleController@update');
// Route::get('/', function () {
//     return 'HelloWorld!';
//     return view('welcome');
// });

// Route::get('user/{name}', function ($name) {
//     return 'Hello '.$name;
// });
