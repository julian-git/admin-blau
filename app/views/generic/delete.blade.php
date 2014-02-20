@extends('generic/layout')
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

@section('content')

    <div class="page-header">

    <?php $idf = $CSN::$identifying_fields; ?>

    <h1> Esborrar
        {{ $$csn->$idf[0] }} 
    (
        @for ($i=1; $i < sizeof($idf); $i++)
	  {{ $$csn->$idf[$i] }}
	@endfor
     )
 <small>Estas segur/a?</small></h1>
    </div>
    <form action="{{ action($CSN . 'sController@handleDelete') }}" method="post" role="form">
        <input type="hidden" name="{{ $csn }}" value="{{ $$csn->id }}" />
        <input type="submit" class="btn btn-danger" value="D&rsquo;acord" />
        <a href="{{ action($CSN . 'sController@edit', $$csn->id) }}" class="btn btn-default">No, de cap de les maneres!</a>
    </form>
@stop