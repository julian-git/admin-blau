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
      {{ $CSN::$singular_class_name }}
  </h1>
</div>

@if (!strcmp($action, 'Editar'))
  {{ Form::model($csn, array('route' => array("$csn.edit", $$csn->id))) }}
  {{ Form::hidden('id', $$csn->id) }}
@else
  {{ Form::open() }}
@endif

@foreach ($CSN::$member_fields as $field => $prompt)
@if ($field != 'id')
<div class="row">
  <div class="col-md-2">
    <div class="form-group">
      {{ Form::label($field, $prompt) }} 
    </div>
  </div>
  <div class="col-md-10">
    <div class="form-group">
      @if (isset($dropbox_options[$field]))
        <div class="panel-body">
          @if (isset($dropbox_default[$field]))
            {{ Form::select($field, $dropbox_options[$field], $dropbox_default[$field]) }} 
          @else
            {{ Form::select($field, $dropbox_options[$field]) }} 
          @endif
          {{ $errors->first($field, '<span class="cvg-error">:message</span>') }}
        </div>


      @elseif (isset($responsible_fields) &&
               !strcmp($responsible_fields['field'], $field))

        <?php 
          $RCL = $CSN::$responsible_class; 
        ?>
	  {{ $RCL::identifying_fields_of($responsible_fields['id']) }}
          <input type="hidden" name="{{ $field }}" value="{{ $responsible_fields['id'] }}" />
        
      @elseif (isset($dependent_fields) &&
               !strcmp($dependent_fields, $field))

	      <?php $dfi = $CSN::$dependent_field . '_input' ?>
	      @include('generic/dependent_class_form', array('DCL' => $CSN::$dependent_class, 'DF' => $CSN::$dependent_field, 'DFI' => $dfi))

      @else 

        @if ($action=='Editar')
          {{ Form::text($field, $$csn->$field) }}
        @else
          {{ Form::text($field, Input::old($field)) }}
        @endif

        {{ $errors->first($field, '<span class="cvg-error">:message</span>') }}

      @endif 
     </div> <!-- form-group -->
   </div> <!-- col-md -->
</div> <!-- row -->
    @endif
@endforeach

  <div class="col-md-8">
        <input type="submit" value="{{ ($action == 'Crear') ? 'Crear' : 'Desar' }}" class="btn btn-primary" />
       <a href="{{ action($CSN . 'sController@index') }}" class="btn btn-link">Cancel&middot;lar</a>
  </div>
@if($action == 'Editar')
  <div class="col-md-4">
        <a href="{{ action($CSN . 'sController@delete', $$csn->id) }}" class="btn btn-danger">Esborrar</a>
  </div>
@endif
	   {{ Form::close() }}


@stop
