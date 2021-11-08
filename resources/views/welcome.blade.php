@extends('layout.base')
@section('title')
    D'amore Store ~ Inicio
@endsection
@section('content')
    <div class="columns is-multiline content">
        <div class="column is-12 has-text-centered">
            <a href="{{route('Products::index')}}">
                <img src="{{asset('assets/images/logo.png')}}" alt="">
            </a>
            <h1><a href="{{route('Products::index')}}">PRODUCTOS </a></h1>
        </div>
    </div>
@endsection
