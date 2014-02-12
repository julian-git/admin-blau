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
Route::model('casteller', 'Casteller');

// Show pages.
Route::get('/', 'CastellersController@index');
Route::get('/create', 'CastellersController@create');
Route::get('/edit/{casteller}', 'CastellersController@edit');
Route::get('/delete/{casteller}', 'CastellersController@delete');

// Handle form submissions.
Route::post('/create', 'CastellersController@handleCreate');
Route::post('/edit', 'CastellersController@handleEdit');
Route::post('/delete', 'CastellersController@handleDelete');
