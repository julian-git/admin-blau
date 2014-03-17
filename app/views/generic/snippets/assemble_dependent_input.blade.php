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

@if(strlen($dependent_id) > 0)
{{-- this test is to catch empty dependent field list upon validation of input --}}
<div id="{{ $field }}-id-{{ $dependent_id }}" {{ $field }}-id="{{ $dependent_id }}" class="{{ $field }}_item">
    <span>
   {{ assemble_identifying_short_fields($DCL, $DCL::find($dependent_id)) }}
    </span>
    @if ($action == 'Editar')
      <button dependentField="{{ $field }}" {{ $field }}-id="{{ $dependent_id }}" class="btn btn-danger btn-xs cvg-remove-button">
        <span class="glyphicon glyphicon-remove"></span>
      </button>
    @endif
  </div>
@endif
