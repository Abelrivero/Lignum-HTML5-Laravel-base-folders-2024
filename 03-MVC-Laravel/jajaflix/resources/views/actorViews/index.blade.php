@extends('layouts.layouts')

@section('title', 'actores')

@section('content')
    <h1>Actores</h1>
    <a href="{{route('actorCreate')}}">Crear</a>

    <ul>
        @forelse ($actores as $actor)
            <li>{{$actor->nombre}}  
                <a href="{{route('actorEdit', $actor->id)}}" type="button">Editar</a>
                <form action="{{route('actorDelete', $actor->id)}}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Eliminar</button>
                </form>
            </li>
        @empty
            <p>No Hay Actores en la Base de Datos</p>
        @endforelse
    </ul>
@endsection