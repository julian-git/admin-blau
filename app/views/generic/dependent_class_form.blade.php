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
  <div class="row">
    <div class="col-md-5">
      <div id="dependent-field-panel" class="panel panel-default">
        {{ $errors->first($field, '<span class="cvg-error">:message</span>') }}
        <div id="dependent-field-list">
        </div>
        <div class="form-group">
        @if ($action=='Editar')
          {{ Form::hidden('dependent_field_input', $$csn->dependent_field_input) }}
        @else
          {{ Form::hidden('dependent_field_input', Input::old('dependent_field_input')) }}
        @endif
        </div>
      </div> <!-- panel -->
    </div> <!-- col-md -->
    <div class="col-md-7">
     <?php
        $include_args = array('button_action_text' => 'Afegir', 
			      'search_class' => strtolower($CSN::$dependent_class), 
			      'search_message' => $CSN::$dependent_field_search_message,
			      'dependent_button' => 'afegir-button'
			      ); // We put it here because @include breaks with newlines
     ?>
     @include('generic/dependent_class_search', $include_args)

    </div> <!-- col-md -->
  </div> <!-- row -->
</div> <!-- form-group -->

<script src="{{ asset('assets/js/dependent_fields.js') }}"></script>
