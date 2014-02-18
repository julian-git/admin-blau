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

function assemble_identifying_fields($class_name, $instance)
{
    $str = '';
    foreach ($class_name::$identifying_fields as $f)
    {
	$str .= $instance->$f . ' ';
    }
    return $str;
}

function dropbox_options_from_foreign_key($field, $value)
{
    $options = array();
    $class_name = foreign_table_of($field);
    foreach ($class_name::all() as $instance) 
    {
	$options[$instance->id] = assemble_identifying_fields($class_name, $instance);
    }
    return $options;
}

function dropbox_options_of($CSN, $class_instance)
{
    $dropbox_options = array();
    foreach (array_keys($CSN::$member_fields) as $field) 
    {
	if (!strcmp(substr($field, -3), '_fk'))
	{
	    $dropbox_options[$field] = dropbox_options_from_foreign_key($field, $class_instance->$field);
	}
    }
    return $dropbox_options;
}


function dropbox_default_from_foreign_key($field, $value)
{
    $class_name = foreign_table_of($field);
    $i = 1;
    foreach ($class_name::all() as $instance) 
    {
	if (!strcmp(assemble_identifying_fields($class_name, $instance), $value)) 
	{
	    return $i;
	}
	$i++;
    }
    return 0;
}

function dropbox_default_of($CSN, $class_instance)
{
    $dropbox_default = array();
    foreach (array_keys($CSN::$member_fields) as $field) 
    {
	if (!strcmp(substr($field, -3), '_fk'))
	{
	    $dropbox_default[$field] = dropbox_default_from_foreign_key($field, $class_instance->$field);
	}
    }
    return $dropbox_default;
}

function foreign_tables_of($CSN)
{
    $foreign_table = array();
    foreach (array_keys($CSN::$member_fields) as $field) 
    {
	if (!strcmp(substr($field, -3), '_fk'))
	{
	    $foreign_table[$field] = foreign_table_of($field);
	}
    }
    return $foreign_table;
}

?>