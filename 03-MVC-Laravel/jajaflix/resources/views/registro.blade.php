@extends('layouts.layouts')

@section('title', 'home')

@section('content')
    <h1>Registro</h1>
    <a href="{{route('home')}}">Atras</a>
    <form action="">
        <label for="">Nombre:</label>
        <input type="text">
        <br>

        <label for="">Emial:</label>
        <input type="email">
        <br>

        <label for="">Password:</label>
        <input type="text">
        <br>

        <label for="">Confirmar Password:</label>
        <input type="text" name="" id="">
        <br>

        <button type="submit">Registrase</button>
    </form>
@endsection