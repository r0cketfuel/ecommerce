@extends("shop.layout.master")

@php
    $title = "Mis compras";
@endphp

@section("title", $title)

@php
    $breadcrumbs = [
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
        @if(count($items))
            @foreach($items as $item)
                <li class="favourite-card">
                    <div>{{ $item["descripcion"] }}</div>
                    <div class="favourite-card-image">
                        @if ($item->imagen->isNotEmpty())
                            <img loading="lazy" src="{{ $item->imagen[0]->ruta }}" alt="{{ $item->imagen[0]->descripcion }}">
                        @else
                            <img loading="lazy" src="{{ asset('images/content/no-image.png') }}" alt="imagen">
                        @endif
                    </div>
                    <div>{{ _money($item["precio"]) }}</div>
                    <div class="flex">
                        <button><span><i class="fa-solid fa-receipt"></i></span>{{ __('buttons.invoice') }}</button>
                        <button><span><i class="fa-solid fa-receipt"></i></span>{{ __('buttons.invoice') }}</button>
                    </div>
                </li>
            @endforeach
        @else
            <p>{{ __("general.empty_purchase_list") }}</p>
        @endif
    </div>
@endsection

@section("scripts")
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            
        });
    </script>
@endsection