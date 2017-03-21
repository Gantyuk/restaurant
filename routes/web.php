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

Route::get('restaurant/{id}','RestaurantsController@restaurant')->name('view_restaurant');

Route::get('top_10','RestaurantsController@restaurant_top')->name('top');

Route::get('authentication',function () {
    return view('authentication');
})->name('authentication');

Route::post('authentication','UserController@authentication')->name('authentication');

Route::get('registration',function () {
    return view('registration');
})->name('registration');

Route::post('registration','UserController@registration')->name('registration');

Route::get('log_out','UserController@log_out')->name('logout');

Route::get('user/{id}','UserController@profile')->name('profile');
Route::get('user_marks/{id}','UserController@marks')->name('marks');
Route::get('user_comments/{id}','UserController@comments')->name('comments');
Route::post('update','UserController@update_profile')->name('update_profile');
Route::post('add_comment', 'CommentController@add_comment')->name('add_comment');
Route::post('add_mark', 'MarkController@add_mark')->name('add_mark');

Route::get('category/{id}','RestaurantsController@category')->name('view_restaurant_category');

Route::get('/error',function (){
   return view("ERROR");
})->name('404');