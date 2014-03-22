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
        <div class="row">
          <div class="col-md-6">
          <a id="new-button" href="{{ action($CSN . 'sController@create') }}" class="btn btn-primary">
	    {{ $CSN::$class_name_gender == 'm' ? 'Nou' : 'Nova' }}
	    {{ $CSN::$singular_class_name }}
          </a>
          </div>
          <div class="col-md-6">
	  <a id="list-button" href="{{ action($CSN . 'sController@list') }}" class="btn btn-primary pull-right">
	    Fer llistat
          </a>
          </div>
      </div> {{-- panel-body --}}
    </div> {{-- panel --}}

    <?php 
      $DataCSN = $CSN;
      $instances = $DataCSN::all();
      $allow_edit = true;
    ?>
    @include('generic/snippets/datatable')

@stop
