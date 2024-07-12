@extends('layouts.layouts')

@section('title', 'Editar Pelicula')

@section('content')
<form action="{{route('peliculaUpdate', $pelicula->id)}}" method="POST">
    @csrf
    @method('PUT')
    <label for="titulo">Titulo:</label>
    <input type="text" id="titulo" name="titulo" value="{{$pelicula->titulo}}">
    <br>
    <label for="duracion">Duracion:</label>
    <input type="number" id="duracion" name="duracion" value="{{$pelicula->duracion}}">
    <br>
    <label for="anio">Año:</label>
    <input type="date" id="anio" name="anio" value="{{$pelicula->anio}}">
    <br>
    <label for="sinopsis">Sinopsis:</label>
    <textarea name="sinopsis" id="sinopsis" cols="30" rows="10">{{$pelicula->sinopsis}}</textarea>
    <br>
    <label for="imagen">Imagen:</label>
    <input type="file" id="imagen" name="imagen">
    <br>
    <label for="actorPrincipalID">Actor Principal:</label>
    <select name="actorPrincipalID" id="actorPrincipalID">
        <option value="{{$pelicula->actorPrincipalID}}">{{$pelicula->actor->nombre}}</option>
    </select>
    <br>
    <button type="submit">Guardar</button>
</form>
@endsection