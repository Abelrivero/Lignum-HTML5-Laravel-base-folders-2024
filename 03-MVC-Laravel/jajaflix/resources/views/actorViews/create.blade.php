@extends('layouts.layouts')

@section('title', 'Crear Actor')

@section('content')
<a href="{{route('actorIndex')}}">Atras</a>
<form method="POST" action="{{route('actorStore')}}">
    @csrf
    <label for="nombre">Nombre</label>
    <input type="text" id="nombre" name="nombre">
    <label for="fechaNacimiento">Fecha de Nacimiento</label>
    <input type="date" id="fechaNacimiento" name="fechaNacimiento">
    <button type="submit">Guardar</button>
</form>
@endsection