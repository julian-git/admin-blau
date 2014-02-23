@extends('generic/layout')
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

@foreach (['Esdeveniment', 'Actuacion'] as $CSN) 
  <?php 
    $csn = strtolower($CSN);
    $instance = new $CSN; 
  ?>
  <div id="{{ $csn }}-panel" class="panel panel-default">
        <div><h2>{{ $CSN }}s</h2></div>
    <div class="panel-body">
      @foreach ($instance->where('data', '>=', date('Y-m-d', strtotime('now')))->get()
		as $res) 
      <div id="{{ $csn }}-{{ $res->id }}" class="row cvg-{{ $csn }}">
        <div class="col-md-3">
          <div class="row">
            <div id="{{ $csn }}-{{ $res->id }}-titol" class="col-md-6">
              {{ $res->titol }}
            </div>
            <div id="{{ $csn }}-{{ $res->id }}-data" class="col-md-6">
              {{ $res->data }}
            </div>
            <div id="{{ $csn }}-{{ $res->id }}-llocs_fk" class="col-md-6">
              {{ $res->llocs_fk }}
            </div>
          </div> <!-- row -->
        </div> <!-- col-md-3 -->
        <div id="{{ $csn }}-{{ $res->id }}-details" class="col-md-9">
	  <div>castell 1</div>
	  <div>castell 2</div>
	  <div>castell 3</div>
        </div> <!-- col-md-9 -->
      </div> <!-- csn-res-id -->
      @endforeach
    </div> <!-- /panel-body -->
  </div> <!-- /panel -->
@endforeach

<script>
    /*
$(document).ready(function() {
	polling('Esdeveniment', ['titol', 'data']);
	polling('actuacion', ['llocs_fk', 'data']);
    });
    */
</script>



@stop