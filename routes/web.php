<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'PagesController@index');

Route::get('/about', 'PagesController@about');



Auth::routes();

Route::get('/dashboard', 'DashboardController@index');

Route::get('/requests/create/{id}', 'RequestController@create')->name('requests.create');

Route::get('/requests/approve/{id}', 'RequestController@approve');

Route::get('/requests/refuse/{id}', 'RequestController@refuse'); 


Auth::routes();






//Routes for the dashboard
Route::get('/dashboard', 'DashboardController@index')->name('dashboard');


//Routes for posts
Route::get('/create', 'PostsController@create')->name('create');

Route::get('/posts', 'PostsController@index')->name('posts');

Route::post('/store', 'PostsController@store');

Route::get('/show/{id}', 'PostsController@show')->name('show');

Route::get('/edit/{id}', 'PostsController@edit')->name('edit');

Route::put('/update/{id}', 'PostsController@update');

Route::delete('/destroy/{id}', 'PostsController@destroy');


//Routes for requests
Route::get('/requests', 'RequestController@index')->name('requests');

Route::get('/makeRequest/{id}', 'RequestController@create')->name('makeRequest');

Route::post('/storeRequest', 'RequestController@store');

Route::get('/showRequest/{id}', 'RequestController@show')->name('showRequest');

Route::get('/email/approved/{id}', 'RequestController@approveRequest')->name('approve');

Route::get('/email/disapproved/{id}', 'RequestController@disapproveRequest')->name('request');

