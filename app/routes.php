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
Route::model('socis', 'Soci');

// Show pages.
Route::get('/', 'SociController@index');
Route::get('/create', 'SociController@create');
Route::get('/edit/{soci}', 'SociController@edit');
Route::get('/delete/{soci}', 'SociController@delete');

// Handle form submissions.
Route::post('/create', 'SociController@handleCreate');
Route::post('/edit', 'SociController@handleEdit');
Route::post('/delete', 'SociController@handleDelete');
