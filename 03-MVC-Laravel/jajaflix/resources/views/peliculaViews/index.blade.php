@extends('layouts.layouts')

@section('title', 'peliculas')

@section('content')
    <div id='listPelicula' class="container">
        <h1 class="text-center fw-bold">PELICULAS</h1>
        <div class="row justify-content-between">
            <div class="col-4">
                <a href="{{route('favoritasIndex', 1)}}" role="button" class="btn btn-outline-warning">Mis Favoritas</a>
            </div>
            <div class="col-4">
                <a href="{{route('peliculaCreate')}}" role="button" class="btn btn-outline-success float-end">Crear</a>
            </div>
        </div>
        <div class="row justify-content-between mt-3">
            @forelse ($peliculas as $pelicula)
            <div class="card mb-3" style="max-width: 540px;">
                <div class="row g-0">
                  <div class="col-md-4">
                    <img src="{{asset($pelicula->imagen)}}" class="img-fluid rounded float-start mt-4" alt="...">
                  </div>
                  <div class="col-md-8 text-dark">
                    <div class="card-body">
                      <h5 class="card-title">{{$pelicula->titulo}}</h5>
                      <p class="card-text .overflow-y-auto">{{$pelicula->sinopsis}}</p>
                      <p class="card-text"><small class="text-body-secondary">Estreno: {{$pelicula->anio}}  Duracion: {{$pelicula->duracion}} min.</small></p>
                      <p class="card-text"><small class="text-body-secondary">Actor Principal: {{$pelicula->actor->nombre}}</small></p>
                    </div>
                  </div>
                  <div class="row justify-content-end">
                    <div class="col-4">
                        <button type="button" class="btn btn-primary float-end" onclick="Livewire.dispatch('showPelicula', {idPelicula: {{$pelicula->id}}})">
                        Editar
                        </button>
                    </div>
                    <div class="col-4">
                        <form action="{{route('peliculaDelete', $pelicula->id)}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Eliminar</button>
                        </form>
                    </div>
                </div>
                <div class="row mb-3">
                    @csrf
                    <input type="text" id="tokenselect" value="{{ csrf_token() }}" hidden>
                    <button onclick="guardarFavorito({{$pelicula->id}}, 1)" class="btn btn-warning">Agregar a favoritos</button> 
                </div>
                </div>
              </div> 
            @empty
                <p>Sin Peliculas En Base de Datos</p>
            @endforelse
        </div>
    </div>
@endsection

<livewire:PeliculaEdit/>

@section('scripts')
    <script src="{{asset('/scripts/scriptsPelicula.js')}}"></script>
@endsection