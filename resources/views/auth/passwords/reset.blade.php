@extends('layouts.correocontrasenia')

@section('titulo')
Recuperar contraseña
@endsection

@section('recuperar.contraseña')

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
                            <h3>Recuperar Contraseña con <strong>Bytecorders</strong></h3>
                            <p class="mb-4">Ingresa tu nueva contraseña</p>
                        </div>

                        <form class="login100-form validate-form" method="POST" action="{{ route('password.update') }}">
                            @csrf
                            <input type="hidden" name="token" value="{{ $token }}">
                            <label for="email">Correo Electrónico</label>
                                <div class="form-group first" data-validate="Email is required">
                                    <input placeholder="Tu correo" id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror " name="email"
                                        value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus >
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                            <label for="password">Contraseña</label>
                                <div class="form-group first" data-validate="Password is required">
                                    <input placeholder="Tu contraseña" id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror " name="password"
                                        required autocomplete="new-password">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            <label for="password-confirm">Confirmar Contraseña</label>
                                <div class="form-group first" data-validate="Password is required">
                                    <input placeholder="Confirma tu contraseña" id="password-confirm" type="password"
                                        class="form-control @error('password') is-invalid @enderror " name="password_confirmation"
                                        required autocomplete="new-password">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div><br>

                            <input type="submit" value="Guardar" class="btn text-white btn-block btn-primary"><br>
                            <div class="form-group last mb-4" data-validate="Password is required">
                        <br>

                        <div class="form-group last mb-4">

                    </div>
                    </div>
                    <!--iniciar sesion-->



                </div>

            </div>
        </div>
    </div>
    </form>
    @endsection
