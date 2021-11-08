<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" href="{{asset('css/splide.min.css')}}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.3/css/bulma.min.css">
    <link rel="shortcut icon" type="image/svg" href="{{asset('assets/images/icon.svg')}}"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <script src="https://kit.fontawesome.com/f0c1ebd83a.js" crossorigin="anonymous"></script>
    <title>@yield('title')</title>
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

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
    <nav class="navbar" role="navigation" aria-label="main navigation">
        <div class="navbar-brand">
            {{--<a class="navbar-item" href="/">
                <img src="{{asset('assets/images/logo.png')}}" width="120" height="200" alt="logo">
            </a>--}}

            <a role="button" class="navbar-burger" aria-label="menu" aria-expanded="true" id="nav-toggle"
               data-target="nav-menu">
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
            </a>
        </div>

        <div id="nav-menu" class="navbar-menu">
            <div class="navbar-start">
                {{--<a class="navbar-item" href="/">
                    Inicio
                </a>--}}
                <div class="navbar-item">
                    <a class="button is-white" href="{{route('Index')}}">
                                <span class="fa fa-home">
                                </span>
                    </a>
                </div>
                <div class="navbar-item">
                    <button class="button is-white"
                            onclick="window.open('https://github.com/LIbanezDev/damore-online-store', '_blank');">
                                <span class="fa fa-github">
                                </span>
                    </button>
                </div>
                <div class="navbar-item">
                    <div class="dropdown is-hoverable">
                        <div class="dropdown-trigger">
                            <button class="button is-white" aria-haspopup="true" aria-controls="dropdown-menu4">
                                <span>Articulos</span>
                                <span class="icon is-small">
                                    <i class="fas fa-angle-down" aria-hidden="true"></i>
                                  </span>
                            </button>
                        </div>
                        <div class="dropdown-menu" id="dropdown-menu4" role="menu">
                            <div class="dropdown-content">
                                <div class="dropdown-item">
                                    <p><a href="{{route('Products::index')}}">Todos </a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="navbar-end">
                <div class="navbar-item">
                    @auth()
                        <a href="{{route('User::profile')}}">
                            <p class="navbar-item"><strong>{{Auth::user()->name}}</strong></p>
                        </a>
                        @can('acceder a cpanel')
                            <a href="{{route('Cpanel')}}">
                                <p class="navbar-item"><strong>Panel</strong></p>
                            </a>
                        @endcan
                        <form action="{{route('logout')}}" method="POST">
                            @csrf
                            <button class="button is-white" onclick="this.closest('form').submit()">
                                    <span class="fa fa-power-off has-text-danger">
                                    </span>
                            </button>
                        </form>
                    @else
                        <div class="buttons">
                            <a class="button is-white" href="{{route('login')}}">
                                    <span class="icon">
                                      <i class="fas fa-sign-in-alt"></i>
                                    </span>
                                <span>Ingresar</span>
                            </a>
                        </div>
                    @endauth
                </div>
            </div>
        </div>
    </nav>
</header>
<main class="p-4 section">
    @yield('content')
</main>
<footer class="footer mt-2">
    <div class="content has-text-centered">
        <p>
            D'amore Store Valparaiso
        </p>
    </div>
</footer>
</body>
<script src="{{asset('js/splide.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="{{asset('js/axios_config.js')}}"></script>
@yield('script')
<script>
    document.getElementById("nav-toggle").addEventListener("click", () => {
        const nav = document.getElementById("nav-menu");
        const className = nav.getAttribute("class");
        console.log(className)
        nav.className = className === 'navbar-menu' ? 'navbar-menu is-active' : 'navbar-menu';
    })
    @yield('javascript')
</script>
</html>
