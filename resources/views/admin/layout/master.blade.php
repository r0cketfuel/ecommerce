<!DOCTYPE html>
<html lang="{{str_replace('_', '-', app()->getLocale())}}">
	<head>
        <meta charset="utf-8">
        <meta name="viewport"       content="width=device-width, initial-scale=1.0">
        <meta name="csrf-token"     content="{{csrf_token()}}">
        <meta name="description"    content="{{ session('infoComercio.nombre') }}">

        <title>@yield("title") - {{session("infoComercio.nombre")}}</title>

        <!-- Font -->
        <link rel="stylesheet"	href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap">

        <!-- Estilos -->
        <link rel="stylesheet"	href="{{config('constants.admin_css')}}style.css">
        <link rel="stylesheet"	href="{{config('constants.framework_css')}}alert.css">
        @yield("css")
        
		<!-- Font awesome -->
        <link rel="stylesheet"	href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

        <!-- Scripts -->
        <script defer src="{{config('constants.framework_js')}}scroll.js"></script>
		<script defer src="{{config('constants.framework_js')}}navbar.js"></script>
        <script defer src="{{config('constants.framework_js')}}alert.js"></script>
        @yield("js")

        @yield("inlineCSS")
	</head>
	<body id="top">
		@include("admin.layout.navbar")
		@include("admin.layout.backToTop")
        
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div class="alert danger">
                    {{$error}}
                    <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                </div>
            @endforeach
        @endif

        @if (session("success"))
            <div class="alert success">
                {{session("success")}}
                <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
            </div>
        @endif

        @if (session("error"))
            <div class="alert danger">
                {{session("error")}}
                <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
            </div>
        @endif

        <div class="main-container">
            @include("admin.layout.breadcrumb")
            @yield("body")
            @yield("scripts")
        </div>
	</body>
</html>