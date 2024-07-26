<?php
class Usuario {
    private $conn;
    private $table_name = 'usuarios';

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function find($id) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE IdUser = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $id);
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
        $query = "INSERT INTO " . $this->table_name . " (Usuario, Nombre, Apellido, Email, Contraseña) VALUES (:usuario, :nombre, :apellido, :email, :contraseña)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':usuario', $data['Usuario']);
        $stmt->bindParam(':nombre', $data['Nombre']);
        $stmt->bindParam(':apellido', $data['Apellido']);
        $stmt->bindParam(':email', $data['Email']);
        $stmt->bindParam(':contraseña', $data['Contraseña']);
        $stmt->execute();
        return ['id' => $this->conn->lastInsertId()];
    }

    public function update($id, $data) {
        $query = "UPDATE " . $this->table_name . " SET Usuario = :usuario, Nombre = :nombre, Apellido = :apellido, Email = :email, Contraseña = :contraseña WHERE IdUser = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':usuario', $data['Usuario']);
        $stmt->bindParam(':nombre', $data['Nombre']);
        $stmt->bindParam(':apellido', $data['Apellido']);
        $stmt->bindParam(':email', $data['Email']);
        $stmt->bindParam(':contraseña', $data['Contraseña']);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return ['status' => 'updated'];
    }

    public function delete($id) {
        $query = "DELETE FROM " . $this->table_name . " WHERE IdUser = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return ['status' => 'deleted'];
    }
}
?>
