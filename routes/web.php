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

Route::get('/', function () {
    return view('welcome');
});


Route::resource('user', 'UserController',
    ['only' => ['index', 'store', 'update', 'destroy', 'show']]);



Route::get('prueba','UserController@index')->middleware('checkapiauth');


