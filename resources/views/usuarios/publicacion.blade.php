@extends('layouts.layout') @section('Nombre', 'Publicación')
@section('css')
<link rel="stylesheet" href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}">
<style>
	label {
	background-color: white;
	display: flex;
	align-items: center;
	gap: 14px;
	padding: 10px 15px 10px 10px;
	cursor: pointer;
	user-select: none;
	border-radius: 10px;
	box-shadow: rgba(149, 157, 165, 0.2) 0px 8px 24px;
	color: black;
   }

   input {
	display: none;
   }

   input:checked + label svg {
	fill: hsl(0deg 100% 50%);
	stroke: hsl(0deg 100% 50%);
	animation: heartButton 1s;
   }

   @keyframes heartButton {
	0% {
	 transform: scale(1);
	}

	25% {
	 transform: scale(1.3);
	}

	50% {
	 transform: scale(1);
	}

	75% {
	 transform: scale(1.3);
	}

	100% {
	 transform: scale(1);
	}
   }

   input + label .action {
	position: relative;
	overflow: hidden;
	display: grid;
   }

   input + label .action span {
	grid-column-start: 1;
	grid-column-end: 1;
	grid-row-start: 1;
	grid-row-end: 1;
	transition: all .5s;
   }

   input + label .action span.option-1 {
	transform: translate(0px,0%);
	opacity: 1;
   }

   input:checked + label .action span.option-1 {
	transform: translate(0px,-100%);
	opacity: 0;
   }

   input + label .action span.option-2 {
	transform: translate(0px,100%);
	opacity: 0;
   }

   input:checked + label .action span.option-2 {
	transform: translate(0px,0%);
	opacity: 1;
   }
	#like-button {
		color: #888;
		font-size: 1.5em;
		font-family: "Heebo", sans-serif;
		background-color: transparent;
		border: 0.1em solid;
		border-radius: 1em;
		padding: 0.333em 1em 0.25em;
		line-height: 0.7em;
		cursor: pointer;
		transition: color 150ms ease-in-out, background-color 150ms ease-in-out, transform 150ms ease-in-out;
		outline: 0;
	}
	#like-button:hover {
		color: indianred;
	}
	#like-button:active {
		transform: scale(0.95);
	}
	#like-button.selected {
		color: #fff;
		background-color: indianred;
		border-color: indianred;
	}
	#like-button .heart-icon {
		display: inline-block;
		fill: currentColor;
		width: 0.8em;
		height: 0.8em;
		margin-right: 0.2em;
	}

	#guardar-button {
		color: #888;
		font-size: 1.5em;
		font-family: "Heebo", sans-serif;
		background-color: transparent;
		border: 0.1em solid;
		border-radius: 1em;
		padding: 0.333em 1em 0.25em;
		line-height: 0.7em;
		cursor: pointer;
		transition: color 150ms ease-in-out, background-color 150ms ease-in-out, transform 150ms ease-in-out;
		outline: 0;
	}
	#guardar-button:hover {
		color: rgb(90, 180, 233);
	}
	#guardar-button:active {
		transform: scale(0.95);
	}
	#guardar-button.selected {
		color: #fff;
		background-color: rgb(59, 114, 197);
		border-color: rgb(59, 114, 197);
	}
	#guardar-button .save-icon {
		display: inline-block;
		fill: currentColor;
	}
</style>

@endsection
@section('contenido')

