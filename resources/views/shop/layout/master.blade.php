<!DOCTYPE html>
<html lang="{{str_replace('_', '-', app()->getLocale())}}">
	<head>
        <meta charset="utf-8">
        <meta name="viewport"       content="width=device-width, initial-scale=1.0">
        <meta name="csrf-token"     content="{{ csrf_token() }}">
        <meta name="description"    content="{{ session('infoComercio.nombre') }}">
        
        <title>@yield("title") - {{ session("infoComercio.nombre") }}</title>

        <!-- Estilos -->
        <link rel="stylesheet"  href="{{ config('constants.shop_css') }}style.css">
        <link rel="stylesheet"	href="{{ config('constants.shop_css') }}login.css">
        <link rel="stylesheet"	href="{{ config('constants.framework_css') }}modal.css">
        
        @yield("css")

        <!-- Font awesome -->
		<link rel="stylesheet"	href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
        
        <!-- Framework Scripts -->
        <script src="{{ config('constants.framework_js') }}scroll.js"></script>
        <script src="{{ config('constants.framework_js') }}loader.js"></script>
        <script src="{{ config('constants.framework_js') }}navbar.js"></script>
        
        <!-- Shop Scripts -->
        <script src="{{ config('constants.shop_js') }}searchBar.js"></script>

        @guest
            <script src="{{ config('constants.shop_js') }}loginModal.js"></script>
        @endguest

		@yield("js")

        <style>
            .wrapper {
                min-height: 		    100vh;
                flex: 				    1;
                display: 			    flex;
                flex-flow: 			    column nowrap;
                opacity: 			    0;
            }
        </style>

        @yield("inlineCSS")
	</head>
	<body id="top">
        @include("shop.layout.loader")

        @include("shop.layout.alerts")

        @guest
            @include("shop.modals.login")
        @endguest

        <!-- Wrapper -->
        <div class="wrapper" id="wrapper">
            @include("shop.layout.headers")
            @include("shop.layout.backToTop")
            @include("shop.layout.whatsappBubble")
            @yield("body")
        </div>
        @include("shop.layout.footers")

        @yield("scripts")

        <script>
            window.addEventListener("load", function () {

                const wrapper = document.getElementById("wrapper");

                wrapper.style.transition    = "opacity 1s";
                wrapper.style.opacity       = 1;
            });
        </script>

	</body>
</html>