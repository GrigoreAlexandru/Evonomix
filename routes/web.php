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

Route::get('/', 'WelcomeController@index')->name('index');


Auth::routes(['verify' => true]);

// acces numai pt useri cu email verificat
Route::resource('content', 'ScheduleContentsController', ['except' => 'show'])->middleware('verified');
