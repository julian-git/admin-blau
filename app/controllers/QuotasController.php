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


class QuotasController extends BaseController
{
    protected $member_fields = array('banc' => 'Banc',
				     'codi_banc' => 'Codi Banc',
				     'oficina' => 'Oficina',
				     'digit_control' => 'Digit Control',
				     'compte' => 'N&uacute;mero de Compte',
				     'import' => 'Import',
				     'periodicitat' => 'Periodicitat');

    protected $validation_rules = array('banc' => 'required|alpha',
					'codi_banc' => 'required|integer',
					'oficina' => 'required|alpha',
					'digit_control' => 'required|integer',
					'compte' => 'required|alpha_num',
					'import' => 'required|numeric',
					'periodicitat' => 'required|alpha_num');

    public function index()
    {
        // Show a listing of quotas.
	$quotas = Quota::all();
	return View::make('index', compact('quotas')); 
    }

    public function create()
    {
        // Show the create quotas form.
        return View::make('create');
    }

    public function handleCreate()
    {
	$validator = Validator::make(Input::all(), $this->validation_rules);
	if ($validator->fails()) {
	    return Redirect::to('/create')->withErrors($validator)->withInput();
	}

	$quota = new Quota;
	foreach (array_keys($this->member_fields) as $field) {
	    $quota->$field = Input::get($field); 
	}
	$quota->save();

	return Redirect::action('QuotasController@index');

    }

    public function edit(Quota $quota)
    {
        // Show the edit quota form.
        return View::make('edit', compact('quota'));
    }

    public function handleEdit()
    {
        // Handle edit form submission.
	$quota = Quota::findOrFail(Input::get('id'));

	foreach (array_keys($this->member_fields) as $field) 
	    $quota->$field = Input::get($field); 

	$quota->save();
	return Redirect::action('QuotasController@index');
    }

    public function delete(Quota $quota)
    {
        // Show delete confirmation page.
        return View::make('delete', compact('quota'));
    }

    public function handleDelete()
    {
        // Handle the delete confirmation.
	$quota = Quota::findOrFail(Input::get('quota'));
	$quota->delete();
	return Redirect::action('QuotasController@index');
    }
}
 ?>