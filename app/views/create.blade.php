@extends('layout')

@section('content')
    <div class="page-header">
        <h1>Crear nou soci</h1>
    </div>

    <form action="{{ action('SocisController@handleCreate') }}" method="post" role="form">

   <div class="form-group">
            <label for="cognom1">Cognom 1</label>
            <input type="text" class="form-control" name="cognom1" />
        </div>
     
        <div class="form-group">
            <label for="cognom2">Cognom 2</label>
            <input type="text" class="form-control" name="cognom2" />
        </div>
     
        <div class="form-group">
            <label for="nom">Nom</label>
            <input type="text" class="form-control" name="nom" />
        </div>
     
        <div class="form-group">
            <label for="mot">Mot</label>
            <input type="text" class="form-control" name="mot" />
        </div>
     
        <div class="form-group">
            <label for="naixement">Data de naixement</label>
            <input type="text" class="form-control" name="naixement" />
        </div>
     
        <div class="form-group">
            <label for="dni">DNI</label>
            <input type="text" class="form-control" name="dni" />
        </div>
     
        <div class="form-group">
            <label for="email">email</label>
            <input type="text" class="form-control" name="email" />
        </div>
     
        <div class="form-group">
            <label for="direccio">Direcció</label>
            <input type="text" class="form-control" name="direccio" />
        </div>
     
        <div class="form-group">
            <label for="cp">CP</label>
            <input type="text" class="form-control" name="cp" />
        </div>
     
        <div class="form-group">
            <label for="poblacio">Població</label>
            <input type="text" class="form-control" name="poblacio" />
        </div>
     
        <div class="form-group">
            <label for="provincia">Provincia</label>
            <input type="text" class="form-control" name="provincia" />
        </div>
     
        <div class="form-group">
            <label for="telefon1">Telèfon 1</label>
            <input type="text" class="form-control" name="telefon1" />
        </div>
     
        <div class="form-group">
            <label for="telefon2">Telèfon 2</label>
            <input type="text" class="form-control" name="telefon2" />
        </div>
     
        <div class="form-group">
            <label for="mobil1">Mòvil 1</label>
            <input type="text" class="form-control" name="mobil1" />
        </div>
     
        <div class="form-group">
            <label for="mobil2">Mòvil 2</label>
            <input type="text" class="form-control" name="mobil2" />
        </div>
     
        <div class="form-group">
            <label for="twitter">Twitter</label>
            <input type="text" class="form-control" name="twitter" />
        </div>
     
        <div class="form-group">
            <label for="whatsapp">Whatsapp</label>
            <input type="text" class="form-control" name="whatsapp" />
        </div>
     
        <div class="form-group">
            <label for="sexe">Sexe</label>
            <input type="text" class="form-control" name="sexe" />
        </div>

        <input type="submit" value="Crear" class="btn btn-primary" />
        <a href="{{ action('SocisController@index') }}" class="btn btn-link">Cancel.lar</a>
    </form>
@stop
