@extends("shop.layout.master")

@php
    $title = "Detalles del producto";
@endphp

@section("title", $title)

@php
    $breadcrumbs = [
    ];
@endphp

@section("css")
    <link rel="stylesheet"	href="{{ config('constants.shop_css') }}carousel.css">
    <link rel="stylesheet"	href="{{ config('constants.shop_css') }}tiles.css">
    <link rel="stylesheet"	href="{{ config('constants.shop_css') }}productRating.css">
    <link rel="stylesheet"	href="{{ config('constants.framework_css') }}tabs.css">
    <link rel="stylesheet"	href="{{ config('constants.framework_css') }}modal.css">
@endsection

@section("js")
    <script defer src="{{ config('constants.shop_js') }}tabs.js"></script>
    <script defer src="{{ config('constants.shop_js') }}cart.js"></script>
    <script defer src="{{ config('constants.framework_js') }}modal.js"></script>
@endsection

@section("inlineCSS")
    <style>
        ul.tabs {
            margin-top: 50px;
        }
    </style>
@endsection

@section("body")

    @auth
        @include("shop.modals.addReview")
    @endauth

    <div class="main-container">
        @include("shop.layout.breadcrumb")

        <!-- Grid -->
        <div class="grid grid-cols-12 grid-align-start gap-4">

            <!-- Mosaicos -->
            <div class="col-span-7 col-span-900p-12">
                <div class="product-tile">
                    <div class="tiles-container">
                        @if ($item->imagen->isNotEmpty())
                            @foreach ($item->imagen as $imagen)
                                @if ($loop->first)
                                    <div class="tile active">
                                        <img src="{{ $imagen->miniatura }}" alt="{{ $imagen->descripcion }}">
                                    </div>
                                    <div class="tile main">
                                        <a href="{{ $item->imagen[0]->ruta }}">
                                            <img id="image" src="{{ $item->imagen[0]->miniatura }}" alt="vista_previa">
                                        </a>
                                        <button class="btn btn-next"><i class="fa-solid fa-chevron-right"></i></button>
                                        <button class="btn btn-prev"><i class="fa-solid fa-chevron-left"></i></button>
                                    </div>
                                @else
                                    <div class="tile">
                                        <img src="{{ $imagen->miniatura }}" alt="{{ $imagen->descripcion }}">
                                    </div>
                                @endif
                            @endforeach
                        @else
                            <div class="tile main" style="grid-column: span 6;">
                                <img src="{{ asset('images/content/no-image.png') }}" alt="No Image">
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <!-- /Mosaicos -->

            <!-- Panel info -->
            <div class="col-span-5 col-span-900p-12">
                <div class="tile-info">
                    <div>
                        <h1>{{ $item->nombre }}</h1>
                        <h2>{{ $item->descripcion }}</h2>
                    </div>

                    @if (env('RATING_SYSTEM')==true)
                        @include ("shop.item.rating")
                    @endif

                    @if ($item->categoria)
                        <div class="tile-info-row">
                            <div>Categoría:</div>
                            <div>{{ $item->categoria["nombre"] }}</div>
                        </div>
                    @endif

                    @if ($item->subcategoria)
                        <div class="tile-info-row">
                            <div>Subcategoría:</div>
                            <div>{{ $item->subcategoria["nombre"] }}</div>
                        </div>
                    @endif

                    <!-- Precio -->
                    <div class="tile-info-row">
                        <div>Precio:</div>
                        @if ($item->promocion)
                            <div class="flex align-items-center gap-2">
                                <div class="discount">{{ _money($item->precioConDescuento) }}</div>
                                <div id="precio" class="text-line-through">{{ $item->precio }}</div>
                            </div>
                        @else
                            <div id="precio">{{ $item->precio }}</div>
                        @endif
                    </div>
                    <!-- /Precio -->

                    <!-- Atributo Tamaño -->
                    <div class="tile-info-row">
                        <p>Tamaño:</p>
                        <div class="flex">
                            <select id="sizes" class="attribute"></select>
                        </div>
                    </div>
                    
                    <!-- Atributo Color -->
                    <div class="tile-info-row">
                        <p>Color:</p>
                        <div class="flex">
                            <select id="colors" class="attribute"></select>
                        </div>
                    </div>

                    <div class="tile-info-row">
                        <p>Stock disponible:</p>
                        <p id="stock">-</p>
                    </div>
                        
                    <!-- Cantidad -->
                    <div id="qtyControl" class="tile-info-row">
                        <div>Cantidad:</div>
                        <div class="flex">
                            <button class="minusButton" id="minusButton"><i class="fa-solid fa-minus"></i></button>
                            <input 	class="addToCartQty" id="addToCartQty" type="number" disabled>
                            <button class="plusButton" id="plusButton"><i class="fa-solid fa-plus"></i></button>
                        </div>
                    </div>

                    <!-- Subtotal -->
                    <div class="tile-info-row">
                        <div>Subtotal:</div>
                        <div id="subtotal">-</div>
                    </div>

                    <div style="flex-grow: 1"></div>
                    <button id="button_addToCart" value="{{ $item->id }}" class="btn-primary"><span><i class="fa-solid fa-cart-plus"></i></span>{{ __('buttons.addToCart') }}</button>
                </div>
            </div>
            <!-- /Panel info -->
        </div>
        <!-- /Grid -->

        @include("shop.item.tabs")

    </div>
