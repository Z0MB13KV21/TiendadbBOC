<?php
class Producto {
    private $conn;
    private $table_name = "productos";

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function find($id) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE IdProduct = :id";
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
        $query = "INSERT INTO " . $this->table_name . " (NProducto, Descripcion, Precio, Stock, NCategoria, enlace, estado) VALUES (:NProducto, :Descripcion, :Precio, :Stock, :NCategoria, :enlace, :estado)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':NProducto', $data['NProducto']);
        $stmt->bindParam(':Descripcion', $data['Descripcion']);
        $stmt->bindParam(':Precio', $data['Precio']);
        $stmt->bindParam(':Stock', $data['Stock']);
        $stmt->bindParam(':NCategoria', $data['NCategoria']);
        $stmt->bindParam(':enlace', $data['enlace']);
        $stmt->bindParam(':estado', $data['estado']);
        $stmt->execute();
        return ['id' => $this->conn->lastInsertId()];
    }

    public function update($id, $data) {
        $query = "UPDATE " . $this->table_name . " SET NProducto = :NProducto, Descripcion = :Descripcion, Precio = :Precio, Stock = :Stock, NCategoria = :NCategoria, enlace = :enlace, estado = :estado WHERE IdProduct = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':NProducto', $data['NProducto']);
        $stmt->bindParam(':Descripcion', $data['Descripcion']);
        $stmt->bindParam(':Precio', $data['Precio']);
        $stmt->bindParam(':Stock', $data['Stock']);
        $stmt->bindParam(':NCategoria', $data['NCategoria']);
        $stmt->bindParam(':enlace', $data['enlace']);
        $stmt->bindParam(':estado', $data['estado']);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return ['status' => 'updated'];
    }

    public function delete($id) {
        $query = "DELETE FROM " . $this->table_name . " WHERE IdProduct = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return ['status' => 'deleted'];
    }
    public function existsByProductName($productName) {
        $query = "SELECT IdProduct FROM " . $this->table_name . " WHERE NProducto = :NProducto";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':NProducto', $productName);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>
