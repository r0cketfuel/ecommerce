window.addEventListener("load", function () 
{
    // Esconde el loader al finalizar la carga de la página
    loading(false);
    
});

// Función que muestra / oculta el loader
function loading(status)
{
    const loader    = document.getElementById("loader");
    if(status)
    {
        loader.classList.add("loader-active");
    }
    else
    {
        // Permanencia mínima del loader de 500ms
        setTimeout(function() {
            loader.classList.remove("loader-active");
        }, 500);
    }
}