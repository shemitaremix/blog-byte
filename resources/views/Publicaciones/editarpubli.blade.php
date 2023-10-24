@extends('layouts.layout')
@section('Nombre',"Editar Publicación")

@section('contenido')

    <div class="card">
        <div class="card-body">
            {!! Form::model($publicaciones, ['route' => ['publicacion.actualizar', $publicaciones->id], 'method' => 'put', 'files' => true ]) !!}

                {!! Form::hidden('user_id', auth()->user()->id) !!}

                    @include('Publicaciones.partials.formulario')
                {{-- {!! Form::submit('Guardar', ['class' => 'button button-3d button-rounded gradient-purple-blue']) !!} --}}
                <button name="submit" type="submit" id="submit" tabindex="5" value="Submit" class="button button-3d button-rounded gradient-purple-blue">Guardar cambios</button>

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
                    'Se Edito con exito!!',
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

