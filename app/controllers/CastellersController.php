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


class CastellersController extends BaseController
{
    protected $member_fields = array('cognom1' => 'Cognom 1',
				     'cognom2' => 'Cognom 2',
				     'nom' => 'Nom',
				     'mot' => 'Mot',
				     'naixement' => 'Data de naixement',
				     'dni' => 'DNI',
				     'email' => 'email',
				     'direccio' => 'Direcció',
				     'cp' => 'CP',
				     'poblacio' => 'Població',
				     'provincia' => 'Provincia',
				     'telefon1' => 'Telèfon 1',
				     'telefon2' => 'Telèfon 2',
				     'mobil1' => 'Mòvil 1',
				     'mobil2' => 'Mòvil 2',
				     'twitter' => 'Twitter',
				     'whatsapp' => 'Whatsapp',
				     'sexe' => 'Sexe');

    protected $validation_rules = array('cognom1' => 'required|alpha',
					'cognom2' => 'alpha',
					'nom' => 'required|alpha',
					'mot' => 'required|alpha',
					'naixement' => 'date',
					'dni' => 'alpha_num|max:12',
					'email' => 'email',
					'cp' => 'alpha_num',
					'telefon1' => 'alpha_num',
					'telefon2' => 'alpha_num',
					'mobil1' => 'alpha_num',
					'mobil2' => 'alpha_num',
					'twitter' => 'alpha_num',
					'whatsapp' => 'alpha_num',
					'sexe' => 'in:H,D');

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
	$validator = Validator::make(Input::all(), $this->validation_rules);
	if ($validator->fails()) 
	{
	    return Redirect::to('/create')->withErrors($validator)->withInput();
	}

	$casteller = new Casteller;
	foreach (array_keys($this->member_fields) as $field) 
	{
	    $casteller->$field = Input::get($field);
	}
	$casteller->quota_id_fk=1;
	$casteller->save();

	return Redirect::action('CastellersController@index');

    }

    public function edit(Casteller $casteller)
    {
        // Show the edit game form.
        return View::make('edit', compact('casteller'));
    }

    public function handleEdit()
    {
        // Handle edit form submission.
	$casteller = Casteller::findOrFail(Input::get('id'));

	foreach (array_keys($this->member_fields) as $field) 
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