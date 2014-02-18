<!doctype html>
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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>l.Admin Blau</title>
    <link rel="stylesheet" href="{{ asset('components/bootstrap/dist/css/bootstrap.min.css') }}" />
</head>
<body>
    <div class="container">
        <nav class="navbar navbar-default" role="navigation">
     @foreach (array('Casteller',
		     'Familie',
		     'Quote',
		     'TipusQuote',
		     'Activitat',
		     'TipusActivitat'
		     )
	       as    $SCN)
            <div class="navbar-header">
     <a href="{{ action($SCN . 'sController@index') }}" class="navbar-brand">{{ $SCN::$plural_class_name }}</a>
            </div>
     @endforeach
        </nav>
        @yield('content')
    </div>
</body>
</html>
