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
        <h1>Castellers</h1>
    </div>

    <div class="panel panel-default">
        <div class="panel-body">
            <a href="{{ action('CastellersController@create') }}" class="btn btn-primary">Nou casteller</a>
        </div>
    </div>

    @if ($castellers->isEmpty())
        <p>No hi ha cap casteller de moment.</p>
    @else
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Número de casteller</th>
                    <th>Cognom 1</th>
                    <th>Cognom 2</th>
                    <th>Nom</th>
                    <th>Mot</th>
                    <th>Data de naixement</th>
                    <th>DNI</th>
                    <th>email</th>
                    <th>Direcció</th>
                    <th>CP</th>
                    <th>Població</th>
                    <th>Provincia</th>
                    <th>Telèfon 1</th>
                    <th>Telèfon 2</th>
                    <th>Mòvil 1</th>
                    <th>Mòvil 2</th>
                    <th>twitter</th>
                    <th>Whatsapp</th>
                    <th>Data alta</th>
                    <th>Sexe</th>
                </tr>
            </thead>
            <tbody>
                @foreach($castellers as $casteller)
                <tr>
                    <td>{{ $casteller->id }}</td>
                    <td>{{ $casteller->cognom1 }}</td>
                    <td>{{ $casteller->cognom2 }}</td>
                    <td>{{ $casteller->nom }}</td>
                    <td>{{ $casteller->mot }}</td>
                    <td>{{ $casteller->naixement }}</td>
                    <td>{{ $casteller->dni }}</td>
                    <td>{{ $casteller->email }}</td>
                    <td>{{ $casteller->direccio }}</td>
                    <td>{{ $casteller->cp }}</td>
                    <td>{{ $casteller->poblacio }}</td>
                    <td>{{ $casteller->provincia }}</td>
                    <td>{{ $casteller->telefon1 }}</td>
                    <td>{{ $casteller->telefon2 }}</td>
                    <td>{{ $casteller->mobil1 }}</td>
                    <td>{{ $casteller->mobil2 }}</td>
                    <td>{{ $casteller->twitter }}</td>
                    <td>{{ $casteller->whatsapp }}</td>
                    <td>{{ $casteller->alta }}</td>
                    <td>{{ $casteller->sexe }}</td>
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
