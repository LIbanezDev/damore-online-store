@extends('layout.base')
@section('titulo')
    D'amore Store ~ Inicio
@endsection
@section('content')
    <div class="content has-text-centered">
        <h1>
            @guest No estas autenticado @else {{Auth::user()->name}} @endguest
        </h1>
        <h2>
            @auth
                <a href="{{route('User::profile')}}"> Profile </a>
                <form action="{{route('logout')}}" method="POST">
                    @csrf
                    <button class="button is-white" onclick="this.closest('form').submit()">
                                <span class="fa fa-power-off has-text-danger">
                                </span>
                    </button>
                </form>
            @else
                <a href="{{route('register')}}"> Registro </a> <hr/>
                <a href="{{route('login')}}"> Login </a>
            @endauth
        </h2>
    </div>
@endsection
