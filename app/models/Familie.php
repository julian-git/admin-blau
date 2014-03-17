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

class Familie extends ResolvingEloquent
{
/*
    public function __construct() 
    {
	DB::connection()->enableQueryLog();
    }
*/
    public static $singular_class_name = 'Família';
    public static $plural_class_name = 'Famílies';
    public static $class_name_gender = 'f';

    public static $member_fields = array('id' => 'Id',
					 'nom' => 'Nom',
					 'id_membres_no_responsables' => 'Membres',
					 'id_membres_responsables' => 'Responsable'
					 );

    public static $fields_in_index = array('id' => 'Id',
                       'nom' => 'Nom',
                       'id_membres_no_responsables' => 'Membres',
                       'id_membres_responsables' => 'Responsable'
                       );                    

    public static $panels = array('Família' => array(
						     'nom' => 'Nom'
						     ),
				  'Responsables' => array(
							  'id_membres_responsables' => 'Responsables'
							  ),
				  'Membres' => array(
						     'id_membres_no_responsables' => 'Membres'
						     )
				  );

    // this is for searchboxes containing foreign keys
    public static $foreign_class = array(
					 'id_membres_responsables' => 'Persone',
					 'id_membres_no_responsables' => 'Persone'
					 );

    public static function is_foreign_selection($field)
    {
	return 
	    $field == 'id_membres_responsables' ||
	    $field == 'id_membres_no_responsables'
	    ;
    }



    public static $validation_rules = array('nom' => 'required');

    public static $default_values = array();

    public static $identifying_fields = array('nom');

    public function membres_no_responsables()
    {
        return $this->belongsToMany('Persone')->withPivot('es_responsable')->where('es_responsable', '=', 0)->get();
    }

    public function membres_responsables()
    {
        return $this->belongsToMany('Persone')->withPivot('es_responsable')->where('es_responsable', '=', 1)->get();
    }
    
    public function getIdMembresNoResponsablesAttribute($value)
    {    
        $membres = array();
        foreach($this->membres_no_responsables() as $p)
        {
	    $membres[] = $p->id;
	}
        return join(', ', $membres);
    }

    public function getIdMembresResponsablesAttribute($value)
    {    
        $membres = array();
        foreach($this->membres_responsables() as $p)
        {
	    $membres[] = $p->id;
	}
        return join(', ', $membres);
    }
}

?>