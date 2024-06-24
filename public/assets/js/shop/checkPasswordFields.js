document.addEventListener('DOMContentLoaded', function () {
    var passwordInput = document.getElementById('password');
    var passwordRepeatInput = document.getElementById('password_repeat');
    var typingTimer;
    var doneTypingInterval = 1000;

    function doneTyping() {
        var password = passwordInput.value;
        var passwordRepeat = passwordRepeatInput.value;

        // Verificar si ambos campos están completos antes de realizar la verificación
        if (password && passwordRepeat) {
            var passwordsMatch = password === passwordRepeat;

            var passwordValidationMsg = document.createElement('p');
            passwordValidationMsg.className = 'field-validation-msg';
            passwordInput.parentNode.appendChild(passwordValidationMsg);

            var passwordRepeatValidationMsg = document.createElement('p');
            passwordRepeatValidationMsg.className = 'field-validation-msg';
            passwordRepeatInput.parentNode.appendChild(passwordRepeatValidationMsg);

            passwordValidationMsg.textContent = passwordsMatch ? '' : 'Las contraseñas no coinciden.';
            passwordRepeatValidationMsg.textContent = passwordsMatch ? '' : 'Las contraseñas no coinciden.';

            passwordInput.classList.toggle('form-error', !passwordsMatch);
            passwordRepeatInput.classList.toggle('form-error', !passwordsMatch);
        }
    }

    passwordInput.addEventListener('input', function () {
        clearTimeout(typingTimer);
        typingTimer = setTimeout(doneTyping, doneTypingInterval);
    });

    passwordRepeatInput.addEventListener('input', function () {
        clearTimeout(typingTimer);
        typingTimer = setTimeout(doneTyping, doneTypingInterval);
    });
});     