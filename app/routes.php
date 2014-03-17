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

require_once('validators.php');

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

Route::get('/', function() 
	   {
	       return View::make('index');
	   });

Route::get('/test.html', function() 
	   {
	       return View::make('test');
	   });

foreach(array('Categorie',
              'Rol',
              'TipusQuote', 
              'Persone', 
              'Familie', 
			  'Quote',

              'Esdeveniment',
			  'TipusEsdeveniment',
			
			  'Lloc',
			  'TipusActuacion',
			  'Actuacion',
			  'TipusCastell',
			  'Castell',
			  'Posicion',
			
			  'Missatge'
			 ) as $CSN) {  // CSN is a mnemonic for ClassSingularName

    $csn = strtolower($CSN);

    // Bind route parameters.
    Route::model($csn, $CSN); // e.g., model('persone', 'Persone');

    // Show pages.
    Route::get("/$csn", "{$CSN}sController@index");
    Route::get("/$csn/create/{responsable?}", "{$CSN}sController@create");
    Route::get("/$csn/edit/{" . $csn . '}', array('uses' => "{$CSN}sController@edit", 'as' => "$csn.edit"));
    Route::get("/$csn/inspect/{" . $csn . '}', array('uses' => "{$CSN}sController@inspect", 'as' => "$csn.inspect"));
    Route::get("/$csn/delete/{" . $csn . '}', "{$CSN}sController@delete");
    /*
    Route::get("/$csn/json", function() use ($CSN) {
	    return Response::json($CSN::all()->toArray());
	});
    */

    // Handle form submissions.
    Route::post("/$csn/create", "{$CSN}sController@handleCrear");
    Route::post("/$csn/create/{" . $csn . '}', "{$CSN}sController@handleCrear");
    Route::post("/$csn/edit/{" . $csn . '}', "{$CSN}sController@handleEditar");
    Route::post("/$csn/delete", "{$CSN}sController@handleDelete");
}

Route::get("/esdeveniments/apuntats/{esdeveniment}", 'EsdevenimentsController@apuntats');
Route::get("/actuacions/apuntats/{actuacion}", 'ActuacionsController@apuntats');
Route::get("/persones/actives/{persone}", 'PersonesController@actives');
Route::get("/persones/search/{first}", 'PersonesController@search');
Route::get("/persones/search_id/{first}", 'PersonesController@search_id');
Route::get("/quote/generar_rebut/{quote}", 'QuotesController@generar_rebut');