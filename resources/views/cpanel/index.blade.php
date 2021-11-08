@extends('layout.base')
@section('title')
    D'amore Store ~ CPanel
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
        <div class="column is-12">
            <div class="columns is-multiline">
                @can('gestionar roles y permisos')
                    <div class="column is-4-desktop is-12-tablet">
                        <div class="content has-text-centered">
                            <h2><a href="{{route('Cpanel::roles')}}"> Roles </a></h2>
                        </div>
                    </div>
                @endcan
                @can('gestionar usuarios administradores')
                    <div class="column is-4-desktop is-12-tablet">
                        <div class="content has-text-centered">
                            <h2><a href="{{route('Cpanel::usuarios')}}"> Usuarios </a></h2>
                        </div>
                    </div>
                @endcan
                @if(Gate::check('crear productos') || Gate::check('modificar productos') || Gate::check('eliminar productos'))
                    <div class="column is-4-desktop is-12-tablet">
                        <div class="content has-text-centered">
                            <h2><a href="{{route('Cpanel::productos')}}"> Productos </a></h2>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
@section('javascript')

@endsection
