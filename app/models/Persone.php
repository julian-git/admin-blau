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
    public static $singular_class_name = 'Persona';
    public static $plural_class_name = 'Persones';
    public static $class_name_gender = 'f';

    public static $member_fields = array('id' => 'N&uacute;mero de soci',
					 'cognom1' => 'Cognom 1',
					 'cognom2' => 'Cognom 2',
					 'nom' => 'Nom',
					 'mot' => 'Mot',
					 'families_fk' => 'Família',
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
					 'sexe' => 'Sexe',
					 'quotes_fk' => 'Quota');

    public static $fields_in_index = array('id' => 'N&uacute;mero de soci',
					   'cognom1' => 'Cognom 1',
					   'cognom2' => 'Cognom 2',
					   'nom' => 'Nom',
					   'mot' => 'Mot',
					   'telefon1' => 'Telèfon 1',
					   'telefon2' => 'Telèfon 2',
					   'mobil1' => 'Mòvil 1',
					   'mobil2' => 'Mòvil 2',
					   'twitter' => 'Twitter',
					   'whatsapp' => 'Whatsapp'
					   );					 

    public static $validation_rules = array('cognom1' => 'required|alpha',
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

    public static $default_values = array('quotes_fk' => 1);

    public static $identifying_fields = array('mot', 
					      'nom',
					      'cognom1',
					      'cognom2');
    
    public function getFamiliesFkAttribute($value) 
    {
	return resolve_foreign_key('Familie', $value);
    }

    public function getQuotesFkAttribute($value) 
    {
	return resolve_foreign_key('Quote', $value);
    }

    public function castells()
    {
	return $this->belongsToMany('Castell');
    }
}

?>