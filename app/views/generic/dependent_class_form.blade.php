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
          <input id="dependent-field-input" name="dependent-field-input" type="hidden" value="{{ Input::old('dependent-field-input') }}" />
          @if (sizeof(Input::old('dependent-field-input')))
          @foreach(explode(',', Input::old('dependent-field-input')) as $dependent_id)
            <div id="dependent-id-{{ $dependent_id }}" dependent-id="{{ $dependent_id }}" class="dependent_list_item">
              <span>
                {{ assemble_identifying_fields($DCL, $DCL::findOrFail($dependent_id)) }}
              </span>
              <button id="dependent-delete-{{ $dependent_id }}" class="btn btn-default btn-xs">
                <span class="glyphicon glyphicon-remove"></span>
              </button>
            </div>
          @endforeach
          @endif
        </div>
      </div> <!-- panel -->
    </div> <!-- col-md -->
    <div class="col-md-7">
      <?php 
        $button_action_text = 'Afegir';
        $search_class = strtolower($CSN::$dependent_class);
        $search_message = $CSN::$dependent_field_search_message;
      ?>
      @include('generic/dependent_class_search')

    </div> <!-- col-md -->
  </div> <!-- row -->
</div> <!-- form-group -->

<script src="{{ asset('assets/js/dependent_fields.js') }}"></script>
