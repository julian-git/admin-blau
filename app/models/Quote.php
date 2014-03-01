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
					 'id_responsables_fk' => 'Persona responsable',
					 'beneficiari' => 'Beneficiaris' // fake field
					 );

    public static $responsible_class = 'Persone';

    public static $no_dropbox = array('id_responsables_fk'
				      );

    public static $validation_rules = array('periodicitat_mesos' => 'required|integer',
					    'import' => 'required|numeric'
					    );

    public static $default_values = array();

    public static $identifying_fields = array('periodicitat_mesos',
					      'id_responsables_fk',
					      'import'
					      );

    public function getIdResponsablesFkAttribute($value) 
    {
	return resolve_foreign_key('Persone', $value);
    }

    public function beneficiaris()
    {
	return $this->belongsToMany('Persone', 'beneficiaris');
    }
}

?>