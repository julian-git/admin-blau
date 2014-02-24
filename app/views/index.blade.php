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
      <h2>
	@if ($CSN == 'Actuacion')
          assajos i actuacions
        @else
          {{ $csn }}s
        @endif
      </h2>
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
              @if(!method_exists($CSN, 'pinya_necessaria')) 
	        <div class="col-md-2">
                  {{ $detail[1] }}
                </div>
              @else
	        <div class="col-md-1">
                  {{ $detail[1] }}
                </div>
	        <div class="col-md-1">
                  <span id="current-count-{{ $detail[0] }}">0</span>/{{ $CSN::pinya_necessaria($detail[1]) }}
                </div>
                <div class="col-md-10 {{ $csn }}-detail">
                  <div class="progress progress-striped">
                    <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="{{ $CSN::pinya_necessaria($detail[1]) }}" style="width: 0%" castell-id="{{ $detail[0] }}">
                      <span class="sr-only">0% Complert (warning)</span>
                    </div> <!-- progress-bar -->
                  </div> <!-- progress -->
                </div> <!-- detailId -->
              @endif
            @endforeach
          </div> <!-- row -->
        </div> <!-- col-md-8 -->
      </div> <!-- csn-res-id -->
      @endforeach
    </div> <!-- /panel-body -->
  </div> <!-- /panel -->
@endforeach

		{{--
@foreach(DB::connection()->getQueryLog() as $query)
		<div>{{ $query['query'] }} {{ var_dump($query['bindings']) }} </div>
@endforeach
		  --}}
<script>

$(function() {
	$('.actuacion-detail .progress-bar').each(function(){drawCastellBar($(this))});
    });

</script>



@stop