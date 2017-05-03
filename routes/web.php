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

Route::get('',"ApiController@Welcome");

Route::get('hit',"ApiController@Hit");

Route::post('send-data',"ApiController@HitData");

Route::get('stream',"ApiController@Stream");