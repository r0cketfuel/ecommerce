document.addEventListener("DOMContentLoaded", () => {

    const loginLink         = document.getElementById("login-link");
    const modalLogin        = document.getElementById("modal-login");
    const modalContainer    = document.getElementById("modal-container");
    const loginForm         = document.getElementById("form-login");

    loginLink.addEventListener("click", function(event) {
        event.preventDefault();
        modalLogin.style.display = "block";
    });

    loginForm.addEventListener("submit", function(event) {
        event.preventDefault();
        
        document.getElementsByName("username")[0].classList.remove("form-error");
        document.getElementsByName("password")[0].classList.remove("form-error");

        loading(true);

        const formData = new FormData(loginForm);

        fetch("/shop/modal-login", {
            method: 'POST',
            body: formData,
            headers: {

            },
        })
        .then(response => {
            
            if (response.ok)
            {
                window.location.reload();
            }
            else
            {
                loading(false);
                
                document.getElementsByName("username")[0].classList.add("form-error");
                document.getElementsByName("password")[0].classList.add("form-error");
            }
        })
        .catch(error => {
            console.error('Error al iniciar sesión:', error);
        });
    });
});