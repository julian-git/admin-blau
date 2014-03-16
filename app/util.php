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

function assemble_fields_impl($class_name, $instance, $field_list)
{
    $str = '';
    foreach ($class_name::$$field_list as $f)
    {
	if (!strcmp($f, 'mot'))
	{
	    $str .= '(';
	}
	$str .= $instance->$f;
	if (!strcmp($f, 'mot'))
	{
	    $str .= ')';
	}
	$str .= ' ';
    }
    return $str;
}

function assemble_identifying_fields($class_name, $instance)
{
    return assemble_fields_impl($class_name, $instance, 'identifying_fields');
}

function assemble_identifying_short_fields($class_name, $instance)
{
    return assemble_fields_impl($class_name, $instance, 'identifying_short_fields');
}

?>