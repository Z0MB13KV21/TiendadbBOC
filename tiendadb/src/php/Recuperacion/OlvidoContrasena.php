<?php
require_once '../../db/Database.php'; // Ruta correcta a la clase Database

// Obtener los datos enviados por POST
$forgotUserEmail = isset($_POST['forgot_user_email']) ? $_POST['forgot_user_email'] : '';

if (empty($forgotUserEmail)) {
    echo 'Ingrese un usuario o correo electrónico.';
    exit;
}

try {
    $database = new Database();
    $conn = $database->getConnection();

    $query = "SELECT IdUser, Email FROM usuarios WHERE Usuario = :user_or_email OR Email = :user_or_email LIMIT 1";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':user_or_email', $forgotUserEmail);
    $stmt->execute();

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        echo 'Usuario encontrado';
        echo '|' . $user['IdUser'] . '|' . $user['Email'];
    } else {
        echo 'No se encontró el usuario o correo electrónico.';
    }
} catch (PDOException $e) {
    echo 'Error: ' . $e->getMessage();
}
?>
