@extends('layouts.layout')
@section('Nombre', 'Perfil')
@section('contenido')

    <!-- Content
      ============================================= -->
    <section id="content">
        <div class="content-wrap">
            <div class="container clearfix">

                <div class="row clearfix">

                    <div class="col-md-9">

                         <img @if (auth()->user()->imagenesusu!=null) src="{{asset('/imgusu/'. auth()->user()->imagenesusu->url)}}" @else src="https://static.vecteezy.com/system/resources/previews/004/026/956/non_2x/person-avatar-icon-free-vector.jpg"  @endif  class="alignleft img-circle img-thumbnail my-0" alt="Avatar"
                                        style="max-width: 111px;">

                        <div class="heading-block border-0">
                            <h3>{{ auth()->user()->name }}</h3>
                            <span>{{ auth()->user()->email }}</span>
                        </div>

                        <div class="clear"></div>

                        <div class="row clearfix">

                            <div class="col-lg-12">

                                <div class="tabs tabs-alt clearfix" id="tabs-profile">

                                    <ul class="tab-nav clearfix">
                                        <li><a href="#tab-feeds"><i class="icon-rss2"></i>Biografia</a></li>
                                        <li><a href="#tab-posts"><i class="fas fa-fw fa-save"></i>Guardado</a></li>
                                    </ul>

                                    <div class="tab-container">

                                        <div class="tab-content clearfix" id="tab-feeds">

                                            @if (auth()->user()->biografia != null)
                                                <p>{{auth()->user()->biografia}}</p>
                                            @else
                                                <p>No cuenta con biografia actualmente</p>
                                            @endif



                                        </div>
                                        <div class="tab-content clearfix" id="tab-posts">
                                            <!-- Posts
                ============================================= -->
                                            <div class="row gutter-40 posts-md mt-1">

                                                <div class="section bg-transparent m-0">
                                                    <div class="container clearfix">
                                                        <h4 class="mb-3 ls1 text-uppercase fw-bold">Publicaciones Guardadas</h4>
                                                        <!-- Owl Carousel
                                              ============================================= -->
                                                        <div id="oc-news" class="owl-carousel fixed-nav top-nav carousel-widget posts-md customjs">
                                                            <!-- Post Article -->


                                                            @foreach ($publicaciones as $publicacion)
                                                                <div class="entry mb-0"
                                                                @if($publicacion->imagenes!=null)
                                                                    style="background: url('{{asset('/imgblog/'. $publicacion->imagenes->url)}}') center center; background-size: cover; height: 400px;"
                                                                @else
                                                                    style="background: url('https://cdn.pixabay.com/photo/2017/05/30/03/58/blog-2355684_960_720.jpg') center center; background-size: cover; height: 400px;"
                                                                @endif >
                                                                    <div class="bg-overlay">
                                                                        <div
                                                                            class="bg-overlay-content text-overlay-mask dark desc-sm align-items-end justify-content-start p-4">
                                                                            <div class="position-relative w-100">
                                                                                <div class="entry-categories"><a href="{{route('publicaciones.mostrar', $publicacion)}}"
                                                                                    class="bg-fashion">{{$publicacion->nombre}}</a>
                                                                                </div>
                                                                                <div class="entry-meta no-separator">
                                                                                    <ul>
                                                                                        <li><span>Autor: </span> <a href="{{route('autor', $publicacion->user_id)}}">{{$publicacion->user->name}}</a></li>
                                                                                        <li><i class="icon-time"></i>{{$publicacion->created_at->toDateString('Y:m:d')}}</li>
                                                                                    </ul>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endforeach

                                                        </div>
                                                        <!-- Carousel End -->
                                                    </div>
                                                </div>


                                                <div class="entry col-12">

                                                </div>
                                            </div>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                    <div class="w-100 line d-block d-md-none"></div>

                    <div class="col-md-3">

                        <div class="list-group">
                            <a href="{{route('eperfil')}}"
                                class="list-group-item list-group-item-action d-flex justify-content-between">
                                <div>Editar perfil</div><i class="icon-user"></i>
                            </a>
                            @if (auth()->check())
                            @can('administracion')
                            <a href="{{ route('admin.home') }}"
                                class="list-group-item list-group-item-action d-flex justify-content-between">
                                <div>Administración</div><i class="icon-laptop2"></i>
                            </a>
                            @endcan
                            @endif
                            <a href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();"
                                class="list-group-item list-group-item-action d-flex justify-content-between">
                                <div>Logout</div><i class="icon-line2-logout"></i>
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                    class="d-none">
                                    @csrf
                                </form>
                        </div>
                        <br>

                        @if (auth()->user()->biografia != null)
                            <p>{{auth()->user()->biografia}}</p>
                        @else
                            <p>Aun no agregas alguna biografia!!, Cuentanos mas de ti editando tu perfil</p>
                        @endif

                    </div>

                </div>

            </div>
        </div>
    </section>
@endsection
