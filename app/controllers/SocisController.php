<?php

class SocisController extends BaseController
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
        // Show a listing of socis.
	$socis = Soci::all();
	return View::make('index', compact('socis')); 
   }

    public function create()
    {
        // Show the create socis form.
        return View::make('create');
    }

    public function handleCreate()
    {
	$soci = new Soci;

	foreach (array_keys($this->member_fields) as $field) 
	    $soci->$field = Input::get($field); 

	$validator = Validator::make(array_keys($this->member_fields), $this->validation_rules);

	if ($validator->passes()) {
	    $soci->save();
	    return Redirect::action('SocisController@index');
	}

	return Redirect::to('/create')->withErrors($validator);
    }

    public function edit(Soci $soci)
    {
        // Show the edit game form.
        return View::make('edit', compact('soci'));
    }

    public function handleEdit()
    {
        // Handle edit form submission.
	$soci = Soci::findOrFail(Input::get('id'));

	foreach (array_keys($this->member_fields) as $field) 
	    $soci->$field = Input::get($field); 

	$soci->save();
	return Redirect::action('SocisController@index');
    }

    public function delete(Soci $soci)
    {
        // Show delete confirmation page.
        return View::make('delete', compact('soci'));
    }

    public function handleDelete()
    {
        // Handle the delete confirmation.
	$soci = Soci::findOrFail(Input::get('soci'));
	$soci->delete();
	return Redirect::action('SocisController@index');
    }
}
 ?>