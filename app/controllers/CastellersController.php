<?php

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
	if ($validator->fails()) {
	    return Redirect::to('/create')->withErrors($validator)->withInput();
	}

	$casteller = new Casteller;
	foreach (array_keys($this->member_fields) as $field) {
	    $casteller->$field = Input::get($field); 
	}
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