<!-- Content
		============================================= -->
		<section id="content">
			<div class="content-wrap">
				<div class="container clearfix">

					<div class="row gutter-40 col-mb-80">
						<!-- Post Content
						============================================= -->
						<div class="postcontent col-lg-9">

							<div class="single-post mb-0">

								<!-- Single Post
								============================================= -->
								<div class="entry clearfix">

									<!-- Entry Title
									============================================= -->
									<div class="entry-title">
										<h2>{{$publicacion->nombre}} </h2>
									</div><!-- .entry-title end -->

									<!-- Entry Meta
									============================================= -->
									<div class="entry-meta">
										<ul>
											<li><i class="icon-calendar3"></i> {{$publicacion->created_at->toDateString()}}</li>
											<li><a href="{{route('autor', $publicacion->user_id)}}"><i class="icon-user"></i> {{$publicacion->user->name}}</a></li>
											<li><i class="icon-folder-open"></i><a href="{{route('categoria', $publicacion->categoria_id)}}">{{$publicacion->categoria->nombre}}</a></li></li>
											<li><a id="likes"><i class="icon-like"></i> {{$likes}}</a> </li>
											@if (Auth::check())
												@if ($usuario_likeo)
													<li><button onclick="dislike()" type="button" id="like-button" class="selected">
													<svg class="heart-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><path d="M91.6 13A28.7 28.7 0 0 0 51 13l-1 1-1-1A28.7 28.7 0 0 0 8.4 53.8l1 1L50 95.3l40.5-40.6 1-1a28.6 28.6 0 0 0 0-40.6z"/></svg>
													</button></li>
												@else
													<li><button onclick="like()" type="button" id="like-button">
													<svg class="heart-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><path d="M91.6 13A28.7 28.7 0 0 0 51 13l-1 1-1-1A28.7 28.7 0 0 0 8.4 53.8l1 1L50 95.3l40.5-40.6 1-1a28.6 28.6 0 0 0 0-40.6z"/></svg>
													</button></li>
												@endif
												@if ($publi_guardado)
													<li><button onclick="pguardar()" type="button" id="guardar-button" class="selected">
													<i class="fas fa-save save-icon"></i>
													</button></li>
												@else
													<li><button onclick="pguardar()" type="button" id="guardar-button" >
													<i class="fas fa-save save-icon"></i>
													</button></li>

												@endif
											@endif
											</div>
											</label>
                                        </ul>
									</div><!-- .entry-meta end -->

									<!-- Entry Image
									============================================= -->
									<div class="entry-image">
										<a href="#"><img  @if($publicacion->imagenes!=null) src="{{asset('/imgblog/'. $publicacion->imagenes->url)}}" @else src="/images/post.webp" @endif style="object-fit:cover; height:2000px; width:2500px; min-height: 600px; max-height: 200px" alt="Publicacion en Bytecoders"></a>
									</div><!-- .entry-image end -->

									<!-- Entry Content
									============================================= -->
									<div class="entry-content mt-0">

                              <blockquote>
                                 <h3>Tema:</h3>
                                 <p>{!!$publicacion->tema!!}</p>
                              </blockquote>

                              <h3>Contenido:</h3>
										<p>{!!$publicacion->contenido!!}</p>

										<div class="clear"></div>

									</div>

								</div><!-- .entry end -->

								<!-- Post Navigation
								============================================= -->


								<div class="line"></div>
                                <!-- Post Author Info
								============================================= -->


								<!-- Post Author Info
								============================================= -->
								<div class="card">
									<div class="card-header"><strong>Publicado por: <a href='{{route('autor', $publicacion->user_id)}}'>{{$publicacion->user->name}}</a></strong></div>
                                    <div class="card-body">
										<div class="author-image">
                                            <img @if ($publicacion->user->imagenesusu!=null) src="{{asset('/imgusu/'. $publicacion->user->imagenesusu->url)}}" @else src="https://static.vecteezy.com/system/resources/previews/004/026/956/non_2x/person-avatar-icon-free-vector.jpg"  @endif  class="alignleft img-circle img-thumbnail my-0" alt="Avatar"
                                            style="max-width: 84px;">
										</div>
                                        @if ($publicacion->user->biografia != null)
                                           <i>Biografia del Autor:</i> {{$publicacion->user->biografia}}
                                        @else
                                        <h4>Aun no se agrega alguna biografia!!, Cuentanos mas de ti editando tu perfil en el siguiente link:<a href="{{route('eperfil')}}">Editar Perfil</a> </h4>
                                        @endif

									</div>
								</div><!-- Post Single - Author End -->
								<!-- Comments
								============================================= -->
								<div id="comments" class="clearfix">

									<h3 id="comments-title"><span>Listado de</span> Comentarios</h3>
									<!-- Comments List
									============================================= -->
                                    @foreach($publicacion->comentarios as $comentario)
                                            <div id="comment-1" class="comment-wrap clearfix">
                                                <div class="comment-meta">

                                                    <div class="comment-author vcard">

                                                        <span class="comment-avatar clearfix">
                                                            <img @if ($comentario->user->imagenesusu!=null) src="{{asset('/imgusu/'. $comentario->user->imagenesusu->url)}}" @else src="https://static.vecteezy.com/system/resources/previews/004/026/956/non_2x/person-avatar-icon-free-vector.jpg"  @endif  class='avatar avatar-60 photo avatar-default' height='60' width='60'></span>

                                                    </div>

                                                </div>

												<div class="comment-content clearfix">
													<div class="comment-author"><a href='{{route('autor', $publicacion->user_id)}}' rel='external nofollow' class='url'>{{$comentario->user->name}}</a><span>{{$comentario->created_at->toDateString('Y:m:d')}}</span></div>
                                                    <br>
													<p>{!!$comentario->contenido!!}</p>
												</div>
                                            </div>
                                     @endforeach
									<div class="clear"></div>

									<!-- Comment Form
									============================================= -->
                                    @if (auth()->check())
									<div id="respond">

										<h3>Agregar un <span>Comentario</span></h3>

										<form class="row" action="{{route('publicaciones.comentarios')}}" method="post">
                                            {!! csrf_field() !!}
                                            <input type="hidden" name="publicaciones_id" value="{{$publicacion->id}}">
                                            <input type="hidden" name="usuario_id" value="{{$usuario_id}}">
											<div class="w-100"></div>

											<div class="col-12 form-group">
												<label for="comment">Comentario:</label>
												<textarea name="contenido" cols="58" rows="7" tabindex="4" class="sm-form-control" placeholder= "Escribe, que sucede..." id="contenidos"></textarea>
											</div>

											<div class="col-12 form-group">
												<button name="submit" type="submit" id="submit" tabindex="5" value="Submit" class="button button-3d m-0">Enviar comentario</button>
											</div>
										</form>

									</div><!-- #respond end -->
                                    @endif


								</div><!-- #comments end -->

							</div>

							<!-- Sidebar
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
																<a href="" data-lightbox="image"><img  @if($publicacion->imagenes!=null) src="{{asset('/imgblog/'. $publicacion->imagenes->url)}}" @else src="/images/LogoAC.webp" @endif  alt="Publicacion en Bytecoders"></a>
															</div>
														</div>
														<div class="col ps-3">
															<div class="entry-title">
																<h4><a href="{{route('publicaciones.mostrar', $publicacion)}}">{{$publicacion->nombre}}</a></h4>
															</div>
															<div class="entry-meta">
																<ul>
																	<li><i class="icon-calendar3"></i> {{$publicacion->created_at->toDateString('Y:m:d')}}</li>
																	<li><a href="#"><i class="icon-user"></i> {{$publicacion->user->name}}</a></li>
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
						<!-- .sidebar end -->
						</div><!-- .postcontent end -->

					</div>

				</div>
			</div>
		</section><!-- #content end -->

