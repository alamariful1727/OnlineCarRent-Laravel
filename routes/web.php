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

// user auth
Auth::routes();
//check user/admin
Route::post('/login-validate', 'LoginController@check')->name('login.validate');
// home
Route::get('/', 'HomeController@index')->name('home.index');
Route::get('/about', 'HomeController@about')->name('home.about');

// admin dashboard
Route::group(['middleware' => ['auth', 'admin']], function () {
  Route::get('/admin-dashboard', 'AdminController@index')->name('admin.index');
});

// blogs
Route::resource('blog', 'BlogsController');
Route::get('/myblogs', 'BlogsController@userBlogs')->name('blogs.userBlogs');

// user dashboard
Route::get('/{url}', 'DashboardController@index')->name('dashboard');
// Route::get('/blog/{blog}/edit', 'DashboardController@index')->name('dashboard');
