@extends("shop.layout.master")

@php
    $title = "Pago";
@endphp

@section("title", $title)

@section("css")
    <link rel="stylesheet"	href="{{ config('constants.framework_css') }}panel.css">
    <link rel="stylesheet"	href="{{ config('constants.framework_css') }}modal.css">
    <link rel="stylesheet"	href="{{ config('constants.framework_css') }}spinner.css">
@endsection

@section("inlineCSS")
    <style>
        .container {
            height:                         28px;
            width:                          100%;
            border:                         1px solid rgb(220,220,220);
            padding:                        5px;
            background-color:               white;
            box-sizing:                     border-box;
        }

        .payment-grid {
            display:                        grid;
            margin:                         0 auto;
            gap:                            10px;
            width:                          100%;
            grid-template-areas:            "user       resume"
                                            "payment    .";
            align-items:                    start;
            grid-template-columns:          1fr 250px;
        }

        #user {
            grid-area:                      user;
        }

        #resume {
            grid-area:                      resume;
        }

        #payment {
            grid-area:                      payment;
        }

        #button {
            grid-area:                      button;
        }

        @media(max-width: 1024px) {
            .payment-grid {
                width:                      100%;
            }
        }

        @media(max-width: 768px) {
            .payment-grid {
                grid-template-areas:        "user"
                                            "resume"
                                            "payment";
                grid-template-columns:      1fr;
            }
        }
    </style>
@endsection

@section("js")
    <script defer src="{{ config('constants.framework_js') }}modal.js"></script>
@endsection

