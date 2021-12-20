@extends('layout.base')
@section('title')
    D'amore Store ~ Pago
@endsection
@section('content')
    <div class="page payment-page">
        <section class="clean-block payment-form dark">
            <div class="container">
                <div class="block-heading">
                    <div id="main-msg">
                        <h2 class="text-info">Pago</h2>
                        <p>
                            Tu carro está vacio, añade productos para poder proceder al pago.
                        </p>
                    </div>
                    <div id="main-msg-success" class="d-none">
                        <h2 class="text-info">Pago</h2>
                        <p>
                            Confirma tu compra y realiza la transferencia a la cuenta indicada, en un plazo máximo de 2 días hábiles se confirmará el pago
                            y se va a proceder con el envío.
                        </p>
                    </div>
                </div>
                <form method="post" id="form-order" class="d-none">
                    <div class="products">
                        <h3 class="title">Resumen de orden</h3>
                        <div id="products_resumen">
                        </div>
                        <div class="total"><span>Total</span><span class="price" id="total"></span></div>
                    </div>
                    <div class="card-details mb-4">
                        <h3 class="title">Entrega</h3>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="order-type" id="retiroTienda" value="retiro_en_tienda" checked>
                            <label class="form-check-label" for="retiroTienda">
                                Retiro en tienda Jorge Hunneus 100 - Valparaiso (+0$)
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="order-type" value="delivery" id="delivery">
                            <label class="form-check-label" for="delivery">
                                Envío a domicilio dentro de la V Región
                            </label>
                        </div>
                        <div class="row mb-4" id="client_data">
                            <h3 class="title mt-2">Confirma tus datos de contacto</h3>
                            <div class="col-sm-6">
                                <div class="mb-3"><label class="form-label" for="rut">Rut</label>
                                    <input class="form-control" type="text" id="rut"
                                           placeholder="Sin puntos ni guión" name="rut" value="{{Auth::user()->rut ?? ''}}" {{ Auth::check() ? 'disabled' : ''}}></div>
                            </div>
                            <div class="col-sm-6">
                                <div class="mb-3"><label class="form-label" for="name">Nombre</label>
                                    <input class="form-control" type="text" id="name"
                                           placeholder="Nombre y apellido" name="name" value="{{Auth::user()->name ?? ''}}" {{ Auth::check() ? 'disabled' : ''}}>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label" for="email">Correo electrónico</label>
                                <input class="form-control" type="text" id="email"
                                       placeholder="usuario@gmail.com" name="email" value="{{Auth::user()->email ?? ''}}">

                            </div>
                            <div class="col-sm-6">
                                <label class="form-label" for="address">Dirección de entrega</label>
                                <input class="form-control" type="text" id="address" placeholder="Comuna, Dirección"
                                       name="address" value="{{Auth::user()->default_shipping_address ?? ''}}">

                            </div>
                        </div>
                        <h3 class="title mt-2">Datos de transferencia</h3>
                        <h6 class="mb-2" id="total_2">Total a pagar: </h6>
                        <div class="col-12 mt-2">
                            <img class="img-fluid" src="https://www.bellpro.cl/wp-content/uploads/2020/09/bancoestado.png" alt="">
                        </div>
                        <div class="mb-3 mt-3">
                            <label for="comprobante" class="form-label">Comprobante de transferencia</label>
                            <input id="comprobante" class="form-control" type="file" name="file">
                        </div>
                        <div class="col-sm-12">
                            <div class="mb-3">
                                <button class="btn btn-primary d-block w-100" type="submit">Confirmar</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    </div>
@endsection
@section('javascript')
    const productsResumenContainer = document.getElementById('products_resumen');
    const infoEnvioContainer = document.getElementById('client_data');
    const rutInput = document.getElementById('rut');
    const nameInput = document.getElementById('name');
    const emailInput = document.getElementById('email');
    const addressInput = document.getElementById('address');
    const totalText = document.getElementById('total');
    const formOrder = document.getElementById('form-order');
    const products = JSON.parse(localStorage.getItem('products'))
    const total = localStorage.getItem('total');
    const radioBtns = document.getElementsByName('order-type');

    formOrder.addEventListener('submit', async (evt) => {
        evt.preventDefault();
        let formData = new FormData();
        if (document.getElementById('comprobante').files.length > 0) {
            const file = document.getElementById('comprobante').files[0]
            formData.append('file', file);
        }
        products.forEach(p => {
            formData.append('products[]', JSON.stringify(p));
        })
        if({{Auth::check()}} === 1) formData.append('user_id', {{Auth::user()->id}});
        formData.append('name', nameInput.value);
        formData.append('rut', emailInput.value);
        formData.append('email', emailInput.value);
        formData.append('shipping_address', addressInput.value);
        formData.append('total', total);
        for(i = 0; i < radioBtns.length; i++) {
            if(radioBtns[i].checked) formData.append('order_type', radioBtns[i].value);
        }
        const {data} = await axios.post('/api/orders', formData);
        if(data.ok) {
            localStorage.clear();
            await Swal.fire(
                'Exito',
                'La orden se ha creado correctamente, en un plazo de 2 días hábiles ya debería estar confirmada',
                'success'
            )
            window.location.href = '/productos';
        }
    })

    document.addEventListener('DOMContentLoaded', async () => {
    products.forEach(p => {
    productsResumenContainer.innerHTML += `
    <div class="item"><span class="price">$${p.price}</span>
        <p class="item-name">${p.name} x${p.amount}</p>
    </div>`
    document.getElementById('main-msg').classList.add('d-none');
    document.getElementById('main-msg-success').classList.remove('d-none');
    formOrder.classList.remove('d-none');
    });
    totalText.innerText = '$' + total;
    document.getElementById('total_2').innerHTML = `Total a pagar: $<strong> ${total} </strong>`;
    });

@endsection
