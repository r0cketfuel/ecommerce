<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recupero de contraseña - {{ session("infoComercio.nombre") }}</title>

    <!-- Hojas de estilo -->
    <link rel="stylesheet" href="{{ config('constants.shop_css') }}style.css">
    <link rel="stylesheet" href="{{ config('constants.framework_css') }}panel.css">
    <link rel="stylesheet" href="{{ config('constants.framework_css') }}alert.css">

    </head>
    <body id="top">

        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div class="alert danger">
                    <div>{{$error}}</div>
                    <div class="closebtn" onclick="this.parentElement.style.display='none';">&times;</div>
                </div>
            @endforeach
        @endif

        @if (session("success"))
            <div class="alert success">
                <div>{{session("success")}}</div>
                <div class="closebtn" onclick="this.parentElement.style.display='none';">&times;</div>
            </div>
        @endif

        @if (session("error"))
            <div class="alert danger">
                <div>{{session("error")}}</div>
                <div class="closebtn" onclick="this.parentElement.style.display='none';">&times;</div>
            </div>
        @endif

        <!-- Contenido de la página -->
        <div class="main-container">
            <div class="panel">
                <div class="panel-title">Recuperar contraseña</div>
                <div class="panel-content">
                    <label>
                        Teléfono celular
                        <input required form="form" type="text" name="telefono_celular">
                    </label>
                    <label>
                        Correo electrónico
                        <input required form="form" type="email" name="email">
                    </label>
                    <button form="form" class="btn-primary" type="submit">Enviar</button>
                </div>
            </div>

        </div>

        <form id="form" method="post" autocomplete="off">@csrf</form>
	</body>
</html>