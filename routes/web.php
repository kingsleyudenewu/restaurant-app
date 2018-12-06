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

Route::get('/', 'RestaurantController@getAllRestaurant');
Route::post('/sorting', 'RestaurantController@sorting')->name('sorting');
Route::post('/fav_sorting', 'RestaurantController@fav_sorting')->name('fav_sorting');
