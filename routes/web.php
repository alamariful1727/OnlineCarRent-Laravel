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

Route::get('/', 'HomeController@index')->name('home.index');
Route::get('/about', 'HomeController@about')->name('home.about');
Route::resource('blog', 'BlogsController');

Auth::routes();

Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
Route::get('/myblogs', 'DashboardController@myblogs')->name('dashboard.myblogs');
