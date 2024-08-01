document.addEventListener('DOMContentLoaded', function() {
    const loginForm = document.querySelector('#loginContent form');
    const registerForm = document.querySelector('#registerContent form');

    // Función para mostrar mensajes de error en el campo correspondiente
    function showError(input, message) {
        const errorElement = document.querySelector(`#${input.id}-error`);
        if (errorElement) {
            errorElement.textContent = message;
            input.classList.add('is-invalid');
        }
    }

    // Función para limpiar mensajes de error
    function clearErrors(form) {
        const errorElements = form.querySelectorAll('.invalid-feedback');
        const inputs = form.querySelectorAll('.form-control');
        errorElements.forEach(element => {
            element.textContent = '';
        });
        inputs.forEach(input => {
            input.classList.remove('is-invalid');
            input.classList.remove('is-valid');
        });
    }

// Función para validar un campo de formulario
function validateField(input) {
    const value = input.value.trim();
    let valid = true;
    let message = '';

    if (input.required && !value) {
        valid = false;
        message = 'Este campo es requerido.';
    } else if (input.type === 'email' && !validateEmail(value)) {
        valid = false;
        message = 'Ingrese una dirección de correo electrónico válida.';
    } else if (input.id === 'usuario' && !/^[a-zA-Z0-9]+$/.test(value)) {
        valid = false;
        message = 'El nombre de usuario debe contener solo letras y números.';
    } else if (input.id === 'contrasena' && !/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[A-Za-z\d!@#$%^&*()_+=[\]{};':"\\|,.<>/?]{8,}$/.test(value)) {
        valid = false;
        message = 'La contraseña debe tener al menos 8 caracteres, contener letras y números, y puede incluir caracteres especiales.';
    } else if (input.id === 'correoRegistro' && !validateEmail(value)) {
        valid = false;
        message = 'Ingrese una dirección de correo electrónico válida.';
    } else if (input.id === 'vcontrasenaRegistro' && value !== document.querySelector('#contrasenaRegistro').value) {
        valid = false;
        message = 'Las contraseñas no coinciden.';
    }

    if (valid) {
        input.classList.add('is-valid');
        input.classList.remove('is-invalid');
    } else {
        showError(input, message);
    }
}


    // Función para validar correos electrónicos
    function validateEmail(email) {
        const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return regex.test(email);
    }

    // Validación en tiempo real para los campos del formulario de inicio de sesión
    loginForm.addEventListener('input', function(event) {
        const input = event.target;
        if (input.matches('.form-control')) {
            validateField(input);
        }
    });

    // Validación en tiempo real para los campos del formulario de registro
    registerForm.addEventListener('input', function(event) {
        const input = event.target;
        if (input.matches('.form-control')) {
            validateField(input);
        }
    });

// Manejo del formulario de inicio de sesión
loginForm.addEventListener('submit', function(event) {
    event.preventDefault();
    clearErrors(loginForm); // Limpiar errores anteriores
    const formData = new FormData(loginForm);
    
    fetch('src/php/InicioSesion-Registro/login_register.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Guardar el nombre de usuario en localStorage
            localStorage.setItem('nombreUsuario', data.userName);
            // Redireccionar a perfil.php
            window.location.href = 'perfil.php';
        } else {
            // Mostrar mensaje de error general
            showError(document.querySelector('#usuario_correo'), data.message);
        }
    })
    .catch(error => console.error('Error en la solicitud:', error));
});


    // Manejo del formulario de registro
    registerForm.addEventListener('submit', function(event) {
        event.preventDefault();
        clearErrors(registerForm); // Limpiar errores anteriores
        const formData = new FormData(registerForm);
        fetch('src/php/InicioSesion-Registro/login_register.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Mostrar mensaje de éxito y limpiar datos
                alert('Usuario creado correctamente.');

                // Limpiar formulario
                registerForm.reset();

                // Cambiar a la pestaña de inicio de sesión después de 2 segundos
                setTimeout(() => {
                    openTab('loginContent');
                }, 2000);
            } else {
                // Mostrar mensajes de error específicos
                Object.keys(data.errors || {}).forEach(key => {
                    const input = document.querySelector(`#${key}`);
                    if (input) {
                        showError(input, data.errors[key]);
                    }
                });
            }
        })
        .catch(error => console.error('Error en la solicitud:', error));
    });

    function openTab(tabId) {
        const tabs = document.querySelectorAll('.tab-content');
        tabs.forEach(tab => {
            if (tab.id === tabId) {
                tab.classList.add('show');
            } else {
                tab.classList.remove('show');
            }
        });

        const tabButtons = document.querySelectorAll('.tab');
        tabButtons.forEach(button => {
            if (button.getAttribute('onclick').includes(tabId)) {
                button.classList.add('active-tab');
            } else {
                button.classList.remove('active-tab');
            }
        });
    }
});
