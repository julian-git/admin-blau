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
  <h2>{{ $CSN }}s</h2>
  <div id="{{ $csn }}-wrap">

  @foreach ($instance->where('data', '>=', date('Y-m-d', strtotime('now')))->get()
	    as $res) 
    <div id="{{ $csn }}{{ $res->id }}" class="cvg-{{ $csn }}">
    @foreach (['titol', 'data', 'llocs_fk'] as $f) 
	<div id="{{ $f }}" class="cvg-{{ $csn }}-{{ $f }}">{{ $res->$f }}</div>
    @endforeach
    </div>
  @endforeach
  </div>
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