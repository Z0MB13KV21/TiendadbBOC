<?php

require_once 'Database.php';
session_start();

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

// Añade datos de sesión a una variable global para su uso en el frontend
$GLOBALS['sessionData'] = [
    'isLoggedIn' => isset($_SESSION['user_id']),
    'userName' => $username,
    'userRole' => $role,
    'userId' => $userId
];
?>
