<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Log;


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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//cars 

Route::get('/cars', 'CarsController@index')->name('cars_home');
Route::get('/cars/create', 'CarsController@create')->middleware('auth')->name('cars_create');
Route::post('/cars', 'CarsController@store')->name('cars_store');
Route::get('/cars/set_date/{id}', 'CarsController@createDate')->name('create_mot');
Route::post('cars/set_date/{id}', 'CarsController@storeDate')->name('store_mot');
Route::get('/cars/admin', 'CarsController@adminView')->name('cars_admin');
Route::post('/cars/admin/', 'CarsController@setStatus')->name('set_status');
Route::get('/cars/edit/{id}', 'CarsController@edit')->name('cars_edit');
Route::post('cars/edit/{id}', 'CarsController@update')->name('cars_update');
Route::delete('/cars/delete/{id}', 'CarsController@destroy')->name('cars_delete');
Route::get('/user/edit/{id}', 'UserController@edit')->name('user_edit');
Route::post('/user/edit/{id}', 'UserController@update')->name('user_store');
Route::delete('/user/delete/{id}', 'UserController@destroy')->name('user_image_delete');

//admin
Route::get('/admin/calendar', 'CarsController@adminCalendar')->name('admin_cal');