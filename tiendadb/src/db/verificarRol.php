<?php
require_once 'auth.php';

// Función para verificar el acceso basado en el rol
function checkAccess() {
    // Obtiene el camino de la URI
    $requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

    // Define el prefijo para las rutas específicas de administración
    $frontendPrefix = '/tiendadb/public/frontend/';
    
    // Define rutas y roles permitidos
    $routes = [
        'index.php' => ['Administrador', 'Cajero', 'Usuario', 'Invitado'],
        'log.php' => ['Administrador', 'Cajero', 'Usuario', 'Invitado'],
        'perfil.php' => ['Administrador', 'Cajero', 'Usuario'],
        'sobrenosotros.php' => ['Administrador', 'Cajero', 'Usuario', 'Invitado'],
        'ventas.php' => ['Administrador', 'Cajero', 'Usuario', 'Invitado'],
        'VerCarta.php' => ['Administrador', 'Cajero', 'Usuario', 'Invitado'],
        'Pagos.php' => ['Administrador', 'Cajero', 'Usuario'],
        'PasarelaPago.php' => ['Administrador', 'Cajero', 'Usuario'],
        'public/error/response.html' => ['Administrador', 'Cajero', 'Usuario', 'Invitado'],
    ];

    $routesAdmin = [
        'index.php' => ['Administrador', 'Cajero'],
        'productos.php' => ['Administrador', 'Cajero'],
        'GP.php' => ['Administrador', 'Cajero'],
        'usuarios.php' => ['Administrador'],
    ];

    // Verifica si la URI comienza con el prefijo específico
    if (strpos($requestUri, $frontendPrefix) === 0) {
        // Elimina el prefijo para obtener la ruta relativa
        $currentPath = substr($requestUri, strlen($frontendPrefix));
        $routesToCheck = $routesAdmin;
    } else {
        // Obtiene el nombre del archivo
        $currentPath = basename($requestUri);
        $routesToCheck = $routes;
    }

    // Obtiene el rol del usuario
    $userRole = $GLOBALS['sessionData']['userRole'] ?? 'Invitado';

    // Verifica si la ruta actual está en las rutas definidas
    if (array_key_exists($currentPath, $routesToCheck)) {
        // Verifica si el rol del usuario tiene permiso para la ruta
        if (!in_array($userRole, $routesToCheck[$currentPath])) {
            header("Location: http://localhost/tiendadb/index.php");
            exit();
        }
    } else {
        // Redirige al error si la ruta no está definida
        header("Location: http://localhost/tiendadb/index.php");
        exit();
    }
}

checkAccess();
?>
