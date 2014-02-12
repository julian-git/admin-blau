@extends('layout')

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
