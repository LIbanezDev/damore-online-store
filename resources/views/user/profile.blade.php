@extends('layout.base')
@section('title')
    D'amore ~ Perfil
@endsection
@section('content')
    <div class="content has-text-centered">
        <h1> Perfil </h1>
        <p>
            Estas loggeado como <strong>{{Auth::user()->name}}</strong> y tu correo es <strong>{{Auth::user()->email}}</strong>
        </p>
    </div>
@endsection
