<?php
// auth.php
require_once 'Database.php';
session_start();

function redirectBasedOnRole() {
    global $role;

    $roleRequiredPages = [
        'perfil.php' => ['Administrador', 'Cajero', 'Usuario'],
        'public/frontend/index.php' => ['Administrador', 'Cajero'],
        'public/frontend/productos.php' => ['Administrador', 'Cajero'],
        'public/frontend/usuarios.php' => ['Administrador']
    ];

    $currentPage = basename($_SERVER['SCRIPT_FILENAME']);
    
    if (isset($roleRequiredPages[$currentPage])) {
        if (!isset($_SESSION['user_id'])) {
            header("Location: /tiendadb/index.php");
            exit();
        } elseif (!checkAccess($currentPage)) {
            header("Location: /tiendadb/index.php");
            exit();
        }
    }
}

if (!isset($_SESSION['user_id'])) {
    $currentPage = basename($_SERVER['SCRIPT_FILENAME']);
    
    $pagesWithoutRole = [
        'index.php',
        'log.php',
        'sobrenosotros.php',
        'ventas.php'
    ];

    if (!in_array($currentPage, $pagesWithoutRole)) {
        header("Location: /tiendadb/index.php");
        exit();
    }
}

$userId = $_SESSION['user_id'] ?? null;

if ($userId) {
    $database = new Database();
    $conn = $database->getConnection();

    $sql = "SELECT Usuario, Rol FROM usuarios WHERE IdUser = :userId";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':userId', $userId);
    $stmt->execute();

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        header("Location: /tiendadb/index.php");
        exit();
    }

    $username = $user['Usuario'];
    $role = $user['Rol'];
} else {
    $username = $role = null;
}

function checkRole($allowedRoles) {
    global $role;
    return in_array($role, $allowedRoles);
}

function checkAccess($page) {
    global $role;

    $accessControl = [
        'index.php' => ['Administrador', 'Cajero', 'Usuario'],
        'log.php' => ['Administrador'],
        'perfil.php' => ['Administrador', 'Cajero', 'Usuario'],
        'sobrenosotros.php' => ['Administrador', 'Cajero', 'Usuario'],
        'ventas.php' => ['Administrador', 'Cajero', 'Usuario'],
        'public/frontend/index.php' => ['Administrador', 'Cajero'],
        'public/frontend/productos.php' => ['Administrador', 'Cajero'],
        'public/frontend/usuarios.php' => ['Administrador'],
        'public/error/response.html' => ['Administrador', 'Cajero', 'Usuario']
    ];

    if (isset($accessControl[$page])) {
        return in_array($role, $accessControl[$page]);
    }
    return false;
}

if (isset($_GET['action']) && $_GET['action'] === 'logout') {
    session_unset(); // Eliminar todas las variables de sesión
    session_destroy(); // Destruir la sesión
    setcookie(session_name(), '', time() - 3600, '/'); // Eliminar la cookie de sesión

    // Para depuración: Verificar si la sesión fue eliminada
    if (session_status() == PHP_SESSION_NONE) {
        echo 'Sesión destruida.';
    } else {
        echo 'Error al destruir la sesión.';
    }

    header("Location: /tiendadb/index.php");
    exit();
}



// Añadir datos de sesión a una variable global para su uso en el frontend
$GLOBALS['sessionData'] = [
    'isLoggedIn' => isset($_SESSION['user_id']),
    'userName' => $username
];
?>
