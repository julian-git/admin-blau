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

class Castell extends Eloquent
{
    public static $singular_class_name = 'Castell';
    public static $plural_class_name = 'Castells';
    public static $class_name_gender = 'm';

    public static $member_fields = array('id' => 'Id',
					 'tipus_castells_fk' => 'Tipus de Castell',
					 'actuacions_fk' => 'Actuació',
					 'ordre' => 'Ordre a Plaça'
					 );

    public static $validation_rules = array('id' => 'required|integer',
					    'placa_o_assaig' => 'in:P,A',
					    'resultat' => 'in:,c,id,i'
					    );

    public static $default_values = array();

    public static $identifying_fields = array('tipus_castells_fk',
					      'actuacions_fk'
					      );

    public function getActuacionsFkAttribute($value) 
    {
	return resolve_foreign_key('Actuacion', $value);
    }

    public function getTipusCastellsFkAttribute($value) 
    {
	return resolve_foreign_key('TipusCastell', $value);
    }

    public function actuacion()
    {
	return $this->belongsTo('Actuacion');
    }
}

?>