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

Route::resource('/', 'ProductController');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::resource('/wishlist', 'WishlistController');
Route::get('/sharedwishlist/{user_id}', 'SharedWishlistController@index');
Route::resource('/products', 'ProductController');
