<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('titulo')</title>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Scripts -->
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{asset('assets/fonts/icomoon/style.css')}}">

    <link rel="stylesheet" href="{{asset('assets/Css/owl.carousel.min.css')}}">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{asset('assets/Css/bootstrap.min.css')}}">

    <!-- Style -->
    <link rel="stylesheet" href="{{asset('assets/Css/stile.css')}}">

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
<body>
            <div class="limiter">
                <div class="container-login100">
                    <div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-54">
                        
                        @guest
                        @if (Route::has('register'))
                            @yield('registro')
                        @endif

                        @if (Route::has('login'))
                            @yield('inicio_sesion')
                        @endif

                    @else

                    <li class="nav-item dropdown">
                       <a class="dropdown-item" href="{{ route('logout') }}"
                              onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                               {{ __('Logout') }}
                           </a>

                           <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                               @csrf
                           </form>
                   </li>

                    @endguest
                    @yield('verificacion')
                    </div>
                    
                </div>
            </div>
            

            <div id="dropDownSelect1"></div>

            <script src="{{asset('vendor/jquery/jquery-3.2.1.min.js')}}"></script>
            <script src="{{asset('vendor/popper/popper.min.js')}}"></script>
            <script src="{{asset('vendor/bootstrap/js/bootstrap.min.js')}}"></script>
            <script src="{{asset('js/main.js')}}"></script>
</body>
</html>





