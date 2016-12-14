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


Route::get('/', 'TaskController@index')->name('tasks.index');
Route::get('/tasks', 'TaskController@index')->name('tasks.index');
Route::get('/tasks/incomplete', 'TaskController@incomplete')->name('tasks.incomplete');
Route::get('/tasks/complete', 'TaskController@complete')->name('tasks.complete');
Route::get('/tasks/create', 'TaskController@create')->name('tasks.create');
Route::post('/tasks/create', 'TaskController@store')->name('tasks.store');
Route::get('/tasks/{id}/edit', 'TaskController@edit')->name('tasks.edit');
Route::put('/tasks/{id}', 'TaskController@update')->name('tasks.update');
Route::delete('/tasks/{id}', 'TaskController@destroy')->name('tasks.destroy');

Route::auth();

Route::get('/register', 'Auth\AuthController@register')->name('auth.register');
Route::post('/register', 'Auth\AuthController@store')->name('auth.store');

Route::get('/home', 'HomeController@index');
