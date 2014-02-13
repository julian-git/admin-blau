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

class CVGController extends BaseController
{
    protected $ClassSingularName;

    public function __construct($ClassSingularName) {
	$this->ClassSingularName = $ClassSingularName;
    }

    public function index()
    {
        // Show a listing.
	$CSN = $this->ClassSingularName;
	$listing = $CSN::all();
	return View::make(strtolower($CSN) . '/index', array(strtolower($CSN) . 's' => $listing)); 
    }

    public function create()
    {
        // Show the create form.
	$CSN = $this->ClassSingularName;
        return View::make(strtolower($CSN) . '/create');
    }

    public function handleCreate()
    {
	$CSN = $this->ClassSingularName;
	$validator = Validator::make(Input::all(), $CSN::validation_rules);
	if ($validator->fails()) {
	    return Redirect::to('/' . strtolower($CSN) . '/create')->withErrors($validator)->withInput();
	}

	$class_instance = new $CSN;
	foreach (array_keys($CSN::member_fields) as $field) {
	    if ($field != 'id')
		$class_instance->$field = Input::get($field); 
	}
	$class_instance->save();

	return Redirect::action($CSN . 'sController@index');

    }

    public function edit($class_instance)
    {
        // Show the edit form.
        return View::make(strtolower($CSN) . '/edit', array(strtolower($this->ClassSingularName) => $class_instance));
    }

    public function handleEdit()
    {
        // Handle edit form submission.
	$CSN = $this->ClassSingularName;
	$class_instance = $CSN::findOrFail(Input::get('id'));

	foreach (array_keys($CSN::member_fields) as $field) 
	    if ($field != 'id')
		$class_instance->$field = Input::get($field); 

	$class_instance->save();
	return Redirect::action($CSN . 'sController@index');
    }

    public function delete($class_instance)
    {
        // Show delete confirmation page.
        return View::make(strtolower($CSN) . '/delete', array(strtolower($this->ClassSingularName) => $class_instance));
			  //        return View::make('delete', compact('casteller'));
    }

    public function handleDelete()
    {
        // Handle the delete confirmation.
	$CSN = $this->ClassSingularName;
	$class_instance = $CSN::findOrFail(Input::get(strtolower($CSN)));
	$class_instance->delete();
	return Redirect::action($CSN . 'sController@index');
    }
}
 ?>