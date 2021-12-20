@extends('layout.base')
@section('title')
    D'amore Store ~ CPanel
@endsection
@section('content')
    <main class="page">
        <section class="clean-block features">
            <div class="container">
                <div class="block-heading">
                    <h2 class="text-info">Panel de Administración</h2>
                    <p>Seleccione qué desea gestionar.</p>
                </div>
                <div class="row justify-content-center">
                    @can('gestionar roles y permisos')
                        <div class="col-md-5 feature-box"><i class="fa fa-lock icon"></i>
                            <h4><a href="{{route('Cpanel::roles')}}" class="text-decoration-none text-black">Roles y Permisos</a></h4>
                            <p>Maneje los roles y permisos para autorizar a usuarios administradores a realizar diferentes tareas.</p>
                        </div>
                    @endcan
                    @can('gestionar usuarios administradores')
                        <div class="col-md-5 feature-box"><i class="fa fa-users icon"></i>
                            <h4><a href="{{route('Cpanel::usuarios')}}" class="text-decoration-none text-black"> Usuarios administradores </a> </h4>
                            <p>Cree nuevos usuarios para administrar la aplicación web.</p>
                        </div>
                    @endcan
                    @if(Gate::check('crear productos') || Gate::check('modificar productos') || Gate::check('eliminar productos'))
                        <div class="col-md-5 feature-box"><i class="fa fa-boxes icon"></i>
                            <h4><a href="{{route('Cpanel::productos')}}" class="text-decoration-none text-black"> Productos </a> </h4>
                            <p>Administrar los productos del inventario que se presentan en el sitio.</p>
                        </div>
                    @endif
                    @can('gestionar pedidos')
                        <div class="col-md-5 feature-box"><i class="fas fa-truck-loading icon"></i>
                            <h4>
                                <a href="{{route('Cpanel::ordenes')}}" class="text-decoration-none text-black">
                                    Ordenes
                                </a>
                            </h4>
                            <p>Gestione las ordenes hechas por los clientes.</p>
                        </div>
                    @endcan
                </div>
            </div>
        </section>
    </main>
@endsection
@section('javascript')

@endsection
