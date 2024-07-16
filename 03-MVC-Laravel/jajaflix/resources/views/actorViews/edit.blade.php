@extends('layouts.layouts')

@section('title', 'Editar Actor')

@section('content')
<a href="{{route('actorIndex')}}">Atras</a>
@if ($errors->any())
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{$error}}</li>
        @endforeach
    </ul>
@endif
<form method="POST" action="{{route('actorUpdate', $actor->id)}}">
    @csrf
    @method('PUT')
    <label for="nombre">Nombre</label>
    <input type="text" id="nombre" name="nombre" value="{{$actor->nombre}}">
    <label for="fechaNacimiento">Fecha de Nacimiento</label>
    <input type="date" id="fechaNacimiento" name="fechaNacimiento" value="{{$actor->fechaNacimiento}}">
    <button type="submit">Guardar</button>
</form>
@endsection