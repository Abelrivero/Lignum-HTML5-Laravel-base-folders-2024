@extends('layouts.layouts')

@section('title', 'actores')

@section('content')
    <h1>Actores</h1>
    <a href="{{route('actorCreate')}}">Crear</a>
    <div id="listActor">
        <ul>
            @forelse ($actores as $actor)
                <li>{{$actor->nombre}}  
                    {{-- <a href="{{route('actorEdit', $actor->id)}}" type="button" class="btn btn-primary">Editar</a> --}}
                    <button type="button" class="btn btn-primary" onclick="showActor({{$actor->id}})">
                        Editar
                    </button>
                    <form action="{{route('actorDelete', $actor->id)}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                    </form>
                </li>
            @empty
                <p>No Hay Actores en la Base de Datos</p>
            @endforelse
        </ul>
    </div>
    
@endsection

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

@section('scripts')
    <script src="{{asset('/scripts/scriptsActor.js')}}"></script>
@endsection