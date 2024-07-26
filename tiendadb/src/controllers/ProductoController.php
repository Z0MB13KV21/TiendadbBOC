<?php
require_once __DIR__ . '/../db/Database.php';

class ProductoController {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function get($id = null) {
        $query = "SELECT * FROM productos";
        if ($id) {
            $query .= " WHERE IdProduct = :id";
        }
        $stmt = $this->conn->prepare($query);
        if ($id) {
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        }
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($result);
    }

    public function post() {
        $data = json_decode(file_get_contents("php://input"));
        $query = "INSERT INTO productos (NProducto, Descripcion, Precio, Stock, NCategoria) VALUES (:nproducto, :descripcion, :precio, :stock, :ncategoria)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':nproducto', $data->NProducto);
        $stmt->bindParam(':descripcion', $data->Descripcion);
        $stmt->bindParam(':precio', $data->Precio);
        $stmt->bindParam(':stock', $data->Stock);
        $stmt->bindParam(':ncategoria', $data->NCategoria);
        if ($stmt->execute()) {
            echo json_encode(['message' => 'Producto creado correctamente.']);
        } else {
            echo json_encode(['error' => 'Error al crear el producto.']);
        }
    }

    public function put($id) {
        $data = json_decode(file_get_contents("php://input"));
        $query = "UPDATE productos SET NProducto = :nproducto, Descripcion = :descripcion, Precio = :precio, Stock = :stock, NCategoria = :ncategoria WHERE IdProduct = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':nproducto', $data->NProducto);
        $stmt->bindParam(':descripcion', $data->Descripcion);
        $stmt->bindParam(':precio', $data->Precio);
        $stmt->bindParam(':stock', $data->Stock);
        $stmt->bindParam(':ncategoria', $data->NCategoria);
        if ($stmt->execute()) {
            echo json_encode(['message' => 'Producto actualizado correctamente.']);
        } else {
            echo json_encode(['error' => 'Error al actualizar el producto.']);
        }
    }

    public function delete($id) {
        $query = "DELETE FROM productos WHERE IdProduct = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        if ($stmt->execute()) {
            echo json_encode(['message' => 'Producto eliminado correctamente.']);
        } else {
            echo json_encode(['error' => 'Error al eliminar el producto.']);
        }
    }
}
?>
