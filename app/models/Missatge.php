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

class Missatge extends Eloquent
{
    public static $singular_class_name = 'Missatge';
    public static $plural_class_name = 'Missatges';
    public static $class_name_gender = 'm';

    public static $member_fields = array('titol' => 'Assumpte del missatge',
					 'contingut' => 'Text del missatge',
					 'data_caducitat' => 'Data de caducitat'
					 );

    public static $validation_rules = array('titol' => 'required',
					    'contingut' => 'required',
					    'data_caducitat' => 'date'
					    );

    public static $default_values = array();

    public static $identifying_fields = array('titol',
					      'data_caducitat'
					      );

}

?>