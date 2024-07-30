<?php
class Categoria {
    private $conn;
    private $table_name = "categorias"; // Nombre de la tabla

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function find($id) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE IdCateg = :id";
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

    // Método para obtener datos de categorías para el select
    public function allForSelect() {
        $query = "SELECT IdCateg, NCategoria, Descripción FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        // Formatear los datos para el select
        $formattedCategories = [];
        foreach ($categories as $category) {
            $formattedCategories[] = [
                'id' => $category['IdCateg'],
                'text' => $category['IdCateg'] . ' - ' . $category['NCategoria'] . ' - ' . $category['Descripción']
            ];
        }
        return $formattedCategories;
    }

    public function create($data) {
        $query = "INSERT INTO " . $this->table_name . " (NCategoria, Descripción) VALUES (:name, :description)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':name', $data['Nombre'], PDO::PARAM_STR);
        $stmt->bindParam(':description', $data['Descripcion'], PDO::PARAM_STR);
        $stmt->execute();
        return $this->find($this->conn->lastInsertId());
    }

    public function update($id, $data) {
        $query = "UPDATE " . $this->table_name . " SET NCategoria = :name, Descripción = :description WHERE IdCateg = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':name', $data['Nombre'], PDO::PARAM_STR);
        $stmt->bindParam(':description', $data['Descripcion'], PDO::PARAM_STR);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $this->find($id);
    }

    public function delete($id) {
        $query = "DELETE FROM " . $this->table_name . " WHERE IdCateg = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return ['message' => 'Categoría eliminada'];
    }
}
?>
