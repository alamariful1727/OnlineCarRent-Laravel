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

Route::get('/', 'HmController@index')->name('home.index');
Route::get('/about', 'HmController@about')->name('home.about');
Route::resource('blog', 'BlogsController');

Auth::routes();

Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
