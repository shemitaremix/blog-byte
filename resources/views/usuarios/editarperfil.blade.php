@extends('layouts.layout')
@section('Nombre', 'Editar perfil')
@section('contenido')
    <br>
    <br>
    <section id="content">
                <div class="form-widget">

                    <div class="row">
                        {!! Form::model($usuario, ['route' => 'usuario.actualizar', 'method' => 'put', 'files' => true]) !!}
                        <div class="form-process">
                            <div class="css3-spinner">
                                <div class="css3-spinner-scaler"></div>
                            </div>
                        </div>
                        <div class="container">
                            <h1>Editar perfil</h1>
                            <div class="row align-items-start">
                                <div class="col">
                                    <div class="col-6 form-group">
                                        {!! Form::label('name', 'Usuario:') !!}
                                        {!! Form::text('name', null, ['class' => 'form-control required', 'placeholder' => 'Ingresa tu nombre de usuario']) !!}
                                    </div>
                                    <div class="col-12 form-group">
                                        {!! Form::label('email', 'Correo:') !!}
                                        {!! Form::text('email', null, ['class' => 'form-control required', 'placeholder' => 'Ingresa tu correo']) !!}
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            {!! Form::label('biografia', 'BIOGRAFIA:') !!}
                                            {!! Form::textarea('biografia', null, ['class' => 'form-control', 'cols' => '30', 'rows' => '5']) !!}
                                        </div>
                                    </div>
                                    <div class="col-12 d-none">
                                        <input type="text" id="event-registration-botcheck"
                                            name="event-registration-botcheck" value="" />
                                    </div>
                                </div>
                                <div class="col">
                                    {!! Form::label('file', 'Imagen que se mostrara en el perfil de usuario') !!}
                                    <br>
                                    <div class= "col-md-6">
                                        <img class="img-fluid" id="picture" src="/imgusu/perfil.jpg" alt="">
                                        <br><br>
                                        {!! Form::file('file', ['class' => 'form-control-file', 'accept' => 'image/*']) !!}
                                      </div>

                                    @error('file')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <a href="{{ route('perfil') }}"> <button name="submit" type="submit" id="submit"
                                        tabindex="5" value="Submit" class="btn btn-primary mt-3">Editar
                                        perfil</button></a>
                            </div>

                            <input type="hidden" name="prefix" value="event-registration-">
                            {!! Form::close() !!}
                        </div>

                    </div>



                </div>

        </div>
    </section>
    <br>
    <br>
@endsection
@section('scripts')
    <!-- Scrip para alertas de sweetAlert-->
    <script src="{{ asset('vendor/jQuery-Plugin-stringToSlug-1.3/jquery.stringToSlug.min.js') }}"></script>
    <script src="../assets/sweetalert/sweetalert.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#submit").click(function() {
                Swal.fire(
                    'Se guardaron los cambios con exito!!',
                    'hecho!',
                    'success'
                );
            });
        });
    </script>
    <script>
        document.getElementById("file").addEventListener('change', cambiarImagen);

        function cambiarImagen(event) {
            var file = event.target.files[0];

            var reader = new FileReader();
            reader.onload = (event) => {
                document.getElementById("picture").setAttribute("src", event.target.result);
            };
            reader.readAsDataURL(file);
        }
    </script>
@endsection
