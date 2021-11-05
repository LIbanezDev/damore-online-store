<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="shortcut icon" href="{{asset('assets/usm/logo.png')}}" type="image/png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.3/css/bulma.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <script src="https://kit.fontawesome.com/f0c1ebd83a.js" crossorigin="anonymous"></script>
    <title>@yield('title')</title>
</head>
<body>
    <main class="p-4">
        @yield('content')
    </main>
</body>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="{{asset('js/axios_config.js')}}"></script>
@yield('script')
<script>
    @yield('javascript')
</script>
</html>
