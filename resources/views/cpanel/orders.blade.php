@extends('layout.base')
@section('title')
    D'amore Store ~ CPanel ~ Ordenes
@endsection
@section('content')
    <div class="page payment-page">
        <section class="clean-block payment-form dark">
            <div class="container">
                <div class="block-heading">
                    <h2 class="text-info">Administrar los pedidos</h2>
                    <p>Puedes revisar y cambiar el estado de los pedidos.</p>
                </div>
                <div class="row">
                    <div class="col-md-5">
                        <div class="list-group" id="list-tab" role="tablist">
                            @for($i = 0; $i < count($orders); $i++)
                                <a class="list-group-item list-group-item-action {{$i == 0 ? 'active' : ''}}" id="tab-{{$i}}" href="#" role="tab"
                                   onclick="tabClick({{$i}})">
                                    {{$orders[$i]->email}} | ${{$orders[$i]->total}} | {{$orders[$i]->created_at}}
                                </a>
                            @endfor
                        </div>
                    </div>
                    <div class="col">
                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="order-active" role="tabpanel" aria-labelledby="list-home-list">
                                @if(count($orders) > 0)
                                    @for($i = 0; $i < count($orders); $i++)
                                        <div class="row {{$i > 0 ? 'd-none' : ''}} xd" id="order-{{$i}}">
                                            <div class="col-md-5">
                                                <ul>
                                                    @foreach($orders[$i]->products as $p)
                                                        <li>{{$p->name}} | ${{$p->price}} | (x{{$p->pivot->amount}})</li>
                                                    @endforeach
                                                </ul>
                                                <p>Total: ${{$orders[$i]->total}}</p>
                                                <p>Datos de Usuario: </p>
                                                <p>{{$orders[$i]->email}}</p>
                                                <p>Tipo de pedido: <strong>{{$orders[$i]->order_type}} </strong></p>
                                                <a href="/{{$orders[$i]->receipt}}" class="link-primary" target="_blank">Descargar comprobante</a>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="status" class="label"> Estado de orden </label>
                                                <select class="form-select" aria-label="Default select example" id="order_status_{{$orders[$i]->id}}">
                                                    <option value="pendiente" {{$orders[$i]->status == 'pendiente' ? 'selected' : ''}}>Pendiente</option>
                                                    <option value="aceptada" {{$orders[$i]->status == 'aceptada' ? 'selected' : ''}}>Aceptada</option>
                                                    <option value="pagada" {{$orders[$i]->status == 'pagada' ? 'selected' : ''}}>Pagada</option>
                                                    <option value="despachada" {{$orders[$i]->status == 'despachada' ? 'selected' : ''}}>Despachada</option>
                                                    <option value="rechazada" {{$orders[$i]->status == 'rechazada' ? 'selected' : ''}}>Rechazada</option>
                                                </select>
                                                <button class="btn btn-primary mt-3" onclick="updateState({{$orders[$i]->id}})"> Guardar</button>
                                            </div>
                                        </div>
                                    @endfor
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@section('javascript')
    const tabs = document.getElementById('list-tab');
    const orderActive = document.getElementById('order-active');


    const updateState = async (id) => {
        const orderStatus = document.getElementById(`order_status_${id}`);
        const {data} = await axios.post(`/api/orders/${id}/status`, {
            status: orderStatus.value
        });
        if(data.ok) {
            await Swal.fire(
                'Exito!',
                'Se ha actualizado el estado de la orden',
                'success'
                )
        }
    }

    const tabClick = (position) => {
        for (const li of document.querySelectorAll("a.active")) {
        li.classList.remove("active");
        }
        document.getElementById(`tab-${position}`).classList.add('active');

        for (const div of document.querySelectorAll("div.xd")) {
        div.classList.add("d-none");
        }
        document.getElementById(`order-${position}`).classList.remove('d-none');
    }

@endsection

