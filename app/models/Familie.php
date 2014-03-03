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

class Familie extends Eloquent
{
    public static $singular_class_name = 'Família';
    public static $plural_class_name = 'Famílies';
    public static $class_name_gender = 'f';

    public static $member_fields = array('id' => 'Id',
					 'nom' => 'Nom'
                    );

    public static $fields_in_index = array('id' => 'Id',
                       'nom' => 'Nom',
                       'membres_list' => 'Membres',
                       );                    

    public static $validation_rules = array('nom' => 'required');

    public static $default_values = array();

    public static $identifying_fields = array('nom');

    public function membres()
    {
    	return $this->belongsToMany('Persone')->withPivot('es_responsable');
    }
    
    public function getMembresListAttribute($value)
    {    
	$membres = array();
    	foreach($this->membres as $p)
        {
	    $person = array();
	    foreach(Persone::$identifying_short_fields as $f)
		$person[] = $p->$f;
	    if ($p->pivot->es_responsable)
		$person[] = '(*)';
	    $membres[] = join(' ', $person);
        }
    	return join(', ', $membres);
    }
}

?>