<div class="modal" id="modal-login">
    <div class="modal-container" style="width: 600px" id="modal-container">
        <div class="modal-header">
            <div class="modal-title">
            </div>
            <span class="modal-close" onclick="this.parentElement.parentElement.parentElement.style.display='none'">X</span>
        </div>

        <div class="modal-login">
            <div class="left-panel">
                <h1>Login</h1>
                <p>{{ __('general.register_msg') }} <a class="register-link" href="/shop/register"><span>{{ __('general.register_link') }}</span></a></p>
                <div class="input-group">
                    <label>
                        Usuario o email
                        <input form="form-login" type="text" name="username" required maxlength="16" autocomplete="off">
                    </label>
                    <label>
                        Password
                        <input form="form-login" type="password" name="password" required maxlength="16" autocomplete="off">
                    </label>
                    <div class="radio-fix">
                        <input form="form-login" type="checkbox" id="check_remember" name="check_remember">
                        <label for="check_remember">Recordarme</label>
                    </div>
                </div>
                <a class="password-recovery-link" href="/shop/recovery">{{ __('general.forgot_password_msg') }} Recuperar contraseña</a>
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
</div>

<form id="form-login" method="post" action="{{ route('login.modal') }}">@csrf</form>
<form id="form-guest" method="post" action="{{ route('login.guest') }}">@csrf</form>
