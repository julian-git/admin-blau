@extends('layout')

@section('content')
    <div class="page-header">
    <h1>Esborrar {{ $soci->nom }} {{ $soci->cognom1 }} {{ $soci->cognom2 }} ({{ $soci->mot }}) <small>Estas segur?</small></h1>
    </div>
    <form action="{{ action('SocisController@handleDelete') }}" method="post" role="form">
        <input type="hidden" name="soci" value="{{ $soci->id }}" />
        <input type="submit" class="btn btn-danger" value="Yes" />
        <a href="{{ action('SocisController@index') }}" class="btn btn-default">No, de cap de les maneres!</a>
    </form>
@stop