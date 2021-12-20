@extends('layout.base')
@section('title')
    D'amore Store ~ CPanel ~ Productos
@endsection
@section('css')
    .icon-select {
    font-family: 'FontAwesome', 'Second Font name'
    }
@endsection
@section('content')
    <div class="page payment-page">
        <section class="clean-block payment-form dark">
            <div class="container">
                <div class="block-heading">
                    <h2 class="text-info">Administración de Productos</h2>
                    <p>Gestionar los productos que se muestran en la tienda.</p>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-4">
                        <form method="post" id="form-create" autocomplete="off">
                            @csrf
                            <div class="row p-4">
                                <h3 class="title">Crear Producto</h3>
                                <div class="col-12 mb-3">
                                    <label class="form-label" for="product-name">Nombre</label>
                                    <input type="text" id="product-name" name="name" class="form-control item"/>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label" for="product-stock">Stock</label>
                                    <input type="number" id="product-stock" name="stock" class="form-control item"/>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label" for="product-price">Precio unitario</label>
                                    <input type="number" id="product-price" name="price" class="form-control item"/>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label" for="product-weight">Peso en gramos</label>
                                    <input type="number" id="product-weight" name="weight" placeholder="0 si no sabe" class="form-control item"/>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" for="product-weight">Proveedor</label>
                                    <select class="form-select" name="provider" id="product-provider" aria-label="Default select example">
                                        @foreach($providers as $p)
                                            <option value="{{$p->id}}">{{$p->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" for="product-weight">Categoría</label>
                                    <select class="form-select" name="category" id="product-category" aria-label="Default select example">
                                        @foreach($categories as $c)
                                            <option value="{{$c->id}}">{{$c->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3 mt-3">
                                    <label for="profile-image" class="form-label">Imagen principal</label>
                                    <input id="product-img" class="form-control" type="file" name="product-img">
                                </div>
                                <div class="col-12 mb-3 d-none" id="desc-container">
                                    <label class="form-label" for="product-info">Información</label>
                                    <textarea id="product-info"></textarea>
                                </div>
                                <div class="col-12" id="manage-products">
                                    <button class="btn btn-outline-primary d-block w-100" type="submit" id="btn-register">
                                        Guardar
                                    </button>
                                </div>
                            </div>
                        </form>
                        <div class="col-md-12 mt-4">
                            <div class="products">
                                <ul class="nav nav-tabs mb-3">
                                    @foreach($categories as $c)
                                        <li class="nav-item" onclick="tabClick({{$c->id}}, this)">
                                            <a class="nav-link" href="#manage-products">{{ucfirst($c->name)}}</a>
                                        </li>
                                    @endforeach
                                </ul>
                                <ul id="products_list">
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-12 mb-4">
                                <form method="post" action="{{route('Provider::create')}}" autocomplete="off">
                                    @csrf
                                    <div class="row p-4">
                                        <h3 class="title">Proveedor</h3>
                                        <div class="col-12 mb-3">
                                            <label class="form-label" for="provider-name">Nombre</label>
                                            <input type="text" id="provider-name" name="name" class="form-control item"/>
                                        </div>
                                        <div class="col-12 mb-3">
                                            <label class="form-label" for="provider-phone">Numero telefónico</label>
                                            <input type="text" value="+569" id="provider-phone" placeholder="Incluir +código de país, ej: +56" name="phone" class="form-control
                                            item"/>
                                        </div>
                                        <div class="col-12 mb-3">
                                            <label class="form-label" for="provider-address">Dirección física</label>
                                            <input type="text" id="provider-address" name="address" class="form-control item"/>
                                        </div>
                                        <div class="col-12 mb-3">
                                            <label class="form-label" for="provider-info">Información</label>
                                            <textarea type="text"
                                                      id="provider-info"
                                                      placeholder="Información general sobre el proveedor, ej: proporciona articulos de tipo ..."
                                                      name="description"
                                                      class="form-control item"></textarea>
                                        </div>
                                        <div class="col-12">
                                            <button class="btn btn-outline-success d-block w-100" type="submit">
                                                Guardar
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="col-12">
                                <form method="post" action="{{route('Category::create')}}" autocomplete="off">
                                    @csrf
                                    <div class="row p-4">
                                        <h3 class="title">Categoria</h3>
                                        <div class="col-12 mb-3">
                                            <div class="row">
                                                <div class="col-9">
                                                    <label class="form-label" for="name">Nombre</label>
                                                    <input type="text" id="category-name" name="name" class="form-control item"/>
                                                </div>
                                                <div class="col">
                                                    <label class="form-label" for="category-icon">Icono</label>
                                                    <select class="form-select icon-select" name="icon" id="category-icon">
                                                        <option value="fas fa-wine-bottle" selected>&#xf72f;</option>
                                                        <option value="fas fa-spray-can">&#xf5bd;</option>
                                                        <option value="fas fa-flask">&#xf0c3;</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <button class="btn btn-outline-success d-block w-100" type="submit">
                                                Guardar
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@section('javascript')
    const nameInput = document.getElementById('product-name');
    const stockInput = document.getElementById('product-stock');
    const priceInput = document.getElementById('product-price');
    const weightInput = document.getElementById('product-weight');
    const providerSelect = document.getElementById('product-provider');
    const categorySelect = document.getElementById('product-category');
    const formCreate = document.getElementById('form-create');
    const productsList = document.getElementById('products_list');

    const updateStock = async (pId) => {
        const inputValue = document.getElementById(`p-${pId}`)
        const {data} = await axios.patch(`/api/products/${pId}`, {
            stock: inputValue.value
        })
        if(data.ok) {
            Swal.fire(
                'Exito',
                'El stock del producto se ha actualizado correctamente',
                'success'
            )
        }
    }

    const deleteProduct = (id) => {
        const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
        confirmButton: 'btn btn-success',
        cancelButton: 'btn btn-danger m-3'
        },
        buttonsStyling: false
        })
        swalWithBootstrapButtons.fire({
            title: 'Estas seguro?',
            text: "Esta accion no se puede revertir",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Si, eliminar producto',
            cancelButtonText: 'No, cancelar',
            reverseButtons: true
            }).then(async (result) => {
            if (result.isConfirmed) {
                try {
                    const {data} = await axios.delete(`/api/products/${id}`);
                    await swalWithBootstrapButtons.fire(
                        'Eliminado!',
                        data,
                        'success'
                    );
                    location.reload();
                } catch (e) {
                    swalWithBootstrapButtons.fire(
                        'Error!',
                        'El producto no puede ser eliminado si esta presente en ordenes de compra.',
                        'warning'
                    );
                }

            }
        })
    }

    const tabClick = async (catId, tab) => {
        for (const li of document.querySelectorAll("a.active")) {
        li.classList.remove("active");
        }
        tab.classList.add('is-active');
        const {data} = await axios.get(`/api/products?categories=${catId}`);
        productsList.innerHTML = '';
        data.forEach(p => {
        productsList.innerHTML += `
        <li class="is-size-4">
            ${p.name}
            <button class="btn" onclick="deleteProduct(${p.id})">
                <i class="fas fa-trash text-danger mr-3"></i>
            </button>
            <div class="row">
                <div class="col-md-3">
                    <label for="p-${p.id}"> <h5>  Stock:  </h5></label>
                </div>
                <div class="col-md-5">
                    <input type="number" id="p-${p.id}" value="${p.stock}" min="0" class="form-control item">
                </div>
                <div class="col">
                    <button class="btn btn-warning" onclick="updateStock(${p.id})">
                        Modificar
                    </button>
                </div>
        </li>`;
        });
    }

    formCreate.addEventListener('submit', async (evt) => {
    evt.preventDefault();
    let formData = new FormData();
    formData.append('file', document.getElementById('product-img').files[0]);
    formData.append('name', nameInput.value);
    formData.append('stock', stockInput.value);
    formData.append('price', priceInput.value);
    formData.append('weight', weightInput.value);
    formData.append('description', tinymce.activeEditor.getContent());
    formData.append('category', categorySelect.value);
    formData.append('provider', providerSelect.value);
    const {data} = await axios.post('/api/products', formData);
    if (data.ok) {
    Swal.fire(
    'Exito',
    'Se ha creado el nuevo producto ' + nameInput.value,
    'success'
    )
    formCreate.reset();
    }
    })

    categorySelect.addEventListener('click', async () => {
    document.getElementById('desc-container').classList.remove('d-none');
    const f = new Intl.NumberFormat('es-CL', {
    style: 'currency',
    currency: 'CLP'
    })
    await tinymce.init({
    height: '400',
    selector: 'textarea#product-info',
    menubar: true,
    plugins: [
    'emoticons',
    'lists advlist',
    'image'
    ],
    toolbar: 'undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | ' +
    'bullist numlist outdent indent | link image | print preview media fullpage | ' +
    'forecolor backcolor emoticons | help  | fontsizeselect',
    fontsize_formats: '8pt 10pt 12pt 14pt 16pt 18pt 24pt 36pt 48pt',
    content_style: 'body { font-family:Montserrat,Arial,sans-serif; font-size:28px }'
    });
    tinymce.activeEditor.setContent(`<p><span style="font-size: 26pt;">${nameInput.value}</span></p>
    <p><span style="font-size: 16pt;">---------------- Inserte descripcion -----------------------</span></p>
    <p><strong><span style="font-size: 15pt;">${f.format(priceInput.value)}</span></strong></p>`);
    })


@endsection
