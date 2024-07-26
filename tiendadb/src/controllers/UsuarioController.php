<?php
require_once __DIR__ . '/../db/Database.php';

class UsuarioController {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function get($id = null) {
        $query = "SELECT * FROM usuarios";
        if ($id) {
            $query .= " WHERE IdUser = :id";
        }
        $stmt = $this->conn->prepare($query);
        if ($id) {
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        }
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($result);
    }

    public function post() {
        $data = json_decode(file_get_contents("php://input"));
        $query = "INSERT INTO usuarios (Usuario, Nombre, Apellido, Email, Contraseña) VALUES (:usuario, :nombre, :apellido, :email, :contraseña)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':usuario', $data->Usuario);
        $stmt->bindParam(':nombre', $data->Nombre);
        $stmt->bindParam(':apellido', $data->Apellido);
        $stmt->bindParam(':email', $data->Email);
        $stmt->bindParam(':contraseña', $data->Contraseña);
        if ($stmt->execute()) {
            echo json_encode(['message' => 'Usuario creado correctamente.']);
        } else {
            echo json_encode(['error' => 'Error al crear el usuario.']);
        }
    }

    public function put($id) {
        $data = json_decode(file_get_contents("php://input"));
        $query = "UPDATE usuarios SET Usuario = :usuario, Nombre = :nombre, Apellido = :apellido, Email = :email, Contraseña = :contraseña WHERE IdUser = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':usuario', $data->Usuario);
        $stmt->bindParam(':nombre', $data->Nombre);
        $stmt->bindParam(':apellido', $data->Apellido);
        $stmt->bindParam(':email', $data->Email);
        $stmt->bindParam(':contraseña', $data->Contraseña);
        if ($stmt->execute()) {
            echo json_encode(['message' => 'Usuario actualizado correctamente.']);
        } else {
            echo json_encode(['error' => 'Error al actualizar el usuario.']);
        }
    }

    public function delete($id) {
        $query = "DELETE FROM usuarios WHERE IdUser = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        if ($stmt->execute()) {
            echo json_encode(['message' => 'Usuario eliminado correctamente.']);
        } else {
            echo json_encode(['error' => 'Error al eliminar el usuario.']);
        }
    }
}
?>
