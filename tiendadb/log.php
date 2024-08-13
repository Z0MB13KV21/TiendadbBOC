<?php
require_once 'src/db/verificarRol.php';
?>

<!DOCTYPE html>
<html lang="es-ES">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
  <meta name="apple-mobile-web-app-status-bar-style" content="default">
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <link rel="stylesheet" href="public/css/TIndex.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

  <link rel="icon" href="https://i.pinimg.com/originals/68/ea/a5/68eaa5f9c3a7ed7e12d0b13b20a6f0fb.jpg">
  <title>Inicio de Sesión | BOC</title>

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Dancing+Script|Raleway:500,600&display=swap" rel="stylesheet">
  <style>
    .tab-container {
      display: flex;
      justify-content: center;
      margin-bottom: 20px;
    }

    .tab {
      padding: 10px 20px;
      cursor: pointer;
      border: 1px solid #ddd;
      border-radius: 5px;
      margin: 0 5px;
      background-color: #f8f9fa;
      text-align: center;
    }

    .active-tab {
      background-color: #ff0722;
      color: #fff;
    }

    .tab-content {
      display: none;
    }

    .show {
      display: block;
    }

    .error-message {
      color: #ff0722;
      margin-bottom: 15px;
    }


    label {
      position: static !important;
    }


    #loginContent .form-group label,
    #registerContent .form-group label {
      display: block !important;
      margin-bottom: 5px !important;
    }


  </style>
</head>

<body>
  <div class="background-container"></div>

  <header class="text-white py-3">
    <div class="container d-flex justify-content-between align-items-center">
      <h1 class="h3">BOC</h1>
      <nav class="navbar navbar-expand-lg navbar-light">
        <div class="collapse navbar-collapse">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item"><a class="nav-link" href="index.php">Inicio</a></li>
            <li class="nav-item"><a class="nav-link" href="ventas.php">Ventas y servicios</a></li>
            <li class="nav-item"><a class="nav-link" href="sobrenosotros.php">Sobre Nosotros</a></li>
          </ul>
        </div>
      </nav>
      <div class="text-center">
        <img class="logo" src="https://i.pinimg.com/originals/68/ea/a5/68eaa5f9c3a7ed7e12d0b13b20a6f0fb.jpg" alt="Logo boc" width="200" height="150">
        <label class="label" id="nombreUsuario"></label>
      </div>
    </div>
  </header>

  <main class="container mt-5">
    <div class="tab-container">
      <div class="tab active-tab" onclick="openTab('loginContent')">Iniciar Sesión</div>
      <div class="tab" onclick="openTab('registerContent')">Registrarse</div>
    </div>

    <div id="loginContent" class="tab-content show">
    <form method="POST" action="" novalidate>
        <h2>Iniciar Sesión</h2>
        <div class="form-group">
            <label for="usuario_correo">Correo Electrónico o Usuario:</label>
            <input type="text" id="usuario_correo" name="usuario_correo" class="form-control" placeholder="Ingrese su correo electrónico o usuario" required maxlength="60" autocomplete="username">
            <div class="invalid-feedback" id="usuario_correo-error">Por favor, ingrese un correo electrónico o usuario válido.</div>
        </div>
        <div class="form-group">
            <label for="contrasena">Contraseña:</label>
            <input type="password" id="contrasena" name="contrasena" class="form-control" placeholder="Ingrese su contraseña" required minlength="8" maxlength="30" autocomplete="current-password">
            <div class="invalid-feedback" id="contrasena-error">La contraseña es requerida y debe tener entre 8 y 30 caracteres, contener letras y números.</div>
        </div>
        <div class="form-group">
            <a href="javascript:void(0);" onclick="openTab('forgotPasswordContent')">¿Olvidó su contraseña?</a>
        </div>
        <input type="hidden" name="action" value="login">
        <button type="submit" class="btn btn-primary">Iniciar Sesión</button>
    </form>
