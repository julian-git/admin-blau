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
		    'csn' => strtolower($ClassSingularName)
		    );
    }

    public function index()
    {
        // Show a listing.
	$CSN = $this->ClassSingularName;
	$csn = strtolower($CSN);
	$extended_layout_data = $this->layout_data;
	$this->layout->content = View::make("generic.index", $extended_layout_data);
    }

    public function create($responsible_id=null)
    {
	$this->create_and_edit_impl('Crear', $responsible_id, null);
    }

    public function edit($class_instance)
    {
	$this->create_and_edit_impl('Editar', null, $class_instance);
    }

    protected function create_and_edit_impl($action, $responsible_id, $class_instance)
    {
        // Show the create form.
	$CSN = $this->ClassSingularName;
	$csn = strtolower($CSN);

	$extended_layout_data = $this->layout_data;
	$extended_layout_data['action'] = $action;
	$extended_layout_data['dropbox_options'] = dropbox_options_of($CSN);
	$extended_layout_data['dropbox_default'] = $CSN::$default_values;
	$extended_layout_data['foreign_table'] = foreign_tables_of($CSN);

	if (isset($CSN::$responsible_field)) 
	{
	    $extended_layout_data['responsible_fields'] 
		= array('field' => $CSN::$responsible_field,
			'id' => (isset($responsible_id)
				 ? $responsible_id 
				 : $class_instance->responsible()->pluck('id'))
			);
	}

	if (isset($CSN::$dependent_field)) 
	{
	    $extended_layout_data['dependent_fields'] = $CSN::$dependent_field;
	}

	if (isset($class_instance))
	{
	    if (isset($CSN::$dependent_field) && 
		!strcmp($action, 'Editar')) // should be redundant
	    {
		$dependents = array();
		foreach($class_instance->dependents()->get() as $dep)
		{
		    $dependents[] = $dep->id;
		}
		$class_instance['dependent_field_input'] = join(',', $dependents);
	    }
	    Log::info("class_instance: $class_instance");
	    $extended_layout_data[$csn] = $class_instance;
	}

	$this->layout->content = View::make('generic.create_and_edit', $extended_layout_data);
    }

    protected function log_failed_validator_entries($action_tail, $validator)
    {
	Log::info('responsible_field_id: ' . $action_tail);
	Log::info('size: ' . sizeof($validator->failed()));
	foreach($validator->failed() as $attr => $rule) {
	    Log::info("attr: $attr");
	    foreach($rule as $r => $param) {
		Log::info("rule: $r");
		foreach ($param as $a => $b) {
		    Log::info("param: $attr: $r => ($a => $b)");
		}
	    }
	}
    }

    protected function save_instance($CSN)
    {
	$class_instance_list = new $CSN;
	$input = Input::all();
	foreach ($input as $field => $value) 
        {
	    if (!strcmp($field, 'dependent_field_input')) {
		continue;
	    }
	    if ($field != 'id' || $action == 'edit') { 
		$class_instance_list->$field = $value;
	    } 
	    if ($class_instance_list->$field == '' &&
		isset($CSN::$default_values[$field])) {
		$class_instance_list->$field = $CSN::$default_values[$field];
	    }
	}
	$class_instance_list->save();

	if (isset($input['dependent_field_input']))
        {
	    $this->save_dependent_fields($class_instance_list->id, 
					 $input['dependent_field_input']);
	}

    }

    protected function save_dependent_fields($master_id, $dependent_ids)
    {
	$CSN = $this->ClassSingularName;
	$master_id_field = strtolower($CSN) . '_id';
	$dependent_id_field = strtolower($CSN::$dependent_class) . '_id';
	$pivot_class = $CSN::$dependent_pivot_class;

	// first delete all dependent entries 
	$pivot_class::where($master_id_field, '=', $master_id)->delete();

	// then insert the active ones
	foreach(explode(',', $dependent_ids) as $dependent_id)
	{
	    if (strlen($dependent_id) == 0) 
	    {
		// This catches empty dependent fields 
		// when we return from an unsuccessful validation
		continue; 
	    }
	    $pivot = new $pivot_class;
	    $pivot->$master_id_field = $master_id;
	    $pivot->$dependent_id_field = $dependent_id;
	    $pivot->timestamps = false;
	    $pivot->save();
	}
    }

    public function handleCrear()
    {
	return $this->handle_create_and_edit_impl('create');
    }

    public function handleEditar()
    {
	return $this->handle_create_and_edit_impl('edit');
    }

    protected function handle_create_and_edit_impl($action)
    {
	$CSN = $this->ClassSingularName;
	$validator = Validator::make(Input::all(), $CSN::$validation_rules, $this->custom_validation_messages);
	if ($validator->fails()) {
	    $action_tail = (!strcmp($action, 'create'))
		? Input::get($CSN::$responsible_field)
		: Input::get('id');
	    // If you ever need to see the failed validation tests, uncomment the following:
	    // $this->log_failed_validator_entries($action_tail, $validator);
	    return Redirect::to(strtolower($CSN) . '/' . $action . '/' . $action_tail)
		->with($this->layout_data)
		->withErrors($validator)
		->withInput();
	}

	$this->save_instance($CSN);

	return Redirect::to(strtolower($CSN))
	    ->with($this->layout_data);
    }


    public function handleEdit($id)
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