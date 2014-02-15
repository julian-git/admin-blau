@extends('layout')
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
    <h1>Esborrar {{ $casteller->nom }} {{ $casteller->cognom1 }} {{ $casteller->cognom2 }} ({{ $casteller->mot }}) <small>Estas segur?</small></h1>
    </div>
    <form action="{{ action('CastellersController@handleDelete') }}" method="post" role="form">
        <input type="hidden" name="casteller" value="{{ $casteller->id }}" />
        <input type="submit" class="btn btn-danger" value="Yes" />
        <a href="{{ action('CastellersController@index') }}" class="btn btn-default">No, de cap de les maneres!</a>
    </form>
@stop