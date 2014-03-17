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

function resolve_foreign_key($class, $value) 
{
    return assemble_identifying_fields($class, $class::findOrFail($value));
}

function local_date($date)
{
    setlocale(LC_TIME, 'ca_ES', 'ca_ES.UTF-8', 'Catalan_Spain', 'Catalan');
    return strftime("%A, %e de %B", strtotime($date));
}

class ResolvingEloquent extends Eloquent
{
    public function resolve($field) 
    {
	if (isset($this->resolving_class[$field]))
	    Log::info("resolving $field in " . $this->resolving_class[$field]);
	return (isset($this->resolving_class[$field])
		? resolve_foreign_key($this->resolving_class[$field], $this->$field)
		: $this->$field);
    }
    
    public static function is_right_aligned($field)
    {
	return false;
    }

    public static $foreign_class = array();
    
    public static function is_foreign_selection($field)
    {
	return false;
    }

    public static function is_foreign_chooser($field)
    {
	return false;
    }

    public static function is_single_entry_list($field)
    {
	return false;
    }

    public static $update_display_after_edit = array();

    public static function is_checkbox($field)
    {
	return false;
    }

    public static function is_textarea($field)
    {
	return false;
    }

    public static function is_editable($field)
    {
	return true;
    }

    public static $dropbox_options_of = array();

    public static $display_size_of_field = array('default' => 15);
}
?>