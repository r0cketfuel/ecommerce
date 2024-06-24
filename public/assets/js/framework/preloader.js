window.addEventListener("DOMContentLoaded", () => {

    const body = document.querySelector("body");
    const preloader = document.querySelector(".preloader");
    const ldsEllipsis = document.querySelectorAll(".lds-ellipsis");

    setTimeout(() => {
        preloader.style.opacity     = '0';
        preloader.style.transition  = 'opacity 0.5s';
        setTimeout(() => {
            preloader.style.display = 'none';
        }, 600);
    }, 1000); // will fade out the white DIV that covers the website.

    setTimeout(() => {
        body.style.opacity = '1';
        body.style.transition = 'opacity 1.5s';
    }, 1000);

})