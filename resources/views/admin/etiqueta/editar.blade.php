@extends('adminlte::page')


@section('title', 'Bytecoders')

@section('content_header')
    <h1>Editar etiqueta</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            {!! Form::model($etiqueta, ['route' => ['admin.etiquetas.actualizar', $etiqueta->id ]]) !!}
                <input name="id" type="hidden" value="{{$etiqueta->id}}">
                @include('admin.etiqueta.partials.forms')
                {!! Form::submit('Editar etiqueta', ['class'=> 'btn btn-primary']) !!}
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
    <script src="../assets/sweetalert/sweetalert.min.js"></script>

    <script>
        @if(Session::has('exito'))
            Swal.fire({
                icon: 'success',
                title: "{{Session::get('exito')}}",
                button: "Cerrar",
            });
        @elseif(Session::has('error'))
            
                Swal.fire({
                    icon: 'error',
                    title: "{{Session::get('error')}}",
                    button: "Cerrar",
                });
            
        @endif

        
    </script>
@stop
