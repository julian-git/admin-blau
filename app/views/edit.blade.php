@extends('layout')

@section('content')
    <div class="page-header">
        <h1>Editar Soci</h1>
    </div>

    <form action="{{ action('SocisController@handleEdit') }}" method="post" role="form">
        <input type="hidden" name="id" value="{{ $soci->id }}">

   <div class="form-group">
            <label for="cognom1">Cognom 1</label>
            <input type="text" class="form-control" name="cognom1" value="{{ $soci->cognom1 }}" />
        </div>
     
        <div class="form-group">
            <label for="cognom2">Cognom 2</label>
            <input type="text" class="form-control" name="cognom2" value="{{ $soci->cognom2 }}" />
        </div>
     
        <div class="form-group">
            <label for="nom">Nom</label>
            <input type="text" class="form-control" name="nom" value="{{ $soci->nom }}" />
        </div>
     
        <div class="form-group">
            <label for="mot">Mot</label>
            <input type="text" class="form-control" name="mot" value="{{ $soci->mot }}" />
        </div>
     
        <div class="form-group">
            <label for="naixement">Data de naixement</label>
            <input type="text" class="form-control" name="naixement" value="{{ $soci->naixement }}" />
        </div>
     
        <div class="form-group">
            <label for="dni">DNI</label>
            <input type="text" class="form-control" name="dni" value="{{ $soci->dni }}" />
        </div>
     
        <div class="form-group">
            <label for="email">email</label>
            <input type="text" class="form-control" name="email" value="{{ $soci->email }}" />
        </div>
     
        <div class="form-group">
            <label for="direccio">Direcció</label>
            <input type="text" class="form-control" name="direccio" value="{{ $soci->direccio }}" />
        </div>
     
        <div class="form-group">
            <label for="cp">CP</label>
            <input type="text" class="form-control" name="cp" value="{{ $soci->cp }}" />
        </div>
     
        <div class="form-group">
            <label for="poblacio">Població</label>
            <input type="text" class="form-control" name="poblacio" value="{{ $soci->poblacio }}" />
        </div>
     
        <div class="form-group">
            <label for="provincia">Provincia</label>
            <input type="text" class="form-control" name="provincia" value="{{ $soci->provincia }}" />
        </div>
     
        <div class="form-group">
            <label for="telefon1">Telèfon 1</label>
            <input type="text" class="form-control" name="telefon1" value="{{ $soci->telefon1 }}" />
        </div>
     
        <div class="form-group">
            <label for="telefon2">Telèfon 2</label>
            <input type="text" class="form-control" name="telefon2" value="{{ $soci->telefon2 }}" />
        </div>
     
        <div class="form-group">
            <label for="mobil1">Mòvil 1</label>
            <input type="text" class="form-control" name="mobil1" value="{{ $soci->mobil1 }}" />
        </div>
     
        <div class="form-group">
            <label for="mobil2">Mòvil 2</label>
            <input type="text" class="form-control" name="mobil2" value="{{ $soci->mobil2 }}" />
        </div>
     
        <div class="form-group">
            <label for="twitter">Twitter</label>
            <input type="text" class="form-control" name="twitter" value="{{ $soci->twitter }}" />
        </div>
     
        <div class="form-group">
            <label for="whatsapp">Whatsapp</label>
            <input type="text" class="form-control" name="whatsapp" value="{{ $soci->whatsapp }}" />
        </div>
     
        <div class="form-group">
            <label for="sexe">Sexe</label>
            <input type="text" class="form-control" name="sexe" value="{{ $soci->sexe }}" />
        </div>

        <input type="submit" value="Desar" class="btn btn-primary" />
        <a href="{{ action('SocisController@index') }}" class="btn btn-link">Cancel.lar</a>
    </form>
@stop
