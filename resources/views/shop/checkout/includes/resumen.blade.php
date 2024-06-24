<!-- Contenido -->
<div class="panel">
    <div class="panel-title panel-title-underlined">Resumen de compra</div>
    <div class="panel-content">

        <!-- Contenido -->
        <div class="panel-title panel-title-underlined">Datos facturación</div>
        <div class="grid grid-cols-2">
            <p>Apellidos:</p><p>{{ session('shop.checkout.datos.apellidos') }}</p>
            <p>Nombres:</p><p>{{ session('shop.checkout.datos.nombres') }}</p>
            <p>Número de documento:</p><p>{{ session('shop.checkout.datos.documento_nro') }}</p>
            <p>Correo electrónico:</p><p>{{ session('shop.checkout.datos.email') }}</p>
        </div>

        <!-- Contenido -->
        <div class="panel-title panel-title-underlined">Forma de pago y envío</div>
        <div class="grid grid-cols-2">
            <p>Forma de pago:</p><p>{{ session('shop.checkout.medio_pago.medio') }}</p>
            <p>Envío:</p><p>{{ session('shop.checkout.medio_envio.medio') }}</p>
        </div>
    </div>
</div>