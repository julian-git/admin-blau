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


class FamilieResponsable extends Eloquent
{
    public static $singular_class_name = 'Responsable';
    public static $plural_class_name = 'Responsables';
    public static $class_name_gender = 'm';

    public static $member_fields = array('persone_id' => 'Id de persona',
					 'familie_id' => 'Id de familia');

    public static $validation_rules = array();

    public static $default_values = array();

    public static $identifying_fields = array();
}

?>