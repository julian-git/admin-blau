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
        <h1>Crear nou casteller</h1>
    </div>

    <form action="{{ action('CastellersController@handleCreate') }}" method="post" role="form">

    <?php $member_fields = array('cognom1' => 'Cognom 1',
				     'cognom2' => 'Cognom 2',
				     'nom' => 'Nom',
				     'mot' => 'Mot',
				     'naixement' => 'Data de naixement',
				     'dni' => 'DNI',
				     'email' => 'email',
				     'direccio' => 'Direcció',
				     'cp' => 'CP',
				     'poblacio' => 'Població',
				     'provincia' => 'Provincia',
				     'telefon1' => 'Telèfon 1',
				     'telefon2' => 'Telèfon 2',
				     'mobil1' => 'Mòvil 1',
				     'mobil2' => 'Mòvil 2',
				     'twitter' => 'Twitter',
				     'whatsapp' => 'Whatsapp',
				     'sexe' => 'Sexe');
?>
@foreach ($member_fields as $field => $prompt)
<div class="form-group">
{{ Form::label($field, $prompt) }} {{ Form::text($field, Input::old($field)) }}
{{ $errors->first($field, '<span class="error">:message</span>') }}
    </div>
@endforeach
        <input type="submit" value="Crear" class="btn btn-primary" />
        <a href="{{ action('CastellersController@index') }}" class="btn btn-link">Cancel.lar</a>
    </form>
@stop
