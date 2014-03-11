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

<?php include_once(dirname(dirname(dirname(__FILE__))) . "/models/$CSN.php"); ?>

<div class="page-header">
  <h1>{{ $action }} 
    @if(!strcmp($action, 'Crear'))
      {{ $CSN::$class_name_gender == 'm' ? 'nou' : 'nova' }}
    @endif
      {{ strtolower($CSN::$singular_class_name) }}
  </h1>
</div>

@if (!strcmp($action, 'Editar'))
  {{ Form::model($csn, array('route' => array("$csn.edit", $$csn->id))) }}
  {{ Form::hidden('id', $$csn->id) }}
@else
  {{ Form::open() }}
@endif

@include ('generic/snippets/crud_buttons')

@if (!isset($CSN::$panels))

  @foreach ($CSN::$member_fields as $field => $prompt)
    @include('generic/snippets/member_field')
  @endforeach

@else

  @foreach($CSN::$panels as $panel_title => $fields)
    <div class="panel panel-primary">
      <div class="panel-heading">
        <h3 class="panel-title">{{ $panel_title }}</h3>
      </div>
      <div class="panel-body">
        <div class="row">
          <div class="col-md-6">
            <?php $i = 0; $n = ceil(sizeof($fields)/2) ?>
            @foreach ($fields as $field => $prompt)
              @include('generic/snippets/member_field')
              <?php $i++ ?>
              @if ($i==$n)
          </div>
          <div class="col-md-6">
              @endif
            @endforeach
          </div>
       </div>
      </div>
    </div>
  @endforeach

@endif {{-- !isset($CSN::$panels)) --}}

@include ('generic/snippets/crud_buttons')

@if (!strcmp($action, 'Mostrar') && isset($CSN::$extra_inspect))
  @include('extras/' . $CSN::$extra_inspect)
@endif

{{--  @include('generic/snippets/query_log') --}}

{{ Form::close() }}


@stop
