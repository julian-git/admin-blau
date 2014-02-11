@extends('layout')

@section('content')
    <div class="page-header">
        <h1>Crear nou soci</h1>
    </div>

    <form action="{{ action('SocisController@handleCreate') }}" method="post" role="form">
    @foreach(array('cognom1' => 'Cognom 1',
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
		   'sexe' => 'Sexe') as $key => $value) 
        <div class="form-group">
            <label for="{{$key}}">{{$value}}</label>
            <input type="text" class="form-control" name="{{$key}}" />
        </div>
    @endforeach
        <input type="submit" value="Crear" class="btn btn-primary" />
        <a href="{{ action('SocisController@index') }}" class="btn btn-link">Cancelar</a>
    </form>
@stop
