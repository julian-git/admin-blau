<?php

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