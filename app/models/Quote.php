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

class Quote extends Eloquent
{
    public static $singular_class_name = 'Quota';
    public static $plural_class_name = 'Quotes';
    public static $class_name_gender = 'f';

    public static $member_fields = array('id' => 'Id',
                         'tipus_quotes_fk' => 'Tipus',
						 'import' => 'Import',
						 'persones_fk' => 'Responsable'
						 );

    public static $responsible_class = 'Persone';
    public static $responsible_field = 'id_responsables_fk';

    public static $dependent_class = 'Persone';
    public static $dependent_field = 'beneficiari';

    public static $validation_rules = array('periodicitat_mesos' => 'required|in:0,1,2,3,4,6,12',
					    'import' => 'required|numeric'
					    );
    public static $fields_in_index = array(
                         'id' => 'Id',
                         'tipus_quotes' => 'Tipus',
                         'import' => 'Import',
                         'import_anual' => 'Total anual',
                         'persones_fk' => 'Responsable',
                         'beneficiaris_list' => 'Beneficiaris'
                         );
    						 
    public static $default_values = array();

    public static $identifying_fields = array('tipus_quotes_fk',
										      'persones_fk',
										      'import'
										      );

    public function beneficiaris()
    {
    	return $this->belongsToMany('Persone', 'beneficiaris');
    }
    
    public function getBeneficiarisListAttribute($value)
    {    
        $res = '';
        $firstOne=true;
        $persones=$this->beneficiaris;
        foreach($persones as $p)
        {
            if (!$firstOne)
               $res .=', ';
            foreach(Persone::$identifying_short_fields as $f)
                $res .= $p->$f . ' ';
            $firstOne=false;
        }
        return $res;
    }

    public function getPersonesFkAttribute($value) 
    {
       return resolve_foreign_key('Persone', $value);
    }

    public function getTipusQuotesAttribute($value) 
    {
       return resolve_foreign_key('TipusQuote', $this->tipus_quotes_fk);
    }

    public function getImportAnualAttribute($value) 
    {
        $tipus = TipusQuote::findOrFail($this->tipus_quotes_fk);
    	return $tipus->periodicitat_mesos*$this->import;
    }
}

?>