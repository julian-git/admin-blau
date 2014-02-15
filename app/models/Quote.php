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


class Quote extends Eloquent
{
    public static $member_fields = array('banc' => 'Banc',
					 'codi_banc' => 'Codi Banc',
					 'oficina' => 'Oficina',
					 'digit_control' => 'Digit Control',
					 'compte' => 'N&uacute;mero de Compte',
					 'import' => 'Import',
					 'tipus_fk' => 'Tipus de Quota');

    public static $validation_rules = array('banc' => 'required|alpha',
					    'codi_banc' => 'required|integer',
					    'oficina' => 'required|alpha',
					    'digit_control' => 'required|integer',
					    'compte' => 'required|alpha_num',
					    'import' => 'required|numeric',
					    'tipus_fk' => 'required|integer');

    public static $default_values = array('tipus_fk' => 1);

}

?>