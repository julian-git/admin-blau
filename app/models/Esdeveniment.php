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

class Esdeveniment extends Eloquent
{
    public static $singular_class_name = 'Esdeveniment';
    public static $plural_class_name = 'Esdeveniments';
    public static $class_name_gender = 'm';

    public static $member_fields = array('id' => 'Id',
					 'titol' => 'Titol',
					 'tipus_esdeveniments_fk' => "Tipus d'Esdeveniment",
					 'data' => 'Data (inici)',
					 'data_fi' => 'Data fi',
					 'hora' => 'Hora',
					 'hora_fi' => 'Hora fi',
					 'descripcio' => 'Descripci&oacute;',
					 'llocs_fk' => 'Lloc',
					 'contacte' => 'contacte',
					 'cost_estimat' => 'Cost Estimat',
					 'cost_real' => 'Cost Real'
					 );

    public static $fields_in_index = array('id' => 'Id',
					   'titol' => 'Titol',
					   'tipus_esdeveniments_fk' => "Tipus d'Esdeveniment",
					   'data' => 'Data (inici)',
					   'llocs_fk' => 'Lloc',
					   'contacte' => 'contacte'
					   );
					 

    public static $validation_rules = array('titol' => 'required',
					    'data' => 'required|date',
					    'cost_estimat' => 'decimal',
					    'cost_real' => 'decimal'
					    );

    public static $default_values = array('tipus_esdeveniments_fk' => 1);

    public static $identifying_fields = array('titol',
					      'data',
					      'fi');

    public function getDataAttribute($value)
    {
	return local_date($value);
    }

    public function getHoraAttribute($value)
    {
	return date('H:i', strtotime($value));
    }

    public function getTipusEsdevenimentsFkAttribute($value) 
    {
	return resolve_foreign_key('TipusEsdeveniment', $value);
    }

    public function getLlocsFkAttribute($value) 
    {
	return resolve_foreign_key('Lloc', $value);
    }

    public static function details($id)
    {
	$esdeveniment = Esdeveniment::findOrFail($id);
	return [ [ $esdeveniment->id, $esdeveniment->hora ] ]; 
    }

    public static function persones_actives()
    {
	$P = new Persone;
	return $P->where('actiu', '=', 1)->count();
    }

    public function persones()
    {
	return $this->belongsToMany('Persone');
    }
}

?>