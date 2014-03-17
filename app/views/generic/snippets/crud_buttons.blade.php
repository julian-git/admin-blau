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

<div class="panel-body">

@if ($action=='Mostrar')

     <a class="btn btn-warning pull-right" href="/{{ strtolower($CSN) }}/edit/{{ $$csn->id }}">Editar</a>
     &nbsp;
     <a class="btn btn-primary pull-right" href="/{{ strtolower($CSN) }}/">Tornar a l&lsquo;índex</a>

@else

     <input type="submit" value="{{ ($action == 'Crear') ? 'Crear' : 'Desar' }}" class="btn btn-success pull-right" />

@if($action == 'Editar')

       <a href="/{{ strtolower($CSN) }}/inspect/{{ $$csn->id }}" class="btn btn-primary pull-right">Cancel&middot;lar</a>
        <a href="{{ action($CSN . 'sController@delete', $$csn->id) }}" class="btn btn-danger pull-right">Esborrar</a>

@else
       <a href="/{{ strtolower($CSN) }}" class="btn btn-primary pull-right">Cancel&middot;lar</a>

@endif

@endif
</div>