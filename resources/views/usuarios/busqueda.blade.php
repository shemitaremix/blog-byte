@extends('layouts.layout') @section('Nombre', 'Busqueda') @section('contenido')

<!-- Content
		============================================= -->
<section id="content">
    <div class="content-wrap">
        <div class="container clearfix">

            @if ($publi->count() > 0)
            @foreach ($publi as $publicacion)
            <div class="tab-pane fade show active" id="nav-outdoor" role="tabpanel"
                aria-labelledby="nav-outdoor-tab">
                <div class="row col-mb-30 mb-0">
                    <div class="col-lg-12">
                        <!-- Post Article -->
                        <div class="entry col-12">
                            <div class="grid-inner">
                                <div class="entry-image">
                                    <a href="images/blog/full/17.jpg" data-lightbox="image"><img  @if($publicacion->imagenes!=null) src="{{asset('/imgblog/'. $publicacion->imagenes->url)}}" @else src="https://cdn.pixabay.com/photo/2017/05/30/03/58/blog-2355684_960_720.jpg" @endif style="object-fit:cover; height:2000px; width:2500px; min-height: 600px; max-height: 200px" alt="Standard Post with Image"></a>
                                </div>
                                <div class="entry-title">
                                    <h2><a href="{{route('publicaciones.mostrar', $publicacion)}}">{{$publicacion->nombre}}</a></h2>
                                </div>
                                <div class="entry-meta">
                                    <ul>
                                        <li><i class="icon-calendar3"></i> {{$publicacion->created_at->toDateString()}}</li>
                                        <li><a href="{{route('autor', $publicacion->user_id)}}"><i class="icon-user"></i> {{$publicacion->user->name}}</a></li>

                                        <li><i class="icon-folder-open"></i>
                                            @foreach($publicacion->etiquetas as $etiqueta)
                                            <a href="{{route('categoria', $publicacion->categoria_id)}}">{!!$etiqueta->nombre!!}</a></li>
                                            @endforeach

                                    </ul>
                                </div>
                                <div class="entry-content">
                                    <p>{!!$publicacion->tema!!}</p>
                                    <a href="{{route('publicaciones.mostrar', $publicacion)}}" class="more-link">Leer mas</a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                </div>
            @endforeach
            @else


                <div class="alert alert-success">
                    <strong>{{session('error')}}</strong>
                </div>

                <input type="submit" value="Regresar" onclick="location.href='{{ route('index') }}'" class="btn text-white btn-block btn-primary">

            @endif

        </div>
    </div>
</section>


</section>
@endsection
