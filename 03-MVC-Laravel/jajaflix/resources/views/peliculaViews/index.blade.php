@extends('layouts.layouts')

@section('title', 'peliculas')

@section('content')
    <h1>Peliculas</h1>
    <a href="{{route('peliculaCreate')}}">Crear</a>
    <a href="{{route('favoritasIndex', 1)}}">Mis Favoritas</a>
    <ul>
        @forelse ($peliculas as $pelicula)
        <li>{{$pelicula->titulo}}
            <a href="{{route('peliculaEdit', $pelicula->id)}}">Editar</a>
            <form action="{{route('peliculaDelete', $pelicula->id)}}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit">Eliminar</button>
            </form>
            
            @csrf
            <input type="text" id="tokenselect" value="{{ csrf_token() }}" hidden>
            <button onclick="guardarFavorito({{$pelicula->id}}, 1)">Agregar a favoritos</button>
            
        </li>
        @empty
        <p>Sin Peliculas Guardadas</p>
        @endforelse
    </ul>
@endsection

@section('scripts')
    <script src="{{asset('/scripts/scriptsPelicula.js')}}"></script>
@endsection