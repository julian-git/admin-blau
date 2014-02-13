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

class CastellsController extends BaseController
{
    protected $member_fields = array('tipus' => 'Tipus',
				     'data' => 'Data',
				     'lloc' => 'Lloc',
				     'ordre' => "Ordre a l'actuació");

    protected $validation_rules = array('tipus' => 'required|alpha_num',
					'data' => 'date|required',
					'lloc' => 'required|alpha',
					'ordre' => 'required|num');

    public function index()
    {
        // Show a listing of castells.
	$castells = Castell::all();
	return View::make('index', compact('castells')); 
    }

    public function create()
    {
        // Show the create castells form.
        return View::make('create');
    }

    public function handleCreate()
    {
	$validator = Validator::make(Input::all(), $this->validation_rules);
	if ($validator->fails()) {
	    return Redirect::to('/create')->withErrors($validator)->withInput();
	}

	$castell = new Castell;
	foreach (array_keys($this->member_fields) as $field) {
	    $castell->$field = Input::get($field); 
	}
	$castell->save();

	return Redirect::action('CastellsController@index');

    }

    public function edit(Castell $castell)
    {
        // Show the edit game form.
        return View::make('edit', compact('castell'));
    }

    public function handleEdit()
    {
        // Handle edit form submission.
	$castell = Castell::findOrFail(Input::get('id'));

	foreach (array_keys($this->member_fields) as $field) 
	    $castell->$field = Input::get($field); 

	$castell->save();
	return Redirect::action('CastellsController@index');
    }

    public function delete(Castell $castell)
    {
        // Show delete confirmation page.
        return View::make('delete', compact('castell'));
    }

    public function handleDelete()
    {
        // Handle the delete confirmation.
	$castell = Castell::findOrFail(Input::get('castell'));
	$castell->delete();
	return Redirect::action('CastellsController@index');
    }
}
 ?>