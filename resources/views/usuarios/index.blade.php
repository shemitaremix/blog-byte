@extends('layouts.layout') @section('Nombre', 'Inicio') @section('contenido')


<!-- Content
  ============================================= -->
<section id="content">
    <div class="content-wrap">
        <div class="container clearfix">

            <div class="row clearfix">

                <!-- Posts Area
      ============================================= -->
                <div class="col-lg-9">



                    <!-- Tab Content
       ============================================= -->
                    <div class="tab-content" id="nav-tabContent">
                        <!-- Tab Content 1
        ============================================= -->
                        @if (count($publicaciones) > 0)
                        @foreach ($publicaciones->chunk(5) as $chunk )


                            @foreach ($chunk as $publicacion)
                                <div class="tab-pane fade show active" id="nav-outdoor" role="tabpanel"
                                    aria-labelledby="nav-outdoor-tab">
                                    <div class="row col-mb-30 mb-0">
                                        <div class="col-lg-12">
                                            <!-- Post Article -->
                                            <div class="entry col-12">
                                                <div class="grid-inner">
                                                    <div class="entry-image">
                                                        <a href="{{route('publicaciones.mostrar', $publicacion)}}" ><img  @if($publicacion->imagenes!=null) src="{{asset('/imgblog/'. $publicacion->imagenes->url)}}" @else src="https://cdn.pixabay.com/photo/2017/05/30/03/58/blog-2355684_960_720.jpg" @endif style="object-fit:cover; height:2000px; width:2500px; min-height: 600px; max-height: 200px" ></a>
                                                    </div>

                                                    <div class="entry-title">
                                                        <h2><a href="{{route('publicaciones.mostrar', $publicacion)}}">{{$publicacion->nombre}}</a></h2>
                                                    </div>
                                                    <div class="entry-meta">
                                                        <ul>
                                                            <li><i class="icon-calendar3"></i> {{$publicacion->created_at->toDateString()}}</li>
                                                            <li><a href="{{route('autor', $publicacion->user_id)}}"><i class="icon-user"></i> {{$publicacion->user->name}}</a></li>

                                                            <li><i class="icon-folder-open"></i>
                                                                <a href="{{route('categoria', $publicacion->categoria_id)}}">{{$publicacion->categoria->nombre}}</a></li>
                                                            @if ($publicacion->usuario_likeo)
                                                                <li><span onclick="dislike({{$publicacion->id}})" style="cursor: hand;" id="likes{{$publicacion->id}}"><i class="icon-thumbs-down" ></i>{{$publicacion->like}}</a></span></li>
                                                            @else
                                                                <li><span onclick="like({{$publicacion->id}})" style="cursor: hand;" id="likes{{$publicacion->id}}"><i class="icon-like" ></i>{{$publicacion->like}}</a></span></li>
                                                            @endif
                                                            @if ($publicacion->guardado)
                                                                <li><span onclick="pguardar({{$publicacion->id}})" style="cursor: hand;" id="guardar{{$publicacion->id}}"><i class="icon-save" ></i></a></span></li>
                                                            @else
                                                                <li><span onclick="pguardar({{$publicacion->id}})" style="cursor: hand;" id="guardar{{$publicacion->id}}"><i class="icon-save2" ></i></a></span></li>
                                                            @endif
                                                        </ul>
                                                    </div>
                                                    <div class="entry-content">
                                                        <p>{!!$publicacion->tema!!}</p>
                                                        <a href="{{route('publicaciones.mostrar', $publicacion)}}" class="more-link">Lee mas</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endforeach
                        @else
                            <h3>Por el momento no se cuentan con publicaciones</h3>
                        @endif
                    </div>
                    <!-- Tab End -->

                </div>

                <!-- Top Sidebar Area
      ============================================= -->
                <!-- Second Sidebar
      ============================================= -->
                <div class="col-lg-3 sticky-sidebar-wrap mt-5 mt-lg-0">
                    <div class="sticky-sidebar">

                        <!-- Sidebar Widget 1
       ============================================= -->
                        <div class="widget widget_links clearfix">
                            <h4 class="mb-2 ls1 text-uppercase fw-bold">Categorias mas Populares</h4>
                            <div class="line line-xs line-sports"></div>
                            <ul>
                                @if (count($categorias) > 0)
                                    @foreach ($categorias as $categoria)
                                    <li class="d-flex align-items-center"><a href="{{ route('categoria', $categoria->id) }}"
                                        class="flex-fill">{{$categoria->nombre}}</a>
                                    </li>
                                    @endforeach
                                @else
                                    <li class="d-flex align-items-center">No hay Categorias populares</li>
                                @endif
                            </ul>
                        </div>

                        <!-- Sidebar Widget 2
       ============================================= -->

                        <div class="widget clearfix">
                            <h4 class="mb-2 ls1 text-uppercase fw-bold">Publicaciones Recientes</h4>
                            <div class="line line-xs line-home"></div>
                            @if (count($publicaciones_populares)>0)
                                @foreach ($publicaciones_populares as $publicacion)
                                    <div class="posts-sm row col-mb-30">
                                        <div class="entry col-12">
                                            <div class="grid-inner row align-items-center g-0">
                                                <div class="col-auto">
                                                    <div class="entry-image">
                                                        <a href="" data-lightbox="image"><img  @if($publicacion->imagenes!=null) src="{{asset('/imgblog/'. $publicacion->imagenes->url)}}" @else src="https://cdn.pixabay.com/photo/2017/05/30/03/58/blog-2355684_960_720.jpg" @endif  alt="Publicacion en Bytecoders"></a>
                                                    </div>
                                                </div>
                                                <div class="col ps-3">
                                                    <div class="entry-title">
                                                        <h4><a href="{{route('publicaciones.mostrar', $publicacion)}}">{{$publicacion->nombre}}</a></h4>
                                                    </div>
                                                    <div class="entry-meta">
                                                        <ul>
                                                            <li><i class="icon-calendar3"></i> {{$publicacion->created_at->toDateString('Y:m:d')}}</li>
                                                            <li><a href="{{route('autor', $publicacion->user_id)}}"><i class="icon-user"></i> {{$publicacion->user->name}}</a></li>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="posts-sm row col-mb-30">
                                    <div class="entry col-12">
                                        <div class="grid-inner row align-items-center g-0">
                                            <li>No hay publicaciones populares</li>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>

                    </div>

                </div>
            </div>
        </div>
        {{$publicaciones->links()}}
        <!-- Container End -->

