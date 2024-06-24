<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Ingreso de usuarios - {{ session("infoComercio.nombre") }}</title>

        <!-- Hojas de estilo -->
        <link rel="stylesheet" href="{{ config('constants.shop_css') }}style.css">
        <link rel="stylesheet" href="{{ config('constants.shop_css') }}login.css">
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

        <div class="login-container">
            <div class="login-panel">
                <div class="left-panel">
                    <h1>Login</h1>
                    <p>{{ __('general.register_msg') }} <a class="register-link" href="/shop/register"><span>{{ __('general.register_link') }}</span></a></p>
                    <div class="input-group">
                        <label>
                            Usuario o email
                            <input form="form-login" type="text" name="username" required maxlength="16" autofocus>
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
                    <a class="password-recovery-link" href="/shop/recovery">{{ __('general.forgot_password_msg') }}</a>
                    <div class="input-group">
                        <button form="form-login" type="submit" class="btn-primary">{{ __('general.login_button') }}</button>
                        <button form="form-guest" type="submit" class="btn-secondary">{{ __('general.login_guest_button') }}</button>
                    </div>
                </div>
                <div class="right-panel">
                    <div>
                        <h2>{{ session("infoComercio.nombre") }}</h2>
                        <h4>{{ session("infoComercio.slogan") }}</h4>
                    </div>
                </div>
            </div>
        </div>

        <form id="form-login" method="post">@csrf</form>
        <form id="form-guest" method="post" action="{{ route('login.guest') }}">@csrf</form>
    </body>
</html>
