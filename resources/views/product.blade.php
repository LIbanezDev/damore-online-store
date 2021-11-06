@extends('layout.base')
@section('titulo')
    D'amore Store ~ Inicio
@endsection
@section('content')
    <div class="container">
        <div class="columns is-multiline">
            <div class="column is-5-desktop is-12-tablet">
                <div class="splide">
                    <div class="splide__track">
                        <ul class="splide__list">
                            <li class="splide__slide">
                                <img
                                    src="https://assets.adidas.com/images/h_840,f_auto,q_auto:sensitive,fl_lossy,c_fill,g_auto/6a0d6246e26a4852825dad3900baddfd_9366/Zapatillas_adidas_Ultraboost_x_LEGO(r)_Colors_Blanco_FZ3983_01_standard.jpg"
                                    alt="profile image">
                            </li>
                            <li class="splide__slide">
                                <img
                                    src="https://assets.adidas.com/images/h_840,f_auto,q_auto:sensitive,fl_lossy,c_fill,g_auto/186cc80da9934951bbfaad5f00b432cd_9366/Zapatillas_adidas_Ultraboost_x_LEGO(r)_Colors_Blanco_FZ3983_HM1.jpg"
                                    alt="profile image">
                            </li>
                            <li class="splide__slide">
                                <img
                                    src="https://assets.adidas.com/images/h_840,f_auto,q_auto:sensitive,fl_lossy,c_fill,g_auto/035e3f3f9560484882e8ad5f00b420c3_9366/Zapatillas_adidas_Ultraboost_x_LEGO(r)_Colors_Blanco_FZ3983_HM3.jpg"
                                    alt="">
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="column content">
                <div class="columns is-multiline">
                    <div class="column is-12">
                        <h1> ZAPATILLAS ADIDAS ULTRABOOST X LEGO® COLORS </h1>
                        <h3>
                            ZAPATILLAS DE RUNNING DE ALTO RENDIMIENTO CREADAS EN COLABORACIÓN CON LEGO GROUP
                        </h3>
                        <p class="has-text-justified">
                            Correr es tu momento de diversión. Y si no te has dado cuenta por los toques de color y el
                            diseño de
                            los bloques LEGO®, estas zapatillas de running adidas creadas con LEGO Group son pura
                            diversión.
                            Juega con comodidad. Porque nada tiene que interponerse en el camino de pasar un buen rato.
                            Una
                            mediasuela Boost suave se encarga de la amortiguación, y la suela Continental™ con compuesto
                            Better
                            Rubber estabiliza tu pisada ante movimientos rápidos.
                        </p>
                    </div>
                    <div class="column is-12">
                        <h2><strong> $159.990 </strong></h2>
                    </div>
                    <div class="column is-6">
                        <ul>
                            <li> Peso: 312 g (talla CHI 42)</li>
                            <li> Peso: 312 g (talla CHI 42)</li>
                            <li> Peso: 312 g (talla CHI 42)</li>
                            <li> Peso: 312 g (talla CHI 42)</li>
                            <li> Peso: 312 g (talla CHI 42)</li>
                            <li> Peso: 312 g (talla CHI 42)</li>
                        </ul>
                    </div>
                    <div class="column is-6">
                        <ul>
                            <li> Peso: 312 g (talla CHI 42)</li>
                            <li> Peso: 312 g (talla CHI 42)</li>
                            <li> Peso: 312 g (talla CHI 42)</li>
                            <li> Peso: 312 g (talla CHI 42)</li>
                            <li> Peso: 312 g (talla CHI 42)</li>
                            <li> Peso: 312 g (talla CHI 42)</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="columns is-multiline">
            <div class="column is-12">
                <figure class="image">
                    <video
                        loop
                        autoplay
                        playsinline
                        muted
                        src="https://brand.assets.adidas.com/video/upload/q_auto,vc_auto/video/upload/global%20brand%20publishing/Training/running-fw21-lego-dnacolours-adult-launch-plp-statement-t.mp4">
                    </video>
                </figure>
            </div>
        </div>
    </div>
@endsection
@section('javascript')
    document.addEventListener('DOMContentLoaded', function() {
    var splide = new Splide('.splide');
    splide.mount();
    } );
@endsection
