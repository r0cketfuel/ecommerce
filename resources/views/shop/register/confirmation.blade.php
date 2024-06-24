@extends("shop.layout.master")

@php
    $title = "Alta de usuarios";
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
                    <h2><span style="color: rgb(100,220,100);"><i class="fa-regular fa-circle-check fa-6x"></i></span><br><br>Tu cuenta se encuentra verificada</h2>
                    <h4>Ahora podrás loguearte normalmente con tus credenciales</h4>
                    <a href="/shop" class="btn-link">Continuar</a>
                </div>
            </div>
        </div>
    </div>
@endsection