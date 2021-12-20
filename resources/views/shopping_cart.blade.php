@extends('layout.base')
@section('title')
    D'amore Store ~ Carrito
@endsection
@section('content')
    <main class="page shopping-cart-page">
        <section class="clean-block clean-cart dark">
            <div class="container">
                <div class="block-heading">
                </div>
                <div class="content">
                    <div class="row g-0">
                        <div class="col-md-12 col-lg-8">
                            <div class="items" id="products-list">
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-4">
                            <div class="summary" id="resumen">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
@section('javascript')
    const productsList = document.getElementById('products-list');
    const resumen = document.getElementById('resumen');
    const products = [];

    const goToPayment = (total) => {
        localStorage.setItem('products', JSON.stringify(products));
        localStorage.setItem('total', total);
        window.location.href = '/confirmar-pago';
    }

    const updateSummary = () => {
        let suma = 0;
        products.forEach(({id, price}) => {
            suma += parseInt(document.getElementById(`cantidad_p_${id}`).value) * price;
        })
        resumen.innerHTML = `
            <h3>Resumen</h3>
            <h4><span class="text">Subtotal</span><span class="price">$${suma}</span></h4>
            <h4><span class="text">Descuento</span><span class="price">$0</span></h4>
            <h4><span class="text">Envío</span><span class="price">$0</span></h4>
            <h4><span class="text">Total</span><span class="price"><strong>$${suma}</strong></span></h4>
            <button class="btn btn-primary btn-lg d-block w-100" type="button" onclick="goToPayment(${suma})">Pagar</button>
        `;
    }

    const updateAmount = (evt) => {
        const pos = products.map(p => p.id).indexOf(parseInt(evt.target.id.charAt(evt.target.id.length - 1)));
        products[pos].amount = parseInt(evt.target.value);
    }

    const removeItemFromCart = (id) => {
        const carrito = JSON.parse(localStorage.getItem('carrito'));
        const index = carrito.indexOf(id.toString());
        carrito.splice(index, 1);
        localStorage.setItem('carrito', JSON.stringify(carrito));
        location.reload();
    }

    document.addEventListener('DOMContentLoaded', async () => {
        let carrito = [];
        if(localStorage.getItem('carrito') !== null) carrito = JSON.parse(localStorage.getItem('carrito'));
        if(carrito.length === 0) {
            productsList.innerHTML = '<h2 class="p-4"> No hay productos en el carro </h2>';
        } else {
            const url = `/api/products?ids=${carrito.toString()}`;
            const {data} = await axios.get(url);
            data.forEach((p) => {
                productsList.innerHTML += `
                    <div class="product">
                        <div class="row justify-content-center align-items-center">
                            <div class="col-md-3">
                                    <div class="product-image">
                                        <a href="/productos/${p.name}" class="link-primary">
                                            <img class="img-fluid d-block mx-auto image" src="${p.profile_image}" />
                                        </a>
                                    </div>
                            </div>
                            <div class="col-md-3 product-info">
                                 <strong>${p.name} </strong>
                            </div>
                            <div class="col-6 col-md-2 quantity">
                                <label class="form-label d-none d-md-block" for="quantity">
                                    Cantidad (Máximo: ${p.stock})
                                </label>
                                <input type="number" id="cantidad_p_${p.id}" class="form-control quantity-input" value="1" min="1" max="${p.stock}">
                            </div>
                            <div class="col-6 col-md-2 price"><span>$${p.price}</span></div>
                            <div class="col-6 col-md-2 price">
                                <a href="#" class="nav-link" onclick="removeItemFromCart(${p.id})">
                                    <i class="fa fa-trash text-danger"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                `;
                products.push({
                    id: p.id,
                    price: p.price,
                    name: p.name,
                    amount: 1
                })
            });
            updateSummary();
                products.forEach(p => {
                    document.getElementById(`cantidad_p_${p.id}`).addEventListener('change', (evt) => {
                        updateSummary()
                        updateAmount(evt)
                    })
            })
        }
    });

@endsection
