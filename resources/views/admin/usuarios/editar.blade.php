@extends('adminlte::page')


@section('title', 'Bytecoders')

@section('content_header')
    <h1>Asignacion de rol</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <h5>Nombre: {{$editar->name}}</h5>
            <br>
            <h2 class="h5">Listado de Roles</h2>
            {!! Form::model($editar, ['route' => ['admin.usuarios.actualizar', $editar->id],'class' => 'form-asignar']) !!}
            @foreach ($roles as $rol)
                <div class="">
                    <label for="">
                        {!! Form::checkbox('roles[]', $rol->id, null, ['class' => 'mr-1']) !!}
                        {{$rol->name}}
                    </label>
                </div>
            @endforeach
            {!! Form::submit('Asignar rol', ['class'=> 'btn btn-primary mt-3']) !!}

            {!! Form::close() !!}
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script src="../assets/sweetalert/sweetalert.min.js"></script>
    <script src="../js/jquery-3.0.0.min.js"></script>
    <script src="{{ asset('vendor/jQuery-Plugin-stringToSlug-1.3/jquery.stringToSlug.min.js') }}"></script>
    <script> console.log('Hi!'); </script>
    <script>
        $(document).ready(function() {
            $("#submit").click(function(){
                Swal.fire(
                    'Se guardaron los cambios!!',
                    'hecho!',
                    'success'
                    );
            });
        });
        // @if(Session::has('exito'))
        //     Swal.fire({
        //         icon: 'success',
        //         title: "{{Session::get('exito')}}",
        //         button: "Cerrar",
        //         timer: 1500
        //     });
        // @elseif(Session::has('error'))

        //         Swal.fire({
        //             icon: 'error',
        //             title: "{{Session::get('error')}}",
        //             button: "Cerrar",
        //         });

        // @endif

        $('.form-asignar').on('submit', function(e){
            e.preventDefault();
            Swal.fire({
                title: '¿Seguro que desea asignar el rol?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, asignar!'
            }).then((result) => {
                if(result.value == true){
                    this.submit();
                }
            });
        });
    </script>
@stop
