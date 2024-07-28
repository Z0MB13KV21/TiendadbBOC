<?php
class Factura {
    private $conn;
    private $table_name = 'facturas';

    public function __construct($conn) {
        $this->conn = $conn;
    }

    // Find a factura by ID
    public function find($id) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE NFactura = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $id);
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
        $query = "INSERT INTO " . $this->table_name . " (IdProduct, Total, IdUser, Usuario) VALUES (:idproduct, :total, :iduser, :usuario)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':idproduct', $data['IdProduct']);
        $stmt->bindParam(':total', $data['Total']);
        $stmt->bindParam(':iduser', $data['IdUser']);
        $stmt->bindParam(':usuario', $data['Usuario']);

        try {
            $stmt->execute();
            return ['id' => $this->conn->lastInsertId()];
        } catch (PDOException $e) {
            return ['error' => $e->getMessage()];
        }
    }

    // Update an existing factura
    public function update($id, $data) {
        $query = "UPDATE " . $this->table_name . " SET IdProduct = :idproduct, Total = :total, IdUser = :iduser, Usuario = :usuario WHERE NFactura = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':idproduct', $data['IdProduct']);
        $stmt->bindParam(':total', $data['Total']);
        $stmt->bindParam(':iduser', $data['IdUser']);
        $stmt->bindParam(':usuario', $data['Usuario']);
        $stmt->bindParam(':id', $id);

        try {
            $stmt->execute();
            return ['status' => 'updated'];
        } catch (PDOException $e) {
            return ['error' => $e->getMessage()];
        }
    }

    // Delete a factura
    public function delete($id) {
        $query = "DELETE FROM " . $this->table_name . " WHERE NFactura = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);

        try {
            $stmt->execute();
            return ['status' => 'deleted'];
        } catch (PDOException $e) {
            return ['error' => $e->getMessage()];
        }
    }
}
?>
