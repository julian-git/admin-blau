<!DOCTYPE html>
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
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>l'Admin Blau</title> <!-- this comma ' is for stupid emacs syntax highlighter-->

    <!-- Core CSS - Include with every page -->
    <link href="{{ asset('components/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/typeahead.js-bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('components/sb-admin-v2/font-awesome/css/font-awesome.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/cvg.css') }}" rel="stylesheet">

    <!-- Page-Level Plugin CSS - Blank -->
        <link href="{{ asset('assets/css/datatable_hover.css') }}" rel="stylesheet">

    <!-- SB Admin CSS - Include with every page -->
    <link href="{{ asset('components/sb-admin-v2/css/sb-admin.css') }}" rel="stylesheet">

</head>

<body>
    <!-- Core Scripts - Include with every page -->
    <!-- These scripts have to go at the beginning because the content included by @yield needs them -->
    <script src="{{ asset('components/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('components/bootstrap/dist/js/bootstrap.min.js') }}"></script>

    <div id="wrapper">

        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/">
		       <img src="{{ asset('favicon.ico') }}"/> L'Admin Blau <!--'-->
                </a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-envelope fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-messages">
                        <li>
                            <a href="#">
                                <div>
                                    <strong>Foguerons</strong>
                                    <span class="pull-right text-muted">
                                        <em>fa dues setmanes</em>
                                    </span>
                                </div>
                                <div>Descarregat un 3de7</div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <strong>La Merc&eacute,</strong>
                                    <span class="pull-right text-muted">
                                        <em>ahir</em>
                                    </span>
                                </div>
                                <div>Descarregat un 7de7</div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a class="text-center" href="#">
                                <strong>Read All Messages</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>
                    </ul>
                    <!-- /.dropdown-messages -->
                </li>
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-tasks fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-tasks">
                        <li>
                            <a href="#">
                                <div>
                                    <p>
                                        <strong>Pinya del 3de9f</strong>
                                        <span class="pull-right text-muted">40% Complert</span>
                                    </p>
                                    <div class="progress progress-striped active">
                                        <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
                                            <span class="sr-only">40% Complert (warning)</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <p>
                                        <strong>Pinya del 4de9f</strong>
                                        <span class="pull-right text-muted">20% Complert</span>
                                    </p>
                                    <div class="progress progress-striped active">
                                        <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 20%">
                                            <span class="sr-only">20% Complert</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <p>
                                        <strong>Pinya del p7fm</strong>
                                        <span class="pull-right text-muted">60% Complert</span>
                                    </p>
                                    <div class="progress progress-striped active">
                                        <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%">
                                            <span class="sr-only">60% Complert (info)</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <p>
                                        <strong>Pinya del 2de8f</strong>
                                        <span class="pull-right text-muted">80% Complert</span>
                                    </p>
                                    <div class="progress progress-striped active">
                                        <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%">
                                            <span class="sr-only">80% Complert (success)</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a class="text-center" href="#">
                                <strong>See All Tasks</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>
                    </ul>
                    <!-- /.dropdown-tasks -->
                </li>
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-bell fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-alerts">
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-comment fa-fw"></i> New Comment
                                    <span class="pull-right text-muted small">4 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-twitter fa-fw"></i> 3 New Followers
                                    <span class="pull-right text-muted small">12 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-envelope fa-fw"></i> Message Sent
                                    <span class="pull-right text-muted small">4 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-tasks fa-fw"></i> New Task
                                    <span class="pull-right text-muted small">4 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-upload fa-fw"></i> Server Rebooted
                                    <span class="pull-right text-muted small">4 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a class="text-center" href="#">
                                <strong>See All Alerts</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>
                    </ul>
                    <!-- /.dropdown-alerts -->
                </li>
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
                        </li>
                        <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="login.html"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->
        </nav>
        <!-- /.navbar-static-top -->

        <nav class="navbar-default navbar-static-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="side-menu">
                    <li class="sidebar-search">
                        <div class="input-group custom-search-form">
                            <input type="text" class="form-control" placeholder="Search...">
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="button">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                        </div>
                        <!-- /input-group -->
                    </li>
                    <li>
                        <a href="/"><i class="fa fa-dashboard fa-fw"></i> Propers Events</a>
                    </li>
                    <li>
                        <a href="{{ action('MissatgesController@index') }}"><i class="fa fa-table fa-fw"></i> Missatges</a>
                    </li>
                    <li>
                        <a href="tables.html"><i class="fa fa-table fa-fw"></i> Configuraci&oacute;<span class="fa arrow"></a>
                        <ul class="nav nav-second-level">
						@foreach(['Categorie', 'TipusQuote'] as $CSN)   
                            <li>
                                <a href="{{ action($CSN . 'sController@index') }}" >{{ $CSN::$plural_class_name }}</a>
                            </li>
                        @endforeach
                        </ul>
                        <!-- /.nav-second-level -->
                    </li>
                    <li>
				<a href="tables.html"><i class="fa fa-table fa-fw"></i> Persones, Famílies, Quotes<span class="fa arrow"></a>
                        <ul class="nav nav-second-level">
                        @foreach(['Persone',
                              'Familie',
                              'Quote'
                             ] as $CSN)   
                            <li>
                                <a href="{{ action($CSN . 'sController@index') }}" >{{ $CSN::$plural_class_name }}</a>
                            </li>
                        @endforeach
                        </ul>
                        <!-- /.nav-second-level -->
                    </li>
                    <li>
                        <a href="tables.html"><i class="fa fa-table fa-fw"></i> Esdeveniments<span class="fa arrow"></a>
                        <ul class="nav nav-second-level">
