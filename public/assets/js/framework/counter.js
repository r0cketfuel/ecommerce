const animationDuration = 5000; // Duración de la animación en milisegundos

// Obtén todos los elementos con la clase "counter"
const counterElements = document.querySelectorAll(".counter");

// Itera sobre todos los elementos y aplica el contador a cada uno
counterElements.forEach((counterElement) => {
    const fromValue = parseInt(counterElement.getAttribute("data-from"));
    const toValue = parseInt(counterElement.getAttribute("data-to"));

    const difference = toValue - fromValue;
    const increment = difference / (animationDuration / 1000); // Calcula la velocidad de incremento

    let currentValue = fromValue;
    counterElement.textContent = currentValue;

    const updateCounter = () => {
        if (currentValue < toValue) {
            currentValue += increment;
            counterElement.textContent = Math.round(currentValue); // Asegura que se muestren números enteros
        }
    };

    const counterInterval = setInterval(updateCounter, 100); // Actualiza cada 100 milisegundos (ajusta según tu preferencia)
});