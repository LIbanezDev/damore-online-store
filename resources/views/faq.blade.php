@extends('layout.base')
@section('title')
    D'amore ~ FAQ
@endsection
@section('content')
    <div class="page faq-page">
        <section class="clean-block clean-faq dark">
            <div class="container">
                <div class="block-heading">
                    <h2 class="text-info">FAQ</h2>
                    <p>Preguntas frecuentes</p>
                </div>
                <div class="block-content">
                    <div class="faq-item">
                        <h4 class="question">Registro</h4>
                        <div class="answer">
                            <div id="accordion-1" class="accordion" role="tablist">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" role="tab"><button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#accordion-1 .item-1" aria-expanded="false" aria-controls="accordion-1 .item-1">¿Cómo me registro en el sitio de D&#39;amore Store?<br /></button></h2>
                                    <div class="accordion-collapse collapse item-1" role="tabpanel" data-bs-parent="#accordion-1">
                                        <div class="accordion-body">
                                            <p class="mb-0">- Para registrarte debes hacer click en el botón &quot;Registro&quot; en la parte superior derecha del sitio y posteriormente seguir los pasos de registro ingresando los datos solicitados.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="faq-item">
                        <h4 class="question">¿Cómo comprar?</h4>
                        <div class="answer">
                            <div id="accordion-2" class="accordion" role="tablist">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" role="tab"><button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#accordion-2 .item-1" aria-expanded="false" aria-controls="accordion-2 .item-1">Paso a paso<br /></button></h2>
                                    <div class="accordion-collapse collapse item-1" role="tabpanel" data-bs-parent="#accordion-2">
                                        <div class="accordion-body">
                                            <p class="mb-0">A continuación, te brindamos algunos datos importantes que pueden ayudarte al momento de realizar tu compra.<br /><br />1. Primero te recomendamos registrarte en nuestro sitio.<br /><br />2. Encuentra los productos que estás buscando utilizando la barra de categorías localizada en la parte superiordel sitio. <br /><br />3. En el lado izquierdo de la página de resultados, vas a poder filtrar los productos por el tipo de producto o rango de precios.<br /><br />4. Haz click en la foto del producto que te gusta para poder acceder a los detalles.<br /><br />5. Si quieres comprarlo agrégalo a tu carro de compras. Luego de agregar un producto al carro de compras, es posible continuar comprando y agregar otros productos.<br /><br />6. Una vez que hayas elegido todos los productos que quieres comprar, debes seleccionar el botón &quot;ir a pagar&quot; para terminar el proceso de compra.<br /><br />7. Luego debes concluir la compra.<br /><br />8. Una vez que recibas la confirmación de compra a tu correo electrónico, solo debes esperar la llegada de tu producto o coordinar la entrega al contacto que te es entregado.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
