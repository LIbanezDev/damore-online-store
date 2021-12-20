@extends('layout.base')
@section('title')
    D'amore Store ~ CPanel ~ Roles
@endsection
@section('css')
    li {list-style-type: none;}
@endsection
@section('content')
    <div class="page payment-page">
        <section class="clean-block payment-form dark">
            <div class="container">
                <div class="block-heading">
                    <h2 class="text-info">Administración de Roles y Permisos</h2>
                    <p>Agregar, asignar y eliminar los roles y permisos de los usuarios administradores.</p>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <form method="post" action="{{route('Rol::create')}}" autocomplete="off">
                            @csrf
                            <div class="products">
                                <div class="card-details">
                                    <h3 class="title">Agregar Rol</h3>
                                    <div class="row">
                                        <div class="col-12 mb-3">
                                            <label class="form-label" for="input-name">Nombre</label>
                                            <input required
                                                   class="form-control item" type="text"
                                                   name="name"
                                                   id="input-name">
                                        </div>
                                        <label class="form-label">Permisos</label>
                                        @foreach($permissions as $p)
                                            <div class="col-12">
                                                <input class="form-check-input" type="checkbox"
                                                       value="{{$p->name}}"
                                                       name="permissions[]" id="{{$p->name}}"/>
                                                <label class="form-check-label" for="{{$p->name}}">
                                                    {{$p->name}}
                                                </label>
                                            </div>
                                        @endforeach
                                        <div class="col-12 mb-3">
                                            <button class="btn btn-outline-primary d-block w-100" type="submit">Guardar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col">
                        <form method="post" action="{{route('Rol::modifyByUser')}}" class="mb-3">
                            @csrf
                            <input type="hidden" id="hidden" name="userId" value="">
                            <div class="products">
                                <div class="card-details">
                                    <h3 class="title">Asignar</h3>
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="list-group" id="users_ul">
                                                @foreach($users as $u)
                                                    <a href="#form-asign" class="list-group-item list-group-item-action"
                                                       onclick="userClick({{$u->id}})" id="u-{{$u->id}}">
                                                        {{$u->email}}
                                                    </a>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="row">
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
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <button class="btn btn-outline-success d-block w-100" type="submit">Guardar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <form method="post" action="{{route('Rol::remove')}}" autocomplete="off">
                            @csrf
                            <div class="products">
                                <div class="card-details">
                                    <h3 class="title">Eliminar</h3>
                                    @foreach($roles as $r)
                                        <div class="col-12">
                                            <input class="form-check-input" type="checkbox"
                                                   value="{{$r->name}}"
                                                   name="roles[]" id="{{$r->name}}"/>
                                            <label class="form-check-label" for="{{$r->name}}">
                                                {{$r->name}}
                                            </label>
                                        </div>
                                    @endforeach
                                    <div class="col-md-12">
                                        <button class="btn btn-outline-danger d-block w-100" type="submit">Eliminar</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <div class="column is-6-desktop content">
        <h4 class="has-text-centered"> Eliminar </h4>
        <form method="post" action="{{route('Rol::remove')}}" autocomplete="off">
            @csrf
            <div class="columns is-multiline">
                <div class="column is-6">
                    @foreach($roles as $r)
                        <div class="column is-12">
                            <label class="checkbox">
                                <input type="checkbox" alt="{{$r->id}}" value="{{$r->name}}" name="roles[]">
                                {{$r->name}}
                            </label>
                        </div>
                    @endforeach
                </div>
                <div class="column is-12">
                    <button class="button">
                                    <span class="icon is-small">
                                      <i class="fas fa-save"></i>
                                    </span>
                        <span>Eliminar</span>
                    </button>
                </div>
            </div>
        </form>
    </div>
    </div>
@endsection
@section('javascript')
    const rolesCheckboxes = document.getElementById('roles_checkboxes');
    const usersListUl = document.getElementById('users_ul');
    const userIdInput = document.getElementById('hidden');

    const userClick = async (userId) => {
    userIdInput.value = userId;
    const items = usersListUl.getElementsByTagName('a');
    for (let i = 0; i < items.length; i++) {
    items[i].classList.remove('active');
    }
    document.getElementById(`u-${userId}`).classList.add('active');
    const {data:roles} = await axios.get(`/api/roles?user_id=${userId}`);
    const rolesIds = roles.map(r => r.role_id);
    const checkboxesDivs = rolesCheckboxes.getElementsByTagName('div');
    for (let i = 0; i < checkboxesDivs.length; i++) {
    const checkbox = checkboxesDivs[i].firstElementChild.firstElementChild;
    checkbox.checked = rolesIds.indexOf(parseInt(checkbox.alt)) !== -1;
    }
    }
@endsection
