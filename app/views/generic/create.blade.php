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
  <h1>Crear 
    {{ $CSN::$class_name_gender == 'm' ? 'nou' : 'nova' }}
    {{ $CSN::$singular_class_name }}
  </h1>
</div>

<form action="{{ action($CSN . 'sController@handleCreate') }}" method="post" role="form">

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
          {{ Form::select($field, $dropbox_options[$field]) }} 
        </div>


      @elseif (isset($responsible_fields) &&
               !strcmp($responsible_fields['field'], $field))

        <?php $RCL = $CSN::$responsible_class; ?>
	  {{ $RCL::identifying_fields_of($responsible_fields['id']) }}

        
      @elseif (isset($dependent_fields) &&
               !strcmp($dependent_fields, $field))

        <div class="form-group">
          <div class="row">
            <div class="col-md-4">
              <div id="dependent-field-panel" class="panel panel-default">
                <div id="dependent-field-list">
                </div>
              </div> <!-- panel -->
            </div> <!-- col-md -->
            <div class="col-md-8">
              <div class="input-group custom-search-form">
                <span class="input-group-btn">
                  <button id="afegir-button" class="btn btn-default disabled" type="button">Afegir</button>
                </span>
                <input id="dependent-search" type="text" class="form-control" placeholder="Busca...">
                <span class="input-group-btn">
                  <button class="btn btn-default disabled" type="button">
                    <i class="fa fa-search"></i>
                  </button>
                </span>
              </div> <!-- input group -->

            </div> <!-- col-md -->
          </div> <!-- row -->
        </div> <!-- form-group -->

        <script>
          $("#dependent-search").val('');
	  $("#dependent-search").keyup(function(e){
		  var minLength = 3;  // search with min of X characters
		  var searchStr = $("#dependent-search").val();
		  if (searchStr.length >= minLength) {
		      $.getJSON('/{{ strtolower($CSN::$dependent_class) }}' + 's/search/' + searchStr, function() {
			  }).done(function(dependentObject) {
				  $('#dependent-search')
				      .attr('dependent-id', dependentObject.id)
				      .val(dependentObject.name);
				  if (dependentObject.id != -1) {
				      $('#afegir-button').removeClass('disabled');
				  } else {
				      $('#afegir-button').addClass('disabled');
				  }
                          }).fail(function(result) {
                              $('#dependent-search').val("No es troba cap persona semblant.");
				  $('#afegir-button').addClass('disabled');
		          });
		  }
	      });
              $('#afegir-button').click(function() {
		      var dependent_id = $('#dependent-search').attr('dependent-id');
		      if (dependent_id != -1) {
			  var delete_button = '<button id="dependent-delete-' + dependent_id + '" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-remove"></span></button>';
			  var dependent_div = '<div id="dependent-id-' + dependent_id + '" dependent-id="' + dependent_id + '"><span>' + $('#dependent-search').val() + '</span>' + delete_button + '</div>';
			  $('#dependent-field-list').append(dependent_div);   
			  $('#dependent-search').val('');
			  $('#afegir-button').addClass('disabled');
			  $('#dependent-delete-' + dependent_id).click(function(){
				  $('#dependent-id-' + dependent_id).remove();
			      });
		      }
		  });
        </script>

      @else 

        {{ Form::text($field, Input::old($field)) }}
        {{ $errors->first($field, '<span class="error">:message</span>') }}

      @endif 
     </div> <!-- form-group -->
   </div> <!-- col-md -->
</div> <!-- row -->
    @endif
@endforeach

        <input type="submit" value="Crear" class="btn btn-primary" />
       <a href="{{ action($CSN . 'sController@index') }}" class="btn btn-link">Cancel&middot;lar</a>
    </form>
@stop
