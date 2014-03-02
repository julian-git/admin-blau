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

require_once('util.php');

class CVGController extends BaseController
{
    // this variable will be instantiated to, for example,
    // 'Persone' or 'Quote' (these being mangled catalan for the singular of 'Persones', 'Quotes')
    protected $ClassSingularName;

    // which layout template to use
    protected $layout = 'generic.layout';

    // pass information to layout template so that it can instantiate the correct class
    protected $layout_data;

    // Error messages for custom validation rules
    protected $custom_validation_messages
	= array('integer_size' => "El camp ha de consistir d'exactament :size digits.");

    public function __construct($ClassSingularName) {
	$this->ClassSingularName = $ClassSingularName;
	$this->layout_data
	    = array('CSN' => $ClassSingularName,
		    'csn' => strtolower($ClassSingularName),
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

	if (isset($CSN::$responsible_class))
	{
	    $extended_layout_data['potential_responsibles_list'] 
		= list_all_by_identifying_fields($CSN::$responsible_class);
	}

	$this->layout->content = View::make("generic.index", $extended_layout_data);
    }

    public function create($responsible_id=null)
    {
        // Show the create form.
	$CSN = $this->ClassSingularName;
	$csn = strtolower($CSN);

	$extended_layout_data = $this->layout_data;
	$extended_layout_data['dropbox_options'] = dropbox_options_of($CSN);
	$extended_layout_data['dropbox_default'] = $CSN::$default_values;
	$extended_layout_data['foreign_table'] = foreign_tables_of($CSN);
	if (isset($CSN::$responsible_field)) 
	{
	    $extended_layout_data['responsible_fields'] 
		= array('field' => $CSN::$responsible_field,
			'id' => $responsible_id);
	}
	if (isset($CSN::$dependent_field)) 
	{
	    $extended_layout_data['dependent_fields'] = $CSN::$dependent_field;
	}

	$this->layout->content = View::make('generic.create', $extended_layout_data);
    }

    public function multicreate($instance)
    {
	// Create a new entry in an m-to-n table corresponding to a given first entry
	// e.g., $instance will be of class Beneficiari

	$CSN = $this->ClassSingularName;
	$csn = strtolower($CSN);

	$extended_layout_data = $this->layout_data;
	$this->layout->content = View::make('generic.create', $extended_layout_data);
    }

    public function handleCreate()
    {
	$CSN = $this->ClassSingularName;
	$validator = Validator::make(Input::all(), $CSN::$validation_rules, $this->custom_validation_messages);
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

    public function edit($class_instance)
    {
        // Show the edit form.
	$CSN = $this->ClassSingularName;
	$csn = strtolower($CSN);

	$extended_layout_data = $this->layout_data;
	$extended_layout_data[$csn] = $class_instance;

	$extended_layout_data['dropbox_options'] = dropbox_options_of($CSN);
	$extended_layout_data['dropbox_default'] = dropbox_default_of($CSN, $class_instance);
	$extended_layout_data['foreign_table'] = foreign_tables_of($CSN);
	$extended_layout_data['multidropbox_options'] = multidropbox_options_of($CSN, $class_instance);

        return View::make('generic.edit', $extended_layout_data);
    }

    public function handleEdit()
    {
        // Handle edit form submission.
	$CSN = $this->ClassSingularName;
	$class_instance = $CSN::findOrFail(Input::get('id'));

	$validator = Validator::make(Input::all(), $CSN::$validation_rules, $this->custom_validation_messages);
	if ($validator->fails()) {
	    return Redirect::to(strtolower($CSN) . '/edit/' . Input::get('id'))
		->with($this->layout_data)
		->withErrors($validator)
		->withInput();
	}

	foreach (array_keys($CSN::$member_fields) as $field) 
	{
	    $class_instance->$field = Input::get($field); 
	}

	$class_instance->save();
	return Redirect::action($CSN . 'sController@index');
    }

    public function delete($class_instance)
    {
        // Show delete confirmation page.
	$CSN = $this->ClassSingularName;
	$csn = strtolower($CSN);

	$extended_layout_data = $this->layout_data;
	$extended_layout_data[$csn] = $class_instance;

        return View::make('generic.delete', $extended_layout_data);
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