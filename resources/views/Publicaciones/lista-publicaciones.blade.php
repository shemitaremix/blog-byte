@extends('layouts.layout')

@section('nombre', 'Catalogo')
@section('contenido')

<!-- Content
============================================= -->
<section id="content">
    <div class="content-wrap">
        <div class="container clearfix">

            <!-- Posts
            ============================================= -->
            <div id="posts" class="post-grid row grid-container gutter-30" data-layout="fitRows">
                <h2>Publicaciones </h2>
                @foreach ($publicaciones as $publicacion)
                    <div class="entry col-lg-3 col-md-4 col-sm-6 col-12">
                        <div class="grid-inner">
                            <div class="entry-image">
                                <a href="{{route('publicaciones.mostrar', $publicacion)}}" data-lightbox="image"><img @if($publicacion->imagenes!=null) src="{{asset('/imgblog/'. $publicacion->imagenes->url)}}" @else src="https://cdn.pixabay.com/photo/2017/05/30/03/58/blog-2355684_960_720.jpg" @endif alt="Publicacion en Bytecoders" style="width: 25em; height: 20em;"></a>
                            </div>
                            <div class="entry-title">
                                <h2><a href="{{route('publicaciones.mostrar', $publicacion)}}">{{$publicacion->nombre}}</a></h2>
                            </div>
                            <div class="entry-meta">
                                <ul>
                                    <li><a href="{{route('autor', $publicacion->user_id)}}"><i class="icon-user"></i> {{$publicacion->user->name}}</a></li>
                                    <li><i class="icon-calendar3"></i> {{$publicacion->created_at->toDateString()}}</li>
                                    <li><i class="icon-like"></i> {{$publicacion->likes}}</a></li>

                                </ul>
                            </div>
                            <div class="entry-content">
                                <p>{!!$publicacion->tema!!}</p>
                                <a href="{{route('publicaciones.mostrar', $publicacion)}}" class="more-link">Leer Mas</a>
                            </div>
                        </div>
                    </div>
                @endforeach


            </div><!-- #posts end -->

            <!-- Pagination
            ============================================= -->
            <ul class="pagination mt-5 pagination-circle justify-content-center">
                <!-- crear paginacion -->
                {{$publicaciones->links()}}
            </ul>

        </div>
    </div>
</section><!-- #content end -->


@endsection