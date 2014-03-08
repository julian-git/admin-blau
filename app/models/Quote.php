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
    public static $singular_class_name = 'Quota';
    public static $plural_class_name = 'Quotes';
    public static $class_name_gender = 'f';

    public static $member_fields = array('id' => 'Id',
					 'tipus_quotes_fk' => 'Tipus',
					 'import' => 'Import',
					 'id_responsables_fk' => 'Responsable',
					 'beneficiari' => 'Beneficiaris'
					 );

    protected $resolving_class = array(
				       'tipus_quotes_fk' => 'TipusQuote',
				       'id_responsables_fk' => 'Persone'
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

    public static $identifying_fields = array(
					      'id_responsables_fk',
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

    public function getImportAttribute($value) 
    {
    	return number_format($value, 2, ',', '.');
    }

    public function getImportAnualAttribute($value) 
    {
        $tipus = TipusQuote::findOrFail($this->tipus_quotes_fk);
    	return number_format($tipus->periodicitat_mesos * $this->import, 2, ',', '.');
    }

    public static function is_right_aligned($field)
    {
	return 
	    $field == 'import' ||
	    $field == 'import_anual';
    }
}

?>