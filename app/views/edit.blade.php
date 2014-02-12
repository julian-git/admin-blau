@extends('layout')

@section('content')
    <div class="page-header">
        <h1>Editar Soci</h1>
    </div>

    <form action="{{ action('SocisController@handleEdit') }}" method="post" role="form">
        <input type="hidden" name="id" value="{{ $soci->id }}">

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
            <input type="text" class="form-control" name="{{$key}}" value="{{ $soci->$key }}" />
        </div>
    @endforeach
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" name="title" value="{{ $soci->title }}" />
        </div>
        <input type="submit" value="Guardar" class="btn btn-primary" />
        <a href="{{ action('GamesController@index') }}" class="btn btn-link">Cancel.lar</a>
    </form>
@stop
