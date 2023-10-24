@extends('adminlte::page')


@section('title', 'Bytecoders')

@section('content_header')
    <h1>Etiquetas</h1>
@stop

@section('content')

    @livewire('admin.etiquetas-index')
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script src="../assets/sweetalert/sweetalert.min.js"></script>
    <script src="../js/jquery-3.0.0.min.js"></script>
    <script> console.log('Hi!'); </script>
    <script>
        @if(Session::has('success'))
            Swal.fire({
                icon: 'success',
                title: "{{Session::get('success')}}",
                button: "Cerrar",
                timer: 1500
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
