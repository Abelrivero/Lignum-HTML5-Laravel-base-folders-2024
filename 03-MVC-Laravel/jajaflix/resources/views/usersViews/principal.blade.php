@extends('layouts.layouts')

@section('title', 'ingreso')

@section('content')
    <a href="{{route('peliculaIndex')}}">peliculas</a>
    <br>
    <a href="{{route('actorIndex')}}">actores</a>
    <br>
    <a href="{{route('favoritasIndex', 1)}}">favoritas</a>
@endsection

