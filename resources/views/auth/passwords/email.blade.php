@extends('layouts.correocontrasenia')

@section('titulo')
Recuperar contraseña
@endsection

@section('recuperar.contraseñaa')

<div class="content">
    <div class="container">
        <div class="row">
            <div class="col-md-6 order-md-2">
                <img src="/assets/images/undraw_file_sync_ot38.svg" alt="Image" class="img-fluid">
            </div>
            <div class="col-md-6 contents">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="mb-4">
                            <h3>Recupera tu contraseña con <strong>Bytecorders</strong></h3>
                            <p class="mb-4">Recupera tu contraseña para explorar nuestro blog</p>
                        </div>

                        <form class="login100-form validate-form" method="POST" action="{{ route('password.email') }}">
                            @csrf
                            <label for="email">Correo Electrónico</label>
                                <div class="form-group first" data-validate="Email is required">
                                    <input placeholder="Tu correo" id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror " name="email"
                                        value="{{ old('email') }}" required autocomplete="email" autofocus>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            <input type="submit" value="Aceptar" class="btn text-white btn-block btn-primary"><br>
                            <input onclick="location.href='{{ route('login') }}'" type="submit" value="Regresar" class="btn text-white btn-block btn-primary"><br>
                            <div class="form-group last mb-4" data-validate="Password is required">
                        <br>
                        
                        <div class="form-group last mb-4">
                    
                    </div>
                    </div>
                    <!--iniciar sesion-->


                </div>




                <!-- </div>
            <input type="submit" value="Iniciar Sesion" class="btn text-white btn-block btn-primary" onclick="location.href='{{ route('login') }}'">
            </div> -->

            </div>
        </div>
    </div>
    </form>


    @endsection



