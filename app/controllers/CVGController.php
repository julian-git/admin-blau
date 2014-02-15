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
    // this variable will be instantiated to, for example,
    // 'Casteller' or 'Quote' (the latter is mangled catalan for the singular of "Quotes").
    protected $ClassSingularName;

    // which layout template to use
    protected $layout = 'generic.layout';

    // pass information to layout template so that it can instantiate the correct class
    protected $layout_data;

    public function __construct($ClassSingularName) {
	$this->ClassSingularName = $ClassSingularName;
	$this->layout_data  = array('CSN' => $ClassSingularName,
				    'class_instance_list' => strtolower($ClassSingularName) . 's');
    }

    public function index()
    {
        // Show a listing.
	$CSN = $this->ClassSingularName;
	$csn = strtolower($CSN);
	$listing = $CSN::all();
	$extended_layout_data = $this->layout_data;
	$extended_layout_data[$csn . 's'] = $listing;

	$this->layout->content = View::make("generic.index", $extended_layout_data);
    }

    public function create()
    {
        // Show the create form.
	$this->layout->content = View::make('generic.create', $this->layout_data);
    }

    public function handleCreate()
    {
	$CSN = $this->ClassSingularName;
	$validator = Validator::make(Input::all(), $CSN::$validation_rules);
	if ($validator->fails()) {
	    return Redirect::to(strtolower($CSN) . '/create')
		->with($this->layout_data)
		->withErrors($validator)
		->withInput();
	}

	$class_instance_list = new $CSN;
	foreach (array_keys($CSN::$member_fields) as $field) {
	    if ($field != 'id') {
		$class_instance_list->$field = Input::get($field); 
	    }
	    if ($class_instance_list->$field == '' &&
		isset($CSN::$default_values[$field])) {
		$class_instance_list->$field = $CSN::$default_values[$field];
	    }
	}
	$class_instance_list->save();

	return Redirect::action($CSN . 'sController@index');

    }

    public function edit($class_instance_list)
    {
        // Show the edit form.
	$CSN = $this->ClassSingularName;
	$csn = strtolower($CSN);
        return View::make("/$csn/edit", 
			  array($csn => $class_instance_list));
    }

    public function handleEdit()
    {
        // Handle edit form submission.
	$CSN = $this->ClassSingularName;
	$class_instance_list = $CSN::findOrFail(Input::get('id'));

	foreach (array_keys($CSN::member_fields) as $field) 
	    if ($field != 'id')
		$class_instance_list->$field = Input::get($field); 

	$class_instance_list->save();
	return Redirect::action($CSN . 'sController@index');
    }

    public function delete($class_instance)
    {
        // Show delete confirmation page.
	$CSN = $this->ClassSingularName;
	$csn = strtolower($CSN);
        return View::make("/$csn/delete", array($csn => $class_instance));
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