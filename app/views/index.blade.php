@extends('layout')

@section('content')
    <div class="page-header">
        <h1>Socis</h1>
    </div>

    <div class="panel panel-default">
        <div class="panel-body">
            <a href="{{ action('SocisController@create', $soci->id) }}" class="btn btn-primary">Nou soci</a>
        </div>
    </div>

    @if ($socis->isEmpty())
        <p>No hi ha cap soci de moment.</p>
    @else
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Número de soci</th>
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
                @foreach($socis as $soci)
                <tr>
                    <td>{{ $soci->id }}</td>
                    <td>{{ $soci->cognom1 }}</td>
                    <td>{{ $soci->cognom2 }}</td>
                    <td>{{ $soci->nom }}</td>
                    <td>{{ $soci->mot }}</td>
                    <td>{{ $soci->naixement }}</td>
                    <td>{{ $soci->dni }}</td>
                    <td>{{ $soci->email }}</td>
                    <td>{{ $soci->direccio }}</td>
                    <td>{{ $soci->cp }}</td>
                    <td>{{ $soci->poblacio }}</td>
                    <td>{{ $soci->provincia }}</td>
                    <td>{{ $soci->telefon1 }}</td>
                    <td>{{ $soci->telefon2 }}</td>
                    <td>{{ $soci->mobil1 }}</td>
                    <td>{{ $soci->mobil2 }}</td>
                    <td>{{ $soci->twitter }}</td>
                    <td>{{ $soci->whatsapp }}</td>
                    <td>{{ $soci->alta }}</td>
                    <td>{{ $soci->sexe }}</td>
                    <td>
                        <a href="{{ action('SocisController@edit', $soci->id) }}" class="btn btn-default">Editar</a>
                        <a href="{{ action('SocisController@delete', $soci->id) }}" class="btn btn-danger">Esborrar</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@stop
