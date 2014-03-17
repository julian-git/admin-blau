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

class Actuacion extends ResolvingEloquent
{

    /*
    public function __construct() 
    {
	DB::connection()->enableQueryLog();
    }
    */
    public static $singular_class_name = 'Actuació';
    public static $plural_class_name = 'Actuacions';
    public static $class_name_gender = 'f';

    public static $member_fields = array('id' => 'Id',
					 'nom' => 'Nom',
					 'tipus_actuacions_fk' => "Tipus d'actuació",
					 'data' => 'Data',
					 'llocs_fk' => 'Lloc'
					 );

    protected $resolving_class = array(
					 'tipus_actuacions_fk' => 'TipusActuacio',
					 'llocs_fk' => 'Lloc'
				       );

    public static $validation_rules = array('id' => 'required|integer',
					    'data' => 'required|date'
					    );

    public static $default_values = array();

    public static $identifying_fields = array('nom',
					      'data'
					      );

    public function getDataAttribute($value)
    {
	return local_date($value);
    }

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

    public function persones() 
    {
	return $this->belongsToMany('Persone');
    }

    public static function details($actuacion_id)
    {
	$res = array();
	foreach (Actuacion::findOrFail($actuacion_id)->castells->all() as $c) 
	{
	    $tc = TipusCastell::where('id', '=', $c->tipus_castells_fk)->first();
	    $res[] = array($c->id, $tc->nom);
	}
	return $res;
    }

    public static function pinya_necessaria($castell_nom)
    {
	$TC = new TipusCastell;
	return $TC->where('nom', '=', $castell_nom)->pluck('pinya_necessaria');
    }

    public static function current_count($castell_id)
    {
	return Castell::findOrFail($castell_id)->castellers()->count();
    }
}

?>