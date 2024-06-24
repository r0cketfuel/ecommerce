@extends("shop.layout.master")

@php
    $title = "Compra finalizada";
@endphp

@section("title", $title)

@section("css")
    <link rel="stylesheet" href="{{config('constants.framework_css')}}panel.css">
@endsection

@section("body")
    <div class="main-container">
        <div class="flex">
            <div class="panel" style="margin: auto; padding: 40px;">
                <div class="grid text-center">
                    <h2><span style="color: rgb(100,220,100);"><i class="fa-regular fa-circle-check fa-6x"></i></span><br><br>Muchas gracias por su compra!</h2>
                    <h4>Su pedido se registró bajo el número: {{ $order }}</h4>
                    <h4>Puedes ver los detalles de la compra haciendo click <a href="/shop/details?order={{ $order }}">AQUI</a></h4>
                    <h4>Tambien hemos enviado un correo con los detalles de la compra</h4>
                    <a href="/shop" class="btn-link">Seguir comprando</a>
                </div>
            </div>
        </div>
    </div>
@endsection