<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ingreso de usuarios - {{ session("infoComercio.nombre") }}</title>

    <!-- Hojas de estilo -->
    <link rel="stylesheet" href="{{ config('constants.admin_css') }}style.css">
    <link rel="stylesheet" href="{{ config('constants.admin_css') }}login.css">
    <link rel="stylesheet" href="{{ config('constants.framework_css') }}alert.css">

    </head>
    <body>

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

        <div class="login-container">
            <div class="login-panel">
                <div class="left-panel">
                    <h1>Login</h1>
                    <div class="input-group">
                        <label>
                            Usuario o email
                            <input form="form-login" type="text" name="username" required maxlength="16">
                        </label>
                        <label>
                            Password
                            <input form="form-login" type="password" name="password" required maxlength="16">
                        </label>
                        <div class="radio-fix">
                            <input form="form-login" type="checkbox" id="check_remember" name="check_remember">
                            <label for="check_remember">Recordarme</label>
                        </div>
                    </div>
                    <div class="input-group">
                        <button form="form-login" type="submit" class="btn-primary">{{ __('general.login_button') }}</button>
                    </div>
                </div>
                <div class="right-panel">
                    <div>
                        <h2>{{ session("infoComercio.nombre") }}</h2>
                        <h4>Panel de administración</h4>
                    </div>
                </div>
            </div>
        </div>

        <form id="form-login" method="post">@csrf</form>
    </body>
</html>