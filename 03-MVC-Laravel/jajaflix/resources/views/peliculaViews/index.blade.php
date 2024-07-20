@extends('layouts.layouts')

@section('title', 'peliculas')

@section('content')
    <h1>Peliculas</h1>
    <a href="{{route('peliculaCreate')}}">Crear</a>
    <a href="{{route('favoritasIndex', 1)}}">Mis Favoritas</a>
    <div id='listPelicula'>
        <ul>
            @forelse ($peliculas as $pelicula)
            <li>{{$pelicula->titulo}}
                <button type="button" class="btn btn-primary" onclick="Livewire.dispatch('showPelicula', {idPelicula: {{$pelicula->id}}})">
                    Editar
                </button>
                {{-- <a href="{{route('peliculaEdit', $pelicula->id)}}">Editar</a> --}}
                <form action="{{route('peliculaDelete', $pelicula->id)}}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                </form>
                
                @csrf
                <input type="text" id="tokenselect" value="{{ csrf_token() }}" hidden>
                <button onclick="guardarFavorito({{$pelicula->id}}, 1)" class="btn btn-warning">Agregar a favoritos</button>
    
                
            </li>
            @empty
            <p>Sin Peliculas Guardadas</p>
            @endforelse
        </ul>
    </div>
@endsection

<livewire:PeliculaEdit/>

@section('scripts')
    <script src="{{asset('/scripts/scriptsPelicula.js')}}"></script>
@endsection