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
  <div id="{{ $DF }}-id-{{ $dependent_id }}" dependent-id="{{ $dependent_id }}" class="dependent_list_item">
    <span>
   {{ assemble_identifying_fields($DCL, $DCL::find($dependent_id)) }}
    </span>
    <button df="{{ $DF }}" dependent-id="{{ $dependent_id }}" class="btn btn-default btn-xs cvg-remove-button">
      <span class="glyphicon glyphicon-remove"></span>
    </button>
  </div>
@endif
