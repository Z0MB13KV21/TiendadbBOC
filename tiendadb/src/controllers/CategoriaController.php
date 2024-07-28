<?php
require_once __DIR__ . '/../db/Database.php';

class CategoriaController {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function get($id = null) {
        $query = "SELECT * FROM categorias";
        if ($id) {
            $query .= " WHERE IdCateg = :id";
        }
        $stmt = $this->conn->prepare($query);
        if ($id) {
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        }
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        header('Content-Type: application/json');
        echo json_encode($result);
    }

    public function post() {
        $data = json_decode(file_get_contents("php://input"), true);

        if (!isset($data['NCategoria']) || !isset($data['Descripcion'])) {
            header('Content-Type: application/json');
            http_response_code(400);
            echo json_encode(['error' => 'Datos incompletos.']);
            return;
        }

        $query = "INSERT INTO categorias (NCategoria, Descripcion) VALUES (:ncategoria, :descripcion)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':ncategoria', $data['NCategoria']);
        $stmt->bindParam(':descripcion', $data['Descripcion']);

        if ($stmt->execute()) {
            header('Content-Type: application/json');
            http_response_code(201);
            echo json_encode(['message' => 'Categoría creada correctamente.']);
        } else {
            header('Content-Type: application/json');
            http_response_code(500);
            echo json_encode(['error' => 'Error al crear la categoría.']);
        }
    }

    public function put($id) {
        $data = json_decode(file_get_contents("php://input"), true);

        if (!isset($data['NCategoria']) || !isset($data['Descripcion'])) {
            header('Content-Type: application/json');
            http_response_code(400);
            echo json_encode(['error' => 'Datos incompletos.']);
            return;
        }

        $query = "UPDATE categorias SET NCategoria = :ncategoria, Descripcion = :descripcion WHERE IdCateg = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':ncategoria', $data['NCategoria']);
        $stmt->bindParam(':descripcion', $data['Descripcion']);

        if ($stmt->execute()) {
            header('Content-Type: application/json');
            http_response_code(200);
            echo json_encode(['message' => 'Categoría actualizada correctamente.']);
        } else {
            header('Content-Type: application/json');
            http_response_code(500);
            echo json_encode(['error' => 'Error al actualizar la categoría.']);
        }
    }

    public function delete($id) {
        $query = "DELETE FROM categorias WHERE IdCateg = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            header('Content-Type: application/json');
            http_response_code(200);
            echo json_encode(['message' => 'Categoría eliminada correctamente.']);
        } else {
            header('Content-Type: application/json');
            http_response_code(500);
            echo json_encode(['error' => 'Error al eliminar la categoría.']);
        }
    }
}
?>
