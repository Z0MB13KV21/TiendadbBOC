<?php
class HistoricoUsuario {
    private $conn;
    private $table_name = "historico_usuarios";

    public function __construct($conn) {
        $this->conn = $conn;
    }

    // Find historico_usuario by ID
    public function find($id) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE IdHistorico = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Get all historico_usuarios
    public function all() {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Create a new historico_usuario
    public function create($data) {
        $query = "INSERT INTO " . $this->table_name . " (IdUser, Fecha, Accion, Detalle) VALUES (:idUser, :fecha, :accion, :detalle)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':idUser', $data['IdUser']);
        $stmt->bindParam(':fecha', $data['Fecha']);
        $stmt->bindParam(':accion', $data['Accion']);
        $stmt->bindParam(':detalle', $data['Detalle']);
        $stmt->execute();
        return ['id' => $this->conn->lastInsertId()];
    }

    // Update an existing historico_usuario
    public function update($id, $data) {
        $query = "UPDATE " . $this->table_name . " SET IdUser = :idUser, Fecha = :fecha, Accion = :accion, Detalle = :detalle WHERE IdHistorico = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':idUser', $data['IdUser']);
        $stmt->bindParam(':fecha', $data['Fecha']);
        $stmt->bindParam(':accion', $data['Accion']);
        $stmt->bindParam(':detalle', $data['Detalle']);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return ['status' => 'updated'];
    }

    // Delete a historico_usuario
    public function delete($id) {
        $query = "DELETE FROM " . $this->table_name . " WHERE IdHistorico = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return ['status' => 'deleted'];
    }
}
?>