@foreach(['Esdeveniment',
	 'TipusEsdeveniment'
	 ] as $CSN)   
                            <li>
 <a href="{{ action($CSN . 'sController@index') }}" >{{ $CSN::$plural_class_name }}</a>
                            </li>
@endforeach
                        </ul>
                        <!-- /.nav-second-level -->
                    </li>
                    <li>
                        <a href="tables.html"><i class="fa fa-table fa-fw"></i> Actuacions<span class="fa arrow"></a>
                        <ul class="nav nav-second-level">
@foreach(['Actuacion',
	 'TipusActuacion'
	 ] as $CSN)   
                            <li>
 <a href="{{ action($CSN . 'sController@index') }}" >{{ $CSN::$plural_class_name }}</a>
                            </li>
@endforeach
                        </ul>
                        <!-- /.nav-second-level -->
                    </li>
                    <li>
                        <a href="tables.html"><i class="fa fa-table fa-fw"></i> Castells<span class="fa arrow"></a>
                        <ul class="nav nav-second-level">
@foreach(['Castell',
	  'TipusCastell',
	  'Posicion'
	 ] as $CSN)   
                            <li>
 <a href="{{ action($CSN . 'sController@index') }}" >{{ $CSN::$plural_class_name }}</a>
                            </li>
@endforeach
                        </ul>
                        <!-- /.nav-second-level -->
                    </li>
                </ul>
                <!-- /#side-menu -->
            </div>
            <!-- /.sidebar-collapse -->
        </nav>
        <!-- /.navbar-static-side -->

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
	  @yield('content')
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->


    <!-- Page-Level Plugin Scripts - Blank -->
    <script src="{{ asset('assets/js/polling.js') }}"></script>

    <!-- SB Admin Scripts - Include with every page -->
    <script src="{{ asset('components/sb-admin-v2/js/sb-admin.js') }}"></script>
    <script src="{{ asset('components/sb-admin-v2/js/plugins/metisMenu/jquery.metisMenu.js') }}"></script>

    <!-- Page-Level Demo Scripts - Blank - Use for reference -->

<footer><a href="http://github.com/julian-git/admin-blau">L&lsquo;Admin Blau</a> &eacute;s <a href="https://www.gnu.org/copyleft/gpl.html">software lliure</a> basada en <a href="http://laravel.com">Laravel</a>, <a href="http://getbootstrap.com/">bootstrap</a>, <a href="http://startbootstrap.com/sb-admin-v2">sb-admin-v2</a> i <a href="https://github.com/twitter/typeahead.js">typeahead.js</a>.
</footer>
</body>

</html>