@endsection
@section('scripts')
<script src="https://cdn.ckeditor.com/ckeditor5/34.1.0/classic/ckeditor.js"></script>
<script src="../assets/sweetalert/sweetalert.min.js"></script>
<script src="{{ asset('vendor/jQuery-Plugin-stringToSlug-1.3/jquery.stringToSlug.min.js') }}"></script>
<script>

   ClassicEditor
    .create( document.querySelector('#contenido') )
    .catch( error => {
		console.error( error );
    } );
        @if (Session::has('success'))
			Swal.fire(
				'Ya se agrego tu comentario!!',
				'hecho!',
				'success'
			);
		@endif
		@if (Session::has('error'))
			Swal.fire(
				'Ocurrio un error!!',
				'Contacte al administrador',
				'error'
			);
		@endif
	function pguardar(){
		$.ajax({
			url: '{{route('publicacion.guardar')}}',
			type: 'POST',
			data: {
				'_token': '{{csrf_token()}}',
				'publicaciones_id': '{{$p_id}}',
				'usuario_id': '{{$usuario_id}}'

			},
			success: function(data){
				if (data.status == 'ok') {
					if (data.estado == '1') {
						$('#guardar-button').toggleClass('selected');
					}else if (data.estado == '2') {
						$('#guardar-button').removeClass('selected');
					}
				}
			}
		});
	}
	function like(){
		$.ajax({
			url: '{{route('publicacion.like')}}',
			type: 'POST',
			data: {
				'_token': '{{csrf_token()}}',
				'publicaciones_id': '{{$p_id}}',
				'usuario_id': '{{$usuario_id}}',
				'likes': '1',
			},
			success: function(data){
				if (data.status == 'ok') {
					//agregar el icono like en el elemento con el id likes

				$('#likes').html('<i class="icon-like"></i> '+data.likes);
				//cambiar el color del boton en danger y cambiar el icono
				$('#like-button').toggleClass('selected');
				$('#like-button').attr('onclick','dislike()');
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
	function dislike() {
		$.ajax({
			url: '{{route('publicacion.like')}}',
			type: 'POST',
			data: {
				'_token': '{{csrf_token()}}',
				'publicaciones_id': '{{$p_id}}',
				'usuario_id': '{{$usuario_id}}',
				'likes': '0',
			},
			success: function(data){
				if (data.status == 'ok') {
				$('#likes').html('<i class="icon-like"></i> '+data.likes);
				$('#like-button').removeClass('selected');
				$('#like-button').attr('onclick','like()');
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
</script>
@endsection
