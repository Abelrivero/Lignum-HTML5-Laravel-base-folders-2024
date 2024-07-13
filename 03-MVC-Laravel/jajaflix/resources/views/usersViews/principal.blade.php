@extends('layouts.layouts')

@section('title', 'ingreso')

@section('content')
    <a href="{{route('peliculaIndex')}}">peliculas</a>
    <br>
    <a href="{{route('actorIndex')}}">actores</a>
    <br>
    <a href="">favoritas</a>
@endsection

