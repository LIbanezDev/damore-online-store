<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" href="{{asset('assets/bootstrap/css/bootstrap.min.css')}}"/>
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,400i,700,700i,600,600i" rel="stylesheet"/>
    <link rel="shortcut icon" type="image/svg" href="{{asset('assets/images/icon.svg')}}"/>
    <link rel="stylesheet" href="{{asset('assets/fonts/font-awesome.min.css')}}"/>
    <link rel="stylesheet" href="{{asset('assets/fonts/simple-line-icons.min.css')}}"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.10.0/baguetteBox.min.css"/>
    <link rel="stylesheet" href="{{asset('assets/css/styles.min.css')}}"/>
    <script src="https://kit.fontawesome.com/f0c1ebd83a.js" crossorigin="anonymous"></script>
    <script src="{{asset('assets/js/tinymce/tinymce.min.js')}}"></script>
    <title>@yield('title')</title>
    <style>
        .main {
            display: flex;
            min-height: 100vh;
            flex-direction: column;
        }

        .section {
            flex: 1;
        }
        @yield('css')
    </style>
</head>
<body class="main">
<header>
    <nav class="navbar navbar-light navbar-expand-lg fixed-top bg-white clean-navbar">
        <div class="container"><a class="navbar-brand logo" href="/">
                <img src="{{asset('assets/img/logo.jpg')}}" width="125" height="40" class="d-inline-block align-top" alt="">
            </a>
            <button data-bs-toggle="collapse" class="navbar-toggler" data-bs-target="#navcol-1"><span class="visually-hidden">Toggle navigation</span><span
                    class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navcol-1">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="{{route('Products::index')}}">productos</a></li>
                    @auth()
                        <li class="nav-item dropdown">
                            <a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown" href="#">
                                {{Auth::user()->name}}
                            </a>
                            <div class="dropdown-menu">
                                @can('acceder a cpanel')
                                    <a href="{{route('Cpanel')}}" class="dropdown-item">
                                        CPanel
                                    </a>
                                @endcan
                                <a href="{{route('User::profile')}}" class="dropdown-item">
                                    Mi perfil
                                </a>
                                <form method="POST" action="{{route('logout')}}">
                                    @csrf
                                    <button type="submit" class="dropdown-item">
                                        Cerrar sesión
                                    </button>
                                </form>
                            </div>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('login')}}">Ingresar</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('register')}}">Registrarse</a>
                        </li>
                    @endauth
                    <li class="nav-item">
                        <a href="{{route('ShoppingCart::index')}}" class="nav-link">
                            <i class="fa fa-shopping-cart"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>
<main class="mt-4">
    @yield('content')
</main>
<footer class="page-footer dark">
    <div class="container">
        <div class="row">
            <div class="col" style="margin-right: 0px;">
                <h5>Categorías</h5>
                <ul>
                    <li><a href="#">Matizadores</a></li>
                    <li><a href="#" style="color: rgb(210, 209, 209);">Cremas</a></li>
                    <li><a href="#" style="color: rgb(210, 209, 209);">Máscara de hidratación</a></li>
                    <li><a href="#" style="color: rgb(210, 209, 209);">Aceites</a></li>
                </ul>
            </div>
            <div class="col" style="margin-right: 0px;">
                <h5>D&#39;amore store</h5>
                <ul>
                    <li><a href="#">Quienes somos</a></li>
                    <li><a href="#" style="color: rgb(210, 209, 209);">Redes sociales Instagram</a></li>
                </ul>
                <h5>Soporte</h5>
                <ul>
                    <li style="margin-right: -13px;"><a href="{{route('Main::faq')}}" style="margin-right: 0px;">Preguntas freguentes FAQ</a></li>
                </ul>
            </div>
            <div class="col" style="margin-top: 0px;margin-left: 0px;">
                <p style="color: rgb(210, 209, 209);"><br/>Se realizan entregas en puntos físicos entre Valparaíso y Viña del Mar. Si no puede acordar punto de entrega, se realizan
                    envíos por Starken o chilexpress. <br/><br/></p>
            </div>
        </div>
    </div>
    <div class="footer-copyright">
        <p>©D&#39;amore Store Valparaíso 2022</p>
    </div>
</footer>
</body>
<script src="{{asset('assets/bootstrap/js/bootstrap.min.js')}}"></script>
<script src="{{asset('https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.10.0/baguetteBox.min.js')}}"></script>
<script src="{{asset('assets/js/script.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="{{asset('js/axios_config.js')}}"></script>
@yield('script')
<script>
    @yield('javascript')
</script>
</html>
