const ALERT_TIMEOUT = 5000;

function createAlertContainer(className, message) {
    const alertContainer = document.createElement("div");
    alertContainer.className = "alert " + className;

    const closeBtn = document.createElement("span");
    closeBtn.className = "closebtn";
    closeBtn.innerHTML = "&times;";

    closeBtn.onclick = function () {
        // Al hacer clic en el botón de cerrar, agregar animación de salida y ocultar después de la animación
        alertContainer.style.animation = 'fade-out 0.3s';
        setTimeout(function () {
            alertContainer.style.display = 'none';
        }, 300);
    };

    alertContainer.innerHTML = message;
    alertContainer.appendChild(closeBtn);

    return alertContainer;
}

function displayAlert(className, message) {
    const alertContainer = createAlertContainer(className, message);
    document.body.appendChild(alertContainer);
    alertContainer.style.display = 'flex';
    
    // Configurar el temporizador para ocultar la alerta después de ALERT_TIMEOUT milisegundos
    setTimeout(function () {
        alertContainer.style.animation = 'fade-out 0.3s';
        setTimeout(function () {
            alertContainer.style.display = 'none';
        }, 300);
    }, ALERT_TIMEOUT);
}