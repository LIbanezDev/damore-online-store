@extends('layout.base')
@section('title')
    D'amore Store ~ CPanel ~ Usuarios
@endsection
@section('content')
    <div class="page payment-page">
        <section class="clean-block payment-form dark">
            <div class="container">
                <div class="block-heading">
                    <h2 class="text-info">Gestión de Usuarios Administradores </h2>
                    <p>Controlar a los usuarios administradores de la aplicación.</p>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <form id="form-register" autocomplete="off">
                            @csrf
                            <div class="products">
                                <div class="card-details">
                                    <h3 class="title">Crear Administrador</h3>
                                    <div class="row">
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
                                            <label class="form-label" for="input-address">Dirección</label>
                                            <input required
                                                   class="form-control item" type="text"
                                                   name="address"
                                                   id="input-address">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="input-password">Contraseña</label>
                                            <input class="form-control"
                                                   required type="password" name="password"
                                                   id="input-password"
                                            >
                                        </div>
                                        <div id="roles_checkboxes">
                                            @foreach($roles as $r)
                                                <div class="col-12">
                                                    <label class="checkbox">
                                                        <input class="form-check-input"
                                                               type="checkbox"
                                                               alt="{{$r->id}}"
                                                               value="{{$r->name}}" name="roles[]">
                                                        {{$r->name}}
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>
                                        <div class="col-12 mb-3">
                                            <button class="btn btn-outline-primary d-block w-100" type="submit" id="btn-register">
                                                Guardar
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-6">
                        <div class="products">
                            <ul class="nav nav-tabs mb-3">
                                @foreach($roles as $role)
                                    <li class="nav-item" onclick="tabClick({{$role->id}}, this)">
                                        <a class="nav-link" href="#">{{ucfirst($role->name)}}</a>
                                    </li>
                                @endforeach
                            </ul>
                            <ul id="users_list">
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@section('javascript')
    const usersList = document.getElementById('users_list');
    const formRegister = document.getElementById('form-register');
    const nameInput = document.getElementById('input-name');
    const addressInput = document.getElementById('input-address');
    const rutInput = document.getElementById('input-rut');
    const emailInput = document.getElementById('input-email');
    const passwordInput = document.getElementById('input-password');

    formRegister.addEventListener('submit', async(evt) => {
        var cboxes = document.getElementsByName('roles[]');
        const roles = [];
        for (let i=0; i < cboxes.length; i++) {
            if(cboxes[i].checked)  roles.push(cboxes[i].value);
        }
        evt.preventDefault();
        const body = {
            name: nameInput.value,
            email: emailInput.value,
            password: passwordInput.value,
            rut: rutInput.value,
            address: addressInput.value,
            roles
        }
        const {data} = await axios.post('/register', body);
        if(data.ok) return window.location.href = `/cpanel/usuarios`
            Swal.fire(
                'Hubo un error',
                data.msg,
                'error'
            )
    })

    const tabClick = async (roleId, tab) => {
        for (const li of document.querySelectorAll("a.active")) {
        li.classList.remove("active");
        }
        tab.classList.add('is-active');
        const {data:{users}} = await axios.get(`/api/roles/${roleId}/users`);
        usersList.innerHTML = '';
        users.forEach(user => {
        usersList.innerHTML += `
            <li class="is-size-4">
                ${user.name} - ${user.email}
                <button class="btn is-danger" onclick="deleteUser(${user.id})">
                    <i class="fas fa-trash text-danger"></i>
                </button>
            </li>`;
            });
    }
    const deleteUser = async (userId) => {
        const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
        confirmButton: 'btn btn-success',
        cancelButton: 'btn btn-danger m-3'
        },
        buttonsStyling: false
        })
        swalWithBootstrapButtons.fire({
            title: 'Estas seguro?',
            text: "Esta accion no se puede revertir",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Si, eliminar usuario',
            cancelButtonText: 'No, cancelar',
            reverseButtons: true
        }).then(async (result) => {
        if (result.isConfirmed) {
            const {data} = await axios.delete(`/api/users/remove/${userId}`);
            await swalWithBootstrapButtons.fire(
            'Eliminado!',
            data,
            'success'
            );
            location.reload();
            }
        })
    }

@endsection
