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

Route::get('/', 'appController@home')->name('home');

Route::get('details', 'appController@details')->name('details');

Route::get('about', 'appController@aboutUs')->name('about');

Route::get('enroll', 'appController@enroll')->name('enroll');

Route::post('add', 'appController@addUser')->name('add');

Route::any('delete/{user_id?}', 'appController@deleteUser')->name('delete');

Route::any('edit/{userId?}', 'appController@editUser')->name('editUser');

Route::post('editUserAction', 'appController@editUserAction')->name('editUserAction');
