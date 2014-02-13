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

require_once(dirname(__FILE__) . '/../models/Casteller.php');

class CastellersController extends BaseController
{
    public function index()
    {
        // Show a listing of castellers.
	$castellers = Casteller::all();
	return View::make('index', compact('castellers')); 
    }

    public function create()
    {
        // Show the create castellers form.
        return View::make('create');
    }

    public function handleCreate()
    {
	$validator = Validator::make(Input::all(), Casteller::validation_rules);
	if ($validator->fails()) {
	    return Redirect::to('/create')->withErrors($validator)->withInput();
	}

	$casteller = new Casteller;
	foreach (array_keys(Casteller::member_fields) as $field) {
	    if ($field != 'id')
		$casteller->$field = Input::get($field); 
	}
	$casteller->save();

	return Redirect::action('CastellersController@index');

    }

    public function edit(Casteller $casteller)
    {
        // Show the edit casteller form.
        return View::make('edit', compact('casteller'));
    }

    public function handleEdit()
    {
        // Handle edit form submission.
	$casteller = Casteller::findOrFail(Input::get('id'));

	foreach (array_keys(Casteller::member_fields) as $field) 
	    if ($field != 'id')
		$casteller->$field = Input::get($field); 

	$casteller->save();
	return Redirect::action('CastellersController@index');
    }

    public function delete(Casteller $casteller)
    {
        // Show delete confirmation page.
        return View::make('delete', compact('casteller'));
    }

    public function handleDelete()
    {
        // Handle the delete confirmation.
	$casteller = Casteller::findOrFail(Input::get('casteller'));
	$casteller->delete();
	return Redirect::action('CastellersController@index');
    }
}
 ?>