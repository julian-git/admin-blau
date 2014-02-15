<?php
/*
    (c) 2014 Castellers de la Vila de Gràcia
    info@cvg.cat

    This file is part of l'Admin Blau.

    L'Admin Blau is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    L'Admin Blau is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.
*/



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
