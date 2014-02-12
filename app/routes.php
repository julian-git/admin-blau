<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/


// Bind route parameters.
Route::model('soci', 'Soci');

// Show pages.
Route::get('/', 'SocisController@index');
Route::get('/create', 'SocisController@create');
Route::get('/edit/{soci}', 'SocisController@edit');
Route::get('/delete/{soci}', 'SocisController@delete');

// Handle form submissions.
Route::post('/create', 'SocisController@handleCreate');
Route::post('/edit', 'SocisController@handleEdit');
Route::post('/delete', 'SocisController@handleDelete');
