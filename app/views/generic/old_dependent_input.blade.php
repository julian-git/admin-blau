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
