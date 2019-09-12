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

//this should probably end up in api route file as it is used for dyamic jquery make/model dropdowns
Route::get('/getModels/{id}', 'ServiceRequestsController@getModels');

Route::get('/', 'ServiceRequestsController@index')->name('home');

Route::get('/create', 'ServiceRequestsController@create')->name('create');
Route::post('/store', 'ServiceRequestsController@store')->name('doCreate');

//changed from dynamic portion from id to serviceRequest to make route model binding work
Route::get('{serviceRequest}', 'ServiceRequestsController@edit')->name('edit');
Route::post('/update', 'ServiceRequestsController@update')->name('doEdit');
Route::delete('/','ServiceRequestsController@destroy')->name('doDelete');





