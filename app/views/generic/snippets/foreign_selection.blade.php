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
?>

<div class="form-group">
        <?php 
           $the_df_input = ($action == 'Editar' ||
			     $action == 'Mostrar' ||
			     $action == 'Enviar correu' ||
			     ( $action == 'Crear' && $field == 'id_responsables_fk' )
			    )
			    ? $$csn->$field
			    : Input::old($field);
           $extra_data = array();
           if ($CSN::is_single_entry_list($field)) 
	   {
	       $extra_data['class'] = 'cvg-single-entry';
	   }
           if (isset($CSN::$update_display_after_edit[$field]))
	   {
	       $extra_data['update-display-after-edit'] 
		   = $CSN::$update_display_after_edit[$field];
	       $extra_data['master-class']
		   = strtolower($CSN::$foreign_class[$field]);
	   }
        ?>
        {{ Form::hidden($field, $the_df_input, $extra_data) }}
<div id="{{ $field }}-field-list" {{ isset($CSN::$has_slave_lists) && isset($CSN::$slave_list_of[$field]) ? 'slaveList="' . $CSN::$slave_list_of[$field] . '"' : '' }}>
	    <?php $DCL = $CSN::$foreign_class[$field] ?>
           @foreach(explode(',', $the_df_input) as $dependent_id)
	       @include('generic/snippets/assemble_dependent_input')
           @endforeach  
           @if ($action == 'Mostrar' && $CSN == 'Persone')
	    <a class="btn btn-success btn-xs" href="/{{ strtolower($DCL) }}/create/{{ $DCL == 'Quote' ? $$csn->id : '' }}">{{ $DCL::$class_name_gender == 'm' ? 'Nou' : 'Nova' }} {{ strtolower($DCL::$singular_class_name) }}</a>
    @endif      </div>
        {{ $errors->first($field, '<span class="cvg-error">:message</span>') }}
</div> <!-- form-group -->

