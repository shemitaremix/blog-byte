@extends('adminlte::page')


@section('title', 'Bytecoders')

@section('content_header')
    <h1>Crear etiqueta</h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        {!! Form::open(['route' => 'admin.etiquetas.agregar']) !!}
        @include('admin.etiqueta.partials.forms')

        {!! Form::submit('crear etiqueta', ['class' => 'btn btn-primary']) !!}
    {!! Form::close() !!}
    </div>
</div>
@stop





@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script src="{{asset('vendor/jQuery-Plugin-stringToSlug-1.3/jquery.stringToSlug.min.js')}}"></script>

    <script>
        $(document).ready( function() {
            $("#nombre").stringToSlug({
                setEvents: 'keyup keydown blur',
                getPut: '#slug',
                space: '-'
            });
        });
    </script>
@stop
