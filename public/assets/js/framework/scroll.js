document.addEventListener("DOMContentLoaded", function () {

    const backToTopButton = document.getElementById("backToTop");

    if (backToTopButton)
        backToTopButton.addEventListener("click", function () { smoothScroll("top"); return false });

    const links = document.querySelectorAll(".link");

    for (let i = 0; i < links.length; i++) {
        links[i].addEventListener("click", function () {
            smoothScroll("section" + (i + 1));
            return false;
        });
    }

    //=======================//
    // Visibilidad del botón //
    //=======================//
    window.onscroll = function () {
        if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
            backToTopButton.style.display = "block";
            backToTopButton.classList.add("show");
        }
        else {
            backToTopButton.classList.remove("show");
        }
    };

});

//=======================================//
// Función que hace scroll a un elemento //
//=======================================//
function smoothScroll(id) {
    let element = document.getElementById(id);
    if (element)
        element.scrollIntoView({ block: "start", behavior: "smooth" });
}