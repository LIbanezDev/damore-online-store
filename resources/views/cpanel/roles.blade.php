@extends('layout.base')
@section('title')
    D'amore Store ~ CPanel ~ Roles
@endsection
@section('css')
    li {list-style-type: none;}
@endsection
@section('content')
    <div class="columns is-multiline">
        <div class="column is-6-desktop is-12-tablet content">
            <div class="columns is-multiline">
                <div class="column is-12">
                    <h4 class="has-text-centered"> Crear rol </h4>
                    <form method="post" action="{{route('Rol::create')}}" autocomplete="off">
                        @csrf
                        <div class="columns is-multiline">
                            <div class="column is-12">
                                <div class="field">
                                    <label class="label"> Nombre </label>
                                    <div class="control">
                                        <input type="text" class="input" name="name" required>
                                    </div>
                                </div>
                            </div>
                            <div class="column is-12">
                                <div class="field">
                                    <div class="control">
                                        <div class="columns is-multiline">
                                            @foreach($permissions as $p)
                                                <div class="column is-3">
                                                    <label class="checkbox">
                                                        <input type="checkbox" value="{{$p->name}}"
                                                               name="permissions[]">
                                                        {{$p->name}}
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="column">
                                <div class="field">
                                    <div class="control">
                                        <button class="button" type="submit">
                                                <span class="icon is-small">
                                                  <i class="fas fa-save"></i>
                                                </span>
                                            <span>Guardar</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="column content">
            <h4 class="has-text-centered"> Asignar </h4>
            <form method="post" action="{{route('Rol::modifyByUser')}}">
                @csrf
                <div class="columns">
                    <div class="column is-8-desktop is-12-tablet">
                        <aside class="menu">
                            <p class="menu-label has-text-centered">
                                seleccione un usuario
                            </p>
                            <ul class="menu-list" id="users_ul">
                                @foreach($users as $u)
                                    <li><a onclick="userClick({{$u->id}})" id="u-{{$u->id}}">{{$u->name}}
                                            - {{$u->email}} </a></li>
                                @endforeach
                            </ul>
                        </aside>
                    </div>
                    <div class="column">
                        <div class="columns is-multiline">
                            <div id="roles_checkboxes">
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
                                    <span>Guardar</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('javascript')
    const rolesCheckboxes = document.getElementById('roles_checkboxes');
    const usersListUl = document.getElementById('users_ul');

    const userClick = async (userId) => {
    const items = usersListUl.getElementsByTagName('li');
    for (let i = 0; i < items.length; i++) {
    items[i].firstElementChild.classList.remove('is-active');
    }
    document.getElementById(`u-${userId}`).classList.add('is-active');
    const {data:roles} = await axios.get(`/api/roles?user_id=${userId}`);
    const rolesIds = roles.map(r => r.role_id);
    const checkboxesDivs = rolesCheckboxes.getElementsByTagName('div');
    for (let i = 0; i < checkboxesDivs.length; i++) {
    const checkbox = checkboxesDivs[i].firstElementChild.firstElementChild;
    checkbox.checked = rolesIds.indexOf(parseInt(checkbox.alt)) !== -1;
    }
    }
@endsection
