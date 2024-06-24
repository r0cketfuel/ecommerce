@extends("shop.layout.master")

@php
    $title = "Mi cuenta";
@endphp

@section("title", $title)

@php
    $breadcrumbs = [
    ];
@endphp

@section("css")
    <link rel="stylesheet"	href="{{  config('constants.framework_css') }}alert.css">
    <link rel="stylesheet"	href="{{  config('constants.framework_css') }}accordion.css">
@endsection

@section("js")
    <script defer src="{{  config('constants.framework_js') }}accordion.js"></script>
@endsection

@section("body")

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

    <div class="main-container">
        @include("shop.layout.breadcrumb")

        <div class="flex flex-column gap-3" style="max-width: 700px;">

            <div class="accordion">
                <div class="accordion-header">
                    <div class="accordion-title">Datos personales</div>
                    <div class="arrow"><i class="fa-solid fa-chevron-down"></i></div>
                </div>
                <div class="accordion-panel">
                    <div class="panel-container">
                        <div class="input-group">
                            <div class="flex gap-3">
                                <label>
                                    Apellidos
                                    <input disabled value="{{ session('shop.usuario.datos.apellidos') }}">
                                </label>
                                <label>
                                    Nombres
                                    <input disabled value="{{ session('shop.usuario.datos.nombres') }}">
                                </label>
                            </div>

                            <label>
                                Tipo de documento
                                <select disabled>
                                    <option value="" selected disabled>Seleccione</option>
                                    @foreach($tiposDocumentos as $tipoDocumento)
                                        <option value="{{ $tipoDocumento->id }}" @if (session('shop.usuario.datos.tipo_documento_id') == $tipoDocumento->id) selected @endif>{{$tipoDocumento->tipo}}</option>
                                    @endforeach
                                </select>
                            </label>

                            <label>
                                Número de documento
                                <input disabled value="{{ session('shop.usuario.datos.documento_nro') }}">
                            </label>

                            <div class="flex gap-3">
                                <label>
                                    Fecha de nacimiento
                                    <input form="form1" type="date" id="fecha_nacimiento" name="fecha_nacimiento" value="{{ session('shop.usuario.datos.fecha_nacimiento') }}">
                                </label>

                                <label>
                                    Género
                                    <select form="form1" id="genero_id" name="genero_id">
                                        <option value="" disabled selected>Seleccione</option>
                                        @foreach ($generos as $genero)
                                            <option value="{{ $genero->id }}" @if (session('shop.usuario.datos.genero_id') == $genero->id) selected @endif> {{ $genero->genero }}</option>
                                        @endforeach
                                    </select>
                                </label>
                            </div>

                            <label>
                                Cuil
                                <input form="form1" id="cuil" name="cuil" value="{{ session('shop.usuario.datos.cuil') }}">
                            </label>

                            <label>
                                Cuit
                                <input form="form1" id="cuit" name="cuit" value="{{ session('shop.usuario.datos.cuit') }}">
                            </label>

                            <button type="submit" form="form1" name="form1" class="btn-primary">Guardar cambios</button>
                        </div>
                        <!-- /Input group -->
                    </div>
                    <!-- /Panel container-->
                </div>
                <!-- /Accordion panel-->
            </div>
            <!-- /Accordion-->

            <div class="accordion">
                <div class="accordion-header">
                    <div class="accordion-title">Datos de contacto</div>
                    <div class="arrow"><i class="fa-solid fa-chevron-down"></i></div>
                </div>
                <div class="accordion-panel">
                    <div class="panel-container">
                        <div class="input-group">
                            <label>
                                Domicilio
                                <input form="form2" id="domicilio" name="domicilio" value="{{ session('shop.usuario.datos.domicilio') }}">
                            </label>

                            <div class="flex gap-3">
                                <label>
                                    Domicilio número
                                    <input form="form2" type="text" id="domicilio_nro" name="domicilio_nro" required value="{{ session('shop.usuario.datos.domicilio_nro') }}">
                                </label>
                                
                                <label>
                                    Domicilio piso
                                    <input form="form2" type="text" id="domicilio_piso" name="domicilio_piso" value="{{ session('shop.usuario.datos.domicilio_piso') }}">
                                </label>

                                <label>
                                    Domicilio depto
                                    <input form="form2" type="text" id="domicilio_depto" name="domicilio_depto" value="{{ session('shop.usuario.datos.domicilio_depto') }}">
                                </label>
                            </div>

                            <label>
                                Localidad
                                <input form="form2" type="text" id="localidad" name="localidad" required value="{{ session('shop.usuario.datos.localidad') }}">
                            </label>

                            <label>
                                Codigo postal
                                <input form="form2" type="text" id="codigo_postal" name="codigo_postal" required value="{{ session('shop.usuario.datos.codigo_postal') }}">
                            </label>

                            <label>
                                Teléfono fijo
                                <input form="form2" type="text" id="telefono_fijo" name="telefono_fijo" value="{{ session('shop.usuario.datos.telefono_fijo') }}">
                            </label>

                            <label>
                                Teléfono celular
                                <input form="form2" type="text" id="telefono_celular" name="telefono_celular" required value="{{ session('shop.usuario.datos.telefono_celular') }}">
                            </label>

                            <label>
                                Teléfono alternativo
                                <input form="form2" type="text" id="telefono_alt" name="telefono_alt" value="{{ session('shop.usuario.datos.telefono_alt') }}">
                            </label>

                            <label>
                                Correo electrónico
                                <input type="email" disabled value="{{ session('shop.usuario.datos.email') }}">
                            </label>

                            <button form="form2" name="form2" class="btn-primary">Guardar cambios</button>
                        </div>
                        <!-- /Input group -->
                    </div>
                    <!-- /Panel container-->
                </div>
                <!-- /Accordion panel-->
            </div>
            <!-- /Accordion-->

            <div class="accordion">
            <div class="accordion-header">
                    <div class="accordion-title">Cambio de contraseña</div>
                    <div class="arrow"><i class="fa-solid fa-chevron-down"></i></div>
                </div>
                <div class="accordion-panel">
                    <div class="panel-container">
                        <div class="input-group">
                            <label>
                                Password anterior
                                <input form="form3" type="password" id="password_old" name="password_old" required>
                            </label>
    
                            <label>
                                Nuevo password
                                <input form="form3" type="password" id="password_new" name="password_new" required>
                            </label>
    
                            <label>
                                Repetir password
                                <input form="form3" type="password" id="password_repeat" name="password_repeat" required>
                            </label>
    
                            <button form="form3" name="form3" class="btn-primary">Guardar cambios</button>
                        </div>
                        <!-- /Input group -->
                    </div>
                    <!-- /Panel container-->
                </div>
                <!-- /Accordion panel-->
            </div>
            <!-- /Accordion-->

        </div>
    </div>

    <form id="form1" method="post">@csrf</form>
    <form id="form2" method="post">@csrf</form>
    <form id="form3" method="post">@csrf</form>

@endsection