</div>

<div id="registerContent" class="tab-content">
    <form method="POST" action="" novalidate>
        <h2>Registrarse</h2>
        <div class="form-group">
            <label for="usuario">Usuario:</label>
            <input type="text" id="usuario" name="usuario" class="form-control" placeholder="Ingrese el nombre de usuario" required minlength="3" maxlength="20" autocomplete="username">
            <div class="invalid-feedback" id="usuario-error">El nombre de usuario debe tener entre 3 y 20 caracteres.</div>
        </div>
        <div class="form-group">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" class="form-control" placeholder="Ingrese su nombre" required maxlength="30" autocomplete="given-name">
            <div class="invalid-feedback" id="nombre-error">Por favor, ingrese su nombre.</div>
        </div>
        <div class="form-group">
            <label for="apellido">Apellido:</label>
            <input type="text" id="apellido" name="apellido" class="form-control" placeholder="Ingrese su apellido" required maxlength="30" autocomplete="family-name">
            <div class="invalid-feedback" id="apellido-error">Por favor, ingrese su apellido.</div>
        </div>
        <div class="form-group">
            <label for="correoRegistro">Correo Electrónico:</label>
            <input type="email" id="correoRegistro" name="correoRegistro" class="form-control" placeholder="Ingrese su correo electrónico" required maxlength="60" autocomplete="email">
            <div class="invalid-feedback" id="correoRegistro-error">Ingrese una dirección de correo electrónico válida.</div>
        </div>
        <div class="form-group">
            <label for="contrasenaRegistro">Contraseña:</label>
            <input type="password" id="contrasenaRegistro" name="contrasenaRegistro" class="form-control" placeholder="Ingrese su contraseña" required minlength="8" maxlength="30" autocomplete="new-password">
            <div class="invalid-feedback" id="contrasenaRegistro-error">La contraseña es requerida y debe tener entre 8 y 30 caracteres, y contener letras y números.</div>
        </div>
        <div class="form-group">
            <label for="vcontrasenaRegistro">Verifica la Contraseña:</label>
            <input type="password" id="vcontrasenaRegistro" name="vcontrasenaRegistro" class="form-control" placeholder="Verifique su contraseña" required minlength="8" maxlength="30" autocomplete="new-password">
            <div class="invalid-feedback" id="vcontrasenaRegistro-error">Las contraseñas no coinciden.</div>
        </div>
        <input type="hidden" name="action" value="register">
        <button type="submit" class="btn btn-primary">Registrarse</button>
    </form>
</div>
<!-- Formulario de Recuperación de Contraseña -->
<div id="forgotPasswordContent" class="tab-content">
    <form id="forgotPasswordForm" method="POST" action="" novalidate>
        <h2>Recuperar Contraseña</h2>
        <div class="form-group">
            <label for="forgot_user_email">Usuario o Correo Electrónico:</label>
            <input type="text" id="forgot_user_email" name="forgot_user_email" class="form-control" placeholder="Ingrese su usuario o correo electrónico" required minlength="8" maxlength="30">
            <div class="invalid-feedback" id="forgot_user_email-error">Ingrese un usuario o correo electrónico válido.</div>
        </div>
        <input type="hidden" name="action" value="forgot_password">
        <button type="submit" class="btn btn-primary">Enviar</button>
        <button type="button" id="cancelForgotPassword" class="btn btn-secondary">Cancelar</button>
    </form>
</div>

