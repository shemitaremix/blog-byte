<!DOCTYPE html>
<html dir="ltr" lang="en-US">

<head>

    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="author" content="SemiColonWeb" />
    <meta name="description" content="blog para la presentacion de los avances tecnologicos dentro del equipo de desarrollo AndoCodeando">
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Stylesheets
 ============================================= -->
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@400;600;700&family=Roboto:wght@400;500;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}" type="text/css" />
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" type="text/css" />
    <link rel="stylesheet" href="{{ asset('assets/css/dark.css') }}" type="text/css" />
    <link rel="stylesheet" href="{{ asset('assets/css/font-icons.css') }}" type="text/css" />
    <link rel="stylesheet" href="{{ asset('assets/css/et-line.css') }}" type="text/css" />
    <link rel="stylesheet" href="{{ asset('assets/css/fonts/font-icons.woff') }}" type="text/css" />
    <link rel="stylesheet" href="{{ asset('assets/css/fonts/lined-icons.woff') }}" type="text/css" />
    <link rel="stylesheet" href="{{ asset('assets/css/animate.css') }}" type="text/css" />
    <link rel="stylesheet" href="{{ asset('assets/css/magnific-popup.css') }}" type="text/css" />
    <link rel="stylesheet" href="{{ asset('assets/sweetalert/sweetalert.min.css') }}" type="text/css" />
    <link rel="stylesheet" href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}">
    <link rel="shortcut icon" href="{{asset('assets/images/favicon.ico')}}" /> 




    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}" type="text/css" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Theme Color Stylesheet -->
    <link rel="stylesheet" href="{{ asset('assets/css/fonts.css') }}" type="text/css" />

    <!-- News Demo Specific Stylesheet -->
    <link rel="stylesheet" href="{{ asset('assets/css/news.css') }}" type="text/css" />
    <!-- / -->

    <!-- SLIDER REVOLUTION 5.x css SETTINGS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/settings.css') }}" media="screen" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/layers.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/navigation.css') }}">


    <!-- Document Title
 ============================================= -->
    <title>@yield('Nombre')</title>

    <style>
        /* Revolution Slider Styles */
        .hesperiden .tp-tab {
            border-bottom: 0;
        }

        .hesperiden .tp-tab:hover,
        .hesperiden .tp-tab.selected {
            background-color: #E5E5E5;
        }
    </style>
    @yield('css')

    <!-- Google Analitycs-->
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-T163JV6WE6"></script>
    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'G-T163JV6WE6');
    </script>

</head>

