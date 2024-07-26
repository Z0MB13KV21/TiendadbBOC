<?php
class Categoria {
    private $conn;
    private $table_name = 'categorias';

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function find($id) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE IdCateg = ?";
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
        $query = "INSERT INTO " . $this->table_name . " (NCategoria, Descripcion) VALUES (:ncategoria, :descripcion)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':ncategoria', $data['NCategoria']);
        $stmt->bindParam(':descripcion', $data['Descripcion']);
        $stmt->execute();
        return ['id' => $this->conn->lastInsertId()];
    }

    public function update($id, $data) {
        $query = "UPDATE " . $this->table_name . " SET NCategoria = :ncategoria, Descripcion = :descripcion WHERE IdCateg = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':ncategoria', $data['NCategoria']);
        $stmt->bindParam(':descripcion', $data['Descripcion']);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return ['status' => 'updated'];
    }

    public function delete($id) {
        $query = "DELETE FROM " . $this->table_name . " WHERE IdCateg = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return ['status' => 'deleted'];
    }
}
?>