@endsection

@section("scripts")
    <script>
        document.addEventListener("DOMContentLoaded", () => {

        const tiles = document.querySelectorAll("div.tile:not(.main)");
        tiles.forEach(tile => tile.addEventListener("click", () => { imageGrid(tile); return false; }));

        const maxSlide = tiles.length - 1;
        let curSlide = 0;

        const nextSlide = document.querySelector(".btn-next");
        
        if(nextSlide)
            nextSlide.addEventListener("click", () => { curSlide = curSlide === maxSlide ? 0 : curSlide + 1; imageGrid(tiles[curSlide]); });

        const prevSlide = document.querySelector(".btn-prev");

        if(prevSlide)
            prevSlide.addEventListener("click", () => { curSlide = curSlide === 0 ? maxSlide : curSlide - 1; imageGrid(tiles[curSlide]); });

        //==================================//
        // CARGA LAS MINIATURAS EN EL VISOR //
        //==================================//
        function imageGrid(tile) {
            curSlide = Array.from(tiles).indexOf(tile);

            const tileMainPicture = document.querySelector(".tile.main");
            const tileActive = document.querySelector(".tile.active");
            const tileClicked = tile.children[0];

            tileActive.classList.remove("active");
            tile.classList.add("active");

            const tileClickedHref = tileClicked.currentSrc.replace("thumbs/", "");

            tileMainPicture.children[0].children[0].src = tileClicked.currentSrc;
            tileMainPicture.children[0].href = tileClickedHref;
        }
        });
    </script>

    @auth
        <script>
            // Espera a que el DOM esté completamente cargado
            document.addEventListener("DOMContentLoaded", function() {
                // Obtiene todas las estrellas
                const stars = document.querySelectorAll('.product-stars span');
                const token = document.querySelector("meta[name='csrf-token']").getAttribute("content");
                
                // Recorre cada estrella y agrega un event listener para el clic
                stars.forEach(function(star, index) {
                    star.addEventListener('click', function() {
                        const rating = index + 1; // Índice + 1 es la puntuación
                        const productId = obtenerIdDelURL(); // Obtener el ID del producto de la URL

                        // Realizar la solicitud POST
                        fetch('/shop/requests/rating', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                "X-CSRF-TOKEN": token,
                            },
                            body: JSON.stringify({
                                id: productId,
                                puntuacion: rating
                            }),
                        })
                        .then(response => {
                            if (!response.ok) {
                                throw new Error('Hubo un problema al enviar la calificación.');
                            }
                            return response.json();
                        })
                        .then(data => {
                            // Manejar la respuesta si es necesario
                            console.log('Calificación enviada con éxito:', data);
                        })
                        .catch(error => {
                            console.error('Error al enviar la calificación:', error);
                        });
                    });
                });
            });

            // Función para obtener el ID del producto de la URL
            function obtenerIdDelURL() {
                const url = window.location.href;
                const parts = url.split('/');
                return parts[parts.length - 1];
            }
        </script>
    @endauth
@endsection