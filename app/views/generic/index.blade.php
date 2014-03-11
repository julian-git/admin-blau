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
          <a id="new-button" href="{{ action($CSN . 'sController@create', -1) }}" class="btn btn-primary disabled">
	    {{ $CSN::$class_name_gender == 'm' ? 'Nou' : 'Nova' }}
	    {{ $CSN::$singular_class_name }}
          </a>
        </div> {{-- col-md-2 --}}

        @if (isset($CSN::$responsible_class))
          <div class="col-md-8">
            <?php
              $include_args 
	    = array('search_description_text' => $CSN::$member_fields[$CSN::$responsible_field], 
		    'search_class' => strtolower($CSN::$responsible_class), 
		    'search_message' => $CSN::$responsible_field_search_message,
		    'dependent_button' => 'new-button',
		    'DCL' => $CSN::$responsible_class, 
		    'DF' => $CSN::$responsible_field, 
		    'DFI' => $CSN::$responsible_field . '_input'
		    ); // Put this array here because the following @include breaks with newlines
            ?>
            @include('generic/snippets/dependent_class_search', $include_args)
          </div>
          <script src="{{ asset('assets/js/dependent_fields.js') }}"></script>
        @endif

      </div> {{-- panel-body --}}
    </div> {{-- panel --}}

    <?php 
      $DataCSN = $CSN;
      $allow_edit = true;
    ?>
    @include('generic/datatable')

@stop
