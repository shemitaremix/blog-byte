@extends('layouts.app')

@section('titulo')
INICIO DE SESION
@endsection

@section('inicio_sesion')
<div class="content">
    <div class="container">
        <div class="row">
            <div class="col-md-6 order-md-2">
                <img src="assets/images/undraw_file_sync_ot38.svg" alt="Image" class="img-fluid">
            </div>
            <div class="col-md-6 contents">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="mb-4">
                            <h3>Inicio de sesión <strong>Bytecorders</strong></h3>
                            <p class="mb-4">Inicia sesión para poder explorar nuestro Blog</p>
                        </div>

                        <form class="login100-form validate-form" method="POST" action="{{ route('login') }}">
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

                                <label for="password">Contraseña</label>
                                <div class="form-group last mb-4" data-validate="Password is required">

                                    <input placeholder="Tu contraseña" id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="current-password">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                            <div class="d-flex mb-5 align-items-center">


                                @if (Route::has('password.request'))
                                <span class="ml-auto"><a class="forgot-pass" href="{{ route('password.request') }}">
                                        {{ __(' Olvidaste tu Contraseña?') }}
                                    </a>
                                </span>
                                @endif
                            </div>

                            <input type="submit" value="Iniciar Sesión" class="btn text-white btn-block btn-primary">

                            <span class="d-block text-left my-4 text-muted"> Iniciar sesion con:</span>

                            <div class="social-login">
                                <a href="{{ route('login_facebook') }}" class="facebook">
                                    <span class="icon-facebook mr-3"></span>
                                </a>
                                <a href="{{ route('login_github') }}" class="twitter">
                                    <span class="icon-github mr-3"></span>
                                </a>
                                <a href="{{ route('login_google') }}" class="google">
                                    <span class="icon-google mr-3"></span>
                                </a>
                            </div>

                            @if (Route::has('register'))
                            <p class="text-center mt-4">
                                <a href="{{ route('register') }}">
                                    {{ __('¿No tienes una cuenta? Regístrate') }}
                                </a>
                            </p>
                            @endif


                    </div>
                </div>

            </div>

        </div>
    </div>
</div>
</form>
@endsection
