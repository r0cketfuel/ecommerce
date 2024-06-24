document.addEventListener("DOMContentLoaded", load, false);

//===========//
// CONTROLES //
//===========//
const modal             = document.getElementById("modal-add");

const selectSizes       = document.getElementById("sizes");
const selectColors      = document.getElementById("colors");

const inputField        = document.getElementById("addToCartQty");
const minusButton       = document.getElementById("minusButton");
const plusButton        = document.getElementById("plusButton");

const precio            = document.getElementById("precio");
const subtotal          = document.getElementById("subtotal");

const addToCartButton   = document.getElementById("button_addToCart");

// Objeto con los datos del artículo
let data = {
    info                : [],
    atributos           : 
    {
        talles          : [],
        colores         : [],
        combinaciones   : []
    },
};

function load()
{
    init();

    //=================//
    // EVENT LISTENERS //
    //=================//
    const addToCartButtons = [...document.querySelectorAll(".btn-primary.btn-rounded")];
    if(addToCartButtons.length>0)
        addToCartButtons.forEach(x => x.addEventListener("click", function() { info(x.value); return false }));

    addToCartButton.addEventListener("click", function() { addToCart(addToCartButton.value); return false });

    selectSizes.addEventListener    ("change",  function() { selectSizesChangeEvent();  return false });
    selectColors.addEventListener   ("change",  function() { selectColorsChangeEvent(); return false });
    minusButton.addEventListener    ("click",   function() { changeQtyMinus();          return false });
    plusButton.addEventListener     ("click",   function() { changeQtyPlus();           return false });
    inputField.addEventListener     ("change",  function() { updateSubtotal();          return false });

    if(!modal)
        info(addToCartButton.value);
}

//======================================//
// FUNCION QUE REALIZA LA PETICION AJAX //
//======================================//
async function ajax(url = "", parameters = {})
{
    let token = document.querySelector("meta[name='csrf-token']").getAttribute("content");

    const response = await fetch(url,
    {
        method:         "POST",
        cache:          "no-cache",
        credentials:    "same-origin",
        headers: 
        {
                        "Content-Type": "application/x-www-form-urlencoded",
                        "X-CSRF-TOKEN": token,
        },
        redirect:       "follow",
        referrerPolicy: "strict-origin-when-cross-origin",
        body:           parameters
    });
    
    return response.json();
}

//===========================================================//
// FUNCION QUE OBTIENE LA INFORMACION PRINCIPAL DEL ARTICULO //
//===========================================================//
async function infoItem(id)
{
    const url           = "/shop/requests/infoItem";
    const parameters    = "id=" + id;
    const promise       = ajax(url,parameters);
    
    return(promise);
}

//=============================================================//
// FUNCION QUE OBTIENE LA INFORMACION DE LA TABLA DE ATRIBUTOS //
//=============================================================//
async function atributosItem(id)
{
    const url           = "/shop/requests/atributosItem";
    const parameters    = "articulo_id=" + id;
    const promise       = ajax(url,parameters);
    
    return(promise);
}

//=========================================================//
// FUNCION QUE LLAMA AL MODAL CON LOS PARAMETROS RECIBIDOS //
//=========================================================//
async function info(id)
{
    const [info, atributos] = await Promise.all([infoItem(id), atributosItem(id)]);

    data.info       = info;
    data.atributos  = 
    {
        talles          : [],
        colores         : [],
        combinaciones   : []
    };

    // Talles
    data.atributos.talles = atributos.reduce((talles, atributo) => {
        if(!atributo.talle_id) 
            return talles;

        let talle_id = atributo.talle_id;
        let talle = atributo.talle.talle;
        
        if(!talles.find(t => t.talle_id === talle_id))
            talles.push({ talle_id, talle });

        return talles;
    }, []);

    // Colores
    data.atributos.colores = [...new Set(atributos.filter(({ color }) => color).map(({ color }) => color))];
    
    // Combinaciones
    data.atributos.combinaciones = atributos.map(item => ({ ...item }));
    
    init();
    selectClear(selectSizes);
    selectClear(selectColors);
    precio.innerHTML = formatCurrency(parseFloat(data["info"]["precio"]));
    
    if(data.atributos.talles.length>0)
    {
        for(let i=0;i<data.atributos.talles.length;i++)    
            addOption(selectSizes, data.atributos.talles[i].talle_id, data.atributos.talles[i].talle, false, false);
        
        selectSizes.disabled = false;
    }
    else
    {
        if(data.atributos.colores.length>0)
        {
            for(let i=0;i<data.atributos.colores.length;i++)    
                addOption(selectColors, data.atributos.colores[i], data.atributos.colores[i], false, false);
        
            selectColors.disabled = false;
        }
        else
        {
            let combinacion = data.atributos.combinaciones.find(c => c.talle_id == null && c.color === null);
            updateStock(combinacion);

            if(combinacion.stock > 0)
            {
                updateInputField(combinacion);
                displayQtyControl();
                updateSubtotal();
            }
        }
    }

    if(modal)
        modalAdd(data);
}

