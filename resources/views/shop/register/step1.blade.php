<div class="carousel-slide">
    <!-- Contenido -->
    <div class="panel">
        <div class="panel-title panel-title-underlined">Datos personales</div>
        <div class="panel-content">
            <div class="flex gap-3">
                <label>
                    Apellidos
                    <input type="text" name="apellidos">
                </label>

                <label>
                    Nombres
                    <input type="text" name="nombres">
                </label>
            </div>

            <div class="flex gap-3">
                <label>
                    Tipo de documento
                    <select name="tipo_documento_id">
                        <option value="" selected disabled>Seleccione</option>
                        @foreach ($tiposDocumentos as $tipoDocumento)
                            <option value="{{ $tipoDocumento->id }}">{{ $tipoDocumento->tipo }}</option>
                        @endforeach
                    </select>
                </label>

                <label>
                    Número de documento
                    <input type="text" name="documento_nro">
                </label>
            </div>

            <label>
                Correo electrónico
                <input type="email" name="email" autocomplete="off">
            </label>

            <div class="radio-fix">
                <input type="checkbox" id="check_suscribe" name="check_suscribe">
                <label for="check_suscribe">Quiero suscribirme al Newsletter</label>
            </div>
        </div>
    </div>
    <!-- Botones -->
    <br>
    <div class="flex justify-content-end">
        <button class="btnNext">Siguiente <i class="fa-solid fa-chevron-right fa-xs"></i></button>
    </div>
</div>