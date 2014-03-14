<!DOCTYPE html>
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

<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>l'Admin Blau</title> <!-- this comma ' is for stupid emacs syntax highlighter-->

    <!-- Core CSS - Include with every page -->
    <link href="{{ asset('components/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('components/sb-admin-v2/font-awesome/css/font-awesome.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/cvg.css') }}" rel="stylesheet">
    <!-- SB Admin CSS - Include with every page -->
    <link href="{{ asset('components/sb-admin-v2/css/sb-admin.css') }}" rel="stylesheet">

</head>

<body>
    <!-- Core Scripts - Include with every page -->
    <!-- These scripts have to go at the beginning because the content included by @yield needs them -->
    <script src="{{ asset('components/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('components/bootstrap/dist/js/bootstrap.min.js') }}"></script>

@section('content')

<h1><img src="{{ asset('favicon.ico') }}"/> Jo sóc un rebut i vull un format xulo</h1>

  {{ Form::open() }}

<div class="row">
<div class="col-md-6">

  <div class="row">
    <div class="col-md-6">
      <div class="form-group">
        {{ Form::label('id', 'Número del rebut') }}
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        {{ $instance->id }}
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-6">
      <div class="form-group">
        {{ Form::label('tipus_quotes_fk', 'Tipus de Quota') }}
      </div>
    </div>
    <div class="col-md-6">
	  {{ $instance->resolve('tipus_quotes_fk') }}
    </div>
  </div>

  <div class="row">
    <div class="col-md-6">
      <div class="form-group">
        {{ Form::label('id_responsables_fk', 'Responsable') }}
      </div>
    </div>
    <div class="col-md-6">
	  {{ $instance->resolve('id_responsables_fk') }}
    </div>
  </div>

  <div class="row">
    <div class="col-md-6">
      <div class="form-group">
        {{ Form::label('import', 'Import') }}
      </div>
    </div>
    <div class="col-md-6">
	  {{ $instance->resolve('import') }}
    </div>
  </div>

  <div class="row">
    <div class="col-md-6">
      <div class="form-group">
        {{ Form::label('beneficiaris_list', 'Beneficiaris') }}
      </div>
    </div>
    <div class="col-md-6">
     @foreach($instance->beneficiaris()->get() as $beneficiari)
     <div> {{ assemble_identifying_short_fields('Persone', $beneficiari) }} </div>
     @endforeach
    </div>
  </div>

</div>
<div class="col-md-6">
    segona columna
</div>
</div>
	{{ Form::close() }}

    <!-- SB Admin Scripts - Include with every page -->
    <script src="{{ asset('components/sb-admin-v2/js/sb-admin.js') }}"></script>
    <script src="{{ asset('components/sb-admin-v2/js/plugins/metisMenu/jquery.metisMenu.js') }}"></script>

    <!-- Page-Level Demo Scripts - Blank - Use for reference -->

<footer><a href="http://github.com/julian-git/admin-blau">L&lsquo;Admin Blau</a> &eacute;s <a href="https://www.gnu.org/copyleft/gpl.html">software lliure</a> basada en <a href="http://laravel.com">Laravel</a>, <a href="http://getbootstrap.com/">bootstrap</a> i <a href="http://startbootstrap.com/sb-admin-v2">sb-admin-v2</a>.
</footer>
</body>

</html>
