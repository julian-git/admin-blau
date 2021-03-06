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

    protected static $search_field = 'search';

    public function build_search_field()
    {
	$search = array();
	foreach (array('nom',
		       'cognom1',
		       'cognom2',
		       'mot',
		       'numero_soci',
		       'dni',
		       'email',
		       'telefon',
		       'mobil',
		       'bic',
		       'iban',
		       'naixement',
		       'data_alta',
		       'direccio'
		       ) as $field)
        {
	    if (strlen($this->$field) > 0)
	    {
		$search[] = Persone::$member_fields[$field] . ':' . $this->$field;
	    }
	}
	return join('\\', $search);
    }

    public static $default_values = array(
					  'actiu' => 1,
					  'poblacio' => 'Barcelona',
					  'provincia' => 'Barcelona',
					  'data_alta' => '',
					  'rebre_sms' => 1,
					  'rebre_mail' => 1,
					  'categories_fk' => 1,
					  'sexe' => 'D',
					  'rols_fk' => 1
					  );

    public static $validation_rules = array('nom' => 'required',
					    'naixement' => 'date',
					    'dni' => 'alpha_num|max:12',
					    'email' => 'email|required',
					    'sexe' => 'in:H,D');

    public static $display_size_of_field = array('id' => 4,
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
	
    // this controls the appearance of the create/edit/inspect page
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
							     'sexe' => 'Sexe',
							     'id_responsable_familia_list' => 'Responsable per família',
							     'id_membre_familia_list' => 'Membre de família'
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
							      'id_quotes_list' => 'Quotes'
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
						       'comentari' => 'Comentari'
							)
				  );


    // this is for dropboxes containing foreign keys
    protected $resolving_class = array(
				       'categories_fk' => 'Categorie',
				       'rols_fk' => 'Rol'
				       );

    // this is for searchboxes containing foreign keys
    public static $foreign_class = array(
					 'id_quotes_list' => 'Quote',
					 'id_responsable_familia_list' => 'Familie',
					 'id_membre_familia_list' => 'Familie'
					 );

    // what will be displayed in the index listing
    public static $fields_in_index = array('id' => 'Id',
					   'numero_soci' => 'N&uacute;mero de soci',
					   'nom_complert' => 'Nom',
					   'mot' => 'Mot',
					   'telefon' => 'Tel&egrave;fon',
					   'mobil' => 'M&ograve;bil'
					   );					 

    public static function is_creatable($field)
    {
	return 
	    $field != 'numero_soci'
	    ;
    }


    // fields that store an index to (an array of) foreign key values
    // The *_list fields are actually fake, in that they don't correspond to
    // a field in the database, but rather to all the matching entries in the pivot table
    public static function is_foreign_selection($field)
    {
	return 
	    $field == 'id_quotes_list' ||
	    $field == 'id_responsable_familia_list' ||
	    $field == 'id_membre_familia_list' 
	    ;
    }

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

    public static $send_mail_to = array(
					'short_fields' => 'Destinatari'
					);

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

    public function quotes()
    {
        return $this->hasMany('Quote', 'id_responsables_fk');
    }
    
    public function getIdQuotesListAttribute($value)
    {
        $quotes = array();
        foreach($this->quotes()->get() as $q)
        {
	    $quotes[] = $q->id;
	}
        return join(',', $quotes);
    }

    public function responsable_familia()
    {
	return $this->belongsToMany('Familie', 'familie_responsables');
    }

    public function getIdResponsableFamiliaListAttribute($value)
    {
	$families = array();
	foreach ($this->responsable_familia()->get() as $f)
	{
	    $families[] = $f->id;
	}
	return join(',', $families);
    }

    public function membre_familia()
    {
	return $this->belongsToMany('Familie', 'familie_membres');
    }

    public function getIdMembreFamiliaListAttribute($value)
    {
	$families = array();
	foreach ($this->membre_familia()->get() as $f)
	{
	    $families[] = $f->id;
	}
	return join(',', $families);
    }

    public function getShortFieldsAttribute($value)
    {
	return assemble_identifying_short_fields('Persone', $this);
    }
}

// work around the fact that PHP doesn't allow constexpr computations on static variables
// inside the class body

Persone::$default_values['data_alta'] = date('Y-m-d');

?>