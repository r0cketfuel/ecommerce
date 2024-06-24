<!DOCTYPE html>
<html lang="{{str_replace('_', '-', app()->getLocale())}}">
	<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Inicio - {{session("infoComercio.nombre")}}</title>

        <!-- Hojas de estilo -->
        <link rel="stylesheet"	href="{{asset('/assets/css/site/style.css')}}">
        <link rel="stylesheet"	href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

        <!-- Scripts -->
		<script defer src="{{asset('/assets/js/framework/scroll.js')}}"></script>
		<script defer src="{{asset('/assets/js/framework/navbar.js')}}"></script>
        <script defer src="{{asset('/assets/js/framework/preloader.js')}}"></script>
    </head>
	<body id="top">

        @include("site.layout.preloader")

        @include("site.layout.backToTop")

        <div class="hero-background">
            <header>
                <div class="container">
                    <div class="responsive-nav-icon"><i class="fa-solid fa-bars"></i></div>
                    <ul>
                        <li><a class="link">Nosotros</a></li>
                        <li><a class="link">Link 2</a></li>
                        <li><a class="link">Link 3</a></li>
                        <li><a class="link">Contacto</a></li>
                    </ul>
                </div>
            </header>
        </div>
        <div class="hero-text">
            <h1>{{session("infoComercio.nombre")}}</h1>
            <h2>{{session("infoComercio.slogan")}}</h2>
            <a href="/shop">Ingresar a la tienda</a>
            <a href="/admin">Ingresar al panel admin</a>
        </div>

        <section id="section1">
            <h3>Sección 1</h3>
        </section>

        <section id="section2">
            <h3>Sección 2</h3>
        </section>

        <section id="section3">
            <h3>Sección 3</h3>
        </section>

        <section id="section4">
            <h3>Sección 4</h3>
        </section>
        
	</body>
</html>