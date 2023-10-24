@extends('layouts.layout')
@section('Nombre', 'Crear Publicación')

@section('css')
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css"
        integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
    <style>
        html,
        body {
            min-height: 100%;
        }

        body,
        div,
        form,
        input,
        select,
        /* p {
            padding: 0;
            margin: 0;
            outline: none;
            font-family: Roboto, Arial, sans-serif;
            font-size: 16px;
            color: #eee;
        } */

        body {
            background-image: url({{ asset('images/sf1.png') }}) no-repeat center;
            background-size: cover;
        }

        h1,
        h2 {
            text-transform: uppercase;
            font-weight: 400;
        }

        h2 {
            margin: 0 0 0 8px;
        }

        .main-block {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100%;
            padding: 25px;
            background: rgba(253, 254, 254);
        }

        .left-part,
        form {
            padding: 25px;
        }

        .left-part {
            text-align: center;
        }

        .fa-graduation-cap {
            font-size: 72px;
        }

        form {
            background: rgba(247, 249, 249);
        }

        .title {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }

        .info {
            display: flex;
            flex-direction: column;
        }

        input,
        select {
            padding: 5px;
            margin-bottom: 30px;
            background: transparent;
            border: none;
            border-bottom: 1px solid #eee;
        }

        input::placeholder {
            color: #eee;
        }

        option:focus {
            border: none;
        }

        option {
            background: white;
            border: none;
        }

        .checkbox input {
            margin: 0 10px 0 0;
            vertical-align: middle;
        }

        .checkbox a {
            color: #26a9e0;
        }

        .checkbox a:hover {
            color: #85d6de;
        }

        .btn-item,
        button {
            padding: 10px 5px;
            margin-top: 20px;
            border-radius: 5px;
            border: none;
            background: #26a9e0;
            text-decoration: none;
            font-size: 15px;
            font-weight: 400;
            color: #fff;
        }

        .btn-item {
            display: inline-block;
            margin: 20px 5px 0;
        }

        button {
            width: 100%;
        }

        button:hover,
        .btn-item:hover {
            background: #85d6de;
        }

        @media (min-width: 568px) {

            html,
            body {
                height: 100%;
            }

            .main-block {
                flex-direction: row;
                height: calc(100% - 50px);
            }

            .left-part,
            form {
                flex: 1;
                height: auto;
            }
        }
    </style>
@endsection

