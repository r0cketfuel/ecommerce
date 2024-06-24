document.addEventListener("DOMContentLoaded", () => {
    let accHeaders = document.getElementsByClassName("accordion-header");

    for (let i = 0; i < accHeaders.length; i++) {
        let arrow = accHeaders[i].querySelector(".arrow");
        
        // Añadir evento de clic a la flecha
        arrow.addEventListener("click", function () {
            // Acceder al elemento padre (accordion-header) y agregar/quitar la clase "active"
            this.closest(".accordion").classList.toggle("active");
        });
    }
});