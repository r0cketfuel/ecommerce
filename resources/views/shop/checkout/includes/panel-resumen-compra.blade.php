<div class="carousel-slide">
    <div class="flex justify-content-between">
        <button class="btnPrev"><i class="fa-solid fa-chevron-left fa-xs"></i> Anterior</button>
        <button class="btnNext">Siguiente <i class="fa-solid fa-chevron-right fa-xs"></i></button>
    </div>
    <br>
    <!-- Contenido -->
    <div class="panel">
        <div class="panel-title panel-title-underlined">Resumen de compra</div>
        <div class="panel-content">
            <div class="flex-column gap-1">
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