<div id="modal_filter" class="modal modal-primary">
    <div class="modal-container" style="width: 500px">
        <div class="modal-header">
            <div class="modal-title">
                <h1>Filtros</h1>
            </div>
            <span class="modal-close" onclick="closeModal(this.parentElement.parentElement.parentElement.id)">X</span>
        </div>
        
        <div class="modal-body" style="padding-top: 60px; background: white">

            <label>
                Estado
                <select id="modal_select_estado">
                    <option value="" disabled selected>Seleccione</option>
                    <option value="1">Activos</option>
                    <option value="0">Pausados</option>
                </select>
            </label>

            <button id="boton_aplicar_filtros_modal" class="btn-primary">Aplicar</button>

        </div>
    </div>
</div>