//==============================//
// FUNCION QUE MUESTRA EL MODAL //
//==============================//
function modalAdd(data)
{
    let itemImage = document.getElementById("image");
    
    if(data["info"]["imagen"].length>0)
        itemImage.src = data["info"]["imagen"][0]["miniatura"];

    addToCartButton.value = data["info"]["id"];

    openModal("modal-add");
}

//=============================================================//
// FUNCION QUE EJECUTA EL AJAX CUANDO SE SELECCIONA UNA OPCION //
//=============================================================//
function selectSizesChangeEvent()
{
    init();
    selectClear(selectColors);
    
    let selectedTalleId = selectSizes.value;
    let combinacion     = data.atributos.combinaciones.find(c => c.talle_id == selectedTalleId);

    if (data.atributos.colores.length > 0)
    {
        let filtradas = data.atributos.combinaciones.filter(c => c.talle_id == selectedTalleId);
        filtradas.forEach(c => addOption(selectColors, c.color, c.color, false, false));
        selectColors.disabled = false;
    }
    else
    {
        updateStock(combinacion);
        
        if(combinacion.stock > 0)
        {
            updateInputField(combinacion);
            updatePhoto(combinacion);
            displayQtyControl();
            updateSubtotal();
        }
    }
}

//=============================================================//
// FUNCION QUE EJECUTA EL AJAX CUANDO SE SELECCIONA UNA OPCION //
//=============================================================//
function selectColorsChangeEvent()
{
    init();

    let selectedColor   = selectColors.value;
    let combinacion     = data.atributos.combinaciones.find(c => c.color === selectedColor);
    
    if (combinacion)
    {
        updateStock(combinacion);

        if(combinacion.stock > 0)
        {
            updateInputField(combinacion);
            updatePhoto(combinacion);
            displayQtyControl();
            updateSubtotal();
        }
    }
}

//====================================================================================//
// FUNCION QUE MUESTRA EL STOCK DISPONIBLE DEL ITEM SEGUN LA COMBINACION SELECCIONADA //
//====================================================================================//
function updateStock(combinacion)
{
    const stock = document.getElementById("stock");

    if(combinacion.stock == 0)
        stock.innerHTML = "<span style='background-color: red; padding: 4px 8px; color: white; font-weight: bold;'>SIN STOCK</span>";
    else
        stock.innerHTML = combinacion.stock + (combinacion.stock == 1 ? " unidad" : " unidades");
}

//==============================================//
// FUNCION QUE SE EJECUTO AL TOCAR EL SIGNO "+" //
//==============================================//
function changeQtyPlus()
{                    
    if(parseInt(inputField.value) < parseInt(inputField.max) && parseInt(inputField.value) > 0)
    {
        inputField.value = parseInt(inputField.value) + 1;
        updateSubtotal();
    }
}

//==============================================//
// FUNCION QUE SE EJECUTO AL TOCAR EL SIGNO "-" //
//==============================================//
function changeQtyMinus()
{
    if(parseInt(inputField.value) > parseInt(inputField.min) && parseInt(inputField.value) <= parseInt(inputField.max))
    {
        inputField.value = parseInt(inputField.value) - 1;
        updateSubtotal();
    }
}

//======================================================================//
// FUNCION QUE ACTUALIZA LA MINIATURA SEGUN LA COMBINACION SELECCIONADA //
//======================================================================//
function updatePhoto(combinacion)
{
    let itemImage   = document.getElementById("image");
    let imagenId    = combinacion.imagen_id;

    if(imagenId)
    {
        let imagen = data.info.imagen.find(img => img.id === imagenId);

        if(imagen)
        {
            itemImage.src = imagen.miniatura;
        }
    }
}

//========================================================//
// FUNCION QUE ESTABLECE LOS ATRIBUTOS DEL INPUT CANTIDAD //
//========================================================//
function updateInputField(combinacion)
{
    inputField.min      = combinacion.compra_min || 1;
    inputField.max      = combinacion.compra_max || combinacion.stock;
    inputField.step     = 1;
    inputField.value    = inputField.min;
}

//===============================================//
// FUNCION QUE MUESTRA LOS CONTROLES DE CANTIDAD //
//===============================================//
function displayQtyControl()
{
    const qtyControls = document.getElementById("qtyControl");

    qtyControls.style.display = "flex";
}

