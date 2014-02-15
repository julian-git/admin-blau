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


foreach(['Casteller', 'Quote'] as $CSN) {  // CSN is a mnemonic for ClassSingularName

    $csn = strtolower($CSN);
    // Bind route parameters.
    Route::model($csn, $CSN); // e.g., model('casteller', 'Casteller');

    // Show pages.
    Route::get("/$csn", "{$CSN}sController@index");
    Route::get("/$csn/create", "{$CSN}sController@create");
    Route::get("/$csn/edit/{" . $csn . '}', "{$CSN}sController@edit");
    Route::get("/$csn/delete/{" . $csn . '}', "{$CSN}sController@delete");

    // Handle form submissions.
    Route::post("/$csn/create", "{$CSN}sController@handleCreate");
    Route::post("/$csn/edit", "{$CSN}sController@handleEdit");
    Route::post("/$csn/delete", "{$CSN}sController@handleDelete");
}