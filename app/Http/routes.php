<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('login',['as'=>'login', 'uses'=>'LoginController@index']);
Route::post('login',['as'=>'login', 'uses'=>'LoginController@login']);
Route::any('logout',['as'=>'logout', 'uses'=>'LoginController@logout']);


Route::resource('user', 'UserController');
Route::resource('board', 'BoardController');
Route::resource('device', 'DeviceController');