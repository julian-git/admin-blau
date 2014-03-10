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

require_once(dirname(__FILE__) . '/../util.php');

function foreign_table_of($field)
{
    if (!strcmp($field, 'id_responsables_fk'))
    {
	return 'Persone';
    } 
    else 
    {
	return toCamelCase(substr($field, 0, -4)); // remove also plural 's'
    }
}

function dropbox_options_from_foreign_key($field)
{
    $options = array();
    $class_name = foreign_table_of($field);
    foreach ($class_name::all() as $instance) 
    {
	$options[$instance->id] = assemble_identifying_fields($class_name, $instance);
    }
    return $options;
}

function dropbox_options_of($CSN)
{
    $dropbox_options = array();
    foreach (array_keys($CSN::$member_fields) as $field) 
    {
	if (!strcmp(substr($field, -3), '_fk') && 
 	    ( !isset($CSN::$responsible_field) ||
	      strcmp($CSN::$responsible_field, $field) ) &&
 	    ( !isset($CSN::$dependent_field) ||
	      strcmp($CSN::$dependent_field, $field) )
	   )
	{
	    $dropbox_options[$field] = dropbox_options_from_foreign_key($field);
	} 
	elseif (isset($CSN::$dropbox_options_of[$field]))
	{
	    $dropbox_options[$field] = $CSN::$dropbox_options_of[$field];
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
	if (!strcmp(substr($field, -3), '_fk') ||
	    isset($CSN::$dropbox_options_of[$field]))
	{
	    $dropbox_default[$field] = $class_instance->$field;
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

function list_all_by_identifying_fields($CSN)
{
    $list = array();
    foreach($CSN::all() as $instance) 
    {
	$list[$instance->id] = assemble_identifying_fields($CSN, $instance);
    }
    return $list;
}

?>