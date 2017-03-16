<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your module. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::group(['prefix' => 'admin','middleware'=>'admin'], function () {
    Route::get('/','IndexController@index');
//    Route::get('/map','IndexController@map');
    Route::get('/restaurant/create','RestaurantController@create');
    Route::get('/restaurant','RestaurantController@show');
    Route::post('/restaurant/create','RestaurantController@store');
    Route::get('/restaurant/{id}/edit','RestaurantController@edit');
    Route::put('/restaurant/{id}','RestaurantController@update');
    Route::delete('/restaurant/{id}','RestaurantController@delete');
});
Route::post('/add_address','MapController@create_address');
Route::post('/check_address','MapController@check_address');