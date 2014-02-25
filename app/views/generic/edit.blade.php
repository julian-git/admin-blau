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

<?php include_once(dirname(dirname(dirname(__FILE__))) . "/models/$CSN.php"); ?>

    <div class="page-header">
    <h1>Editar 
      {{ $CSN::$singular_class_name }}
    </h1>
    </div>

    <form action="{{ action($CSN . 'sController@handleEdit') }}" method="post" role="form">

<table>
<thead/>
<tbody> 

  <input type="hidden" name="id" value="{{ $$csn->id }}">

    @foreach ($CSN::$member_fields as $field => $prompt)
    @if ($field != 'id')
  <tr>
    <td>
       <div class="form-group">
         {{ Form::label($field, $prompt) }} 
       </div>
    </td>
    <td>
       <div class="form-group">

        @if (isset($dropbox_options[$field]))

           <div class="panel-body">
             {{ Form::select($field, $dropbox_options[$field], $dropbox_default[$field]) }} 

             @if (strcmp($field, 'rols_fk') && strcmp($field, 'categories_fk'))
               <?php $ft = $foreign_table[$field] ?>
               <a href="{{ action($ft . 'sController@create') }}" class="btn btn-primary">
	          {{ $ft::$class_name_gender == 'm' ? 'Nou' : 'Nova' }}
	          {{ $ft::$singular_class_name }}
               </a>
             @endif
           </div> <!-- panel-body -->

         @elseif(isset($multidropbox_options[$field]))
	    
           <div class="panel-body">
             <div class="col-md-8">
	    @foreach($multidropbox_options[$field] as $entry)
		    <div>{{ $entry }}</div>
            @endforeach 
             </div>
             <div class="col-md-4">
               <a href="{{/* action($field . 'sController@multicreate/' . $$csn->id)*/ $field }}" class="btn btn-primary"> 
		    Nou {{ $field }} -- compte: no funciona encara
               </a>
              <div>

           </div> <!-- panel-body -->

         @else
	     {{ Form::text ($field, $$csn->$field) }}
             {{ $errors->first($field, '<span class="error">:message</span>') }}
         @endif
       </div>
    </td>
  </tr>
    @endif
@endforeach
 
</table>
  
  <div class="col-md-8">
        <input type="submit" value="Desar" class="btn btn-primary" />
        <a href="{{ action($CSN . 'sController@index') }}" class="btn btn-link">Cancel&middot;lar</a>
  </div>
  <div class="col-md-4">
        <a href="{{ action($CSN . 'sController@delete', $$csn->id) }}" class="btn btn-danger">Esborrar</a>
  </div>

    </form>
@stop
