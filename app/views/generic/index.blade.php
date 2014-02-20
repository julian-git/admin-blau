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
    <a href="{{ action($CSN . 'sController@create') }}" class="btn btn-primary">
	{{ $CSN::$class_name_gender == 'm' ? 'Nou' : 'Nova' }}
	{{ $CSN::$singular_class_name }}</a>
        </div>
    </div>

    @if ($$class_instance_list->isEmpty())
        <p>De moment no hi ha cap entrada.</p>
    @else
        <?php $fields_in_index = isset($CSN::$fields_in_index) 
                               ? $CSN::$fields_in_index
			       : $CSN::$member_fields ?>
        <div class="table-responsive">
          <table class="table table-striped table-bordered table-hover" id="indexDataTable">
            <thead>
                <tr>
        @foreach ($fields_in_index as $field => $prompt)
                   <th>{{ $prompt }}</th>
	@endforeach
		<th/>
                </tr>
            </thead>
            <tbody>
                @foreach($$class_instance_list as $instance)
                <tr>
                   @foreach(array_keys($fields_in_index) as $field)
                     @if (!strcmp(substr($field, -3), '_fk'))
                      <td><div id="{{ $field }}{{ $instance->id }}">{{ $instance->$field }}</div></td>
 		     @else 
                      <td>{{ $instance->$field }}</td>
                     @endif
		   @endforeach
                    <td>
                        <a href="{{ action($CSN . 'sController@edit', $instance->id) }}" class="btn btn-warning btn-xs">Editar</a>
                        <a href="{{ action($CSN . 'sController@delete', $instance->id) }}" class="btn btn-danger btn-xs">Esborrar</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
      </div>
    <script src="{{ asset('components/sb-admin-v2/js/plugins/dataTables/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('components/sb-admin-v2/js/plugins/dataTables/dataTables.bootstrap.js') }}"></script>
    <script>
      $(document).ready(function() {
          $('#indexDataTable').dataTable();
      });
    </script>
    @endif
@stop
