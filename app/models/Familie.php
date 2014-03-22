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
					 'id_membres_list' => 'Membres',
					 'input_id_membres_list' => 'Triar membres',
					 'id_responsables_list' => 'Responsable',
					 'input_id_responsables_list' => 'Triar responsables',
					 );

    public static $fields_in_index = array('id' => 'Id',
					   'nom' => 'Nom',
					   'responsables_list' => 'Responsables',
					   'membres_list' => 'Membres'
                       );                    

    public static $panels = array('Família' => array(
						     'nom' => 'Nom'
						     ),
				  'Responsables' => array(
							  'id_responsables_list' => 'Responsables',
							  'input_id_responsables_list' => 'Triar responsables'
							  ),
				  'Membres' => array(
						     'id_membres_list' => 'Membres',
						     'input_id_membres_list' => 'Triar membres',
						     )
				  );

    // this is for searchboxes containing foreign keys
    public static $foreign_class = array(
					 'id_responsables_list' => 'Persone',
					 'input_id_responsables_list' => 'Persone',
					 'id_membres_list' => 'Persone',
					 'input_id_membres_list' => 'Persone'
					 );

    public static $pivot_class = array(
				       'id_responsables_list' => 'FamilieResponsable',
				       'id_membres_list' => 'FamilieMembre'
				       );

    public static $search_message = array(
					  'input_id_responsables_list' => 'Busca responsable...',
					  'input_id_membres_list' =>  'Busca membre...'
					  );

    // anytime an entry is added to list $f, it's also added to $slave_list_of[$f]
    public static $has_slave_lists = true;

    public static $slave_list_of = array(
					  'id_responsables_list' => 'id_membres_list'
					  );


    public static function is_foreign_selection($field)
    {
	return 
	    $field == 'id_responsables_list' ||
	    $field == 'id_membres_list'
	    ;
    }

    public static function is_foreign_chooser($field)
    {
	return 
	    $field == 'input_id_responsables_list' ||
	    $field == 'input_id_membres_list' 
	    ;
    }

    // The fields that may be edited in the create/edit/inspect view
    public static function is_editable_foreign_field($field)
    {
	return 
	    $field == 'id_responsables_list' ||
	    $field == 'id_membres_list' 
	    ;
    }

    public static $validation_rules = array('nom' => 'required');

    public static $default_values = array();

    public static $identifying_fields = array('nom');

    public static $identifying_short_fields = array('nom');

    public static $send_mail_to = array(
					'id_responsables_list' => 'Responsables',
					'id_membres_list' => 'Membres'
					);

    public function membres()
    {
        return $this->belongsToMany('Persone', 'familie_membres');
    }

    public function responsables()
    {
        return $this->belongsToMany('Persone', 'familie_responsables');
    }
    
    public function getIdMembresListAttribute($value)
    {    
        $membres = array();
        foreach($this->membres()->get() as $p)
        {
	    $membres[] = $p->id;
	}
        return join(', ', $membres);
    }

    public function getIdResponsablesListAttribute($value)
    {    
        $membres = array();
        foreach($this->responsables()->get() as $p)
        {
	    $membres[] = $p->id;
	}
        return join(', ', $membres);
    }

    public function getMembresListAttribute($value)
    {    
        $membres = array();
        foreach($this->membres()->get() as $p)
        {
	    $membres[] = assemble_identifying_short_fields('Persone', $p);
	}
        return join(', ', $membres);
    }

    public function getResponsablesListAttribute($value)
    {    
        $membres = array();
        foreach($this->responsables()->get() as $p)
        {
	    $membres[] = assemble_identifying_short_fields('Persone', $p);
	}
        return join(', ', $membres);
    }
}

?>