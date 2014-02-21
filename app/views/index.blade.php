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

<h2>Propers Esdeveniments</h2>
<div id="esdeveniment-wrap">

<?php
    $esdeveniment = new Esdeveniment;
foreach($esdeveniment->where('data', '>=', date('Y-m-d', strtotime('now')))->get()
	as $esd) {
    echo '<div id="esdeveniment' . $esd->id . '">';
    echo '  <div id="titol">' . $esd->titol . '</div>';
    echo '  <div id="data">' . $esd->data . '</div>';
    echo '  <div id="llocs_fk">' . $esd->llocs_fk . '</div>';
    echo '</div>';
}
    
?>

</div>

<h2>Properes Actuacions</h2>
<div id="actuacion-wrap">

<?php
    $actuacion = new Actuacion;
foreach($actuacion->where('data', '>=', date('Y-m-d', strtotime('now')))->get()
	as $act) {
    echo '<div id="actuacion' . $act->id . '">';
    echo '  <div id="llocs_fk">' . $act->llocs_fk . '</div>';
    echo '  <div id="data">' . $act->data . '</div>';
    echo '</div>';
}
    
?>

</div>

<script>
    /*
$(document).ready(function() {
	polling('esdeveniment', ['titol', 'data']);
	polling('actuacion', ['llocs_fk', 'data']);
    });
    */
</script>



@stop