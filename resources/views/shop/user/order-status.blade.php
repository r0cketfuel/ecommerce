@extends("shop.layout.master")

@php
    $title = "Estado de compra";
@endphp

@section("title", $title)

@php
    $breadcrumbs = [
        ['link' => '/shop/compras', 'title' => 'Compras'],
    ];
@endphp

@section("css")
    <link rel="stylesheet"	href="{{ config('constants.shop_css') }}productCards.css">
@endsection

@section("js")
@endsection

@section("inlineCSS")
@endsection

@section("body")
    <div class="main-container">
        @include("shop.layout.breadcrumb")
    </div>
@endsection

@section("scripts")
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            
        });
    </script>
@endsection