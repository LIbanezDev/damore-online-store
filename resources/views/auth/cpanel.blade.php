@extends('layout.base')
@section('title')
    D'amore Store ~ CPanel
@endsection
@section('css')
    li {list-style-type: none;}
@endsection
@section('content')
    <div class="columns is-multiline">
        <div class="column is-12 content has-text-centered">
            <h1> PANEL DE ADMINISTRACION </h1>
            <h3 class="has-text-grey-light"> {{@Auth::user()->name}} tiene los siguientes permisos:
                @foreach(@Auth::user()->getAllPermissions() as $permission)
                    {{$permission->name}},
                @endforeach
            </h3>
        </div>
        @can('gestionar roles y permisos')
            <div class="column is-6-desktop is-12-tablet content">
                <div class="columns is-multiline">
                    <div class="column is-12">
                        <h3 class="has-text-centered"> Crear Rol </h3>
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
                                                            <input type="checkbox" value="{{$p->id}}">
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
                <h3 class="has-text-centered"> Asignaciones </h3>
                <div class="columns">
                    <div class="column is-8-desktop is-12-tablet">
                        <aside class="menu">
                            <p class="menu-label has-text-centered">
                                seleccione un usuario
                            </p>
                            <ul class="menu-list">
                                <li><a>Dueño</a></li>
                                <li><a>Lucas</a></li>
                                <li><a>Kevin</a></li>
                            </ul>
                        </aside>
                    </div>
                    {{-- TODO:  Implementar asignaciones de roles --}}
                    <div class="column">
                        <div class="columns is-multiline">
                            @foreach($permissions as $p)
                                <div class="column is-12">
                                    <label class="checkbox">
                                        <input type="checkbox" value="{{$p->id}}">
                                        {{$p->name}}
                                    </label>
                                </div>
                            @endforeach
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
            </div>
        @endcan
    </div>
@endsection
@section('javascript')

@endsection