<!-- Formulario de Actualización de Contraseña -->
<div id="resetPasswordContent" class="tab-content" style="display: none;">
    <form id="resetPasswordForm" method="POST" action="" novalidate>
        <h2>Actualizar Contraseña</h2>
        <div class="form-group">
            <label for="reset_user_email">Correo Electrónico:</label>
            <input type="email" id="reset_user_email" name="reset_user_email" class="form-control" placeholder="Ingrese su correo electrónico" required readonly autocomplete="email">
        </div>
        <div class="form-group">
            <label for="reset_contrasena">Nueva Contraseña:</label>
            <input type="password" id="reset_contrasena" name="reset_contrasena" class="form-control" placeholder="Ingrese su nueva contraseña" required minlength="8" maxlength="30" autocomplete="new-password">
            <div class="invalid-feedback" id="reset_contrasena-error">La contraseña es requerida y debe tener entre 8 y 30 caracteres.</div>
        </div>
        <div class="form-group">
            <label for="reset_vcontrasena">Verifica la Contraseña:</label>
            <input type="password" id="reset_vcontrasena" name="reset_vcontrasena" class="form-control" placeholder="Verifique su nueva contraseña" required minlength="8" maxlength="30" autocomplete="new-password">
            <div class="invalid-feedback" id="reset_vcontrasena-error">Las contraseñas no coinciden.</div>
        </div>
        <input type="hidden" name="action" value="reset_password">
        <button type="submit" class="btn btn-primary">Actualizar Contraseña</button>
        <button type="button" id="cancelResetPassword" class="btn btn-secondary">Cancelar</button>
    </form>
</div>


  </main>

  <script>

// Función global para abrir una pestaña específica
function openTab(tabId) {
    showTab(tabId); // Mostrar la pestaña deseada
}

// Función para mostrar una pestaña específica
function showTab(tabId) {
    const tabs = document.querySelectorAll('.tab-content');
    tabs.forEach(tab => {
        if (tab.id === tabId) {
            tab.classList.add('show');
            tab.style.display = 'block'; // Asegura que la pestaña se muestre
            if (tabId === 'forgotPasswordContent') {
                clearFormFields('forgotPasswordForm');
            } else if (tabId === 'resetPasswordContent') {
                clearFormFields('resetPasswordForm');
            }
        } else {
            tab.classList.remove('show');
            tab.style.display = 'none'; // Asegura que las otras pestañas se oculten
        }
    });
}

// Función para limpiar los campos de un formulario
function clearFormFields(formId) {
    const form = document.getElementById(formId);
    if (form) {
        const inputs = form.querySelectorAll('input');
        inputs.forEach(input => input.value = '');
    }
}

// Función para limpiar el formulario y cambiar a la pestaña de inicio de sesión
function clearFormAndShowLogin(formId) {
    clearFormFields(formId);
    showTab('loginContent'); // Volver a la pestaña de inicio de sesión
}

// Asegúrate de que el enlace abra la pestaña correcta
document.addEventListener('DOMContentLoaded', function() {
    const cancelForgotPasswordBtn = document.getElementById('cancelForgotPassword');
    const cancelResetPasswordBtn = document.getElementById('cancelResetPassword');

    // Manejador de evento para el botón de cancelar en el formulario de recuperación de contraseña
    cancelForgotPasswordBtn.addEventListener('click', function() {
        clearFormAndShowLogin('forgotPasswordForm');
    });

    // Manejador de evento para el botón de cancelar en el formulario de actualización de contraseña
    cancelResetPasswordBtn.addEventListener('click', function() {
        clearFormAndShowLogin('resetPasswordForm');
    });

    // Asegúrate de que el enlace abra la pestaña correcta
    const forgotPasswordLink = document.querySelector('a[href="javascript:void(0);"][onclick*="openTab(\'forgotPasswordContent\')"]');
    if (forgotPasswordLink) {
        forgotPasswordLink.addEventListener('click', function() {
            openTab('forgotPasswordContent');
        });
    }
});

  </script>
  <footer class="text-white py-3 mt-4">
    <div class="container text-center">
      <p>&copy; 2024 BOC. Todos los derechos reservados.</p>
    </div>
  </footer>
  <script src="public/js/InicioSesion-Registro.js"></script>
  <script src="public/js/Recuperacion.js"></script>
  <script src="public/js/sublog.js"></script>
</body>

</html>