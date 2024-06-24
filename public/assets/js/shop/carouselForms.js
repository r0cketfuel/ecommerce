document.addEventListener("DOMContentLoaded", () => {

    const slides 		    = document.querySelectorAll(".carousel-slide");
    const nextButtons 	    = document.querySelectorAll(".btnNext");
    const prevButtons 	    = document.querySelectorAll(".btnPrev");
    const forms             = document.getElementsByClassName('step-form');
    
    let curSlide            = 0;
    let datosRecopilados    = {};

    updateProgressIndicator();

    for (let i = 0; i < forms.length; i++) {
        forms[i].addEventListener('submit', function (event) {
            event.preventDefault();

            // Recopilar datos del formulario actual
            var formData = new FormData(event.target);
            for (var [key, value] of formData.entries()) {
                datosRecopilados[key] = value;
            }
        });
    }

    // Event listener para los botones 'Anterior' & 'Siguiente'
    prevButtons.forEach(button => { button.addEventListener("click", () => { moveLeft() }) });
    nextButtons.forEach(button => { button.addEventListener("click", () => { submitForm(button) })});

    // Función desplazamiento de las pantallas a la izquierda
    function moveLeft()
    {
        if (curSlide > 0)
        {
            --curSlide;
            
            slides.forEach((slide, indx) => { slide.style.transform = `translateX(${-100 * curSlide}%) translateX(${-100 * curSlide}px)` });
            
            updateProgressIndicator();
            smoothScroll("top");
        }
    }

    // Función desplazamiento de las pantallas a la derecha
    function moveRight(step)
    {
        if (curSlide < (forms.length))
        {
            if(step)
                curSlide = step - 1;
            else
                ++curSlide;

            slides.forEach((slide, indx) => { slide.style.transform = `translateX(${-100 * curSlide}%) translateX(${-100 * curSlide}px)` });
            
            updateProgressIndicator();
            smoothScroll("top");
        }
    }

    function limpiarErrores()
    {
        document.querySelectorAll('.field-validation-msg').forEach(el => el.remove());
        document.querySelectorAll('.form-error').forEach(el => el.classList.remove("form-error"));
    }

    function submitForm(button)
    {
        const form = button.closest(".step-form");
    
        if(form)
        {
            limpiarErrores();
            loading(true);
    
            // Recopilar datos de todos los pasos anteriores
            const allFormData = new FormData();
            for (let i = 0; i <= curSlide; i++) {
                const stepForm = forms[i];
                const formData = new FormData(stepForm);
                if (i !== curSlide) {
                    // Excluir campos ocultos de pasos anteriores
                    for (const [key, value] of formData.entries()) {
                        if (stepForm.querySelector(`[name="${key}"][type="hidden"]`) === null) {
                            allFormData.append(key, value);
                        }
                    }
                } else {
                    // Añadir todos los campos del último paso
                    for (const [key, value] of formData.entries()) {
                        allFormData.append(key, value);
                    }
                }
            }
    
            fetch(form.action, {
                method: form.method,
                body:   allFormData,
            })
            .then(response => response.json())
            .then(data => {
    
                loading(false);
    
                if(data["success"] === true)
                {
                    if(data['redirect_url'])
                    {
                        window.location.href = data['redirect_url'];
                    }
                    else
                    {
                        if(data["next-step"])
                            moveRight(data["next-step"]);
                        else
                            moveRight();
                    }
                }
                else
                {
                    function mostrarErrores(errors)
                    {
                        limpiarErrores();
    
                        for (var campo in errors) {
                            if (errors.hasOwnProperty(campo)) {
                                var mensajes = errors[campo];
                                var input = document.querySelector('.step-form [name="' + campo + '"]');
                                if (input) {
                                    input.classList.add("form-error");
                                    mensajes.forEach(function (mensaje) {
                                        var p = document.createElement("p");
                                        p.className = "field-validation-msg";
                                        p.innerHTML = mensaje;
                                        input.parentNode.insertBefore(p, input.nextSibling);
                                    });
                                }
                            }
                        }
                    }
                    mostrarErrores(data.errors);
                }
            })
            .catch(error => {
                console.error("Error al enviar el formulario:", error);
            });
        }
    }

    // Obtén todos los elementos interactivos dentro del formulario actual
    const formElements = document.querySelectorAll('.step-form input, .step-form select, .step-form button, .step-form textarea');

    formElements.forEach(function (element, index) {
        // Agrega un evento de escucha al elemento
        element.addEventListener('keydown', function (event) {
            if(event.key === 'Tab') {
                event.preventDefault();

                // Calcula el índice del próximo elemento en el formulario
                const nextIndex = (index + 1) % formElements.length;

                // Establece el foco en el próximo elemento
                formElements[nextIndex].focus();
            }
        });
    });

    function updateProgressIndicator()
    {
        const progressIndicatorItems    = document.querySelectorAll('.progress-indicator li');
        const progressIndicatorDivision = document.querySelectorAll('.progress-indicator div');
    
        progressIndicatorItems.forEach((item, index) => {
            if (index < curSlide)
            {
                item.classList.remove('current-step');
                item.classList.add('success');
            }
            else if (index === curSlide)
            {
                item.classList.remove('success');
                item.classList.add('current-step');
            }
            else
            {
                item.classList.remove('success', 'current-step');
            }
        });

        progressIndicatorDivision.forEach((item, index) => {
            if (index < curSlide)
            {
                item.classList.remove('current-step');
                item.classList.add('success');
            }
            else if (index === curSlide)
            {
                item.classList.remove('success');
                item.classList.add('current-step');
            }
            else
            {
                item.classList.remove('success', 'current-step');
            }
        });
    }
});
