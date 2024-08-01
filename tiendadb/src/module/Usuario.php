<?php
class Usuario {
    private $conn;
    private $table_name = "usuarios";

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function find($id) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE IdUser = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function all() {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($data) {
        // Hashear la contraseña antes de insertarla en la base de datos
        $hashedPassword = password_hash($data['password'], PASSWORD_DEFAULT);
        
        $query = "INSERT INTO " . $this->table_name . " (Usuario, Nombre, Apellido, Email, Contraseña, Rol, Estado) VALUES (:username, :name, :lastName, :email, :password, :role, :status)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':username', $data['username']);
        $stmt->bindParam(':name', $data['name']);
        $stmt->bindParam(':lastName', $data['lastName']);
        $stmt->bindParam(':email', $data['email']);
        $stmt->bindParam(':password', $hashedPassword);
        $stmt->bindParam(':role', $data['role']);
        $stmt->bindParam(':status', $data['status']);
        $stmt->execute();
        return ['id' => $this->conn->lastInsertId()];
    }

    public function update($id, $data) {
        // Construir la consulta base
        $query = "UPDATE " . $this->table_name . " SET Usuario = :username, Nombre = :name, Apellido = :lastName, Email = :email, Rol = :role, Estado = :status";
        
        // Verificar si hay una nueva contraseña
        if (!empty($data['password'])) {
            // Hashear la nueva contraseña
            $hashedPassword = password_hash($data['password'], PASSWORD_DEFAULT);
            $query .= ", Contraseña = :password";
        }

        // Completar la consulta
        $query .= " WHERE IdUser = :id";
        $stmt = $this->conn->prepare($query);

        // Vincular parámetros
        $stmt->bindParam(':username', $data['username']);
        $stmt->bindParam(':name', $data['name']);
        $stmt->bindParam(':lastName', $data['lastName']);
        $stmt->bindParam(':email', $data['email']);
        $stmt->bindParam(':role', $data['role']);
        $stmt->bindParam(':status', $data['status']);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        // Si hay una nueva contraseña, vincular también
        if (!empty($data['password'])) {
            $stmt->bindParam(':password', $hashedPassword);
        }

        $stmt->execute();
        return ['status' => 'updated'];
    }

    public function delete($id) {
        $query = "DELETE FROM " . $this->table_name . " WHERE IdUser = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return ['status' => 'deleted'];
    }

    public function existsByUsername($usuario) {
        $query = "SELECT IdUser FROM " . $this->table_name . " WHERE Usuario = :usuario";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':usuario', $usuario);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>
