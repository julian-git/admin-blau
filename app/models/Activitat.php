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


class Activitat extends Eloquent
{
    public static $singular_class_name = 'Activitat';
    public static $plural_class_name = 'Activitats';
    public static $class_name_gender = 'f';

    public static $member_fields = array('titol' => 'Titol',
					 'tipus_activitats_fk' => "Tipus d'Activitat",
					 'data' => 'Data (inici)',
					 'fi' => 'Data fi',
					 'descripcio' => 'Descripci&oacute;',
					 'contacte' => 'contacte',
					 'cost_estimat' => 'Cost Estimat',
					 'cost_real' => 'Cost Real'
					 );

    public static $validation_rules = array('titol' => 'required',
					    'data' => 'required|date',
					    'cost_estimat' => 'decimal',
					    'cost_real' => 'decimal'
					    );
    public static $default_values = array('tipus_activitats_fk' => 1);

    public static $identifying_fields = array('titol',
					      'data',
					      'fi');

}

?>