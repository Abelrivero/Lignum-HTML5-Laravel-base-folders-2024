@extends('layouts.layouts')

@section('title', 'actores')

@section('content')
<div class="container">
    <h1 class="text-center fw-bold">Actores</h1>
    <div class="d-flex justify-content-center">
        <nav aria-label="Page navigation example">
            <ul class="pagination" id="ulLinks">
              {{-- <li class="page-item"><a class="page-link" href="#">Previous</a></li>
              <li class="page-item"><a class="page-link" href="#">1</a></li>
              <li class="page-item"><a class="page-link" href="#">2</a></li>
              <li class="page-item"><a class="page-link" href="#">3</a></li>
              <li class="page-item"><a class="page-link" href="#">Next</a></li> --}}
            </ul>
          </nav>
        {{-- {{$actores->links()}} --}}
    </div>
    <div class="d-flex justify-content-between m-3">
        <div class="col-sm-6 col-md-8">
            <input type="text" placeholder="Buscar Actor" class="form-control" id="buscador">
            <p id="textBuscador" class="text-danger"></p>
        </div>
        <div class="float-end">
            <a href="{{route('actorCreate')}}" role="button" class="btn btn-outline-success">Crear</a>
        </div>
    </div>
    <div id="listActor"> 
        <table class="table text-white">
            <thead>
              <tr>
                <th scope="col"><i class="bi bi-arrow-down-up" onclick="ordenarTabla()" style="cursor:pointer"></i> ID</th>
                <th scope="col">Nombre</th>
                <th scope="col"><a onclick="ordenarTabla()" style="cursor: pointer">x</a> Fecha de Nacimiento</th>
                <th scope="col" class="text-center">Acciones</th>
              </tr>
            </thead>
            <tbody id="tbodyVacio">

            </tbody>
            <tbody id="tbodyTablaActor">
                {{-- @forelse ($actores as $actor)
                <tr>
                    <th scope="row">{{$actor->id}}</th>
                    <td>{{$actor->nombre}}</td>
                    <td>{{$actor->fechaNacimiento}}</td>
                    <td>
                        <div class="d-flex justify-content-md-end">
                            <button type="button" class="btn btn-primary me-3" onclick="showActor({{$actor->id}})">
                                Editar
                            </button>
                            <form action="{{route('actorDelete', $actor->id)}}" method="POST" class="formEliminarActor">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Eliminar</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                    <tr>
                        <td>Sin Actores Gruadados</td>
                    </tr>
                @endforelse --}}
            </tbody>
          </table>
        <div class="d-flex justify-content-center py-3">
            {{-- {{$actores->links()}} --}}
        </div>
    </div>
        @component('componentes.modal')
        @slot('modalTitle', 'Editar Actor')

        @slot('botonCerrar')
            <button type="button" class="btn-close" onclick="cerrarModal()"></button>
        @endslot

        @slot('modalBody')
        <ul id="ulErrors">
        </ul>
        <label for="" class="label">
            <input type="text" placeholder=" " class="input" id="nombre">
            <span class="spanName">Nombre</span>
        </label>

        <label for="" class="label">
            <input type="date" name="fechaNacimiento" id="fechaNacimiento" class="input">
            {{-- <input type="date" placeholder=" "  id="nombre"> --}}
            <span class="spanName">Fecha</span>
        </label>
        
        @endslot

        @slot('modalCerrar')
            <button type="button" class="btn btn-secondary" onclick="cerrarModal()">Cerrar</button>
        @endslot

        @slot('modalBotonGuardar')
            <button type="button" id="btn-edit" class="btn btn-primary" onclick="guardarActor()">Editar Actor</button>
        @endslot
    @endcomponent
</div>
@endsection

@section('scripts')
    <script src="{{asset('/scripts/scriptsActor.js')}}"></script>
    @if (session('storeActor'))
        <script>
            alertSwalSuccess('{{session("storeActor")}}')
        </script>
    @endif
    @if (session('actorDelete'))
        <script>
            alertSwalSuccess('{{session("actorDelete")}}')
        </script>
    @endif
@endsection