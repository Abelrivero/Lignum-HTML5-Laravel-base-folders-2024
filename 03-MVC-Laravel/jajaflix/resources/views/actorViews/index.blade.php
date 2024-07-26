@extends('layouts.layouts')

@section('title', 'actores')

@section('content')
<div class="container">
    <h1 class="text-center fw-bold">Actores</h1>
    <div class="d-flex justify-content-md-end">
        <a href="{{route('actorCreate')}}" role="button" class="btn btn-outline-success">Crear</a>
    </div>
    <div id="listActor">
        <table class="table text-white">
            <thead>
              <tr>
                <th scope="col">ID</th>
                <th scope="col">Nombre</th>
                <th scope="col">Fecha de Nacimiento</th>
                <th scope="col" class="text-center">Acciones</th>
              </tr>
            </thead>
            <tbody>
                @forelse ($actores as $actor)
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
                @endforelse
            </tbody>
          </table>
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
    @if (session('exito'))
    <script>
        alertSwalSuccess('{{session("exito")}}')
    </script>
    @endif
    <script src="{{asset('/scripts/scriptsActor.js')}}"></script>
@endsection