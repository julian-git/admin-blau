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
    <h1>{{ $CSN::$plural_class_name }}</h1>
    </div>

    <div class="panel panel-default">
      <div class="panel-body">
        <div class="col-md-2">
          <a id="new_button" href="{{ action($CSN . 'sController@create', -1) }}" class="btn btn-primary">
	    {{ $CSN::$class_name_gender == 'm' ? 'Nou' : 'Nova' }}
	    {{ $CSN::$singular_class_name }}
          </a>
        </div> {{-- col-md-2 --}}

        @if (isset($CSN::$responsible_class))
          <div class="col-md-6">
            responsable: &nbsp;
	{{ Form::select('responsible_select', $potential_responsibles_list, null, array('id' => 'responsible_select')) }}
          </div>
        @endif

      </div> {{-- panel-body --}}
    </div> {{-- panel --}}

    @if ($$class_instance_list->isEmpty())

      <p>De moment no hi ha cap entrada.</p>

    @else

      @include('generic/datatable')

    @endif

@stop
