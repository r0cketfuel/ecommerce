document.addEventListener('DOMContentLoaded', () => {
    
    const doneTypingInterval    = 1000;
    const usernameInput         = document.getElementById('username');
    let typingTimer;

    // Función a ejecutar después de que el usuario deja de escribir
    async function doneTyping()
    {
        let username = usernameInput.value;

        try {
            let response = await fetch('/api/usuarios/check-username-availability', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: 'username=' + encodeURIComponent(username)
            });

            if (response.ok) {
                let responseData = await response.json();

                // Obtener o crear el elemento <p> para mensajes de validación
                let validationMsgElement = document.querySelector('.field-validation-msg');

                if (!validationMsgElement) {
                    // Si el elemento no existe, crearlo y agregarlo al DOM
                    validationMsgElement = document.createElement('p');
                    validationMsgElement.className = 'field-validation-msg';
                    usernameInput.parentNode.appendChild(validationMsgElement);
                }

                // Actualizar el contenido del elemento con el mensaje de error
                if(responseData.is_available)
                {
                    validationMsgElement.textContent = "";
                    usernameInput.classList.remove('form-error');
                }
                else
                {
                    validationMsgElement.textContent = responseData.is_available ? '' : 'El nombre de usuario no está disponible.';
                    usernameInput.classList.add('form-error');
                }
            } else {
                console.error('Error en la solicitud:', response.statusText);
            }
        } catch (error) {
            console.error('Error en la solicitud:', error);
        }
    }

    // Detectar cambios en el campo de texto
    usernameInput.addEventListener('input', function () {
        clearTimeout(typingTimer);
        typingTimer = setTimeout(doneTyping, doneTypingInterval);
    });
});