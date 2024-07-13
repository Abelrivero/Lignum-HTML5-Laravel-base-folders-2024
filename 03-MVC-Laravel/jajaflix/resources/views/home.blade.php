@extends('layouts.layouts')

@section('title', 'home')

@section('content')
    <a href="{{route('login')}}">Ingreso</a>
    <a href="{{route('registro')}}">Registro</a>
    <h1>BIENVINIDO</h1>
@endsection