<body class="stretched">

    <!-- Document Wrapper
 ============================================= -->
    <div id="wrapper" class="clearfix">

        <!-- Header
  ============================================= -->
        <header id="header" class="header-size-sm" data-sticky-shrink="false">
            <div class="container">
                <div class="header-row justify-content-between">

                    <!-- Logo
     ============================================= -->
                    <div id="logo" class="col-auto ms-auto ms-mb-0 me-mb-0 order-md-2">
                        <a href="{{ route('index') }}" class="standard-logo"><img class="img-fluid"
                                src="{{ asset('/assets/images/LogoAC.webp') }}" alt="AndoCodeando Logo"></a>
                        <a href="{{ route('index') }}" class="retina-logo"><img class="mx-auto"
                                src="{{ asset('/assets/images/LogoAC.webp') }}" alt="AndoCodeando Logo"></a>
                    </div><!-- #logo end -->

                    <div class="w-100 d-block d-md-none"></div>


                    <div class="col-12 col-sm-6 col-md-4 order-md-3 mb-4 mb-md-0">
                        <ul class="nav align-items-center justify-content-center justify-content-sm-end">
                            @if (auth()->check())
                                <li class="nav-item">
                                    <div
                                        class="date-today text-uppercase badge bg-dark rounded-pill py-2 px-3 fw-medium">
                                    </div>
                                </li>
                                {{-- Boton cerrar sesion --}}
                                <a href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();"
                                    class="button button-mini button-circle button-red"><i
                                        class="icon-off"></i>{{ __('SALIR') }}</a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            @else
                                <li class="nav-item">
                                    <a class="nav-link text-uppercase fw-medium" href="{{ route('login') }}">Iniciar
                                        Sesión</a>
                                </li>
                                <li class="nav-item">
                                    <div
                                        class="date-today text-uppercase badge bg-dark rounded-pill py-2 px-3 fw-medium">
                                    </div>
                                </li>
                            @endif
                        </ul>
                    </div>

                </div>
            </div>

            <div id="header-wrap" class="border-top border-f5">
                <div class="container">
                    <div class="header-row justify-content-between flex-row-reverse flex-lg-row">

                        <div class="header-misc">

                            <!-- Top Search
       ============================================= -->
                            <div id="top-search" class="header-misc-icon">
                                <a href="#" id="top-search-trigger"><i class="icon-line-search"></i><i
                                        class="icon-line-cross"></i></a>
                            </div><!-- #top-search end -->

                        </div>

                        <div id="primary-menu-trigger">
                            <svg class="svg-trigger" viewBox="0 0 100 100">
                                <path
                                    d="m 30,33 h 40 c 3.722839,0 7.5,3.126468 7.5,8.578427 0,5.451959 -2.727029,8.421573 -7.5,8.421573 h -20">
                                </path>
                                <path d="m 30,50 h 40"></path>
                                <path
                                    d="m 70,67 h -40 c 0,0 -7.5,-0.802118 -7.5,-8.365747 0,-7.563629 7.5,-8.634253 7.5,-8.634253 h 20">
                                </path>
                            </svg>
                        </div>

                        <!-- Primary Navigation
      ============================================= -->
                        <nav class="primary-menu with-arrows">

                            <ul class="menu-container">
                                <li
                                    class="menu-item  menu-color-home {{ !Route::is('index') ?: 'active current menu-color-home' }}">
                                    <a class="menu-link" href="{{ route('index') }}">
                                        <div>Inicio</div>
                                    </a>
                                </li>
                                <li
                                    class="menu-item  menu-color-tech {{ !Route::is('lista-posts') ?: 'active current menu-color-tech' }}">
                                    <a class="menu-link" href="{{ route('lista-posts') }}">
                                        <div>Publicaciones</div>
                                    </a>
                                </li>
                               {{--  <li
                                    class="menu-item menu-color-travel {{ !Route::is('sobrenosotros') ?: 'active current menu-item menu-color-travel ' }}">
                                    <a class="menu-link" href="{{ route('sobrenosotros') }}">
                                        <div>Sobre Nosotros</div>
                                    </a>
                                </li> --}}
                                @if (auth()->check())
                                    <li
                                        class="menu-item menu-color-fashion {{ !Route::is('perfil') ?: 'active current menu-color-fashion' }}">
                                        <a class="menu-link" href="{{ route('perfil') }}">
                                            <div>Perfil</div>
                                        </a>
                                    </li>
                                    @can('publicaciones.crear')
                                        <li
                                            class="menu-item menu-color-food {{ !Route::is('publicacion.crear') ?: 'active current menu-color-food' }}">
                                            <a class="menu-link" href="{{ route('publicacion.crear') }}">
                                                <div>Crear publicación</div>
                                            </a>
                                        </li>
                                    @endcan
                                    @can('administracion')
                                        <li
                                            class="menu-item menu-color-sports {{ !Route::is('admin.home') ?: 'active current menu-color-sports' }}">
                                            <a class="menu-link" href="{{ route('admin.home') }}">
                                                <div>Administración</div>
                                            </a>
                                        </li>
                                    @endcan
                                @else
                                    <li
                                        class="menu-item menu-color-lifestyle {{ !Route::is('register') ?: 'active current menu-color-lifestyle' }}">
                                        <a class="menu-link" href="{{ route('register') }}">Registrarse</a>
                                    </li>
                                @endif
                            </ul>
                        </nav><!-- #primary-menu end -->

                        <form class="top-search-form" action="{{ route('publicacion.buscar') }}" method="POST">
                            @csrf
                            <input type="text" name="buscador" class="form-control" value="" placeholder="Ingresa tu publicación a buscar" autocomplete="off">
                        </form>

                    </div>
                </div>
            </div>

            <div class="header-wrap-clone"></div>
        </header><!-- #header end -->


        @section('contenido')
        @show

        <!-- Footer
      ============================================= -->
        <footer id="footer" class="dark" style="background-color: #1f2024;">

            <div class="container">

                <!-- Footer Widgets
        ============================================= -->
                <div class="footer-widgets-wrap row clearfix">

                    <!-- Footer Widget 3
         ============================================= -->
                    <div class="col-lg-4 col-sm-6 mb-5 mb-sm-0">
                        <div class="widget widget_links clearfix">
                            <h4 class="mb-3 mb-sm-4">Links Rápidos</h4>
                            <ul>
                                <li class="{{ !Route::is('index') ?: 'active' }}">
                                    <a href="{{ route('index') }}">Inicio</a>
                                </li>
                                {{-- <li class="{{ !Route::is('sobrenosotros') ?: 'active' }}">
                                    <a href="{{ route('sobrenosotros') }}">Sobre Nosotros</a>
                                </li> --}}
                                @if (auth()->check())
                                    <li class="{{ !Route::is('perfil') ?: 'active' }}">
                                        <a href="{{ route('perfil') }}">Perfil Usuario</a>
                                    </li>
                                    @can('publicaciones.crear')
                                        <li class="{{ !Route::is('publicacion.crear') ?: 'active' }}">
                                            <a href="{{ route('publicacion.crear') }}">Crear Publicacion</a>
                                        </li>
                                    @endcan
                                    @can('administracion')
                                        <li class="{{ !Route::is('contacto') ?: 'active' }}">
                                            <a href="{{ route('admin.home') }}">Administracion</a>
                                        </li>
                                    @endcan
                                    <li>
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                       document.getElementById('logout-form').submit();">
                                            {{ __('Salir') }}
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                            class="d-none">
                                            @csrf
                                        </form>
                                    </li>
                                @else
                                    <li>
                                        <a href="{{ route('login') }}">Iniciar Sesion</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('register') }}">Registrarse</a>
                                    </li>
                                @endif

                            </ul>
                        </div>
                    </div>


                    <!-- Footer Widget 2
          ============================================= -->
                    <div class="col-lg-4 col-sm-6 mb-0">
                        <h4 class="mb-3 mb-sm-4">Información de contacto</h4>
                        <address>
                            <strong>Los Reyes Acozac</strong> 55755<br>
                            Tecámac, Edo. de Méx.<br>
                        </address>
                        <abbr title="Phone Number"><strong>Celular:</strong></abbr> (+55) 8547 6325<br>
                        <abbr title="Email Address"><strong>Email:</strong></abbr> contacto@bytecoders.tech <br><br>
                    </div>


                    <!-- Footer Widget 4
         ============================================= -->
                    <div class="col-lg-4 col-sm-6 mb-5 mb-lg-0">
                        <a href="{{ route('index') }}" class="standard-logo"><img class="mx-auto"
                                src="/assets/images/LogoAC.webp" alt="AndoCodeando Logo"></a>
                    </div>
                </div>

            </div>

    </div>

    <!-- Copyrights
       ============================================= -->
    <div id="copyrights">

        <div class="container clearfix">

            <div class="mb-2 ls1 text-uppercase fw-bold">
                <div class="col-md-6 align-self-center">
                    Copyrights &copy; 2022 All Rights Reserved by ByteCoders <br>
                </div>
            </div>

        </div>

    </div><!-- #copyrights end -->

    </footer><!-- #footer end -->

    </div><!-- #wrapper end -->

    <!-- Go To Top
     ============================================= -->
    <div id="gotoTop" class="icon-angle-up"></div>

    <!-- JavaScripts============================================= -->
    <script src="{{ asset('assets/Js/jquery.js') }}"></script>
    <script src="{{ asset('assets/Js/plugins.min.js') }}"></script>
    <script src="{{ asset('assets/Js/plugins.infinitescroll.js') }}"></script>

    <!-- Footer Scripts
     ============================================= -->
    <script src="{{ asset('assets/Js/functions.js') }}"></script>



    <!-- ADD-ONS JS FILES -->
    <script src="{{ asset('vendor/jQuery-Plugin-stringToSlug-1.3/jquery.stringToSlug.min.js') }}"></script>
    <script src="{{ asset('assets/sweetalert/sweetalert.min.js') }}"></script>
    <script></script>
    <script>
        var tpj = jQuery;
        var revapi19;
        var $ = jQuery.noConflict();
        

        // Navbar on hover
        $('.nav.tab-hover a.nav-link').hover(function() {
            $(this).tab('show');
        });

        // Current Date
        var weekday = ["Domingo", "Lunes", "Martes", "Miercoles", "Jueves", "Viernes", "Sábado"],
            month = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre",
                "Noviembre", "Diciembre"
            ],
            a = new Date();

        jQuery('.date-today').html(weekday[a.getDay()] + ', ' + month[a.getMonth()] + ' ' + a.getDate());

        // Infinity Scroll
        jQuery(window).on('load', function() {

            var $container = $('.infinity-wrapper');

            $container.infiniteScroll({
                path: '.load-next-portfolio',
                button: '.load-next-portfolio',
                scrollThreshold: false,
                history: false,
                status: '.page-load-status'
            });

            $container.on('load.infiniteScroll', function(event, response, path) {
                var $items = $(response).find('.infinity-loader');
                // append items after images loaded
                $items.imagesLoaded(function() {
                    $container.append($items);
                    $container.isotope('insert', $items);
                    setTimeout(function() {
                        SEMICOLON.widget.loadFlexSlider();
                    }, 1000);
                });
            });

        });

        $(window).on('pluginCarouselReady', function() {
            $('#oc-news').owlCarousel({
                items: 1,
                margin: 20,
                dots: false,
                nav: true,
                navText: ['<i class="icon-angle-left"></i>', '<i class="icon-angle-right"></i>'],
                responsive: {
                    0: {
                        items: 1,
                        dots: true,
                    },
                    576: {
                        items: 1,
                        dots: true
                    },
                    768: {
                        items: 2,
                        dots: true
                    },
                    992: {
                        items: 2
                    },
                    1200: {
                        items: 3
                    }
                }
            });
        });
    </script>

    @yield('scripts')

</body>





</html>
