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
					 'quote' => 'Quota',
					 'bic' => 'BIC',
					 'iban' => 'IBAN',
					 'alcada-cadira' => 'Alçada cadira',
					 'alcada-hombros' => 'Alçada hombros',
					 'alcada-mans' => 'Alçada mans',
					 'amplada-hombros' => 'Amplada hombros',
					 'circunferencia' => 'Circunferencia',
					 'forca' => 'Força'
					 );

    public $display_size_of_field = array('id' => 4,
					  'numero_soci' => 5, 
					  'cognom1' => 30,
					  'cognom2' => 30,
					  'nom' => 30,
					  'mot' => 30,
					  'naixement' => 10,
					  'dni' => 15,
					  'email' => 30,
					  'direccio' => 30,
					  'cp' => 8,
					  'poblacio' => 30,
					  'provincia' => 30,
					  'pais' => 30,
					  'telefon' => 12,
					  'mobil' => 12,
					  'sexe' => 1,
					  'data_alta' => 10,
					  'data_baixa' => 10,
					  'actiu' => 1,
					  'password' => 30,
					  'comentari' => '60x3',
					  'bic' => 12,
					  'iban' => 34
					  );
	
    public static $panels = array('Afiliació' => array(
						       'numero_soci' => 'N&uacute;mero de soci',
						       'data_alta' => "Data d'alta",
						       'data_baixa' => "Data de baixa",
						       'actiu' => 'Actiu',
						       'categories_fk' => 'Categoria'
						       ),
				  'Dades personals' => array(
							     'nom' => 'Nom',
							     'cognom1' => 'Cognom 1',
							     'cognom2' => 'Cognom 2',
							     'mot' => 'Mot',
							     'dni' => 'DNI / NIE / passaport',
							     'naixement' => 'Data de naixement',
							     'sexe' => 'Sexe'
							     ),
				  'Adreça postal' => array(
							   'direccio' => 'Adreça postal',
							   'cp' => 'CP',
							   'poblacio' => 'Població',
							   'provincia' => 'Provincia',
							   'pais' => 'Pais'
							   ),
				  'Dades de contacte' => array(
							       'telefon' => 'Telèfon',
							       'mobil' => 'Mòvil',
							       'rebre_sms' => 'Vol rebre SMS',
							       'email' => 'email',
							       'rebre_mail' => 'Vol rebre mail'
							       ),
				  'Dades finançeres' => array(
							      'iban' => 'IBAN',
							      'bic' => 'BIC',
							      'quote' => 'Quota'
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
							    ),
				  'Comentaris' => array(
						       'comentari' => 'Comentaris'
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
					    'telefon' => 'num_whitespace',
					    'mobil' => 'num_whitespace',
					    'sexe' => 'in:H,D');

    public static $default_values = array();

    public static function is_checkbox($field)
    {
	return 
	    $field == 'actiu' ||
	    $field == 'rebre_sms' ||
	    $field == 'rebre_mail'
	    ;
    }

    public static function is_textarea($field)
    {
	return 
	    $field == 'comentari'
	    ;
    }

    public static $dropbox_options_of = array(
					      'sexe' => array('H' => 'H', 
							      'D' => 'D')
					      );

    public static $identifying_fields = array('nom',
					      'cognom1',
					      'cognom2', 
					      'mot');

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

    public function getQuoteAttribute()
    {
	$quote = '';
	$quote_instance = Quote::where('id_responsables_fk', '=', $this->id)->first();
	foreach (Quote::$identifying_short_fields as $field)
	{
	    $quote .= $quote_instance->resolve($field) . ' ';
	}
	return $quote;
    }

    public static function identifying_fields_of($id)
    {
	return assemble_identifying_fields('Persone', Persone::findOrFail($id));
    }
}

?>