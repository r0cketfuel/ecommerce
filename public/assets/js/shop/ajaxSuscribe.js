document.addEventListener("DOMContentLoaded", () => {

    const form = document.getElementById("form-suscribe");
    if (form)
        form.addEventListener("submit", logSubmit);
});

//===========================================//
// Ajax que suscribe un correo al newsletter //
//===========================================//
function logSubmit(e) {
    e.preventDefault();

    const input = document.getElementById("suscribe");
    const url = "/shop/requests/suscribe";
    const parameters = "email=" + input.value;
    const promise = ajax(url, parameters);

    promise.then((data) => {
        const bar = document.getElementById("newsletter-suscription-bar");
        const msg = document.getElementById("newsletter-suscription-msg");
        const msgP = msg.children[0];

        bar.style.display = "none";
        msg.style.display = "block";
        msgP.innerHTML = data["data"]["message"];
    });
}