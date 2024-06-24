<div class="carousel-slide">
    <div id="resumen"></div>
    <br>
    <div class="flex justify-content-between">
        <button class="btnPrev"><i class="fa-solid fa-chevron-left fa-xs"></i> Pago y envío</button>
        
        @if(session('shop.checkout.medio_pago.id')==1 || session('shop.checkout.medio_pago.id')==2)
            <button class="btn-primary w250px">Finalizar compra</button>
        @else
            <button class="btnNext"> <i class="fa-solid fa-chevron-right fa-xs"></i></button>
        @endif
    </div>
</div>
