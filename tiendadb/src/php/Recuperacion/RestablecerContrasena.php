<?php
require_once '../../db/Database.php'; // Ruta correcta a la clase Database

// Obtener los datos enviados por POST
$resetUserEmail = isset($_POST['reset_user_email']) ? $_POST['reset_user_email'] : '';
$newPassword = isset($_POST['reset_contrasena']) ? $_POST['reset_contrasena'] : '';
$confirmPassword = isset($_POST['reset_vcontrasena']) ? $_POST['reset_vcontrasena'] : '';

if (empty($resetUserEmail) || empty($newPassword) || $newPassword !== $confirmPassword) {
    echo 'Datos incorrectos o contraseñas no coinciden.';
    exit;
}

try {
    $database = new Database();
    $conn = $database->getConnection();

    // Definir el algoritmo de hash
    $hashAlgorithm = PASSWORD_BCRYPT;

    $query = "UPDATE usuarios SET Contraseña = :new_password WHERE Email = :email";
    $stmt = $conn->prepare($query);

    // Usar password_hash con una variable para el algoritmo
    $hashedPassword = password_hash($newPassword, $hashAlgorithm);

    $stmt->bindParam(':new_password', $hashedPassword);
    $stmt->bindParam(':email', $resetUserEmail);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        echo 'Contraseña actualizada con éxito.';
    } else {
        echo 'No se encontró el usuario con el correo electrónico proporcionado.';
    }
} catch (PDOException $e) {
    echo 'Error: ' . $e->getMessage();
}
?>
