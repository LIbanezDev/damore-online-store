@extends('layout.base')
@section('title')
    D'amore ~ Registro
@endsection
@section('content')
    <div class="page login-page">
        <section class="clean-block clean-form dark">
            <div class="container">
                <div class="block-heading">
                    <h2 class="text-info">Registro</h2>
                </div>
                <form id="form-register" autocomplete="off">
                    <div class="mb-3">
                        <label class="form-label" for="input-rut">Rut sin puntos ni guión</label>
                        <input required
                               class="form-control item" type="text"
                               name="rut"
                               id="input-rut">
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="input-name">Nombre</label>
                        <input required
                               class="form-control item" type="text"
                               name="name"
                               id="input-name">
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="input-email">Email</label>
                        <input required
                               class="form-control item" value="{{app('request')->input('email')}}" type="email"
                               name="email"
                               id="input-email">
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="input-password">Contraseña</label>
                        <input class="form-control"
                               required type="password" name="password"
                               id="input-password"
                        >
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="input-address">Dirección de envío</label>
                        <input required
                               class="form-control item" type="text"
                               name="address"
                               id="input-address">
                    </div>
                    <div class="mb-3">
                        <button class="btn btn-primary" type="submit" id="btn-register">Guardar</button>
                    </div>
                    <div class="d-flex justify-content-end">
                        <a class="btn btn-outline-primary btn-sm" href="{{route('login')}}">
                            Login
                        </a>
                    </div>
                </form>
            </div>
        </section>
    </div>
@endsection
@section('javascript')
    const formRegister = document.getElementById('form-register');
    const nameInput = document.getElementById('input-name');
    const addressInput = document.getElementById('input-address');
    const rutInput = document.getElementById('input-rut');
    const emailInput = document.getElementById('input-email');
    const passwordInput = document.getElementById('input-password');
    const btnRegister = document.getElementById('btn-register');

    formRegister.addEventListener('submit', async(evt) => {
    evt.preventDefault();
    btnRegister.classList.add('is-loading');
    const body = {
        name: nameInput.value,
        email: emailInput.value,
        password: passwordInput.value,
        rut: rutInput.value,
        address: addressInput.value
    }
    const {data} = await axios.post('/register', body);
    btnRegister.classList.remove('is-loading');
    if(data.ok) return window.location.href = `/login?email=${body.email}`
    Swal.fire(
    'Hubo un error',
    data.msg,
    'error'
    )
    })
@endsection
