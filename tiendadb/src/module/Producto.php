<?php
class Producto {
    private $conn;
    private $table_name = 'productos';

    public function __construct($conn) {
        $this->conn = $conn;
    }

    // Find producto by ID
    public function find($id) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE IdProduct = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $id);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Get all productos
    public function all() {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Create a new producto
    public function create($data) {
        $query = "INSERT INTO " . $this->table_name . " (NProducto, Descripcion, Precio, Stock, NCategoria) VALUES (:nproducto, :descripcion, :precio, :stock, :ncategoria)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':nproducto', $data['NProducto']);
        $stmt->bindParam(':descripcion', $data['Descripcion']);
        $stmt->bindParam(':precio', $data['Precio']);
        $stmt->bindParam(':stock', $data['Stock']);
        $stmt->bindParam(':ncategoria', $data['NCategoria']);

        try {
            $stmt->execute();
            return ['id' => $this->conn->lastInsertId()];
        } catch (PDOException $e) {
            return ['error' => $e->getMessage()];
        }
    }

    // Update an existing producto
    public function update($id, $data) {
        $query = "UPDATE " . $this->table_name . " SET NProducto = :nproducto, Descripcion = :descripcion, Precio = :precio, Stock = :stock, NCategoria = :ncategoria WHERE IdProduct = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':nproducto', $data['NProducto']);
        $stmt->bindParam(':descripcion', $data['Descripcion']);
        $stmt->bindParam(':precio', $data['Precio']);
        $stmt->bindParam(':stock', $data['Stock']);
        $stmt->bindParam(':ncategoria', $data['NCategoria']);
        $stmt->bindParam(':id', $id);

        try {
            $stmt->execute();
            return ['status' => 'updated'];
        } catch (PDOException $e) {
            return ['error' => $e->getMessage()];
        }
    }

    // Delete a producto
    public function delete($id) {
        $query = "DELETE FROM " . $this->table_name . " WHERE IdProduct = :id";
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
