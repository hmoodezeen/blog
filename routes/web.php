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

//use Illuminate\Routing\Route;

//use Illuminate\Routing\Route;

Route::get('/', 'welcomeController@index')->name('welcome');
Route::get('/articles', 'welcomeController@articles_show')->name('articles');

Auth::routes();

Route::middleware(['auth'])->group(function () {

    Route::get('/home', 'HomeController@index')->name('home');

    Route::resource('/categories', 'CategoriesController');

    Route::resource('/tags', 'TagsController');

    Route::resource('/posts', 'PostsController');

    Route::get('/trashed-posts', 'PostsController@trashed')->name('trashed.index');

    Route::get('/trashed-posts/{id}', 'PostsController@restore')->name('trashed.restore');

    Route::get('/users/{user}/profile', 'UsersController@edit')->name('users.edit');

    Route::post('/users/{user}/profile', 'UsersController@update')->name('users.update');
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
    Route::get('/users', 'UsersController@index')->name('users.index');
    Route::post('/users/{user}/make-admin', 'UsersController@makeAdmin')->name('users.make-admin');
    Route::post('/users/{user}/make-writer', 'UsersController@makeWriter')->name('users.make-writer');
});
