@extends('layout.base')
@section('title')
    D'amore ~ Perfil
@endsection
@section('content')
    <div class="page testimonials">
        <section class="clean-block clean-testimonials dark">
            <div class="container">
                <div class="block-heading">
                    <h2 class="text-info">{{Auth::user()->name}}</h2>
                    <p>Este es tu resumen de actividades en D'Amore Store</p>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="card clean-testimonial-item border-0 rounded-0">
                            <div class="card-header">
                                <h3> Tus datos </h3>
                            </div>
                            <div class="card-body">
                                <form action="{{route('User::update')}}" method="post" autocomplete="off">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label" for="provider-name">Rut</label>
                                            <input type="text" id="provider-name" name="rut" class="form-control item"
                                                   value="{{Auth::user()->rut}}" disabled/>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label" for="name">Nombre</label>
                                            <input type="text" id="name" name="name" class="form-control item"
                                                   value="{{Auth::user()->name}}"/>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label" for="email">Email</label>
                                            <input type="email" id="email" name="email" class="form-control item"
                                                   value="{{Auth::user()->email}}"/>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label" for="pass">Nueva Contraseña</label>
                                            <input type="password" id="pass" name="password" class="form-control item"
                                                   placeholder="Dejar vacio si no desea cambiarla"
                                                   value=""/>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label" for="address">Dirección</label>
                                            <input type="text" id="address" name="address" class="form-control item"
                                                   value="{{Auth::user()->billing_address}}"/>
                                        </div>
                                        <div class="col-12 mt-3">
                                            <button type="submit" class="btn btn-primary"> Guardar</button>
                                        </div>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card clean-testimonial-item border-0 rounded-0">
                            <div class="card-header">
                                <h3>Pedidos</h3>
                            </div>
                            <div class="card-body">
                                <ul>
                                    @foreach($user->orders as $o)
                                        <li>{{$o->created_at}} por <strong>${{$o->total}} </strong> - Estado: <strong>{{$o->status}}</strong></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
