<div class="title">
    <i class="fas fa-pencil-alt"></i>
    <h2>Edita tu publicación</h2>
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

    <div class="container">
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
