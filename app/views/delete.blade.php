@extends('layout')

@section('content')
    <div class="page-header">
    <h1>Esborrar {{ $casteller->nom }} {{ $casteller->cognom1 }} {{ $casteller->cognom2 }} ({{ $casteller->mot }}) <small>Estas segur?</small></h1>
    </div>
    <form action="{{ action('CastellersController@handleDelete') }}" method="post" role="form">
        <input type="hidden" name="casteller" value="{{ $casteller->id }}" />
        <input type="submit" class="btn btn-danger" value="Yes" />
        <a href="{{ action('CastellersController@index') }}" class="btn btn-default">No, de cap de les maneres!</a>
    </form>
@stop