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

class Quote extends Eloquent
{
    public static $singular_class_name = 'Quota';
    public static $plural_class_name = 'Quotes';
    public static $class_name_gender = 'f';

    public static $member_fields = array('id' => 'Id de Quota',
					 'banc' => 'Banc',
					 'codi_banc' => 'Codi Banc',
					 'oficina' => 'Oficina',
					 'digit_control' => 'Digit Control',
					 'compte' => 'N&uacute;mero de Compte',
					 'import' => 'Import',
					 'tipus_quotes_fk' => 'Tipus de Quota');

    public static $validation_rules = array('banc' => 'required',
					    'codi_banc' => 'alpha_num|size:4',
					    'oficina' => 'alpha_num|size:4',
					    'digit_control' => 'alpha_num|size:2',
					    'compte' => 'alpha_num|size:10',
					    'BIC' => 'alpha_num', // FIXME: correct size?
					    'IBAN' => 'alpha_num', // FIXME: correct size?
					    'import' => 'required|numeric',
					    'tipus_quotes_fk' => 'required|integer');

    public static $default_values = array('tipus_quotes_fk' => 1);

    public static $identifying_fields = array('banc',
					      'compte',
					      'import');

    public function getTipusQuotesFkAttribute($value) 
    {
	return resolve_foreign_key('TipusQuote', $value);
    }
}

?>