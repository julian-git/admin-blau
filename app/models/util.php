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
    $foreign_object = $class::findOrFail($value);
    $res = '';
    foreach($class::$identifying_fields as $f)
    {
	$res .= $foreign_object->$f . ' ';
    }
    return $res;
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
	return (isset($this->resolving_class[$field])
		? resolve_foreign_key($this->resolving_class[$field], $this->$field)
		: $this->$field);
    }
    
    public static function is_right_aligned($field)
    {
	return false;
    }

    public static function is_checkbox($field)
    {
	return false;
    }

    public static function is_textarea($field)
    {
	return false;
    }

    public static $dropbox_options_of = array();

    public $display_size_of_field = array('default' => 15);

    public function display_size_of($field)
    {
	return (isset($this->display_size_of_field[$field])
		? $this->display_size_of_field[$field]
		: 15);
    }
}
?>