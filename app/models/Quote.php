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

class Quote extends Eloquent
{
    public static $singular_class_name = 'Quota';
    public static $plural_class_name = 'Quotes';
    public static $class_name_gender = 'f';

    public static $member_fields = array('id' => 'Id de Quota',
					 'periodicitat_mesos' => 'Periodicitat (mesos)',
					 'import' => 'Import',
					 'id_responsable' => 'Persona responsable',
					 'beneficiari' => 'Beneficiaris'); // fake field

    public static $validation_rules = array('banc' => 'required|alpha_whitespace',
					    // FIXME: the following should be numeric
					    'codi_banc' => 'integer_size:4',
					    'oficina' => 'integer_size:4',
					    'digit_control' => 'integer_size:2',
					    'compte' => 'integer_size:10',
					    'BIC' => 'alpha_num', // FIXME: correct size?
					    'IBAN' => 'alpha_num', // FIXME: correct size?
					    'import' => 'required|numeric',
					    'tipus_quotes_fk' => 'required|integer');

    public static $default_values = array('tipus_quotes_fk' => 1);

    public static $identifying_fields = array('banc',
					      'compte',
					      'import');

    public function getIdResponsableFkAttribute($value) 
    {
	return resolve_foreign_key('Persone', $value);
    }

    public function beneficiaris()
    {
	return $this->belongsToMany('Persone', 'beneficiaris');
    }
}

?>