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

	$soci->save();
	return Redirect::action('SocisController@index');
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