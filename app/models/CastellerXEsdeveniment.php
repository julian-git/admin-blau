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

class CastellerXEsdeveniment extends Eloquent
{
    public static $singular_class_name = 'Participació a esdeveniment';
    public static $plural_class_name = 'Participació a esdeveniments';
    public static $class_name_gender = 'f';

    public static $member_fields = array('castellers_fk' => 'Casteller',
					 'esdeveniments_fk' => 'Esdeveniment'
					 );

    public static $validation_rules = array();

    public static $default_values = array();

    public static $identifying_fields = array('castellers_fk',
					      'esdeveniments_fk'
					      );

    public function getCastellersFkAttribute($value) 
    {
	return resolve_foreign_key('Casteller', $value);
    }

    public function getEsdevenimentsFkAttribute($value) 
    {
	return resolve_foreign_key('Esdeveniment', $value);
    }
}

?>