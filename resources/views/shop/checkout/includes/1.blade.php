<div class="carousel-slide">

    <!-- Contenido -->
    <div class="panel">
        <div class="panel-title panel-title-underlined">Carrito de compras</div>
        <div class="panel-content">

            @for($i=0;$i < count($checkout["items"]);++$i)

                @php
                    $id             = $checkout["items"][$i]["id"];
                    $atributosId    = $checkout["items"][$i]["atributos_id"];
                    $nombre         = $checkout["items"][$i]["nombre"];
                    $precio         = $checkout["items"][$i]["precio"];
                    $imagen         = $checkout["items"][$i]["imagen"] ? $checkout["items"][$i]["imagen"] : asset('images/content/no-image.png');
                    $cantidad 	    = $checkout["items"][$i]["cantidad"];
                    $subtotal       = $checkout["items"][$i]["subtotal"];
                    $total          = $checkout["total"];

                    $precio         = _money($precio);
                    $subtotal       = _money($subtotal);
                    $total          = _money($total);

                    $opciones       = $checkout["items"][$i]["opciones"];
                    $talle_id       = $checkout["items"][$i]["opciones"]["talle_id"]    ?? null;
                    $color          = $checkout["items"][$i]["opciones"]["color"]       ?? null;
                @endphp

                <ul class="product-checkout-card" data-id="{{ $id }}">
                    <li>{{ $cantidad }} x <span>{{ $nombre }}</span></li>
                    <li>
                        <img src="{{ $imagen }}" alt="imagen">
                    </li>
                    <li>Talle</li>
                    <li>{{ $talle_id }}</li>
                    <li>Color</li>
                    <li>{{ $color }}</li>
                    <li>Precio</li>
                    <li>{{ $precio }}</li>
                    <li>Subtotal</li>
                    <li>{{ $subtotal }}</li>
                    <div class="product-checkout-card-extra">
                        <button class="btn-link" data-id="{{ $id }}" data-atributos_id="{{ $atributosId }}" onclick="itemRemove(this.dataset)"><i class="fa-solid fa-xmark"></i></button>
                    </div>
                </ul>
            @endfor

        </div>
    </div>
    <br>
    <div class="flex justify-content-end">
        <button class="btnNext">Datos facturación <i class="fa-solid fa-chevron-right fa-xs"></i></button>
    </div>
</div>