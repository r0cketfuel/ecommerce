@extends("shop.layout.master")

@php
    $title = "Alta de usuarios";
@endphp

@section("title", $title)

@php
    $breadcrumbs = [
    ];
@endphp

@section("css")
    <link rel="stylesheet"	href="{{ config('constants.framework_css') }}alert.css">
    <link rel="stylesheet"	href="{{ config('constants.framework_css') }}layout.css">
    <link rel="stylesheet"	href="{{ config('constants.framework_css') }}panel.css">
@endsection

@section("js")
    <script defer src="{{ config('constants.framework_js') }}alert.js"></script>
    <script defer src="{{ config('constants.shop_js') }}carouselForms.js"></script>
@endsection

@section("inlineCSS")
    <style>
        @media (max-width: 600px)
        {
            .panel-content .flex {
                flex-flow:          column nowrap;
            }
        }

		.carousel-container {
			flex: 					1;
			overflow: 				hidden;
		}

		.carousel-slider {
			display: 				flex;
			flex-flow: 				row nowrap;
			width: 					calc(300% + 200px);
            gap:                    100px;
		}

		.carousel-slide {
			flex: 					1;
			transition: 			all 0.5s ease-in-out;
		}

		.btnPrev,
		.btnNext {
			padding:				8px 16px;
			border: 				1px solid rgb(200,200,200);
			border-radius:  		4px;
			width:					unset;
		}

		.btnPrev:not(.btn-primary):hover,
		.btnNext:not(.btn-primary):hover {
			cursor: 				pointer;
			background-color: 		rgba(0, 0, 0, 0.05);
		}
	</style>
@endsection

@section("body")
    <div class="main-container">
        @include("shop.layout.breadcrumb")

        <div class="carousel-container">
            <div class="carousel-slider">
                
                <!-- Pantalla 1 -->
                <form method="post" class="step-form">
                    <input type="hidden" name="currentStep" value="1">
                    @csrf
                    @include('shop.register.step1')
                </form>

                <!-- Pantalla 2 -->
                <form method="post" class="step-form">
                    <input type="hidden" name="currentStep" value="2">
                    @csrf
                    @include('shop.register.step2')
                </form>

                <!-- Pantalla 3 -->
                <div style="width: 100%;">
                    @include('shop.register.success')
                </div>

            </div>
        </div>
    </div>
@endsection