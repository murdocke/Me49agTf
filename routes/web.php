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

Route::get('/getModels/{id}', 'ServiceRequestsController@getModels');

Route::get('/', 'ServiceRequestsController@index')->name('home');
Route::get('/create', 'ServiceRequestsController@create')->name('create');
Route::post('/store', 'ServiceRequestsController@store')->name('doCreate');
Route::get('{serviceRequest}', 'ServiceRequestsController@edit')->name('edit');
Route::post('/update', 'ServiceRequestsController@update')->name('doEdit');






