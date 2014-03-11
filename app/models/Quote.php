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
    public function __construct() 
    {
	DB::connection()->enableQueryLog();
    }

    public static $singular_class_name = 'Quota';
    public static $plural_class_name = 'Quotes';
    public static $class_name_gender = 'f';

    public static $member_fields = array('id' => 'Id',
					 'tipus_quotes_fk' => 'Tipus',
					 'activa' => 'Activa',
					 'import' => 'Import',
					 'id_responsables_fk' => 'Responsable',
					 'beneficiari' => 'Beneficiaris',
					 'iban' => 'IBAN',
					 'bic' => 'BIC'
					 );

    public $display_size_of_field = array('id' => 4,
					  'import' => 8,
					  'iban' => 34,
					  'bic' => 12,
					  'comentari' => '60x3'
					  );

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
							  'beneficiari' => 'Beneficiaris'
							  ),
				  'Comentaris' => array(
						       'comentari' => 'Comentari'
							)
				  );
	  
						   

    protected $resolving_class = array(
				       'tipus_quotes_fk' => 'TipusQuote',
				       'id_responsables_fk' => 'Persone'
				       );

    public static $foreign_class = array(
					 'beneficiari' => 'Persone'
					 );

    public static $responsible_class = 'Persone';
    public static $responsible_field = 'id_responsables_fk';
    public static $responsible_field_search_message = 'Busca responsable per nom, cognom o mot...';

    public static $dependent_class = 'Persone';
    public static $dependent_pivot_class = 'Beneficiari';
    public static $dependent_field = 'beneficiari';
    public static $dependent_field_search_message = 'Busca beneficiari per nom, cognom o mot...';
    public static $dependent_field_pivot_table = 'beneficiaris';

    public static $validation_rules = array(
					    'import' => 'required|numeric'
					    );

    public static $fields_in_index = array(
                         'id' => 'Id',
                         'id_responsables_fk' => 'Responsable',
                         'tipus_quotes_fk' => 'Tipus',
                         'import' => 'Import',
                         'import_anual' => 'Total anual',
                         'beneficiaris_list' => 'Beneficiaris'
                         );
    						 
    public static $default_values = array();

    public static function is_foreign_choices($field)
    {
	return $field == 'beneficiari'
	    ;
    }

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

    public static $extra_inspect = 'quote';

    public static $identifying_fields = array(
					      'id_responsables_fk',
					      'tipus_quotes_fk',
					      'import'
					      );

    public static $identifying_short_fields = array(
						    'tipus_quotes_fk',
						    'import'
						    );

    public function beneficiaris()
    {
    	return $this->belongsToMany('Persone', 'beneficiaris');
    }
    
    public function getBeneficiarisListAttribute($value)
    {    
        $beneficiaris = array();
        foreach($this->beneficiaris as $p)
        {
	    $person = array();
            foreach(Persone::$identifying_short_fields as $f)
                $person[] = $p->$f;
	    $beneficiaris[] = join(' ', $person);
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

    public function dependents()
    {
	return $this->beneficiaris();
    }

    public function rebuts()
    {
	return $this->hasMany('Rebut');
    }

    public function getImportAttribute($value) 
    {
    	return number_format($value, 2, ',', '.');
    }

    public function getImportAnualAttribute($value) 
    {
        $tipus = TipusQuote::findOrFail($this->tipus_quotes_fk);
    	return number_format($tipus->periodicitat_mesos * $this->import, 2, ',', '.');
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