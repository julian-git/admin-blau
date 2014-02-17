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

function toCamelCase($field) 
{
    $CamelCase = str_replace(' ', '', ucwords(str_replace('_', ' ', $field)));
    return $CamelCase;
}

function foreign_table_of($field)
{
    return toCamelCase(substr($field, 0, -4)); // remove also plural 's'
}

function dropbox_from_foreign_key($field)
{
    $str = '<select>';
    $class_name = foreign_table_of($field);
    foreach ($class_name::all() as $instance) 
    {
	$str .= '<option value=' . $instance->id . '>';
	foreach ($class_name::$identifying_fields as $f)
	{
	    $str .= $instance->$f . ' ';
	}
	$str .= '</option>';
    }
    return $str . '</select>';
}

?>