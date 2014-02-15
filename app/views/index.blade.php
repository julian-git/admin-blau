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

<br/>
<?php include_once(dirname(dirname(dirname(__FILE__))) . "/models/$CSN.php"); ?>

@section('content')
    <div class="page-header">
    <h1>{{ $CSN . 's' }}</h1>
    </div>

    <div class="panel panel-default">
        <div class="panel-body">
    <a href="{{ action($CSN . 'sController@create') }}" class="btn btn-primary">Nou {{ $CSN }}</a>
        </div>
    </div>

    @if ($$class_instance->isEmpty())
        <p>De moment no hi ha cap entrada.</p>
    @else
        <table class="table table-striped">
            <thead>
                <tr>
        @foreach ($CSN::$member_fields as $field => $prompt)
                   <th>{{ $prompt }}</th>
	@endforeach
                </tr>
            </thead>
            <tbody>
                @foreach($$class_instance as $casteller)
                <tr>
                   @foreach(array_keys($CSN::$member_fields) as $field)
                      <td>{{ $casteller->$field }}</td>
		   @endforeach
                    <td>
                        <a href="{{ action('CastellersController@edit', $casteller->id) }}" class="btn btn-default">Editar</a>
                        <a href="{{ action('CastellersController@delete', $casteller->id) }}" class="btn btn-danger">Esborrar</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@stop
