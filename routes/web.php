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

Route::get('/', 'RestaurantsController@index');

Route::post('restaurants/{id}','RestaurantsController@restaurant'
/*function (\App\Restaurant $id) {
    $restaurant = \App\Restaurant::where('id',$id)->get();
    return view('restaurants.restaurant',compact('restaurant'));
}*/
)->name('viewrestoran');

Route::get('authentication',function () {
    return view('authentication');
})->name('authentication');

Route::post('authentication','UserController@authentication')->name('authentication');

Route::get('registration',function () {
    return view('registration');
})->name('registration');

Route::post('registration','UserController@registration')->name('registration');

Route::get('log_out','UserController@log_out')->name('logout');