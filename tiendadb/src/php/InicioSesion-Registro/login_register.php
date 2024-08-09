<?php
require_once '../../db/Database.php';
session_start();

$response = array('success' => false, 'message' => '', 'errors' => array());

try {
    $database = new Database();
    $con = $database->getConnection();

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $action = $_POST['action'] ?? '';

        if ($action === 'login') {
            $usuario_correo = $_POST['usuario_correo'] ?? '';
            $contrasena = $_POST['contrasena'] ?? '';

            if (empty($usuario_correo)) {
                $response['errors']['usuario_correo'] = 'Correo electrónico o usuario es requerido.';
            }
            if (empty($contrasena)) {
                $response['errors']['contrasena'] = 'Contraseña es requerida.';
            }

            if (empty($response['errors'])) {
                $stmt = $con->prepare("SELECT * FROM usuarios WHERE Email = ? OR Usuario = ?");
                $stmt->execute([$usuario_correo, $usuario_correo]);
                $user = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($user && password_verify($contrasena, $user['Contraseña'])) {
                    if ($user['Estado'] == 1) {
                        // Establecer sesión
                        $_SESSION['user'] = $user['Usuario'];
                        $_SESSION['userId'] = $user['IdUser'];
                        $_SESSION['userRole'] = $user['Rol'];
                        $response['success'] = true;
                        $response['userName'] = $user['Usuario'];
                        $response['userRole'] = $user['Rol']; 
                    } else {
                        $response['errors']['usuario_correo'] = 'El usuario está inactivo.';
                    }
                } else {
                    $response['errors']['usuario_correo'] = 'Credenciales incorrectas.';
                }
            }
        } elseif ($action === 'register') {
            $usuario = $_POST['usuario'] ?? '';
            $nombre = $_POST['nombre'] ?? '';
            $apellido = $_POST['apellido'] ?? '';
            $correo = $_POST['correoRegistro'] ?? '';
            $contrasena = $_POST['contrasenaRegistro'] ?? '';
            $vcontrasena = $_POST['vcontrasenaRegistro'] ?? '';

            if (empty($usuario)) {
                $response['errors']['usuario'] = 'Nombre de usuario es requerido.';
            } elseif (strlen($usuario) < 3) {
                $response['errors']['usuario'] = 'El nombre de usuario debe tener al menos 3 caracteres.';
            }

            if (empty($nombre)) {
                $response['errors']['nombre'] = 'Nombre es requerido.';
            }

            if (empty($apellido)) {
                $response['errors']['apellido'] = 'Apellido es requerido.';
            }

            if (empty($correo)) {
                $response['errors']['correoRegistro'] = 'Correo electrónico es requerido.';
            } elseif (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
                $response['errors']['correoRegistro'] = 'Correo electrónico no es válido.';
            }

            if (empty($contrasena)) {
                $response['errors']['contrasenaRegistro'] = 'Contraseña es requerida.';
            }

            if ($contrasena !== $vcontrasena) {
                $response['errors']['vcontrasenaRegistro'] = 'Las contraseñas no coinciden.';
            }

            if (empty($response['errors'])) {
                $stmt = $con->prepare("SELECT * FROM usuarios WHERE Email = ? OR Usuario = ?");
                $stmt->execute([$correo, $usuario]);
                if ($stmt->fetch(PDO::FETCH_ASSOC)) {
                    $response['errors']['correoRegistro'] = 'El correo electrónico o nombre de usuario ya está registrado.';
                } else {
                    $hashedPassword = password_hash($contrasena, PASSWORD_BCRYPT);
                    $stmt = $con->prepare("INSERT INTO usuarios (Usuario, Nombre, Apellido, Email, Contraseña, Rol, Estado) VALUES (?, ?, ?, ?, ?, 'Usuario', 1)");
                    if ($stmt->execute([$usuario, $nombre, $apellido, $correo, $hashedPassword])) {
                        $response['success'] = true;
                    } else {
                        $response['errors']['general'] = 'Error al registrar el usuario.';
                    }
                }
            }
        } else {
            $response['errors']['general'] = 'Acción no válida.';
        }
    } else {
        $response['errors']['general'] = 'Método de solicitud no válido.';
    }
} catch (Exception $e) {
    $response['errors']['general'] = 'Error del servidor: ' . $e->getMessage();
}

echo json_encode($response);
?>
