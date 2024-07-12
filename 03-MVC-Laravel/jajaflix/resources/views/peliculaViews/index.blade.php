@extends('layouts.layouts')

@section('title', 'peliculas')

@section('content')
    <h1>Peliculas</h1>
    <a href="{{route('peliculaCreate')}}">Crear</a>
    <ul>
        @forelse ($peliculas as $pelicula)
        <li>{{$pelicula->titulo}}
            <a href="{{route('peliculaEdit', $pelicula->id)}}">Editar</a>
            <form action="{{route('peliculaDelete', $pelicula->id)}}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit">Eliminar</button>
            </form>
        </li>
        @empty
        <p>Sin Peliculas Guardadas</p>
        @endforelse
    </ul>
@endsection