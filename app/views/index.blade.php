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
    <div>
      <h2>{{ $CSN }}s</h2>
    </div>
    <div class="panel-body">
      @foreach ($instance
		->where('data', '>=', date('Y-m-d', strtotime('now')))
		->orderBy('data')
		->get()
		as $res) 
      <div id="{{ $csn }}-{{ $res->id }}" class="row cvg-{{ $csn }}">
        <div class="col-md-4">
          <div class="row">
            <div id="{{ $csn }}-{{ $res->id }}-titol" class="col-md-5 cvg-{{ $csn }}-titol">
              {{ $res->titol }}
            </div>
            <div class="col-md-7">
              <div id="{{ $csn }}-{{ $res->id }}-data" class="cvg-{{ $csn }}-data">
                {{ $res->data }}
              </div>
              <div id="{{ $csn }}-{{ $res->id }}-llocs_fk" class="cvg-{{ $csn }}-llocs_fk">
                {{ $res->llocs_fk }}
              </div>
            </div> <!-- col-md-7 -->
          </div> <!-- row -->
        </div> <!-- col-md-4 -->
        <div id="{{ $csn }}-{{ $res->id }}-details" class="col-md-8 {{ $csn }}-details">
          <div class="row">
            @foreach($CSN::details($res->id) as $detail)
	      <div class="col-md-2">
                {{ $detail[1] }}
              </div>
              <div id="{{ $csn }}-detail-{{ $res->id }}" detailId="{{ $detail[0] }}" class="col-md-10">
		  {{ $CSN::details2($detail[0]) }}
              </div>
            @endforeach
          </div> <!-- row -->
        </div> <!-- col-md-8 -->
      </div> <!-- csn-res-id -->
      @endforeach
    </div> <!-- /panel-body -->
  </div> <!-- /panel -->
@endforeach

<script>
						/*
$(document).ready(function() {
	$('.actuacion-details').each('pollCastells');
    });
						*/
</script>



@stop