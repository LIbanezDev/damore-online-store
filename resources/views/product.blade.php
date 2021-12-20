@extends('layout.base')
@section('title')
    D'amore Store ~ Inicio
@endsection
@section('content')
    <div class="page product-page">
        <section class="clean-block clean-product dark">
            <div class="container">
                <div class="block-heading">
                </div>
                <div class="block-content">
                    <div class="product-info">
                        <div class="row">
                            <div class="col-md-5">
                                <div class="gallery">
                                    <div id="product-preview" class="vanilla-zoom">
                                        <div class="zoomed-image"></div>
                                        <div class="sidebar">
                                            <img class="img-fluid d-block small-preview" src="{{$p->profile_image}}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="info">
                                    <div class="text">
                                        {!! $p->description !!}
                                    </div>
                                    <p>
                                        @if($p->stock > 0)
                                            Quedan {{$p->stock}} unidades!
                                        @else
                                            El producto está agotado! :(
                                        @endif
                                    </p>
                                    <button class="btn btn-primary" {{$p->stock == 0 ? 'disabled' : ''}}
                                            type="button" onclick="addToCart({{$p->id}})">
                                        <i class="fas fa-cart-plus"></i> Añadir al carrito
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="clean-related-items">
                        <h3>Productos Relacionados</h3>
                        <div class="items">
                            <div class="row justify-content-center">
                                @foreach($related as $r)
                                    <div class="col-sm-6 col-lg-4">
                                        <div class="clean-related-item">
                                            <div class="image"><a href="{{route('Products::getOne', ['name' => $r->name])}}">
                                                    <img class="img-fluid d-block mx-auto" src="{{$r->profile_image}}"></a></div>
                                            <div class="related-name"><a href="#">{{$r->name}}</a>
                                                <h4>${{$r->price}}</h4>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@section('javascript')

    const addToCart = async (productId) => {
    let carrito = [];
    if(localStorage.getItem('carrito') !== null) carrito = JSON.parse(localStorage.getItem('carrito'));
    if (carrito.indexOf(productId) === -1){
    carrito.push(productId);
    localStorage.setItem('carrito', JSON.stringify(carrito));
    Swal.fire(
    'Exito',
    'Se ha agregado el producto al carrito',
    'success'
    );
    } else {
    Swal.fire(
    'Error',
    'El producto ya ha sido agregado al carrito,',
    'error'
    );
    }
    }
@endsection
