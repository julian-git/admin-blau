<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>l.Admin Blau</title>
    <link rel="stylesheet" href="{{ asset('bootstrap/dist/css/bootstrap.min.css') }}" />
</head>
<body>
    <div class="container">
        <nav class="navbar navbar-default" role="navigation">
            <div class="navbar-header">
                <a href="{{ action('SociController@index') }}" class="navbar-brand">Socis</a>
            </div>
        </nav>
        @yield('content')
    </div>
</body>
</html>
