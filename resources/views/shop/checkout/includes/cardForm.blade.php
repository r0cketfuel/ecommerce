<script defer src="https://sdk.mercadopago.com/js/v2"></script>
<script defer src="/assets/js/shop/mercadoPago.js"></script>

<div>5031 7557 3453 0604</div>

<label>
    Número de tarjeta
    <div id="form-checkout__cardNumber" class="container"></div>
</label>

<label>
    Fecha de expiración<div id="form-checkout__expirationDate" class="container"></div>
</label>

<label>
    Código de seguridad<div id="form-checkout__securityCode" class="container"></div>
</label>

<label>
    Titular de la tarjeta<input id="form-checkout__cardholderName">
</label>

<label>
    Banco emisor<select id="form-checkout__issuer"></select>
</label>

<label>
    Cuotas<select id="form-checkout__installments"></select>
</label>

<progress value="0" class="progress-bar">Cargando...</progress>

<button id="prueba" form="form-checkout" class="btn-primary" type="submit" id="form-checkout__submit">Confirmar compra</button>