function updateSubtotal()
{
    if(parseInt(inputField.value)>=1)
    {
        let temp    = precio.innerHTML;
        temp        = temp.replace("$","");
        temp        = temp.replace(/\./g,"");
        temp        = temp.replace(",",".");

        subtotal.innerHTML = formatCurrency(parseInt(inputField.value) * temp);
    }
}

function formatCurrency(number)
{
    return("$" + number.toFixed(2).replace(".",",").toString().replace(/\B(?=(\d{3})+(?!\d))/g, "."))
}

//===========================================//
// FUNCION QUE INICIALIZA CAMPOS EN EL MODAL //
//===========================================//
function init()
{
    const stock         = document.getElementById("stock");
    const subtotal      = document.getElementById("subtotal");
    const qtyControls   = document.getElementById("qtyControl");

    stock.innerHTML             = "-"
    subtotal.innerHTML          = "-"
    qtyControls.style.display   = "none";
}

//==================================================================//
// FUNCION QUE INICIALIZA EL SELECT AGREGANDO LA OPCION POR DEFECTO //
//==================================================================//
function selectClear(selectElement)
{
    selectElement.disabled = true;
    selectElement.options.length = 0;
    addOption(selectElement,"","Seleccione...",true,true);
}

//=======================================//
// FUNCION QUE AGREGA OPCIONES AL SELECT //
//=======================================//
function addOption(selectElement,value,text,disabled,selected)
{
    let option      = document.createElement("option");
    option.value    = value;
    option.text     = text;
    option.disabled = disabled;
    option.selected = selected;

    selectElement.add(option);
}

//=====================================//
// FUNCION QUE AGREGA ITEMS AL CARRITO //
//=====================================//
function addToCart(id) {

    const url           = "/shop/requests/updateCart";

    let carticon        = document.getElementById("qty");
    let inputQty        = inputField.value;
    let buttonLabel     = addToCartButton.innerHTML;

    let selectedCombination = data.atributos.combinaciones.find(comb => {
        if((selectSizes.value === "" || comb.talle_id == selectSizes.value) && (selectColors.value === "" || comb.color === selectColors.value))
            return true;

        return false;
    });

    // Si no hay talles y colores seleccionados, asumimos que siempre hay una combinación id
    const atributosId = selectedCombination ? selectedCombination.id : (data.atributos.combinaciones[0] ? data.atributos.combinaciones[0].id : null);

    if (!atributosId) {
        console.error("No se pudo determinar la combinación correcta.");
        return;
    }

    const parameters    = "id=" + id + "&cantidad=" + inputQty + "&atributos_id=" + atributosId;
    const promise       = ajax(url, parameters);

    addToCartButton.disabled    = true;
    addToCartButton.innerHTML   = "";
    addToCartButton.classList.add('button--loading');

    promise.then((data) => {

        // Permanencia mínima del loader de 500ms
        setTimeout(function() {
            addToCartButton.classList.remove('button--loading');
            addToCartButton.innerHTML = buttonLabel;
            addToCartButton.disabled = false;
        }, 1000);

        if(data['success'] == true)
        {
            carticon.innerHTML = data['data']['itemQty'];

            setTimeout(function () {
                closeModal("modal-add");
            }, 1000);
        }
        else
        {
            console.log("Error al agregar el item al carrito");
        }
    });
}



//======================================================//

//======================================================//
function itemUpdate(dataset)
{
    let parametros = {
        id: dataset.id
    };

    if(parseInt(dataset.talle_id)>0)  parametros["talle_id"] = dataset.talle_id;
    if(parseInt(dataset.idcolor)>0) parametros["color_id"] = dataset.idcolor;

    const url           = "/shop/requests/updateCart";
    const parameters    = "parameters=" + encodeURIComponent(JSON.stringify(parametros));
    const promise       = ajax(url,parameters);
    
    promise.then((data) => 
    {
        modalShow(data);
    });
}

//=======================================//
// FUNCION QUE ELIMINA ITEMS DEL CARRITO //
//=======================================//
function itemRemove(dataset)
{
    let parametros = {
        id:         dataset.id,
        atributos:  dataset.atributosId,
        cantidad:   "0"
    };

    if(parseInt(dataset.talle_id)>0)  parametros["talle_id"]     = dataset.talle_id;
    if(parseInt(dataset.idcolor)>0) parametros["color_id"]    = dataset.idcolor;

    const url           = "/shop/requests/updateCart";
    const parameters    = "parameters=" + encodeURIComponent(JSON.stringify(parametros));
    const promise       = ajax(url,parameters);
    
    promise.then((data) => 
    {
        window.location.replace("/shop/checkout")
    });
}