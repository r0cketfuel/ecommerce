<!DOCTYPE html>
<html lang="{{str_replace('_', '-', app()->getLocale())}}">
	<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Sitio en mantenimiento</title>

        <!-- Hojas de estilo -->
        <link rel="stylesheet"	href="{{asset('/assets/css/site/style.css')}}">
        <link rel="stylesheet"	href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

        <!-- Scripts -->
		<script defer src="{{asset('/assets/js/framework/scroll.js')}}"></script>
		<script defer src="{{asset('/assets/js/framework/navbar.js')}}"></script>
        <script defer src="{{asset('/assets/js/framework/preloader.js')}}"></script>

        <style>
            div {
                height:             100vh;
                display:            flex;
                flex-flow:          column;
                align-items:        center;
                justify-content:    center;
            }

            h1,
            h2,
            h3 {
                text-align:         center;
                font-weight:        normal;
            }
        </style>
    </head>
	<body id="top">
        <div>
            <h1><i class="fa-solid fa-triangle-exclamation fa-8x"></i></h1>
            <h2>{{ __('messages.maintenance.maintenance1') }}</h2>
            <h3>{{ __('messages.maintenance.maintenance2') }}</h3>
        </div>
	</body>
</html>