@extends('layouts.layouts')

@section('title', 'Crear Pelicula')

@section('content')
<a href="{{route('peliculaIndex')}}">Volver</a>
@if ($errors->any())
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{$error}}</li>
        @endforeach
    </ul>
@endif
<br>
<img src="{{asset('/resources/imagenes/imgDefaultPeliculas.jpg')}}" alt="" id="imgSelected" width="200" height="200">
<form action="{{route('peliculaStore')}}" method="POST" enctype="multipart/form-data">
    @csrf
    <label for="titulo">Titulo:</label>
    <input type="text" id="titulo" name="titulo">
    <br>
    <label for="duracion">Duracion:</label>
    <input type="number" id="duracion" name="duracion">
    <br>
    <label for="anio">Año:</label>
    <input type="date" id="anio" name="anio">
    <br>
    <label for="sinopsis">Sinopsis:</label>
    <textarea name="sinopsis" id="sinopsis" cols="30" rows="10"></textarea>
    <br>
    <label for="imagen">Imagen:</label>
    <input type="file" id="imagen" name="imagen" hidden>
    <button onclick="cargarImagen()" type="button" >Subir Imagen</button>
    <br>
    <label for="actorPrincipalID">Actor Principal:</label>
    <select name="actorPrincipalID" id="actorPrincipalID">
        <option disabled selected>Selecione Actor</option>
        @foreach ($actores as $actor)
            <option value="{{$actor->id}}">{{$actor->nombre}}</option>
        @endforeach
    </select>
    <br>
    <button type="submit">Crear</button>
</form>
@endsection

@section('scripts')
    <script src="{{asset('/scripts/scriptsPelicula.js')}}"></script>
@endsection