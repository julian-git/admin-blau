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

class Quote extends ResolvingEloquent
{
    /*
    public function __construct() 
    {
	DB::connection()->enableQueryLog();
    }
    */

    public static $singular_class_name = 'Quota';
    public static $plural_class_name = 'Quotes';
    public static $class_name_gender = 'f';

    public static $member_fields = array('id' => 'Id',
					 'tipus_quotes_fk' => 'Tipus',
					 'activa' => 'Activa',
					 'import' => 'Import',
					 'id_responsables_fk' => 'Responsable',
					 'input_id_responsables_fk' => 'Triar responsable',
					 'id_beneficiaris_list' => 'Beneficiaris',
					 'input_id_beneficiaris_list' => 'Triar beneficiaris',
					 'iban' => 'IBAN',
					 'bic' => 'BIC'
					 );

    public static $default_values = array(
					  'activa' => '1',
					  'tipus_quotes_fk' => '1'
					  );

    public static $validation_rules = array(
					    'import' => 'required|numeric'
					    );

    public static $display_size_of_field = array('id' => 4,
						 'import' => 8,
						 'iban' => 34,
						 'bic' => 12,
						 'comentari' => '60x3'
						 );

    // this controls the appearance of the create/edit/inspect page
    public static $panels = array('Quota' => array(
						   'activa' => 'Activa',
						   'tipus_quotes_fk' => 'Tipus',
						   'import' => 'Import'
						   ),
				  'Responsable' => array(
							 'id_responsables_fk' => 'Responsable',
							 'iban' => 'IBAN',
							 'bic' => 'BIC'
							 ),
				  'Beneficiaris' => array(
							  'id_beneficiaris_list' => 'Beneficiaris',
							  'input_id_beneficiaris_list' => 'Triar beneficiaris'
							  ),
				  'Comentaris' => array(
						       'comentari' => 'Comentari'
							)
				  );
	  
						   
    // this is for dropboxes containing foreign keys
    protected $resolving_class = array(
				       'tipus_quotes_fk' => 'TipusQuote',
				       'id_responsables_fk' => 'Persone'
				       );

    // this is for searchboxes containing foreign keys
    public static $foreign_class = array(
					 'id_beneficiaris_list' => 'Persone',
					 'input_id_beneficiaris_list' => 'Persone',
					 'id_responsables_fk' => 'Persone',
					 'input_id_responsables_fk' => 'Persone'
					 );

    public static $pivot_class = array(
				       'id_beneficiaris_list' => 'Beneficiari'
				       );

    public static $search_message = array(
					  'input_id_responsables_fk' => 'Busca responsable: nom/cognom/mot',
					  'input_id_beneficiaris_list' =>  'Busca beneficiari: nom/cognom/mot'
					  );

    // what will be displayed in the index listing
    public static $fields_in_index = array(
					   'id' => 'Id',
					   'id_responsables_fk' => 'Responsable',
					   'tipus_quotes_fk' => 'Tipus',
					   'import' => 'Import',
					   'import_anual' => 'Total anual',
					   'beneficiaris_list' => 'Beneficiaris'
					   );
    						 
    // beneficiaris_list is actually a fake field, in that it doesn't correspond to
    // a field in the database, but rather to all the matching entries in the pivot table.
    // It works because of the function getBeneficiarisListAttribute() below.
    // Similarly for import_anual.

    // fields that store an index to (an array of) foreign key values
    public static function is_foreign_selection($field)
    {
	return 
	    $field == 'id_responsables_fk' ||
	    $field == 'id_beneficiaris_list' // this is also a fake field
	    ;
    }

    public static function is_foreign_chooser($field)
    {
	return 
	    $field == 'input_id_responsables_fk' ||
	    $field == 'input_id_beneficiaris_list' 
	    ;
    }

    // The fields that may be edited in the create/edit/inspect view
    public static function is_editable_foreign_field($field)
    {
	return 
	    $field == 'id_beneficiaris_list'
	    ;
    }

    // some foreign key entries are only allowed to have one value
    public static function is_single_entry_list($field)
    {
	return 
	    $field == 'id_responsables_fk';
	    ;
    }

    // sometimes several fields belonging to a foreign key record are displayed as well.
    // when that happens and the foreign key is edited, the display has to update accordingly
    public static $update_display_after_edit = array(
						     'id_responsables_fk' => 'bic,iban'
						     );

    public static function is_checkbox($field)
    {
	return 
	    $field == 'activa'
	    ;
    }

    public static function is_textarea($field)
    {
	return 
	    $field == 'comentari'
	    ;
    }

    // fields belonging to the foreign key record are not editable 
    public static function is_editable($field)
    {
	return 
	    $field != 'iban' &&
	    $field != 'bic'
	    ;
    }

    // Show specialized code in inspect/ views. This @includes specialized/quote.blade.php
    public static $specialized_inspect = 'quote';

    public static $identifying_fields = array(
					      'id_responsables_fk',
					      'tipus_quotes_fk',
					      'import'
					      );

    public static $identifying_short_fields = array(
						    'tipus_quotes_fk',
						    'import',
						    'beneficiaris_list'
						    );

    public function beneficiari()
    {
    	return $this->belongsToMany('Persone', 'beneficiaris');
    }
    
    public function getIdBeneficiarisListAttribute($value)
    {    
        $id_beneficiaris = array();
        foreach($this->beneficiari()->get() as $p)
        {
	    $id_beneficiaris[] = $p->id;
        }
        return join(',', $id_beneficiaris);
    }

    public function getBeneficiarisListAttribute($value)
    {    
        $beneficiaris = array();
        foreach($this->beneficiari()->get() as $b)
        {
	    $beneficiaris[] = assemble_identifying_short_fields('Persone', $b);
        }
        return join(', ', $beneficiaris);
    }

    public function responsable()
    {
	return $this->belongsTo('Persone', 'id_responsables_fk', 'id');
    }

    public function responsible()
    {
	return $this->responsable();
    }

    public function rebuts()
    {
	return $this->hasMany('Rebut');
    }

    public function getImportAttribute($value) 
    {
    	return number_format($value, 2); //, ',', '.');
    }

    public function getImportAnualAttribute($value) 
    {
        $tipus = TipusQuote::findOrFail($this->tipus_quotes_fk);
    	return number_format($tipus->periodicitat_mesos * $this->import, 2); //, ',', '.');
    }

    public function getIbanAttribute($value)
    {
	return $this->responsible()->pluck('iban');
    }

    public function getBicAttribute($value)
    {
	return $this->responsible()->pluck('bic');
    }
    
    public static function is_right_aligned($field)
    {
	return 
	    $field == 'import' ||
	    $field == 'import_anual';
    }
}

?>