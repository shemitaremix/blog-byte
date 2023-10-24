@extends('adminlte::page')


@section('title', 'Bytecoders')

@section('content_header')
    <h1>Bytecoders</h1>
@stop

@section('content')
    <p>Bienvenido al panel de administrador {{Auth::user()->name}}</p>

    <p>Aquí se muestran todas las publicaciones del blog</p>

    @livewire('admin.publicaciones-index')



@stop




@section('js')
    <script> console.log('Hi!'); </script>
@stop
