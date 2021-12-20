@extends('layout.base')
@section('title')
    D'amore ~ Login
@endsection
@section('content')
    <div class="page login-page">
        <section class="clean-block clean-form dark">
            <div class="container">
                <div class="block-heading">
                    <h2 class="text-info">Login</h2>
                </div>
                <form id="form-login" autocomplete="off">
                    <div class="mb-3">
                        <label class="form-label" for="input-email">Email</label>
                        <input required
                               class="form-control item" value="{{app('request')->input('email')}}" type="email"
                               name="email"
                               id="input-email">
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="input-password">Password</label>
                        <input class="form-control"
                               required type="password" name="password"
                               id="input-password"
                        >
                    </div>
                    <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="checkbox-remember">
                            <label class="form-check-label" for="checkbox-remember">Remember me</label>
                        </div>
                    </div>
                    <div class="mb-3">
                        <button class="btn btn-primary" id="btn-login">Ingresar</button>
                    </div>
                    <div class="d-flex justify-content-end">
                        <a class="btn btn-outline-primary btn-sm" href="{{route('register')}}">
                            Registro
                        </a>
                    </div>
                </form>
            </div>
        </section>
    </div>
@endsection
@section('javascript')
    const formLogin = document.getElementById('form-login');
    const emailInput = document.getElementById('input-email');
    const passwordInput = document.getElementById('input-password');
    const rememberCheckbox = document.getElementById('checkbox-remember');
    const btnLogin = document.getElementById('btn-login');

    formLogin.addEventListener('submit', async (evt) => {
    btnLogin.classList.add('is-loading');
    evt.preventDefault();
    const {data} = await axios.post('/login', {
    email: emailInput.value,
    password: passwordInput.value,
    remember: rememberCheckbox.checked
    });
    btnLogin.classList.remove('is-loading');
    if(data.ok) return window.location.href = '/';
    Swal.fire(
    'Hubo un error!',
    data.msg,
    'error'
    )
    })
@endsection
