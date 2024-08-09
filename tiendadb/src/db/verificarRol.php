<?php

require_once 'auth.php'; 

function redirectBasedOnRole() {
    global $role;

    $currentPage = basename($_SERVER['SCRIPT_FILENAME']);
    
    // Si el usuario está autenticado pero intenta acceder a log.php
    if (isset($_SESSION['user_id']) && $currentPage === 'log.php') {
        header("Location: perfil.php");
        exit();
    }
        // Si el usuario está autenticado pero intenta acceder a log.php
        if (isset($_SESSION['user_id']) && $currentPage === 'Pagos.php') {
            header("Location: perfil.php");
            exit();
        }

    // Páginas y los roles que se requieren para acceder a ellas
    $roleRequiredPages = [
        'perfil.php' => ['Administrador', 'Cajero', 'Usuario'],
        'public/frontend/index.php' => ['Administrador', 'Cajero'],
        'public/frontend/productos.php' => ['Administrador', 'Cajero', 'Usuario'],
        'public/frontend/usuarios.php' => ['Administrador']
    ];
    
    // Verifica si la página actual requiere un rol específico
    if (isset($roleRequiredPages[$currentPage])) {
        // Si el rol es 'Invitado' o no se tiene acceso a la página, redirige a la página principal
        if ($role === 'Invitado' || !checkAccess($currentPage)) {
            header("Location: /tiendadb/index.php");
            exit();
        }
    }
}

function checkAccess($page) {
    global $role;

    // Control de acceso para diferentes páginas
    $accessControl = [
        'index.php' => ['Administrador', 'Cajero', 'Usuario', 'Invitado'],
        'log.php' => ['Administrador', 'Cajero', 'Usuario', 'Invitado'],
        'perfil.php' => ['Administrador', 'Cajero', 'Usuario'],
        'sobrenosotros.php' => ['Administrador', 'Cajero', 'Usuario', 'Invitado'],
        'ventas.php' => ['Administrador', 'Cajero', 'Usuario', 'Invitado'],
        'public/frontend/index.php' => ['Administrador', 'Cajero'],
        'public/frontend/productos.php' => ['Administrador', 'Cajero'],
        'public/frontend/GP.php' => ['Administrador', 'Cajero'],
        'public/frontend/usuarios.php' => ['Administrador'],
        'public/error/response.html' => ['Administrador', 'Cajero', 'Usuario', 'Invitado']
    ];

    // Esto verifica si la página está en el control de acceso y si el rol del usuario está permitido
    if (isset($accessControl[$page])) {
        return in_array($role, $accessControl[$page]);
    }
    return false;
}

// Función para cerrar sesión
if (isset($_GET['action']) && $_GET['action'] === 'logout') {
    session_unset(); // Elimina todas las variables de sesión
    session_destroy(); // Destruye la sesión
    setcookie(session_name(), '', time() - 3600, '/'); // Elimina la cookie de sesión

    // Para depuración: Verifica si la sesión fue eliminada
    if (session_status() == PHP_SESSION_NONE) {
        echo 'Sesión destruida.';
    } else {
        echo 'Error al destruir la sesión.';
    }

    header("Location: /tiendadb/index.php");
    exit();
}

redirectBasedOnRole(); // Llama a la función para redirigir basado en el rol del usuario
?>
