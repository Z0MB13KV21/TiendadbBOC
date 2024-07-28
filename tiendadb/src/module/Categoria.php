<?php
class Categoria {
    private $conn;
    private $table_name = 'categorias';

    public function __construct($conn) {
        $this->conn = $conn;
    }

    // Find a category by ID
    public function find($id) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE IdCateg = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $id);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Get all categories
    public function all() {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Create a new category
    public function create($data) {
        $query = "INSERT INTO " . $this->table_name . " (NCategoria, Descripcion) VALUES (:ncategoria, :descripcion)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':ncategoria', $data['NCategoria']);
        $stmt->bindParam(':descripcion', $data['Descripcion']);

        try {
            $stmt->execute();
            return ['id' => $this->conn->lastInsertId()];
        } catch (PDOException $e) {
            return ['error' => $e->getMessage()];
        }
    }

    // Update an existing category
    public function update($id, $data) {
        $query = "UPDATE " . $this->table_name . " SET NCategoria = :ncategoria, Descripcion = :descripcion WHERE IdCateg = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':ncategoria', $data['NCategoria']);
        $stmt->bindParam(':descripcion', $data['Descripcion']);
        $stmt->bindParam(':id', $id);

        try {
            $stmt->execute();
            return ['status' => 'updated'];
        } catch (PDOException $e) {
            return ['error' => $e->getMessage()];
        }
    }

    // Delete a category
    public function delete($id) {
        $query = "DELETE FROM " . $this->table_name . " WHERE IdCateg = :id";
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
