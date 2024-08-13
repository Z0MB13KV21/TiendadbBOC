<?php

require_once 'Database.php';
session_start();

$userId = $_SESSION['userId'] ?? null;

if ($userId) {
    try {
        $database = new Database();
        $conn = $database->getConnection();

        // Obtener detalles del usuario
        $sql = "SELECT Usuario, Rol FROM usuarios WHERE IdUser = :userId";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$user) {
            // Si el usuario no se encuentra en la base de datos, cerrar sesión y redirigir
            session_unset();
            session_destroy();
            header("Location: /tiendadb/index.php");
            exit();
        }

        $username = $user['Usuario'];
        $role = $user['Rol'];
    } catch (PDOException $e) {
        die("Error de conexión a la base de datos: " . $e->getMessage());
    }
} else {
    // Usuario no está autenticado
    $username = "Invitado";
    $role = "Invitado";
}

// Añade datos de sesión a una variable global para su uso en el frontend
$GLOBALS['sessionData'] = [
    'isLoggedIn' => $userId !== null,
    'userName' => $username,
    'userRole' => $role,
    'userId' => $userId
];
?>
