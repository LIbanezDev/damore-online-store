@extends('layout.base')
@section('title')
    D'amore Store ~ Inicio
@endsection
@section('content')
    <div class="page catalog-page">
        <section class="clean-block clean-catalog dark">
            <div class="container">
                <div class="block-heading">
                </div>
                <div class="content">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="d-none d-md-block">
                                <div class="filters">
                                    <div class="filter-item">
                                        <h3>Categorias</h3>
                                        @foreach($categories as $c)
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="{{$c->name}}" name="checkbox_category"
                                                       onclick="filterItems({{$c->id}})" value="{{$c->id}}">
                                                <label class="form-check-label" for="{{$c->name}}">{{$c->name}} <i class="{{$c->icon}}"></i></label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="d-md-none">
                                <a class="btn btn-link d-md-none filter-collapse" data-bs-toggle="collapse"
                                   aria-expanded="false" aria-controls="filters"
                                   href="#filters" role="button">
                                    Filters
                                    <i class="icon-arrow-down filter-caret"></i></a>
                                <div class="collapse" id="filters">
                                    <div class="filters">
                                        <div class="filter-item">
                                            <h3>Categorias</h3>
                                            @foreach($categories as $c)
                                                <div class="form-check">
                                                    <input
                                                        class="form-check-input"
                                                        type="checkbox"
                                                        id="{{$c->name}}"
                                                        name="checkbox_category"
                                                        onclick="filterItems({{$c->id}})"
                                                        value="{{$c->id}}"
                                                    >
                                                    <label class="form-check-label" for="{{$c->name}}"><i class="fas fa-wine-bottle"></i>{{$c->name}}</label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="products">
                                <div class="row g-0" id="products-container">
                                    @foreach($products as $p)
                                        <div class="col-12 col-md-6 col-lg-4">
                                            <div class="clean-product-item">
                                                <div class="image"><a href="{{route('Products::getOne', ['name' => $p->name])}}">
                                                        <img class="img-fluid d-block mx-auto" src="{{$p->profile_image}}"></a></div>
                                                <div class="product-name"><a href="{{route('Products::getOne', ['name' => $p->name])}}">
                                                        <strong>{{$p->name}}</strong></a></div>
                                                <div class="about">
                                                    <div class="rating">
                                                        @if($p->stock > 0)
                                                            {{$p->stock}} unidades
                                                        @else
                                                            Agotado!!!
                                                        @endif
                                                    </div>
                                                    <div class="price">
                                                        <h3>${{$p->price}}</h3>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@section('javascript')


    const filterItems = async () => {
        const checkedBoxes = document.querySelectorAll('input[name=checkbox_category]:checked');
        const productsContainer = document.getElementById('products-container');
        const filtros = [];

        checkedBoxes.forEach(c => {
            filtros.push(parseInt(c.value.toLowerCase()))
        });

        const {data} = await axios.get(`/api/products?categories=${filtros.toString()}`)

        productsContainer.innerHTML = '';

        data.forEach(p => {
            productsContainer.innerHTML += `
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="clean-product-item">
                        <div class="image"><a href="/productos/${p.id}">
                                <img class="img-fluid d-block mx-auto" src="${p.profile_image}"></a></div>
                        <div class="product-name">
                            <a href="/productos/${p.id}"><strong>${p.name}</strong></a>
                        </div>
                        <div class="about">
                            <div class="rating">${p.stock === 0 ? `${p.stock} unidades` : 'Agotado!!!'}</div>
                            <div class="price">
                                <h3>$${p.price}</h3>
                            </div>
                        </div>
                    </div>
                </div>
            `;
        })

    }

@endsection
