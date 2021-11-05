@extends('layout.base')
@section('title')
    D'amore ~ Registro
@endsection
@section('content')
    <div class="columns is-multiline is-centered">
        <div class="column is-12">
            <h2 class="title has-text-centered"> Registro </h2>
        </div>
        <div class="column is-half is-6">
            <div class="box">
                <form id="form-register" autocomplete="off">
                    <div class="field">
                        <label class="label" for="input-name">Nombre</label>
                        <div class="control">
                            <div class="control">
                                <input required class="input" type="text" name="name"
                                       id="input-name">
                            </div>
                        </div>
                    </div>
                    <div class="field">
                        <label class="label" for="input-email">Email</label>
                        <div class="control">
                            <div class="control">
                                <input required class="input" type="text" name="email"
                                       id="input-email">
                            </div>
                        </div>
                    </div>
                    <div class="field">
                        <label class="label" for="input-password">Contraseña</label>
                        <div class="control">
                            <div class="control">
                                <input required class="input" type="password" name="password" id="input-password">
                            </div>
                        </div>
                    </div>
                    <div class="control">
                        <button class="button is-success" id="btn-register">
                        <span class="icon is-small">
                          <i class="fas fa-save"></i>
                        </span>
                            <strong>Continuar</strong>
                        </button>
                    </div>
                </form>
                <div class="has-text-right">
                    <a href="{{route('login')}}">
                        <strong>Login</strong>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('javascript')
    const formRegister = document.getElementById('form-register');
    const nameInput = document.getElementById('input-name');
    const emailInput = document.getElementById('input-email');
    const passwordInput = document.getElementById('input-password');
    const btnRegister = document.getElementById('btn-register');

    formRegister.addEventListener('submit', async(evt) => {
    evt.preventDefault();
    btnRegister.classList.add('is-loading');
    const body = {
    name: nameInput.value,
    email: emailInput.value,
    password: passwordInput.value
    }
    const {data} = await axios.post('/register', body);
    btnRegister.classList.remove('is-loading');
    if(data.ok) return window.location.href = `/login?email=${body.email}`
    Swal.fire(
    'Good job!',
    data.msg,
    'error'
    )
    })
@endsection
