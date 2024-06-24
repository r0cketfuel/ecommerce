<div class="grid grid-cols-2">
    <p class="text-bold">Banco:</p><p>{{ $cuentaBancaria["banco"] }}</p>
    <p class="text-bold">Cuit:</p><p>{{ $cuentaBancaria["cuit"] }}</p>
    <p class="text-bold">Titular:</p><p>{{ $cuentaBancaria["titular"] }}</p>
    <p class="text-bold">Cuenta:</p><p>{{ $cuentaBancaria["cuenta"] }}</p>
    <p class="text-bold">CBU:</p><p>{{ $cuentaBancaria["cbu"] }}</p>
    <p class="text-bold">Alias:</p><p>{{ $cuentaBancaria["alias"] }}</p>
</div>
<button form='form-checkout' class='btn-primary' type='submit'>Confirmar compra</button>