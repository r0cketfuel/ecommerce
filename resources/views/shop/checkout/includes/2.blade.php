<div class="carousel-slide">

    <!-- Contenido -->
    <div class="panel">
        <div class="panel-title panel-title-underlined">Datos facturación</div>
        <div class="panel-content">
            <div class="flex gap-3">
                <label>
                    Apellidos
                    <input type="text" id="apellidos" name="apellidos" value="{{session('shop.usuario.datos.apellidos')}}">
                </label>

                <label>
                    Nombres
                    <input type="text" id="nombres" name="nombres" value="{{session('shop.usuario.datos.nombres')}}">
                </label>
            </div>
            <div class="flex gap-3">
                <label>
                    Tipo de documento
                    <select id="tipo_documento_id" name="tipo_documento_id">
                        <option value="" selected disabled>Seleccione</option>
                        @foreach($tiposDocumentos as $tipoDocumento)
                            <option value="{{$tipoDocumento->id}}" @if(session('shop.usuario.datos.tipo_documento_id') == $tipoDocumento->id) selected @endif>{{$tipoDocumento->tipo}}</option>
                        @endforeach
                    </select>
                </label>

                <label>
                    Número de documento (sólo números)
                    <input type="text" id="documento_nro" name="documento_nro" value="{{session('shop.usuario.datos.documento_nro')}}">
                </label>
            </div>
            <div class="flex gap-3">
                <label>
                    Teléfono celular (sólo números)
                    <input type="text" id="telefono_celular" name="telefono_celular" value="{{session('shop.usuario.datos.telefono_celular')}}">
                </label>

                <label>
                    Teléfono alternativo (sólo números)
                    <input type="text" id="telefono_alt" name="telefono_alt" value="{{session('shop.usuario.datos.telefono_alt')}}">
                </label>
            </div>

            <label>
                Correo electrónico
                <input type="text" id="email" name="email" value="{{session('shop.usuario.datos.email')}}" autocomplete="off">
            </label>
        </div>
    </div>
    <br>
    <div class="flex justify-content-between">
        <button class="btnPrev"><i class="fa-solid fa-chevron-left fa-xs"></i> Carrito de compras</button>
        <button class="btnNext">Pago y envío <i class="fa-solid fa-chevron-right fa-xs"></i></button>
    </div>
</div>