@section('contenido')

    <div class="main-block">
        {{-- <div class="left-part">
            <i class="fas fa-graduation-cap"></i>
            <h1>¡Que esperas!</h1>
            <p>AGREGA UNA PUBLICACION Y COMPARTENOS TU PUNTO DE OPINION</p>
        </div> --}}
        {!! Form::open(['route' => 'publicacion.nueva', 'autucomplete' => 'off', 'files' => true, 'id'=>'form-publi']) !!}
        {!! Form::hidden('user_id', auth()->user()->id) !!}
        <div class="title">
            <i class="fas fa-pencil-alt"></i>
            <h2>Crea tu publicación</h2>
        </div>
        <div class="info">
            <div class="container">
                <div class="row align-items-start">
                    <div class="col">
                        {!! Form::label('nombre', 'Titulo: ') !!}
                        {!! Form::text('nombre', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el titulo del post']) !!}

                        @error('nombre')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror

                        {!! Form::label('slug', 'Slug: ') !!}
                        {!! Form::text('slug', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el slug del post', 'readonly']) !!}

                        @error('slug')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                        {!! Form::label('categoria_id', 'Categoria: ') !!}
                        {!! Form::select('categoria_id', $categorias, null, ['class' => 'form-control', 'placeholder' => 'seleccione la categoria']) !!}

                        @error('categoria_id')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                        {!! Form::label('etiqueta_id', 'Etiqueta: ') !!}
                        @foreach ($etiquetas as $etiqueta)
                            <div class="form-check">
                                <label class="form-check-label">
                                    {!! Form::checkbox('etiquetas[]', $etiqueta->id, null) !!}
                                    {{ $etiqueta->nombre }}
                                </label>
                            </div>
                        @endforeach
                        {!! Form::label('Estado: ') !!}
                        <br>
                        <label>
                            {!! Form::radio('status', 1, true) !!}
                            Borrador
                        </label>

                        <label>
                            {!! Form::radio('status', 2) !!}
                            Publicación
                        </label>
                        @error('status')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                        @error('etiquetas')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col">
                        <div class="col">
                            {!! Form::label('file', 'Imagen que se mostrara en el post') !!}
                            <br>
                            <div class="image-wrapper">
                                <img id="picture" src="/images/post.jpg" alt="">
                                <br><br>
                                <p>Selecciona la imagen que deseas publicar</p>
                                <br>
                                {!! Form::file('file', ['class' => 'form-control-file', 'accept' => 'image/*']) !!}
                            </div>

                            @error('file')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                </div>
            </div>

            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        {!! Form::label('tema', 'Tema:') !!}
                        <!-- el tema no debe de tener mas de 255 caracteres  -->

                        {!! Form::textarea('tema', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el Tema de la publicacion', 'maxlength' => '255']) !!}
                        @error('tema')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                        <br>
                    </div>
                    <div class="col-sm-6 order-5">
                        {!! Form::label('contenido', 'Contenido:') !!}
                        {!! Form::textarea('contenido', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el Contenido de la publicacion', 'maxlength' => '255']) !!}
                        @error('contenido')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
            </div>


        </div>
        <br>
        <div class="d-grid gap-2 col-6 mx-auto">
            {{-- {!! Form::submit('Crear Publicacion', ['class' => 'button button-3d button-rounded gradient-purple-blue center']) !!} --}}
            <button name="submit" type="submit" id="submit" tabindex="5" value="Submit" class="button button-3d button-rounded gradient-purple-blue center">Crear Publicacion</button>
            {!! Form::close() !!}
        </div>
    </div>




@endsection
@section('scripts')
    <script src="https://cdn.ckeditor.com/ckeditor5/34.1.0/classic/ckeditor.js"></script>
    <script src="{{ asset('vendor/jQuery-Plugin-stringToSlug-1.3/jquery.stringToSlug.min.js') }}"></script>
    <script>

        $(document).ready(function() {
            $("#nombre").stringToSlug({
                setEvents: 'keyup keydown blur',
                getPut: '#slug',
                space: '-'
            });
            $("#submit").click(function(){
                Swal.fire(
                    'Se Publico con exito!!',
                    'hecho!',
                    'success'
                    );
            });
        });

        ClassicEditor
            .create(document.querySelector('#contenido'),{
                toolbar:[
                    'heading',
                    '|',
                    'bold',
                    'italic',
                    'link',
                    'bulletedList',
                    'numberedList',
                    'undo',
                    'redo'
                ],
                options: [
                    {model: 'heading1', view: 'h2', title: 'Heading 1', class: 'ck-heading_heading1'},
                    {model: 'heading2', view: 'h3', title: 'Heading 2', class: 'ck-heading_heading2'},
                ]
            })
            .catch(error => {
                console.error(error);
            });

        ClassicEditor
            .create(document.querySelector('#tema'),{
                toolbar:[
                    'heading',
                    '|',
                    'bold',
                    'italic',
                    'link',
                    'bulletedList',
                    'numberedList',
                    'undo',
                    'redo'
                ],
                options: [
                    {model: 'heading1', view: 'h2', title: 'Heading 1', class: 'ck-heading_heading1'},
                    {model: 'heading2', view: 'h3', title: 'Heading 2', class: 'ck-heading_heading2'},
                ]
            })
            .catch(error => {
                console.error(error);
            });

        //cambiar imagen
        document.getElementById("file").addEventListener('change', cambiarImagen);

        function cambiarImagen(event) {
            var file = event.target.files[0];

            var reader = new FileReader();
            reader.onload = (event) => {
                document.getElementById("picture").setAttribute("src", event.target.result);
            };
            reader.readAsDataURL(file);
        }

        //validar que los campos no superen los 255 caracteres antes de enviar el formulario con el id form-publi
        @if (Session::has('error'))
            Swal.fire({
                title: '{{ Session::get('error') }}',
                icon: 'error',
                confirmButtonText: 'Ok'
            });

        @endif

    </script>
@endsection

<!DOCTYPE html>
<html>

<body>

</html>



