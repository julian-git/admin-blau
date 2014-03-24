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
    <h1>Llistats de {{ strtolower($CSN::$plural_class_name) }}</h1>
</div>

    {{ Form::open() }}

<div class="panel panel-primary">
  <div class="panel-heading">
    <h3 class="panel-title">Paràmetres de la búsqueda</h3>
  </div>
  <div class="panel-body">
    <div class="row">
      <div class="col-md-3">
        <div class="form-group">
           Camp
        </div>
      </div>
      <div class="col-md-9">
        <div class="form-group">
          {{ Form::select('field', $CSN::$member_fields) }}
        </div>
      </div>
    </div> <!-- row -->

    <div class="row">
      <div class="col-md-3">
        <div class="form-group">
           Operador
        </div>
      </div>
      <div class="col-md-9">
        <div class="form-group">
	    {{ Form::select('operator', array('>=' => '>=', '=' => '=', '<=' => '<=', 'like' => 'like')) }}
        </div>
      </div>
    </div> <!-- row -->

    <div class="row">
      <div class="col-md-3">
        <div class="form-group">
           Valor
        </div>
      </div>
      <div class="col-md-9">
        <div class="form-group">
	    {{ Form::text('value', '1') }}
        </div>
      </div>
    </div> <!-- row -->
    <button type="submit" name="list" value="1" class="btn btn-success">Fer llistat</button>
  </div>
</div>

<div class="panel panel-primary">
  <div class="panel-heading">
    <h3 id="resultats-trobats" class="panel-title">{{ sizeof($results) > 0 ? sizeof($results) . ' r' : 'R' }}esultats trobats</h3>
  </div>
  <div class="panel-body">
    <div class="form-group">
      <button type="submit" name="export" value="1" class="btn btn-success{{ sizeof($results) > 0 ? '' : ' disabled' }}">Desar dades complerts com a</button>
	{{ Form::select('format_input', array('csv' => 'csv', 'xml' => 'xml', 'json' => 'json'), 'json', array( sizeof($results) > 0 ? '' : 'disabled')) }}
    </div>
    <div id="results" class="form-group">
       @foreach($results as $result)
         <p>{{$result}}</p>
       @endforeach
    </div>
  </div>
</div>

{{ Form::close() }}

@stop