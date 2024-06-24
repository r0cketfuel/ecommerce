@extends("shop.layout.master")

@php
    $title = "Alta de usuarios";
@endphp

@section("title", $title)

@section("css")
    <link rel="stylesheet"	href="{{ config('constants.framework_css') }}alert.css">
    <link rel="stylesheet"	href="{{ config('constants.framework_css') }}layout.css">
    <link rel="stylesheet"	href="{{ config('constants.framework_css') }}panel.css">
@endsection

@section("js")
    <script defer src="{{  config('constants.framework_js') }}formError.js"></script>
    <script defer src="{{  config('constants.framework_js') }}alert.js"></script>
@endsection

@section("body")

    <!-- Contenido de la página -->
    <div class="main-container">

        <!-- Breadcrumb -->
        <div class="breadcrumb">
            <a href="/shop"><i class="fa-solid fa-house-chimney fa-sm"></i> Home</a> > Alta de usuarios
        </div>

        @if ($errors->any())
            <div class="alert danger">
                Se encontraron errores. Por favor revise la información ingresada
                <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
            </div>
        @endif

        <div class="panel mw50">
            <div class="panel-title">Alta de usuarios</div>
            <div class="panel-content">
                <fieldset>
                    <legend>Usuario y contraseña</legend>

                    <label>Usuario
                        <input required form="form" type="text" id="username" name="username" value="{{  old('username') }}" {{ ($errors->first("username") ? " class=form-error" : "") }}>
                        {!! $errors->first("username", "<p class='field-validation-msg'>:message</p>") !!}
                    </label>

                    <label>Password
                        <input required form="form" type="password" id="password" name="password" value="{{  old('password_repeat') }}" {{ ($errors->first("password") ? " class=form-error" : "") }}>
                        {!! $errors->first("password", "<p class='field-validation-msg'>:message</p>") !!}
                    </label>

                    <label>Repetir password
                        <input required form="form" type="password" id="password_repeat" name="password_repeat" value="{{  old('password_repeat') }}" {{ ($errors->first("password_repeat") ? " class=form-error" : "") }}>
                        {!! $errors->first("password_repeat", "<p class='field-validation-msg'>:message</p>") !!}
                    </label>
                </fieldset>

                <fieldset>
                    <legend>Datos personales</legend>

                    <div class="flex">
                        <label>
                            Apellidos
                            <input required form="form" type="text" name="apellidos" value="{{  old('apellidos') }}" {{ ($errors->first("apellidos") ? " class=form-error" : "") }}>
                            {!! $errors->first("apellidos", "<p class='field-validation-msg'>:message</p>") !!}
                        </label>

                        <label>
                            Nombres
                            <input required form="form" type="text" name="nombres" value="{{  old('nombres') }}" {{ ($errors->first("nombres") ? " class=form-error" : "") }}>
                            {!! $errors->first("nombres", "<p class='field-validation-msg'>:message</p>") !!}
                        </label>
                    </div>

                    <div class="flex">
                        <label>
                            Fecha de nacimiento
                            <input required form="form" type="date" name="fecha_nacimiento" max="{{  date('Y-m-d') }}" value="{{ old('fecha_nacimiento') }}">
                            {!! $errors->first("fecha_nacimiento", "<p class='field-validation-msg'>:message</p>") !!}
                        </label>

                        <label>
                            Género
                            <select required form="form" name="genero_id" {{ $errors->first("genero_id") ? "class=form-error" : "" }}>
                                <option value="" selected disabled>Seleccione</option>
                                @foreach ($generos as $genero)
                                    <option value="{{ $genero->id }}" @selected(old('genero_id') == $genero->id)>{{ $genero->genero }}</option>
                                @endforeach
                            </select>
                            {!! $errors->first("genero_id", "<p class='field-validation-msg'>:message</p>") !!}
                        </label>
                    </div>

                    <label>
                        Tipo de documento
                        <select required form="form" name="tipo_documento_id" {{ $errors->first("tipo_documento_id") ? "class=form-error" : "" }}>
                            <option value="" selected disabled>Seleccione</option>
                            @foreach ($tiposDocumentos as $tipoDocumento)
                                <option value="{{ $tipoDocumento->id }}" @selected(old('tipo_documento_id') == $tipoDocumento->id)>{{ $tipoDocumento->tipo }}</option>
                            @endforeach
                        </select>
                        {!! $errors->first("tipo_documento_id", "<p class='field-validation-msg'>:message</p>") !!}
                    </label>

                    <label>
                        Número de documento
                        <input required form="form" type="text"  name="documento_nro" value="{{ old('documento_nro') }}" {{ ($errors->first("documento_nro") ? " class=form-error" : "") }}>
                        {!! $errors->first("documento_nro", "<p class='field-validation-msg'>:message</p>") !!}
                    </label>

                    <label>
                        Cuil
                        <input form="form" type="text" name="cuil" value="{{ old('cuil') }}" {{ ($errors->first("cuil") ? " class=form-error" : "") }}>
                        {!! $errors->first("cuil", "<p class='field-validation-msg'>:message</p>") !!}
                    </label>

                    <label>
                        Cuit
                        <input form="form" type="text" name="cuit" value="{{ old('cuit') }}" {{ ($errors->first("cuit") ? " class=form-error" : "") }}>
                        {!! $errors->first("cuit", "<p class='field-validation-msg'>:message</p>") !!}
                    </label>

                    <label>
                        Domicilio
                        <input required form="form" type="text" name="domicilio" value="{{ old('domicilio') }}" {{ ($errors->first("domicilio") ? " class=form-error" : "") }}>
                        {!! $errors->first("domicilio", "<p class='field-validation-msg'>:message</p>") !!}
                    </label>

                    <label>
                        Domicilio número
                        <input required form="form" type="text" name="domicilio_nro" value="{{ old('domicilio_nro') }}" {{ ($errors->first("domicilio_nro") ? " class=form-error" : "") }}>
                        {!! $errors->first("domicilio_nro", "<p class='field-validation-msg'>:message</p>") !!}
                    </label>

                    <label>
                        Domicilio piso
                        <input form="form" type="text" name="domicilio_piso" value="{{ old('domicilio_piso') }}" {{ ($errors->first("domicilio_piso") ? " class=form-error" : "") }}>
                        {!! $errors->first("domicilio_piso", "<p class='field-validation-msg'>:message</p>") !!}
                    </label>

                    <label>
                        Domicilio depto
                        <input form="form" type="text" name="domicilio_depto" value="{{ old('domicilio_depto') }}" {{ ($errors->first("domicilio_depto") ? " class=form-error" : "") }}>
                        {!! $errors->first("domicilio_depto", "<p class='field-validation-msg'>:message</p>") !!}
                    </label>

                    <label>
                        Localidad
                        <input required form="form" type="text" name="localidad" value="{{ old('localidad') }}" {{ ($errors->first("localidad") ? " class=form-error" : "") }}>
                        {!! $errors->first("localidad", "<p class='field-validation-msg'>:message</p>") !!}
                    </label>

                    <label>
                        Código postal
                        <input required form="form" type="text" name="codigo_postal" value="{{ old('codigo_postal') }}" {{ ($errors->first("codigo_postal") ? " class=form-error" : "") }}>
                        {!! $errors->first("codigo_postal", "<p class='field-validation-msg'>:message</p>") !!}
                    </label>

                    <label>
                        Teléfono fijo
                        <input form="form" type="text" name="telefono_fijo" value="{{ old('telefono_fijo') }}" {{ ($errors->first("telefono_fijo") ? " class=form-error" : "") }}>
                        {!! $errors->first("telefono_fijo", "<p class='field-validation-msg'>:message</p>") !!}
                    </label>

                    <label>
                        Teléfono celular
                        <input required form="form" type="text" name="telefono_celular" value="{{ old('telefono_celular') }}" {{ ($errors->first("telefono_celular") ? " class=form-error" : "") }}>
                        {!! $errors->first("telefono_celular", "<p class='field-validation-msg'>:message</p>") !!}
                    </label>

                    <label>
                        Teléfono alternativo
                        <input form="form" type="text" name="telefono_alt" value="{{ old('telefono_alt') }}" {{ ($errors->first("telefono_alt") ? " class=form-error" : "") }}>
                        {!! $errors->first("telefono_alt", "<p class='field-validation-msg'>:message</p>") !!}
                    </label>

                    <label>
                        Correo electrónico
                        <input required form="form" type="text" name="email" value="{{ old('email') }}" {{ ($errors->first("email") ? " class=form-error" : "") }}>
                        {!! $errors->first("email", "<p class='field-validation-msg'>:message</p>") !!}
                    </label>
                    
                    <button form="form" class="btn-primary">Registrarme</button>
                </fieldset>
            </div>
        </div>
    </div>

    <form id="form" method="post">@csrf</form>

@endsection