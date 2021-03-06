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
    <h1>Enviar correus confirmatoris de canvis en {{ strtolower($CSN::$singular_class_name) }}</h1>
</div>

{{ Form::open() }}

{{ Form::hidden('id', $$csn->id) }}

@foreach($CSN::$send_mail_to as $field => $prompt)
<div class="row">
  <div class="col-md-3">
    <div class="form-group">
      {{ Form::label($field, $prompt) }} 
    </div>
  </div>
  <div class="col-md-9">
    @if ($CSN::is_foreign_selection($field))
      @include('generic/snippets/foreign_selection', array('action' => 'Enviar correu'))
    @else
      {{ Form::checkbox($field . '-id-' . $$csn->id, 1, 1) }}
      {{ $$csn->$field }}
    @endif
  </div>
</div>
@endforeach

<input type="submit" value="Afegir a la cua de correus" class="btn btn-success" />


{{ Form::close() }}
@stop
