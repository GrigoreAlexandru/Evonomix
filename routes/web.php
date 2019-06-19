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
//Route::get('/content', 'ScheduleContentsController@index')
//    ->name('content.index')
//    ->middleware('verified');
//
//Route::get('/content/create', 'ScheduleContentsController@create')
//    ->name('content.create')
//    ->middleware('verified');
//
//Route::get('/content/{id}/edit', 'ScheduleContentsController@edit')
//    ->name('content.edit')
//    ->middleware('verified');
//
//Route::post('/content/{id}', 'ScheduleContentsController@update')
//    ->name('content.update')
//    ->middleware('verified');
//
//Route::post('/content', 'ScheduleContentsController@store')
//    ->name('content.store')
//    ->middleware('verified');
Route::resource('content', 'ScheduleContentsController', ['except' => 'show'])->middleware('verified');