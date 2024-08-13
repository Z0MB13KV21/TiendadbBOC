<?php
require_once __DIR__ . '/../db/Database.php';
require_once __DIR__ . '/../module/Producto.php';
require_once __DIR__ . '/../module/Categoria.php';

class ProductoController {
    private $model;
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
        $this->model = new Producto($this->conn);
    }

    private function validarDatos($data) {
        return isset($data['NProducto']) && isset($data['Descripcion']) && isset($data['Precio']) && isset($data['Stock']) && isset($data['NCategoria']) && isset($data['enlace']) && isset($data['estado']);
    }

    public function get($id = null) {
        if ($id) {
            echo json_encode($this->model->find($id));
        } else {
            echo json_encode($this->model->all());
        }
    }

    public function post() {
        $data = json_decode(file_get_contents('php://input'), true);
        $productName = $data['NProducto'];

        // Comprobar si el nombre del producto ya existe
        if ($this->model->existsByProductName($productName)) {
            echo json_encode(['error' => 'El nombre del producto ya existe.']);
            http_response_code(400); // Bad Request
            return;
        }

        if ($this->validarDatos($data)) {
            echo json_encode($this->model->create($data));
        } else {
            echo json_encode(['error' => 'Datos inválidos.']);
            http_response_code(400); // Bad Request
        }
    }

    public function put($id) {
        $data = json_decode(file_get_contents('php://input'), true);
        $productName = $data['NProducto'];

        // Comprobar si el nombre del producto ya existe para otro producto
        $existingProduct = $this->model->existsByProductName($productName);
        if ($existingProduct && $existingProduct['IdProduct'] != $id) {
            echo json_encode(['error' => 'El nombre del producto ya existe.']);
            http_response_code(400); // Bad Request
            return;
        }

        if ($this->validarDatos($data)) {
            echo json_encode($this->model->update($id, $data));
        } else {
            echo json_encode(['error' => 'Datos inválidos.']);
            http_response_code(400); // Bad Request
        }
    }

    public function delete($id) {
        echo json_encode($this->model->delete($id));
    }

    public function getCategorias() {
        $categoriaModel = new Categoria($this->conn);
        $categorias = $categoriaModel->all();
        echo json_encode($categorias);
    }
}
?>
