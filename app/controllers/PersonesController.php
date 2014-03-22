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

require_once(dirname(__FILE__) . '/../models/Persone.php');
require_once('CVGController.php');

class PersonesController extends CVGController
{
    public function __construct() {
	CVGController::__construct('Persone');
    }

    public static function actives($unused)
    {
	return Esdeveniment::persones_actives();
    }

    protected function fetch_numero_soci()
    {
	$max_value = DB::table('persones')
	    ->select(DB::raw('max(numero_soci) as max'))
	    ->pluck('max');
	return $max_value + 1;
    }
    
    protected function before_save_hook($input, &$class_instance)
    {
	$class_instance->numero_soci = 
	    (! isset($class_instance->numero_soci) &&
	     in_array($class_instance->categories_fk, array(1,2))) 
	    ? $this->fetch_numero_soci()
	    : null;
    }


    public static function search($search_string)
    {
	return Persone::where('search', 'like', '%' . $search_string . '%')
	    ->select('id', 'search')
	    ->get();
    }

    public static function search_id($search_string)
    {
	return Persone::where('id', '=', $search_string)->get();
    }
}
 ?>