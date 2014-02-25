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

class Familie extends Eloquent
{
    public static $singular_class_name = 'Família';
    public static $plural_class_name = 'Famílies';
    public static $class_name_gender = 'f';

    public static $member_fields = array('id' => 'Id',
					 'nom' => 'Nom',
					 'activa' => 'Activa',
					 'persona_membre_fk' => 'Membre',
					 'persona_responsable_fk' => 'Responsable'
					 );

    public static $validation_rules = array('id' => 'required|integer',
					    'nom' => 'required|alpha'
					    );

    public static $default_values = array('activa' => 1);

    public static $identifying_fields = array('nom'
					      );

    public function getPersonaMembreFkAttribute($value)
    {
	return resolve_foreign_key('Persone', $value);
    }

    public function getPersonaResponsableFkAttribute($value)
    {
	return resolve_foreign_key('Persone', $value);
    }
}

?>