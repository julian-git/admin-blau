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

  <div class="input-group custom-search-form">
    @if (isset($button_action_text) && strlen($button_action_text) > 0)
    <span class="input-group-btn">
      <button id="{{ $dependent_button }}" searchField="{{ $DF }}-search" class="btn btn-default afegir-button disabled" type="button">
        {{ $button_action_text }}
      </button>
    </span>
  @endif
  <input id="{{ $DF }}-search" type="text" class="form-control dependent-search" dependentClass="{{ $search_class }}" dependentButton="{{ $dependent_button }}" placeholder="{{ $search_message }}">
  <span class="input-group-btn">
    <button class="btn btn-default disabled" type="button">
      <i class="fa fa-search"></i>
    </button>
  </span>
</div> <!-- input group -->
