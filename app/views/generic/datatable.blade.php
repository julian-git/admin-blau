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
    This snippet needs two variables to be set:

      $DataCSN = SomeClassSingularName (e.g. 'Persone');
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
                @foreach($DataCSN::all() as $instance)
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
	      var iDT = $('#indexDataTable-{{ $DataCSN }}').dataTable({
		  fnDrawCallback: function(){
			  @if ($allow_edit)
			  $("#indexDataTable-{{ $DataCSN }} tbody tr").click(function () {
				  var position = iDT.fnGetPosition(this); //get position of the selected row
				  var id = iDT.fnGetData(position)[0];    //value of the first column (can be hidden)
				  document.location.href = "edit/" + id;   //redirect
			      });
			  @endif 
		      }
		  });

	      function update_new_button() {
		      var id = $('#responsible_select option:selected').val();
		      var href = $('#new_button').attr('href');
		      var last_slash = href.lastIndexOf('/');
		      $('#new_button').attr('href', href.substr(0, last_slash) + '/' + id);
	      }

	      update_new_button();

	      $("#responsible_select").click(function(){
		      update_new_button();
		  });
      });
    </script>
