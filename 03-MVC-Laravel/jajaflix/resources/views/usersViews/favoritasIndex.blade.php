@extends('layouts.layouts')

@section('title', 'Favoritas')

@section('content')
    <h1>Tus Favoritas</h1>
    <a href="{{route('peliculaIndex')}}">Peliculas</a>
    
    <ul>
        @forelse ($peliculasFav as $fav)
        <li>{{$fav->peliculasFavoritas->titulo}}
            <form action="{{route('favoritasEliminar', [$fav->id, $fav->usuarioId])}}" method="POST">
                @csrf
                @method('DELETE')
                
                <button type="submit">Eliminar</button>
            </form>
            {{-- <input type="text" value="{{ csrf_token() }}" id="tokenselect" hidden>
            <button onclick="eliminarFavorita({{$fav->id}})" id="btnEliminarFav" type="button">Eliminar</button> --}}
        </li>
        @empty
        <p>No tienes Peliculas Favoritas</p>
        @endforelse
    </ul>
@endsection

@section('scripts')
 {{--    @if (session('success'))
    <script>
        alert({{session('success')}})
    </script>
    @endif --}}
    <script src="{{asset('/scripts/scriptsPelicula.js')}}"></script>
@endsection