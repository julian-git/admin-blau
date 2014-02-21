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

class Actuacion extends Eloquent
{
    public static $singular_class_name = 'Actuació';
    public static $plural_class_name = 'Actuacions';
    public static $class_name_gender = 'f';

    public static $member_fields = array('id' => 'Id',
					 'nom' => 'Nom',
					 'tipus_actuacions_fk' => "Tipus d'actuació",
					 'data' => 'Data',
					 'llocs_fk' => 'Lloc'
					 );

    public static $validation_rules = array('id' => 'required|integer',
					    'data' => 'required|date'
					    );

    public static $default_values = array();

    public static $identifying_fields = array('nom',
					      'data'
					      );

    public function getTipusActuacionsFkAttribute($value) 
    {
	return resolve_foreign_key('TipusActuacion', $value);
    }

    public function getLlocsFkAttribute($value) 
    {
	return resolve_foreign_key('Lloc', $value);
    }

    public function castells() 
    {
	return $this->hasMany('Castell');
    }

    public static function propers() 
    {
	$actuacion = new Actuacion;
	return $actuacion->where('data', '>=', date('Y-m-d', strtotime('now')))->get();
    }


}

?>