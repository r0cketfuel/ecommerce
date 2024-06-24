<div class="carousel-slide">

    <!-- Contenido -->
    <div class="flex gap-3">

        <div class="panel" id="payment" style="flex: 1">
            <div class="panel-title panel-title-underlined">Pago</div>
            <div class="panel-content" id="selected_payment_method"></div>
        </div>

        <div class="panel" style="min-width: 250px">
            <div class="panel-title panel-title-underlined">Resumen</div>
            <div class="panel-content">
            <div class="flex flex-column gap-1">
                <div class="flex justify-content-between">
                    <div class="text-bold">Subtotal:</div>
                    <div id="sub-total">{{ _money(0) }}</div>
                </div>
                <div class="flex justify-content-between">
                    <div class="text-bold">Envío:</div>
                    <div id="envio">{{ _money(0) }}</div>
                </div>
                <div class="flex justify-content-between">
                    <div class="text-bold">Descuentos:</div>
                    <div id="descuentos">
                        <?php
                            if(isset($_SESSION["shop"]["checkout"]["cupon"]) && count($_SESSION["shop"]["checkout"]["cupon"])>0)
                            {
                                if($_SESSION["shop"]["checkout"]["cupon"]["tipoDescuento"]==="%")
                                {
                                    $descuento = $checkout["total"] * $_SESSION["shop"]["checkout"]["cupon"]["descuento"] / 100;
                                    echo _money($descuento);
                                }
                            }
                            else
                            {
                                echo _money(0);
                            }
                        ?>
                    </div>
                </div>
                <div style="border-bottom: 1px solid; margin: 5px 0;"><div style="flex: 1 1;"></div></div>

                <div class="flex justify-content-between">
                    <div class="text-bold">Total:</div>
                    <div id="total">
                        <?php
                            if(isset($_SESSION["shop"]["checkout"]["cupon"]) && count($_SESSION["shop"]["checkout"]["cupon"])>0)
                            {
                                echo _money($checkout["total"] - $descuento);
                            }
                            else
                            {
                                echo _money($checkout["total"]);
                            }
                        ?>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>
    <br>
    <div class="flex justify-content-start">
        <button class="btnPrev"><i class="fa-solid fa-chevron-left fa-xs"></i> Anterior</button>
    </div>
</div>