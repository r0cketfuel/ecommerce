document.addEventListener("DOMContentLoaded", load, false);

const modalAgregarCategoria         = document.getElementById("modal_agregar_categoria");
const modalAgregarSubcategoria      = document.getElementById("modal_agregar_subcategoria");

const botonAgregarCategoriaModal    = document.getElementById("boton_agregar_categoria_modal")
const botonAgregarSubcategoriaModal = document.getElementById("boton_agregar_subcategoria_modal")

const selectCategorias              = document.getElementById("categoria_id");
const selectSubcategorias           = document.getElementById("subcategoria_id");

const botonAgregarCategoria         = document.getElementById("boton_agregar_categoria");
const botonAgregarSubcategoria      = document.getElementById("boton_agregar_subcategoria");

function load()
{
    botonAgregarCategoria.addEventListener("click",         modalAgregarCategoriaShow,      false);
    botonAgregarSubcategoria.addEventListener("click",      modalAgregarSubcategoriaShow,   false);

    botonAgregarCategoriaModal.addEventListener("click",    agregarCategoriaClick,          false);
    botonAgregarSubcategoriaModal.addEventListener("click", agregarSubcategoriaClick,       false);

    selectCategorias.addEventListener("change",             categoriasChangeEvent,          false);
}

function modalAgregarCategoriaShow()
{
    modalAgregarCategoria.style.display = "block";
}

function modalAgregarSubcategoriaShow()
{
    modalAgregarSubcategoria.style.display = "block";
}

async function listadoCategorias()
{
    const url = "/api/categorias";

    const response  = await fetch(url, {
        method: "GET",
        headers: {
            "Content-Type": "application/json",
        },
    });

    return response;
}

async function listadoSubcategorias()
{
    const url = "/api/subcategorias";

    const response  = await fetch(url, {
        method: "GET",
        headers: {
            "Content-Type": "application/json",
        },
    });

    return response;
}

async function agregarCategoriaClick()
{
    try {
        const inputName         = document.getElementById("modal_nombre_categoria");
        const inputDescripcion  = document.getElementById("modal_descripcion_categoria");
        const buttonLabel       = botonAgregarCategoria.innerHTML;

        botonAgregarCategoria.disabled = true;

        const url = "/api/categorias";
        const parametros = {
            nombre:         inputName.value,
            descripcion:    inputDescripcion.value,
        };

        const response = await fetch(url, {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
        },
        body: JSON.stringify(parametros),
        });

        if(response.status === 201)
        {
            const nuevaCategoria = await response.json();
            nuevaCategoriaId = nuevaCategoria.id;

            // Reset boton agregar
            botonAgregarCategoria.disabled = false;

            // Reset controles
            inputName.value = "";
            inputDescripcion.value = "";

            // Reset select categorías
            selectCategorias.disabled = true;
            selectCategorias.innerHTML = '<option value="" selected>Categoría</option>';

            // Reset select subcategorías
            selectSubcategorias.disabled = true;
            selectSubcategorias.innerHTML = '<option value="" selected>Subcategoría</option>';

            // Recarga categorías
            const responseCategorias    = await listadoCategorias();
            const categorias            = await responseCategorias.json();
            
            categorias.forEach((categoria) => {
                const isSelected = categoria.id === nuevaCategoriaId;
                addOption(selectCategorias, categoria.id, categoria.nombre, false, isSelected);
            });

            // Habilita select categorías y cierra el modal
            selectCategorias.disabled = false;

            modalAgregarCategoria.style.display = 'none';
        }
    }
    catch (error)
    {
        console.error("Error al agregar categoría:", error);
    }
}

function agregarSubcategoriaClick()
{
    //Controles del modal
    let modalSelectCategoria    = document.getElementById("modal_categoria");
    let inputName               = document.getElementById("modal_nombre_subcategoria");
    let inputDescripcion        = document.getElementById("modal_descripcion_subcategoria");
    let buttonLabel 	        = botonAgregarSubcategoria.innerHTML;

    modalAgregarSubcategoria.style.display  = "block";
    botonAgregarSubcategoria.disabled       = true;

    let xhttp 	= new XMLHttpRequest()
    let url 	= "/admin/ajax/agregaSubcategoria";
    
    let parametros = {};
    parametros["idCategoria"]   = modalSelectCategoria.value;
    parametros["nombre"]        = inputName.value;
    parametros["descripcion"]   = inputDescripcion.value;

    xhttp.onreadystatechange = function()
    {
        if(this.readyState == 4 && this.status == 200)
        {             
            //Reset boton agregar
            botonAgregarSubcategoria.innerHTML = buttonLabel;
            botonAgregarSubcategoria.disabled = false;

            //Reset controles
            modalSelectCategoria.value  = "";
            inputName.value             = "";
            inputDescripcion.value      = "";

            //Reset select subcategorías
            selectSubcategorias.disabled        = true;
            selectSubcategorias.options.length  = 0;
            addOption(selectSubcategorias,"","Subcategoría",true,true);
            
            //Recarga subcategorías
            const array = JSON.parse(this.responseText);
            for(let i=0;i<array.length;++i)
                addOption(selectSubcategorias, array[i]["nombre"], array[i]["descripcion"], false, false);

            selectSubcategorias.disabled = false;
            modalClose(2);

            createAlert("success","Subcategoría creada exitosamente");
        }
    }

    xhttp.open("POST", url, true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("parametros=" + JSON.stringify(parametros));
}

function addOption(selectElement,value,text,disabled,selected)
{
    let option      = document.createElement("option");
    option.value    = value;
    option.text     = text;
    option.disabled = disabled;
    option.selected = selected;

    selectElement.add(option);
}

function categoriasChangeEvent()
{
    let parametros  = {};
    let xhttp 	    = new XMLHttpRequest()
    let url 	    = "/api/subcategorias/" + selectCategorias.value;
    
    //Reset select subcategorías
    selectSubcategorias.disabled        = true;
    selectSubcategorias.options.length  = 0;
    addOption(selectSubcategorias,"","Subcategoría",true,true);

    xhttp.onreadystatechange = function()
    {
        if(this.readyState == 4 && this.status == 200)
        {             
            const array = JSON.parse(this.responseText);
            if(array.length>0)
            {
                for(let i=0;i<array.length;++i)
                    addOption(selectSubcategorias, array[i]["id"], array[i]["nombre"], false, false);

                selectSubcategorias.disabled = false;
            }
        }
    }

    xhttp.open("GET", url, true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("parametros=" + JSON.stringify(parametros));
}