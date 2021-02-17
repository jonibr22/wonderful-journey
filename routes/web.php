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

Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/home/detail/{id}', 'HomeController@detail')->name('home.detail');
Route::get('/home/category/{id}', 'HomeController@category')->name('home.category');

Route::get('/login', 'AuthController@login')->name('login');
Route::post('/login', 'AuthController@doLogin')->name('login.submit');

Route::get('/register', 'AuthController@register')->name('register');
Route::post('/register', 'AuthController@doRegister')->name('register.submit');

Route::middleware(['auth.guard', 'role.guard:admin'])->group(function () {
    Route::get('/user','UserController@index')->name('user');
    Route::delete('/user/{id}', 'UserController@destroy')->name('user.delete');
    Route::get('/user/{userId}/blog','UserController@listBlog')->name('user.blog');
    Route::delete('/user/{userId}/blog/{blogId}','UserController@destroyBlog')->name('user.blog.delete');
});

Route::middleware(['auth.guard', 'role.guard:user'])->group(function () {
    Route::get('/blog', 'BlogController@index')->name('blog');
    Route::get('/blog/create', 'BlogController@create')->name('blog.create');
    Route::post('/blog/create', 'BlogController@doInsert')->name('blog.insert.submit');
    Route::delete('/blog/{id}', 'BlogController@destroy')->name('blog.delete');    
});

Route::middleware(['auth.guard'])->group(function () {
    Route::post('/logout', 'AuthController@logout')->name('logout');

    Route::get('/profile', 'ProfileController@index')->name('profile');
    Route::post('/profile', 'ProfileController@update')->name('profile.update');
});
