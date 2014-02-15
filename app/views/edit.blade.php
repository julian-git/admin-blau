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
        <h1>Editar Casteller</h1>
    </div>

    <form action="{{ action('CastellersController@handleEdit') }}" method="post" role="form">
        <input type="hidden" name="id" value="{{ $casteller->id }}">

   <div class="form-group">
            <label for="cognom1">Cognom 1</label>
            <input type="text" class="form-control" name="cognom1" value="{{ $casteller->cognom1 }}" />
        </div>
     
        <div class="form-group">
            <label for="cognom2">Cognom 2</label>
            <input type="text" class="form-control" name="cognom2" value="{{ $casteller->cognom2 }}" />
        </div>
     
        <div class="form-group">
            <label for="nom">Nom</label>
            <input type="text" class="form-control" name="nom" value="{{ $casteller->nom }}" />
        </div>
     
        <div class="form-group">
            <label for="mot">Mot</label>
            <input type="text" class="form-control" name="mot" value="{{ $casteller->mot }}" />
        </div>
     
        <div class="form-group">
            <label for="naixement">Data de naixement</label>
            <input type="text" class="form-control" name="naixement" value="{{ $casteller->naixement }}" />
        </div>
     
        <div class="form-group">
            <label for="dni">DNI</label>
            <input type="text" class="form-control" name="dni" value="{{ $casteller->dni }}" />
        </div>
     
        <div class="form-group">
            <label for="email">email</label>
            <input type="text" class="form-control" name="email" value="{{ $casteller->email }}" />
        </div>
     
        <div class="form-group">
            <label for="direccio">Direcció</label>
            <input type="text" class="form-control" name="direccio" value="{{ $casteller->direccio }}" />
        </div>
     
        <div class="form-group">
            <label for="cp">CP</label>
            <input type="text" class="form-control" name="cp" value="{{ $casteller->cp }}" />
        </div>
     
        <div class="form-group">
            <label for="poblacio">Població</label>
            <input type="text" class="form-control" name="poblacio" value="{{ $casteller->poblacio }}" />
        </div>
     
        <div class="form-group">
            <label for="provincia">Provincia</label>
            <input type="text" class="form-control" name="provincia" value="{{ $casteller->provincia }}" />
        </div>
     
        <div class="form-group">
            <label for="telefon1">Telèfon 1</label>
            <input type="text" class="form-control" name="telefon1" value="{{ $casteller->telefon1 }}" />
        </div>
     
        <div class="form-group">
            <label for="telefon2">Telèfon 2</label>
            <input type="text" class="form-control" name="telefon2" value="{{ $casteller->telefon2 }}" />
        </div>
     
        <div class="form-group">
            <label for="mobil1">Mòvil 1</label>
            <input type="text" class="form-control" name="mobil1" value="{{ $casteller->mobil1 }}" />
        </div>
     
        <div class="form-group">
            <label for="mobil2">Mòvil 2</label>
            <input type="text" class="form-control" name="mobil2" value="{{ $casteller->mobil2 }}" />
        </div>
     
        <div class="form-group">
            <label for="twitter">Twitter</label>
            <input type="text" class="form-control" name="twitter" value="{{ $casteller->twitter }}" />
        </div>
     
        <div class="form-group">
            <label for="whatsapp">Whatsapp</label>
            <input type="text" class="form-control" name="whatsapp" value="{{ $casteller->whatsapp }}" />
        </div>
     
        <div class="form-group">
            <label for="sexe">Sexe</label>
            <input type="text" class="form-control" name="sexe" value="{{ $casteller->sexe }}" />
        </div>

        <input type="submit" value="Desar" class="btn btn-primary" />
        <a href="{{ action('CastellersController@index') }}" class="btn btn-link">Cancel.lar</a>
    </form>
@stop
