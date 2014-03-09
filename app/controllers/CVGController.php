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
		$class_instance[$CSN::$dependent_field . '_input'] = join(',', $dependents);
	    }
	    Log::info("class_instance: $class_instance");
	    $extended_layout_data[$csn] = $class_instance;
	    $extended_layout_data['dropbox_default'] = dropbox_default_of($CSN, $class_instance);
	} else {
	    $extended_layout_data['dropbox_default'] = $CSN::$default_values;
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

    protected function save_instance($action)
    {
	$CSN = $this->ClassSingularName;
	$class_instance = (($action == 'create')
			   ? new $CSN
			   : $CSN::findOrFail(Input::get('id')));
	$input = Input::all();
	foreach ($input as $field => $value) 
        {
	    Log::info("processing field $field");
	    if (isset($CSN::$dependent_field) && !strcmp($field, $CSN::$dependent_field . '_input') ||
		!strcmp($field, '_token')) {
		continue;
	    }
	    if ($field != 'id' || $action == 'edit') { 
		$class_instance->$field = $value;
	    } 
	    if ($class_instance->$field == '' &&
		isset($CSN::$default_values[$field])) {
		$class_instance->$field = $CSN::$default_values[$field];
	    }
	}
	Log::info("will save $class_instance");
	$class_instance->save();

	Log::info("will save dependent classes");
	if (isset($CSN::$dependent_field_pivot_table))
        {
	    $this->save_dependent_fields_to_pivot_table($class_instance->id, 
							$input[$CSN::dependent_field . '_input']);
	}

    }

    protected function delete_dependent_fields_from_pivot_table($master_id)
    {
	$CSN = $this->ClassSingularName;
	$pivot_class = $CSN::$dependent_pivot_class;
	$master_id_field = strtolower($CSN) . '_id';
	$pivot_class::where($master_id_field, '=', $master_id)->delete();
    }

    protected function save_dependent_fields_to_pivot_table($master_id, $dependent_ids)
    {
	$CSN = $this->ClassSingularName;
	$master_id_field = strtolower($CSN) . '_id';
	$dependent_id_field = strtolower($CSN::$dependent_class) . '_id';

	// first delete all dependent entries 
	$this->delete_dependent_fields_from_pivot_table($master_id);

	// then insert the active ones
	foreach(explode(',', $dependent_ids) as $dependent_id)
	{
	    if (strlen($dependent_id) == 0) 
	    {
		// This catches empty dependent fields 
		// when we return from an unsuccessful validation
		continue; 
	    }
	    $pivot = new $CSN::$dependent_pivot_class;
	    $pivot->$master_id_field = $master_id;
	    $pivot->$dependent_id_field = $dependent_id;
	    $pivot->timestamps = false;
	    $pivot->save();
	}
	Log::info("saved dependent fields");
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

	$this->save_instance($action);

	return Redirect::to(strtolower($CSN))
	    ->with($this->layout_data);
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

	if (isset($CSN::$dependent_field))
        {
	    $this->delete_dependent_fields_from_pivot_table($CSN, $class_instance->id);
	}
	$class_instance->delete();
	return Redirect::action($CSN . 'sController@index');
    }
}
 ?>