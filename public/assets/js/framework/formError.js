window.addEventListener("load", function () {

    const errorField = document.querySelector(".form-error");
    
    if(errorField) {
        const elementLabel = errorField.closest("label");
        setTimeout(function() { 
            smootScroll(elementLabel);
        },1000);
        errorField.focus();
    }

});

function smootScroll(element) {
    element.scrollIntoView({block: "start", behavior: "smooth"});
}