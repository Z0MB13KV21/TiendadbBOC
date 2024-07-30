<?php
class Pedido {
    private $conn;
    private $table_name = "pedidos";

    public function __construct($conn) {
        $this->conn = $conn;
    }

    // Find pedido by ID
    public function find($id) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE IdPedido = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Get all pedidos
    public function all() {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Create a new pedido
    public function create($data) {
        $query = "INSERT INTO " . $this->table_name . " (IdUsuario, Fecha, Total, Estado) VALUES (:idUsuario, :fecha, :total, :estado)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':idUsuario', $data['IdUsuario']);
        $stmt->bindParam(':fecha', $data['Fecha']);
        $stmt->bindParam(':total', $data['Total']);
        $stmt->bindParam(':estado', $data['Estado']);
        $stmt->execute();
        return ['id' => $this->conn->lastInsertId()];
    }

    // Update an existing pedido
    public function update($id, $data) {
        $query = "UPDATE " . $this->table_name . " SET IdUsuario = :idUsuario, Fecha = :fecha, Total = :total, Estado = :estado WHERE IdPedido = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':idUsuario', $data['IdUsuario']);
        $stmt->bindParam(':fecha', $data['Fecha']);
        $stmt->bindParam(':total', $data['Total']);
        $stmt->bindParam(':estado', $data['Estado']);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return ['status' => 'updated'];
    }

    // Delete a pedido
    public function delete($id) {
        $query = "DELETE FROM " . $this->table_name . " WHERE IdPedido = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return ['status' => 'deleted'];
    }
}
?>
