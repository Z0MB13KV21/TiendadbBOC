<?php
class Factura {
    private $conn;
    private $table_name = "facturas";

    public function __construct($conn) {
        $this->conn = $conn;
    }

    // Find factura by ID
    public function find($id) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE IdFactura = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Get all facturas
    public function all() {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Create a new factura
    public function create($data) {
        $query = "INSERT INTO " . $this->table_name . " (Fecha, Total, IdCliente) VALUES (:fecha, :total, :idCliente)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':fecha', $data['Fecha']);
        $stmt->bindParam(':total', $data['Total']);
        $stmt->bindParam(':idCliente', $data['IdCliente']);
        $stmt->execute();
        return ['id' => $this->conn->lastInsertId()];
    }

    // Update an existing factura
    public function update($id, $data) {
        $query = "UPDATE " . $this->table_name . " SET Fecha = :fecha, Total = :total, IdCliente = :idCliente WHERE IdFactura = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':fecha', $data['Fecha']);
        $stmt->bindParam(':total', $data['Total']);
        $stmt->bindParam(':idCliente', $data['IdCliente']);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return ['status' => 'updated'];
    }

    // Delete a factura
    public function delete($id) {
        $query = "DELETE FROM " . $this->table_name . " WHERE IdFactura = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return ['status' => 'deleted'];
    }
}
?>
