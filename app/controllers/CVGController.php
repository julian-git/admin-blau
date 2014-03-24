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
	$this->create_edit_inspect_impl('Crear', $responsible_id, null);
    }

    public function edit($class_instance)
    {
	$this->create_edit_inspect_impl('Editar', null, $class_instance);
    }

    public function inspect($class_instance)
    {
	$this->create_edit_inspect_impl('Mostrar', null, $class_instance);
    }

    protected function create_edit_inspect_impl($action, $responsible_id, $class_instance)
    {
        // Show the create form.
	$CSN = $this->ClassSingularName;
	$csn = strtolower($CSN);

	$extended_layout_data = $this->layout_data;
	$extended_layout_data['action'] = $action;
	$extended_layout_data['dropbox_options'] = dropbox_options_of($CSN);
	$extended_layout_data['foreign_table'] = foreign_tables_of($CSN);

	if (isset($class_instance))
	{
	    $extended_layout_data['dropbox_default'] = dropbox_default_of($CSN, $class_instance);
	} else {
	    $class_instance = new $CSN;
	    $extended_layout_data['dropbox_default'] = $CSN::$default_values;
	    if (isset($responsible_id))
	    {
		$class_instance->id_responsables_fk = $responsible_id;
	    }
	}
	$extended_layout_data[$csn] = $class_instance;

	$this->layout->content = View::make('generic.create_edit_inspect', $extended_layout_data);
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

    protected function before_save_hook($input, &$class_instance)
    {
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
	    if (!strcmp($field, '_token')) {
		continue;
	    }
	    elseif (in_array($field, array_keys($CSN::$foreign_class)) &&
		    ! $CSN::is_single_entry_list($field))
	    {
		continue; // defer this until after we definitely have a $class_instance->id
	    } 
            elseif (($field != 'id' || $action == 'edit') && $value != '') 
            {
		$class_instance->$field = $value;
	    } 
            elseif ($value == '' && isset($CSN::$default_values[$field])) 
            {
		$class_instance->$field = $CSN::$default_values[$field];
	    }
	}

	if (isset($CSN::$search_field))
	{
	    $sf = $CSN::$search_field;
	    $this->$$sf = $this->build_search_field();
	}
	
	//	Log::info("will save $class_instance");
	$this->before_save_hook($input, $class_instance);
	$class_instance->save();

	// Log::info("will save dependent fields");
	foreach ($input as $field => $value) 
	{   // now complete the action left over from before, 
	    // but check whether the field is editable
	    if (in_array($field, array_keys($CSN::$foreign_class)) &&
		$CSN::is_editable_foreign_field($field) &&
		! $CSN::is_single_entry_list($field))
	    {
		$this->save_dependent_fields_to_pivot_table($class_instance->id, $field, $value);
	    }
	}

	return $class_instance;
    }

    protected function delete_dependent_fields_from_pivot_table($master_id, $dependent_field)
    {
	$CSN = $this->ClassSingularName;
	$pivot_class = $CSN::$pivot_class[$dependent_field];
	$master_id_field = strtolower($CSN) . '_id';
	$pivot_class::where($master_id_field, '=', $master_id)->delete();
    }

    protected function save_dependent_fields_to_pivot_table($master_id, $dependent_field, $dependent_ids)
    {
	$CSN = $this->ClassSingularName;
	$master_id_field = strtolower($CSN) . '_id';
	$dependent_id_field = strtolower($CSN::$foreign_class[$dependent_field]) . '_id';

	// first delete all dependent entries 
	$this->delete_dependent_fields_from_pivot_table($master_id, $dependent_field);

	// then insert the active ones
	foreach(explode(',', $dependent_ids) as $dependent_id)
	{
	    if (strlen($dependent_id) == 0) 
	    {
		// This catches empty dependent fields 
		// when we return from an unsuccessful validation
		continue; 
	    }
	    $pivot = new $CSN::$pivot_class[$dependent_field];
	    $pivot->$master_id_field = $master_id;
	    $pivot->$dependent_id_field = $dependent_id;
	    $pivot->timestamps = false;
	    $pivot->save();
	}
	//	Log::info("saved dependent fields");
    }

    public function handleCrear($arg=null)
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
	$csn = strtolower($CSN);
	$validator = Validator::make(Input::all(), $CSN::$validation_rules, $this->custom_validation_messages);
	if ($validator->fails()) {
	    $action_tail = (!strcmp($action, 'create') && !strcmp($CSN, 'Quote'))
		? Input::get('id_responsables_fk')
		: Input::get('id');
	    // If you ever need to see the failed validation tests, uncomment the following:
	    // $this->log_failed_validator_entries($action_tail, $validator);
	    return Redirect::to($csn . '/' . $action . '/' . $action_tail)
		->with($this->layout_data)
		->withErrors($validator)
		->withInput();
	}

	$class_instance = $this->save_instance($action);
	
	return Redirect::to(isset($CSN::$send_mail_to)
			    ? $csn . '/send-mail/' . $class_instance->id
			    : $csn)
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

	foreach (array_keys($CSN::$foreign_class) as $field)
        {
	    if (! $CSN::is_single_entry_list($field) &&
		strcmp(substr($field, 0, strlen('input_')), 'input_')) 
		// it doesn't start with "input"
	    {
		$this->delete_dependent_fields_from_pivot_table($class_instance->id, $field);
	    }
	}
	$class_instance->delete();
	return Redirect::action($CSN . 'sController@index');
    }

    public function sendMail($class_instance) 
    {
        // Show a listing.
	$CSN = $this->ClassSingularName;
	$csn = strtolower($CSN);
	$extended_layout_data = $this->layout_data;
	$extended_layout_data[$csn] = $class_instance;
	$this->layout->content = View::make("generic.send_mail", $extended_layout_data);
    }

    public function handleSendMail()
    {
	$CSN = $this->ClassSingularName;
	$csn = strtolower($CSN);
	$extended_layout_data = $this->layout_data;
	$extended_layout_data[$csn] = $CSN::where('id', '=', Input::get('id'))->first();
	$extended_layout_data['action'] = 'Enviar correu';
	$extended_layout_data['signatari'] = 'Administració CVG';

	foreach(Input::all() as $field_and_id => $value)
	{
	    if (($pos = strpos($field_and_id, '-id-')) === false) continue;

	    $field = substr($field_and_id, 0, $pos);
	    $id = substr($field_and_id, $pos + strlen('-id-'));

	    if ($CSN::is_foreign_selection($field))
	    {
		$C = $CSN::$foreign_class[$field];
		$instance = $C::where('id', '=', $id)->first();
	    } 
	    else 
	    {
		$C = $CSN;
		$instance = $extended_layout_data[$csn];
	    }

	    Mail::queue(array('emails.confirmatori_canvi', 'generic.create_edit_inspect'),
			$extended_layout_data,
			function($message) use ($instance, $C, $CSN) {
		    $message->to($instance->email, 
				 assemble_identifying_short_fields($C, $instance))
			->subject('Confirmació de canvis en ' 
				  . strtolower($CSN::$singular_class_name)
				  )
			//			->cc('info@cvg.cat')
			;
		});
	}
	return Redirect::action($CSN . 'sController@index');
    }

    public function make_list()
    {
	$extended_layout_data = $this->layout_data;
	$extended_layout_data['results'] = array();
	$this->layout->content = View::make('generic.list', $extended_layout_data);
    }

    public function handleList()
    {
	return Input::has('list')
	    ?  $this->list_impl()
	    :  $this->export_impl();
    }

    protected function list_impl()
    {
	$CSN = $this->ClassSingularName;
	$field = Input::get('field');
	$select = $CSN::$identifying_short_fields;
	$select[] = $field;
	$query_result = $CSN::where($field, 
				    Input::get('operator'), 
				    Input::get('value'))
	    ->select($select)
	    ->get();
	$results = array();
	foreach ($query_result as $result)
	{
	    $results[] = assemble_identifying_short_fields($CSN, $result) 
		. ': ' . $result->$field;
	}
	$extended_layout_data = $this->layout_data;
	$extended_layout_data['results'] = $results;
	$this->layout->content = View::make('generic.list', $extended_layout_data);
    }

    protected function export_entry($fmt, $field, $value)
    {
	switch($fmt) 
	{
	case 'json':
	    return '"' . $field . ':' . $value . '"';

	case 'csv':
	    return '"' . $value . '"';

	case 'xml':
	    return '      <' . $field . '>' . $value . '</' . $field . '>';

	default:
	    App::abort(403, 'El format ' . $fmt . ' és desconegut');
	}
    }

    protected function export_header($fmt, $results)
    {
	switch($fmt) {
	case 'csv':
	    return join(',', array_keys($this->fields_to_export())) . "\n";
	    
	case 'xml':
	    return "<dataset>\n"
		. "  <metadata>\n"
		. '    <date>' . date('Y-m-d') . "</date>\n"
		. '    <time>' . date('H:i:s') . "</time>\n"
		. "  </metadata>\n"
		. "  <rows>\n";

	case 'json':
	    return '{';

	default:
	    return '';
	}
    }

    protected function export_footer($fmt)
    {
	switch($fmt) {
	case 'csv':
	    return '';
	    
	case 'xml':
	    return "\n  </rows>\n"
		. "</dataset>\n";

	case 'json':
	    return '}';

	default:
	    return '';
	}
    }

    protected function export_row_prefix($fmt)
    {
	switch($fmt) {
	case 'csv':
	    return '';
	    
	case 'xml':
	    return "    <row>\n";

	case 'json':
	    return '{';

	default:
	    return '';
	}
    }

    protected function export_row_suffix($fmt)
    {
	switch($fmt) {
	case 'csv':
	    return '';
	    
	case 'xml':
	    return "\n    </row>";

	case 'json':
	    return '}';

	default:
	    return '';
	}
    }

    protected function export_row_joiner($fmt)
    {
	switch($fmt) {
	case 'csv':
	    return ',';
	    
	case 'xml':
	    return "\n";

	case 'json':
	    return ',';

	default:
	    return "\n";
	}
    }

    protected function export_rows_joiner($fmt)
    {
	switch($fmt) {
	case 'csv':
	    return "\n";
	    
	case 'xml':
	    return "\n";

	case 'json':
	    return ",\n";

	default:
	    return "\n";
	}
    }

    protected function fields_to_export()
    {
	$CSN = $this->ClassSingularName;
	$bad_fields = array(
			    'usuari' => 'Usuari',
			    'password' => 'Password'
			    );
	$substituted_fields = array();

	foreach ($CSN::$member_fields as $field => $prompt)
	{
	    // don't export fake input member fields
	    if (substr($field, 0, strlen('input_')) == 'input_')
	    {
		$bad_fields[$field] = $prompt;
	    }

	    // convert fields of type 'id_responsables_list' to 'responsables_list'
	    // so that foreign keys get converted upon exporting
	    if (substr($field, 0, strlen('id_')) == 'id_' &&
		substr($field, strrpos($field, '_list')) == '_list')
	    {
		$substituted_fields[$field] = substr($field, strlen('id_'));
	    }
	}
	
	$fields = array_diff_assoc($CSN::$member_fields, $bad_fields);
	
	foreach ($substituted_fields as $orig => $subs)
	{
	    $fields[$subs] = $fields[$orig];
	    unset($fields[$orig]);
	}
	return $fields;
    }


    protected function export_impl()
    {
	$CSN = $this->ClassSingularName;
	$field = Input::get('field');

	$query_results = $CSN::where($field, 
				    Input::get('operator'), 
				    Input::get('value'))
	    ->select('id')
	    ->get();

	$fmt = Input::get('format_input');

	$pathToFile = tempnam(sys_get_temp_dir(), 'export_' . date('Y-m-d') . '_') 
	    . '.' . $fmt;
	if (($handle = fopen($pathToFile, 'w')) === false) 
	{
	    App::abort(403, 'No he pogut obrir el fitxer ' . $tmpfnam);
	}

	fwrite($handle, $this->export_header($fmt, $query_results));

	$rows = array();
	foreach ($query_results as $result)
	{
	    Log::info($result->id);
	    $class_instance = $CSN::findOrFail($result->id);
	    
	    $row = array();
	    foreach ($this->fields_to_export() as $field => $prompt) 
	    {
		$row[] = $this->export_entry($fmt, $prompt, $class_instance->$field);
	    }
	    $rows[] =
		   $this->export_row_prefix($fmt)
		   . join($this->export_row_joiner($fmt), $row)
		   . $this->export_row_suffix($fmt);
	}
	fwrite($handle, join($this->export_rows_joiner($fmt), $rows));
	fwrite($handle, $this->export_footer($fmt));
	fclose($handle);
	return Response::download($pathToFile);
    }

    
}
 ?>