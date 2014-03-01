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
          <a href="{{ action($CSN . 'sController@create', 88) }}" class="btn btn-primary">
	    {{ $CSN::$class_name_gender == 'm' ? 'Nou' : 'Nova' }}
	    {{ $CSN::$singular_class_name }}
          </a>
        </div> {{-- col-md-2 --}}

        @if (isset($CSN::$responsible_class))
          <div class="col-md-6">
            responsable: &nbsp;
            {{ Form::select('responsible', $potential_responsibles_list) }}
          </div>
        @endif

      </div> {{-- panel-body --}}
    </div> {{-- panel --}}

    @if ($$class_instance_list->isEmpty())
        <p>De moment no hi ha cap entrada.</p>
    @else
        <?php $fields_in_index = isset($CSN::$fields_in_index) 
                               ? $CSN::$fields_in_index
			       : $CSN::$member_fields ?>
        <div class="table-responsive">
          <table class="table table-striped table-bordered" id="indexDataTable">
            <thead>
                <tr>
        @foreach ($fields_in_index as $field => $prompt)
                   <th>{{ $prompt }}</th>
	@endforeach
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
                </tr>
                @endforeach
            </tbody>
        </table>
      </div>
    <script src="{{ asset('components/sb-admin-v2/js/plugins/dataTables/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('components/sb-admin-v2/js/plugins/dataTables/dataTables.bootstrap.js') }}"></script>
    <script>
      $(document).ready(function() {
	      var iDT = $('#indexDataTable').dataTable({
		  fnDrawCallback: function(){
			  $("#indexDataTable tbody tr").click(function () {
				  var position = iDT.fnGetPosition(this); //get position of the selected row
				  var id = iDT.fnGetData(position)[0];    //value of the first column (can be hidden)
				  document.location.href = "/{{ strtolower($CSN) }}/edit/" + id;   //redirect
			      });
		      }
		  });
      });
    </script>
    @endif
@stop
