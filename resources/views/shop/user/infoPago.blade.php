@extends("shop.layout.master")

@php
    $title = "Estado de pago";
@endphp

@section("title", $title)

@php
    $breadcrumbs = [
    ];
@endphp

@section("css")
    <link rel="stylesheet"	href="{{ config('constants.framework_css') }}panel.css">
@endsection

@section("body")
    <div class="main-container">
        @include("shop.layout.breadcrumb")
        
        <div class="panel w500px">
            <div class="panel-title panel-title-underlined">Info</div>
            <div class="panel-content">

                <div class="flex justify-content-between">
                    <div class="text-bold">Fecha de creación:</div>
                    <div>{{ _datetimezone($estado->date_created) }}</div>
                </div>
                <div class="flex justify-content-between">
                    <div class="text-bold">Medio de pago:</div>
                    <div>{{ __("mercadopago.payment_types.$estado->payment_type_id") }}</div>
                </div>
                @isset($estado->card->cardholder->name)
                    <div class="flex justify-content-between">
                        <div class="text-bold">Titular de la tarjeta:</div>
                        <div>{{ $estado->card->cardholder->name }}</div>
                    </div>
                    <div class="flex justify-content-between">
                        <div class="text-bold">Cuotas:</div>
                        <div>{{ $estado->installments }}</div>
                    </div>
                @endisset
                
                <div class="panel-title panel-title-underlined">Datos del comprador</div>
                <div class="flex justify-content-between">
                    <div class="text-bold">Apellidos:</div><div>{{ $estado->additional_info->payer->last_name }}</div>
                </div>
                <div class="flex justify-content-between">
                    <div class="text-bold">Nombres:</div><div>{{ $estado->additional_info->payer->first_name }}</div>
                </div>


                <div class="panel-title panel-title-underlined">Datos de la compra</div>
                <div class="flex justify-content-between">
                    <div class="text-bold">Total:</div>
                    <div>{{ _money($estado->transaction_details->total_paid_amount) }}</div>
                </div>

                <div class="panel-title panel-title-underlined">Estado del pago</div>
                <div class="flex justify-content-between">
                    <div class="text-bold">Estado:</div>
                    <div>{{ $estado->status }}</div>
                </div>
                <div class="flex justify-content-between">
                    <div class="text-bold">Descripción:</div>
                    <div>{{ $estado->status_detail }}</div>
                </div>
                @isset($estado->transaction_details->barcode["content"])
                    <div class="text-bold">Código de barras:</div>
                    <div class="text-center" style="border: 1px solid rgb(200,200,200); padding: 10px;">
                        <div>
                            <img src="data:image/png;base64,{{ $image }}">
                        </div>
                        {{ $estado->transaction_details->barcode["content"] }}
                    </div>
                @endisset
            </div>
        </div>
    </div>
@endsection