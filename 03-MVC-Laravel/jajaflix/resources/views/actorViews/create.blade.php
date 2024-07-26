@extends('layouts.layouts')

@section('title', 'Crear Actor')

{{-- TODO: agregar valor anterior (old) a todo los input --}}
@section('content')
<div class="container">
    <a href="{{route('actorIndex')}}">Atras</a>
    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </ul>
    @endif
    <form method="POST" action="{{route('actorStore')}}" class="formCrearActor">
        @csrf
        <div class="row mb-3 col-6">
            <label for="nombre">Nombre (*)</label>
            <input type="text" id="nombre" name="nombre" value="{{old('nombre')}}">
        </div>
        <div class="row mb-3 col-6">
            <label for="fechaNacimiento">Fecha de Nacimiento (*)</label>
            <input type="date" id="fechaNacimiento" name="fechaNacimiento">
        </div>
        <button type="submit" >Guardar</button>
    </form>
</div>
@endsection

@section('scripts')
    <script src="{{asset('/scripts/scriptsActor.js')}}"></script>
@endsection