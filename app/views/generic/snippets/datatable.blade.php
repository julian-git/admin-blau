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

<?php
/*
    This snippet needs the following variables to be set:

      $DataCSN = SomeClassSingularName (e.g. 'Persone');
      $instances = a query result, e.g. $DataCSN::all()
      $allow_edit = true/false;

 */
?>
        <?php $fields_in_index = isset($DataCSN::$fields_in_index) 
                               ? $DataCSN::$fields_in_index
			       : $DataCSN::$member_fields ?>
        <div class="table-responsive">
          <table id="indexDataTable-{{ $DataCSN }}" class="table table-striped table-bordered">
            <thead>
                <tr>
        @foreach ($fields_in_index as $field => $prompt)
                   <th>{{ $prompt }}</th>
	@endforeach
                </tr>
            </thead>
            <tbody>
                @foreach($instances as $instance)
                <tr class="highlight-row">
                   @foreach(array_keys($fields_in_index) as $field)
		   <td{{ $DataCSN::is_right_aligned($field) ? ' class="right"' : '' }}>{{ $instance->resolve($field) }}</td>
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
	      var iDT = $('#indexDataTable-{{ $DataCSN }}').dataTable({
                  'oLanguage': {
		      'sSearch': 'Filtrar per: ',
		      'sInfo': "Mostrant entrades _START_ a _END_ d'un total de _TOTAL_",
			      'sLengthMenu': '_MENU_ entrades per pàgina',
		      'oPaginate' : {
			  'sPrevious': 'Anterior',
			  'sNext': 'Següent'
			      } 
		      },
		  'aoColumnDefs': [{ "bVisible": false, "aTargets": [0] }],
		  fnDrawCallback: function(){
			  $("#indexDataTable-{{ $DataCSN }} tbody tr").click(function () {
				  var position = iDT.fnGetPosition(this); //get position of the selected row
				  var id = iDT.fnGetData(position)[0];    //value of the first column (can be hidden)
				  document.location.href = "/{{ strtolower($DataCSN) }}/inspect/" + id;   //redirect
			      });
		      }
		  });
      });
    </script>
