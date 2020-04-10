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





Route::get('/', 'PagesController@index' );
Route::get('/about', 'PagesController@about' );
Route::get('/services', 'PagesController@services' );

//posts routes

Route::get('/posts','PostController@index')->name('posts.index');


Route::get('/posts/create','PostController@create')->name('posts.create');
Route::post('/posts','PostController@store')->name('posts.store');
Route::get('/posts/{id}','PostController@show')->name('posts.show');

Route::get('/posts/{id}/edit','PostController@edit')->name('posts.edit');
Route::put('/posts/{id}','PostController@update')->name('posts.update');

Route::delete('/posts/{id}','PostController@destroy')->name('posts.destroy');



Auth::routes();

Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