</section>
<!-- section --> @endsection
@section('scripts')
    <script>
    function like(publicaciones_id){
    $.ajax({
        url: '{{route('publicacion.like')}}',
        type: 'POST',
        data: {
            '_token': '{{csrf_token()}}',
            'publicaciones_id': publicaciones_id,
            'usuario_id': '{{$usuario_id}}',
            'likes': '1',
        },
        success: function(data){
            if (data.status == 'ok') {
            $('#likes'+publicaciones_id).html('<i class="icon-thumbs-down"></i>'+data.likes);
            $('#likes'+publicaciones_id).attr('onclick','dislike('+publicaciones_id+')');
            }else if(data.status == 'error'){
            Swal.fire({
                title: "No se pudo registrar el like",
                text: data.text,
                icon: data.icon,
                button: "Aceptar",
            });
            }
        }
    });
	}
	function dislike(publicaciones_id) {
		$.ajax({
			url: '{{route('publicacion.like')}}',
			type: 'POST',
			data: {
				'_token': '{{csrf_token()}}',
				'publicaciones_id': publicaciones_id,
				'usuario_id': '{{$usuario_id}}',
				'likes': '0',
			},
			success: function(data){
				if (data.status == 'ok') {
                $('#likes'+publicaciones_id).html('<i class="icon-like"></i>'+data.likes);
				$('#likes'+publicaciones_id).attr('onclick','like('+publicaciones_id+')');
				}else if(data.status == 'error'){
				Swal.fire({
					title: "No se pudo registrar el like",
					text: data.text,
					icon: data.icon,
					button: "Aceptar",
				});
				}
			}
		});
	}
    function pguardar(publicaciones_id){
		$.ajax({
			url: '{{route('publicacion.guardar')}}',
			type: 'POST',
			data: {
				'_token': '{{csrf_token()}}',
				'publicaciones_id': publicaciones_id,
				'usuario_id': '{{$usuario_id}}'

			},
			success: function(data){
				if (data.status == 'ok') {
					if (data.estado == '1') {
						$('#guardar'+publicaciones_id).html('<i class="icon-save" ></i>');
					}else if (data.estado == '2') {
						$('#guardar'+publicaciones_id).html('<i class="icon-save2" ></i>');
					}
				}
			}
		});
	}
    </script>
@endsection
