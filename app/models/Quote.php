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
					    'codi_banc' => 'integer|size:4',
					    'oficina' => 'integer|size:4',
					    'digit_control' => 'integer|size:2',
					    'compte' => 'alpha_num|size:10',
					    'BIC' => 'alpha_num', // FIXME: correct size?
					    'IBAN' => 'alpha_num', // FIXME: correct size?
					    'import' => 'required|numeric',
					    'tipus_fk' => 'required|integer');

    public static $default_values = array('tipus_fk' => 1);

    public static $identifying_fields = array('banc',
					      'compte',
					      'import');

}

?>