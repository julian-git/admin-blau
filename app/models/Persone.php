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

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

require_once(dirname(__FILE__) . '/../util.php');
require_once('util.php');

class Persone extends ResolvingEloquent implements UserInterface, RemindableInterface 
{
    /*
    public function __construct() 
    {
	DB::connection()->enableQueryLog();
    }
*/
    public static $singular_class_name = 'Persona';
    public static $plural_class_name = 'Persones';
    public static $class_name_gender = 'f';

    public static $member_fields = array('id' => 'Id',
					 'numero_soci' => 'N&uacute;mero de soci',
					 'cognom1' => 'Cognom 1',
					 'cognom2' => 'Cognom 2',
					 'nom' => 'Nom',
					 'mot' => 'Mot',
					 'naixement' => 'Data de naixement',
					 'dni' => 'DNI',
					 'email' => 'email',
					 'direccio' => 'Adreça postal',
					 'cp' => 'CP',
					 'poblacio' => 'Població',
					 'provincia' => 'Provincia',
					 'pais' => 'Pais',
					 'telefon' => 'Telèfon',
					 'mobil' => 'Mòvil',
					 'sexe' => 'Sexe',
					 'data_alta' => "Data d'alta",
					 'data_baixa' => "Data de baixa",
					 'actiu' => 'Actiu',
					 'categories_fk' => 'Categoria',
					 'rols_fk' => 'Rol',
					 'usuari' => 'Usuari',
					 'password' => 'Password',
					 'rebre_sms' => 'Vol rebre SMS',
					 'rebre_mail' => 'Vol rebre mail',
					 'comentari' => 'Comentaris',
					 'bic' => 'BIC',
					 'iban' => 'IBAN',
					 'alcada-cadira' => 'Alçada cadira',
					 'alcada-hombros' => 'Alçada hombros',
					 'alcada-mans' => 'Alçada mans',
					 'amplada-hombros' => 'Amplada hombros',
					 'circunferencia' => 'Circunferencia',
					 'forca' => 'Força'
					 );
	
    public static $panels = array('Dades personals' => array(
							     'nom' => 'Nom',
							     'cognom1' => 'Cognom 1',
							     'cognom2' => 'Cognom 2',
							     'mot' => 'Mot',
							     'dni' => 'DNI',
							     'naixement' => 'Data de naixement',
							     'sexe' => 'Sexe'
							     ),
				  'Dades CVG' => array(
						       'numero_soci' => 'N&uacute;mero de soci',
						       'data_alta' => "Data d'alta",
						       'data_baixa' => "Data de baixa",
						       'actiu' => 'Actiu',
						       'rebre_sms' => 'Vol rebre SMS',
						       'rebre_mail' => 'Vol rebre mail',
						       'comentari' => 'Comentaris',
						       'categories_fk' => 'Categoria'
						       ),
				  'Adreça postal' => array(
							   'direccio' => 'Adreça postal',
							   'cp' => 'CP',
							   'poblacio' => 'Població',
							   'provincia' => 'Provincia',
							   'pais' => 'Pais'
							   ),
				  'Dades de contacte' => array(
							       'email' => 'email',
							       'telefon' => 'Telèfon',
							       'mobil' => 'Mòvil'
							       ),
				  'Dades finançeres' => array(
							      'iban' => 'IBAN'
							      ),
				  "Dades d'accés" => array(
					 'password' => 'Password',
					 'rols_fk' => 'Rol'
							   ),
				  'Dades físiques' => array(
					 'alcada-cadira' => 'Alçada cadira',
					 'alcada-hombros' => 'Alçada hombros',
					 'alcada-mans' => 'Alçada mans',
					 'amplada-hombros' => 'Amplada hombros',
					 'circunferencia' => 'Circunferencia',
					 'forca' => 'Força'
							    )
				  );


    protected $resolving_class = array(
				       'categories_fk' => 'Categorie',
				       'rols_fk' => 'Rol'
				       );

    public static $fields_in_index = array('id' => 'Id',
					   'numero_soci' => 'N&uacute;mero de soci',
					   'nom_complert' => 'Nom',
					   'mot' => 'Mot',
					   'telefon' => 'Tel&egrave;fon',
					   'mobil' => 'M&ograve;bil'
					   );					 

    public static $validation_rules = array('cognom1' => 'required|alpha',
					    'cognom2' => 'alpha',
					    'nom' => 'required|alpha',
					    'mot' => 'required|alpha',
					    'naixement' => 'date',
					    'dni' => 'alpha_num|max:12',
					    'email' => 'email',
					    'cp' => 'alpha_num',
					    'telefon' => 'alpha_num',
					    'mobil' => 'alpha_num',
					    'sexe' => 'in:H,D');

    public static $default_values = array();

    public static $identifying_fields = array('nom',
					      'cognom1',
					      'cognom2');

    public static $identifying_short_fields = array('nom',
						    'cognom1');

    // Now stuff from the UserInterface and the RemindableInterface

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'persones';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password');

	/**
	 * Get the unique identifier for the user.
	 *
	 * @return mixed
	 */
	public function getAuthIdentifier()
	{
		return $this->getKey();
	}

	/**
	 * Get the password for the user.
	 *
	 * @return string
	 */
	public function getAuthPassword()
	{
		return $this->password;
	}

	/**
	 * Get the e-mail address where password reminders are sent.
	 *
	 * @return string
	 */
	public function getReminderEmail()
	{
		return $this->email;
	}

	// done interfaces
    
    public function getNomComplertAttribute()
    {
    	return $this->nom.' '.$this->cognom1.' '.$this->cognom2;
    	
    }

    public function castells()
    {
        return $this->belongsToMany('Castell');
    }

    public function actuacions()
    {
        return $this->belongsToMany('Actuacion');
    }

    public function esdeveniments()
    {
        return $this->belongsToMany('Esdeveniment');
    }

    public static function identifying_fields_of($id)
    {
	return assemble_identifying_fields('Persone', Persone::findOrFail($id));
    }
}

?>