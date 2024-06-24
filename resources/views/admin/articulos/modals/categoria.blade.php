<div id="modal_agregar_categoria" class="modal modal-primary">
    <div class="modal-container" style="width: 500px">
        <div class="modal-header">
            <div class="modal-title">
                <h1>Agregar categoría</h1>
            </div>
            <span class="modal-close" onclick="this.parentElement.parentElement.parentElement.style.display='none'">X</span>
        </div>
        
        <div class="modal-body" style="padding-top: 40px; background: white">

            <label>
                Nombre
                <input type="text" required id="modal_nombre_categoria" placeholder="Nombre">
            </label>

            <label>
                Descripción
                <input type="text" required id="modal_descripcion_categoria" placeholder="Descripcion">
            </label>
            
            <button id="boton_agregar_categoria_modal" class="btn-primary"><span><i class="fa-solid fa-plus"></i></span>Agregar</button>

        </div>
    </div>
</div>