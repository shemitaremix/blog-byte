@extends('adminlte::page')


@section('title', 'Bytecoders')

@section('content_header')
    <h1>Listado de publicaciones</h1>
@stop

@section('content')
    @livewire('admin.publicaciones-index')
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
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
    $('.form-eliminar').on('submit', function(e){
        e.preventDefault();
        Swal.fire({
            title: '¿Estás seguro?',
            text: "¡No podrás revertir esto!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, eliminarlo!'
        }).then((result) => {
            if(result.value == true){
                this.submit();
            }
        });
    });
</script>
@stop