@section("body")
    @include("shop.modals.payment")

    <!-- Contenido de la página -->
    <div class="main-container">

        <!-- Breadcrumb -->
        <div class="breadcrumb">
            <a href="/shop"><i class="fa-solid fa-house-chimney fa-sm"></i> Home</a> > <a href="/shop/checkout">Checkout</a> > Facturación
        </div>

        <!-- Grid -->
        <div class="payment-grid">
            
            <!-- Panel datos del usuario -->
            <div class="panel" id="user">
                <div class="panel-title panel-title-underlined">Datos personales</div>
                <div class="panel-content">
                    <div class="input-group">

                        <label>
                            Apellidos
                            <input form="form-checkout" type="text" id="apellidos" name="apellidos" required pattern="[a-zA-Z]+" title="Sólo se permiten letras" value="{{session('shop.usuario.datos.apellidos')}}">
                        </label>

                        <label>
                            Nombres
                            <input  form="form-checkout" type="text" id="nombres" name="nombres" required pattern="[a-zA-Z]+" title="Sólo se permiten letras" value="{{session('shop.usuario.datos.nombres')}}">
                        </label>
                        
                        <label>
                            Tipo de documento
                            <select form="form-checkout" id="tipo_documento_id" name="tipo_documento_id" required>
                                <option value="" selected disabled>Seleccione</option>
                                @foreach($tiposDocumentos as $tipoDocumento)
                                    <option value="{{$tipoDocumento->id}}" @if(session('shop.usuario.datos.tipo_documento_id') == $tipoDocumento->id) selected @endif>{{$tipoDocumento->tipo}}</option>
                                @endforeach
                            </select>
                        </label>

                        <label>
                            Número de documento
                            <input form="form-checkout" type="text" id="documento_nro" name="documento_nro" required pattern="[0-9]+" title="Sólo se permiten números" value="{{session('shop.usuario.datos.documento_nro')}}">
                        </label>

                        <label>
                            Localidad
                            <input form="form-checkout" type="text" id="localidad" name="localidad" required value="Bahía Blanca">
                        </label>

                        <label>
                            Codigo postal
                            <input form="form-checkout" type="text" id="codigo_postal" name="codigo_postal" required pattern="[0-9]+" title="Sólo se permiten números" value="8000">
                        </label>

                        <label>
                            Domicilio
                            <input form="form-checkout" type="text" id="domicilio" name="domicilio" required value="Domicilio">
                        </label>

                        <div class="flex">
                            <label>
                                Domicilio número
                                <input form="form-checkout" type="text" id="domicilio_nro" name="domicilio_nro" required pattern="[0-9]+" title="Sólo se permiten números" value="1234">
                            </label>
                            
                            <label>
                                Domicilio piso
                                <input form="form-checkout" type="text" id="domicilio_piso" name="domicilio_piso" value="PB">
                            </label>

                            <label>
                                Domicilio depto
                                <input form="form-checkout" type="text" id="domicilio_depto" name="domicilio_depto" value="1">
                            </label>
                        </div>

                        <label>
                            Teléfono celular
                            <input form="form-checkout" type="text" id="telefono_celular" name="telefono_celular" required pattern="[0-9]+" title="Sólo se permiten números" value="{{session('shop.usuario.datos.telefono_celular')}}">
                        </label>
                        <label>
                            Teléfono alternativo
                            <input form="form-checkout" type="text" id="telefono_alt" name="telefono_alt" pattern="[0-9]+" title="Sólo se permiten números" value="{{session('shop.usuario.datos.telefono_alt')}}">
                        </label>
                        <label>
                            Correo electrónico
                            <input form="form-checkout" type="email" id="email" name="email" required value="{{session('shop.usuario.datos.email')}}">
                        </label>
                    
                    </div>
                </div>
            </div>
            <!-- /Panel datos del usuario -->

            <!-- Panel datos pago -->
            <div class="panel" id="payment">
                <div class="panel-title panel-title-underlined">Pago</div>
                <div class="panel-content">

                    <!-- Efectivo -->
                    @if(session("shop.checkout.medio_pago.id")==1)
                        <button form='form-checkout' class='btn-primary' type='submit'>Confirmar compra</button>
                    @endif

                    <!-- Transferencia bancaria -->
                    @if(session("shop.checkout.medio_pago.id")==2)
                        <div class="grid" style="grid-template-columns: auto 1fr; gap: 20px;">
                            <div class="text-bold">Banco:</div>
                            <div>{{$cuentaBancaria["banco"]}}</div>
                            <div class="text-bold">Cuit:</div>
                            <div>{{$cuentaBancaria["cuit"]}}</div>
                            <div class="text-bold">Titular:</div>
                            <div>{{$cuentaBancaria["titular"]}}</div>
                            <div class="text-bold">Cuenta:</div>
                            <div>{{$cuentaBancaria["cuenta"]}}</div>
                            <div class="text-bold">CBU:</div>
                            <div>{{$cuentaBancaria["cbu"]}}</div>
                            <div class="text-bold">Alias:</div>
                            <div>{{$cuentaBancaria["alias"]}}</div>
                        </div>
                        <button form='form-checkout' class='btn-primary' type='submit'>Confirmar compra</button>
                    @endif

                    <!-- Tarjeta de crédito o débito mercadopago -->
                    @if(session("shop.checkout.medio_pago.id")==3)
                        <script defer src="https://sdk.mercadopago.com/js/v2"></script>
                        <script defer src="/assets/js/shop/mercadoPago.js"></script>

                        <div>5031 7557 3453 0604</div>

                        <label>Número de tarjeta<div id="form-checkout__cardNumber"         class="container"></div></label>
                        <label>Fecha de expiración<div id="form-checkout__expirationDate"   class="container"></div></label>
                        <label>Código de seguridad<div id="form-checkout__securityCode"     class="container"></div></label>
                        <label>Titular de la tarjeta<input id="form-checkout__cardholderName"></label>
                        <label>Banco emisor<select id="form-checkout__issuer"></select></label>
                        <label>Cuotas<select id="form-checkout__installments"></select></label>
                        <progress value="0" class="progress-bar">Cargando...</progress>
                        <button id="prueba" form="form-checkout" class="btn-primary" type="submit" id="form-checkout__submit">Confirmar compra</button>
                    @endif

                    <!-- Pagofácil o Rapipago mercadopago -->
                    @if(session("shop.checkout.medio_pago.id")==4 || session("shop.checkout.medio_pago.id")==5)
                        <button form="form-checkout" type="submit">Pagar</button>
                    @endif

                </div>
            </div>
    
            <!-- Panel resumen de compra -->
            <div class="panel">
                <div class="panel-title panel-title-underlined">Resumen de compra</div>
                <div class="panel-content">
                    <div class="flex-column gap-1">
                        <div class="flex justify-content-between">
                            <div class="text-bold">Subtotal:</div>
                            <div id="sub-total">{{_money(session("shop.checkout.total_items"))}}</div>
                        </div>
                        <div class="flex justify-content-between">
                            <div class="text-bold">Envío:</div>
                            <div id="envio">{{ _money(session("shop.checkout.medio_envio.costo")) }}</div>
                        </div>
                        <div class="flex justify-content-between">
                            <div class="text-bold">Descuentos:</div>
                            <div id="descuentos">{{ _money(0) }}</div>
                        </div>
                        <div style="border-bottom: 1px solid; margin: 5px 0;"><div style="flex: 1 1;"></div></div>
                        <div class="flex justify-content-between">
                            <div class="text-bold">Total:</div>
                            <div id="total">{{_money(session("shop.checkout.total"))}}</div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Panel resumen de compra -->

        </div>
        <!-- /Grid -->

        <form id="form-checkout" action="/shop/process_payment" method="post">@csrf</form>

    </div>

@endsection

@section("scripts")
    <script>
        document.addEventListener("DOMContentLoaded", () => {

            const button = document.getElementById("prueba");
            if(button)
                button.addEventListener("click", () => funcion());
            });

            function funcion(id)
            {
                openModal("modal-payment");
            }
    </script>
@endsection