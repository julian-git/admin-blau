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

class Persone extends Eloquent
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

    public static $member_fields = array('id' => 'N&uacute;mero de soci',
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
					 'alta' => "Data d'alta",
					 'actiu' => 'Actiu',
					 'categories_fk' => 'Categoria',
					 'rols_fk' => 'Rol',
					 'usuari' => 'Usuari',
					 'password' => 'Password',
					 'rebre_sms' => 'Vol rebre SMS',
					 'rebre_mail' => 'Vol rebre mail',
					 'comentari' => 'Comentaris',
					 'bic' => 'BIC',
					 'iban' => 'IBAN'
					 );

    public static $fields_in_index = array('id' => 'Id',
					   'num_soci' => 'N&uacute;mero de soci',
					   'cognom1' => 'Cognom 1',
					   'cognom2' => 'Cognom 2',
					   'nom' => 'Nom',
					   'mot' => 'Mot',
					   'telefon' => 'Telèfon',
					   'mobil' => 'Mòvil'
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
}

?>