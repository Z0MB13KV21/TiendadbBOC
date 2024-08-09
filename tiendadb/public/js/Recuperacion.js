document.addEventListener('DOMContentLoaded', function() {
    const forgotPasswordForm = document.getElementById('forgotPasswordForm');
    const resetPasswordForm = document.getElementById('resetPasswordForm');

    // Validación en tiempo real del formulario de recuperación de contraseña
    document.getElementById('forgot_user_email').addEventListener('input', function() {
        const emailInput = this;
        const emailError = document.getElementById('forgot_user_email-error');
        const emailValue = emailInput.value.trim();

        // Limpia el estado de validación
        emailInput.classList.remove('is-invalid', 'is-valid');
        emailError.style.display = 'none';

        // Validar que el campo no esté vacío
        if (emailValue === '') {
            emailInput.classList.add('is-invalid');
            emailError.textContent = "Ingrese un usuario o correo electrónico válido.";
            emailError.style.display = 'block';
        } 
        // Validar formato de correo electrónico
        else if (emailValue.includes('@') && !validateEmail(emailValue)) {
            emailInput.classList.add('is-invalid');
            emailError.textContent = "Ingrese una dirección de correo electrónico válida.";
            emailError.style.display = 'block';
        } else {
            emailInput.classList.add('is-valid');
        }
    });

    // Validación y envío del formulario de recuperación de contraseña
    forgotPasswordForm.addEventListener('submit', function(event) {
        event.preventDefault(); // Evita el envío del formulario de manera convencional
        
        const emailInput = document.getElementById('forgot_user_email');
        const emailValue = emailInput.value.trim();
        const emailError = document.getElementById('forgot_user_email-error');
        
        // Validar que el campo no esté vacío
        if (emailValue === '') {
            emailInput.classList.add('is-invalid');
            emailError.textContent = "Ingrese un usuario o correo electrónico válido.";
            emailError.style.display = 'block';
            return;
        }
        
        // Validar formato de correo electrónico
        if (emailValue.includes('@') && !validateEmail(emailValue)) {
            emailInput.classList.add('is-invalid');
            emailError.textContent = "Ingrese una dirección de correo electrónico válida.";
            emailError.style.display = 'block';
            return;
        }

        // Realizar la solicitud AJAX
        const formData = new FormData(forgotPasswordForm);
        fetch('src/php/Recuperacion/OlvidoContrasena.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(result => {
            const [message, , email] = result.split('|');
            if (message.includes('Usuario encontrado')) {
                //  se cambia a la pestaña de restablecimiento
                document.getElementById('forgotPasswordContent').style.display = 'none';
                document.getElementById('resetPasswordContent').style.display = 'block';
                // Completar el campo de correo en el formulario de restablecimiento
                document.getElementById('reset_user_email').value = email;
            } else {
                emailInput.classList.add('is-invalid');
                emailError.textContent = "No se encontró el usuario o correo electrónico.";
                emailError.style.display = 'block';
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    });

    // Validación en tiempo real del formulario de actualización de contraseña
    document.getElementById('reset_contrasena').addEventListener('input', function() {
        const newPasswordInput = this;
        const newPassword = newPasswordInput.value;
        const newPasswordError = document.getElementById('reset_contrasena-error');

        // Limpia el mensaje de error si la contraseña es válida
        newPasswordInput.classList.remove('is-invalid', 'is-valid');
        newPasswordError.style.display = 'none';

        // Validar la contraseña
        if (newPassword === '') {
            newPasswordInput.classList.add('is-invalid');
            newPasswordError.textContent = "La contraseña es requerida.";
            newPasswordError.style.display = 'block';
        } else if (newPassword.length < 8 || newPassword.length > 30) {
            newPasswordInput.classList.add('is-invalid');
            newPasswordError.textContent = "La contraseña debe tener entre 8 y 30 caracteres.";
            newPasswordError.style.display = 'block';
        } else if (!/[A-Z]/.test(newPassword)) {
            newPasswordInput.classList.add('is-invalid');
            newPasswordError.textContent = "La contraseña debe contener al menos una letra mayúscula.";
            newPasswordError.style.display = 'block';
        } else if (!/[a-z]/.test(newPassword)) {
            newPasswordInput.classList.add('is-invalid');
            newPasswordError.textContent = "La contraseña debe contener al menos una letra minúscula.";
            newPasswordError.style.display = 'block';
        } else if (!/[0-9]/.test(newPassword)) {
            newPasswordInput.classList.add('is-invalid');
            newPasswordError.textContent = "La contraseña debe contener al menos un número.";
            newPasswordError.style.display = 'block';
        } else if (!/[!@#$%^&*]/.test(newPassword)) {
            newPasswordInput.classList.add('is-invalid');
            newPasswordError.textContent = "La contraseña debe contener al menos un carácter especial (!@#$%^&*).";
            newPasswordError.style.display = 'block';
        } else {
            newPasswordInput.classList.add('is-valid');
        }
    });

    document.getElementById('reset_vcontrasena').addEventListener('input', function() {
        const confirmPasswordInput = this;
        const confirmPassword = confirmPasswordInput.value;
        const newPassword = document.getElementById('reset_contrasena').value;
        const confirmPasswordError = document.getElementById('reset_vcontrasena-error');

        // Limpia el mensaje de error si las contraseñas coinciden
        confirmPasswordInput.classList.remove('is-invalid', 'is-valid');
        confirmPasswordError.style.display = 'none';

        if (confirmPassword === newPassword) {
            confirmPasswordInput.classList.add('is-valid');
            confirmPasswordError.style.display = 'none';
        } else {
            confirmPasswordInput.classList.add('is-invalid');
            confirmPasswordError.textContent = "Las contraseñas no coinciden.";
            confirmPasswordError.style.display = 'block';
        }
    });

    // Validación y envío del formulario de actualización de contraseña
    resetPasswordForm.addEventListener('submit', function(event) {
        event.preventDefault(); // Evita el envío del formulario de manera convencional
        
        const newPasswordInput = document.getElementById('reset_contrasena');
        const confirmPasswordInput = document.getElementById('reset_vcontrasena');
        const newPassword = newPasswordInput.value;
        const confirmPassword = confirmPasswordInput.value;
        const newPasswordError = document.getElementById('reset_contrasena-error');
        const confirmPasswordError = document.getElementById('reset_vcontrasena-error');

        let valid = true;

        // Limpia el estado de validación anterior
        newPasswordInput.classList.remove('is-invalid', 'is-valid');
        confirmPasswordInput.classList.remove('is-invalid', 'is-valid');
        newPasswordError.style.display = 'none';
        confirmPasswordError.style.display = 'none';

        // Validar contraseñas
        if (newPassword === '') {
            newPasswordInput.classList.add('is-invalid');
            newPasswordError.textContent = "La contraseña es requerida.";
            newPasswordError.style.display = 'block';
            valid = false;
        } else if (newPassword.length < 8 || newPassword.length > 30) {
            newPasswordInput.classList.add('is-invalid');
            newPasswordError.textContent = "La contraseña debe tener entre 8 y 30 caracteres.";
            newPasswordError.style.display = 'block';
            valid = false;
        } else if (!/[A-Z]/.test(newPassword)) {
            newPasswordInput.classList.add('is-invalid');
            newPasswordError.textContent = "La contraseña debe contener al menos una letra mayúscula.";
            newPasswordError.style.display = 'block';
            valid = false;
        } else if (!/[a-z]/.test(newPassword)) {
            newPasswordInput.classList.add('is-invalid');
            newPasswordError.textContent = "La contraseña debe contener al menos una letra minúscula.";
            newPasswordError.style.display = 'block';
            valid = false;
        } else if (!/[0-9]/.test(newPassword)) {
            newPasswordInput.classList.add('is-invalid');
            newPasswordError.textContent = "La contraseña debe contener al menos un número.";
            newPasswordError.style.display = 'block';
            valid = false;
        } else if (!/[!@#$%^&*]/.test(newPassword)) {
            newPasswordInput.classList.add('is-invalid');
            newPasswordError.textContent = "La contraseña debe contener al menos un carácter especial (!@#$%^&*).";
            newPasswordError.style.display = 'block';
            valid = false;
        } else {
            newPasswordInput.classList.add('is-valid');
        }

        if (newPassword !== confirmPassword) {
            confirmPasswordInput.classList.add('is-invalid');
            confirmPasswordError.textContent = "Las contraseñas no coinciden.";
            confirmPasswordError.style.display = 'block';
            valid = false;
        } else {
            confirmPasswordInput.classList.add('is-valid');
        }

        if (!valid) return;

        // Realizar la solicitud AJAX
        const formData = new FormData(resetPasswordForm);
        fetch('src/php/Recuperacion/RestablecerContrasena.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(result => {
            const [message] = result.split('|');
            if (message.includes('Contraseña actualizada')) {
                alert('Contraseña actualizada exitosamente.');
                // Opcional: redirigir al usuario o limpiar el formulario
                resetPasswordForm.reset();
                document.getElementById('resetPasswordContent').style.display = 'none';
                document.getElementById('loginContent').style.display = 'block';
            } else {
                newPasswordInput.classList.add('is-invalid');
                newPasswordError.textContent = "Error al actualizar la contraseña. Inténtelo de nuevo.";
                newPasswordError.style.display = 'block';
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    });

    // Función de validación de correo electrónico
    function validateEmail(email) {
        const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return regex.test(email);
    }
});
