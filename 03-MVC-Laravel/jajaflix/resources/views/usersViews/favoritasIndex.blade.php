@extends('layouts.layouts')

@section('title', 'Favoritas')

@section('content')
    <h1>Tus Favoritas</h1>
    <a href="{{route('peliculaIndex')}}">Peliculas</a>
    @if (session('success'))
    <script>
        alert({{session('success')}})
    </script>
    @endif
    <ul>
        @forelse ($peliculasFav as $fav)
        <li>{{$fav->peliculasFavoritas->titulo}}
            <form action="{{route('favoritasEliminar', [$fav->id, $fav->usuarioId])}}" method="POST">
                @csrf
                @method('DELETE')
                
                <button type="submit">Eliminar</button>
            </form>
        </li>
        @empty
        <p>No tienes Peliculas Favoritas</p>
        @endforelse
    </ul>
@endsection

@section('scripts')
    <script src="{{asset('/scripts/scriptsPelicula.js')}}"></script>
@endsection