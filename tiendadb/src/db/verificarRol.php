<?php

require_once 'auth.php'; 

function redirectBasedOnRole() {
    global $role;
    if (!isset($role)) {
        $role = 'Invitado'; // Asigna el rol 'Invitado' si no está definido
    }

    $currentPage = basename($_SERVER['SCRIPT_FILENAME']);
    
    if (isset($_SESSION['user_id']) && ($currentPage === 'log.php' || $currentPage === 'Pagos.php')) {
        header("Location: perfil.php");
        exit();
    }

    $roleRequiredPages = [
        'perfil.php' => ['Administrador', 'Cajero', 'Usuario'],
        'public/frontend/index.php' => ['Administrador', 'Cajero'],
        'public/frontend/productos.php' => ['Administrador', 'Cajero', 'Usuario'],
        'public/frontend/usuarios.php' => ['Administrador']
    ];
    
    if (isset($roleRequiredPages[$currentPage])) {
        if ($role === 'Invitado' || !checkAccess($currentPage)) {
            header("Location: /tiendadb/index.php");
            exit();
        }
    }
}

function checkAccess($page) {
    global $role;

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

    if (isset($accessControl[$page])) {
        return in_array($role, $accessControl[$page]);
    }
    return false;
}

// Llamada a la función de redirección basada en el rol
redirectBasedOnRole(); 

?>
