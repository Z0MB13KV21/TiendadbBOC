<?php
require_once __DIR__ . '/../module/Usuario.php';

class UsuarioController {
    private $model;
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
        $this->model = new Usuario($this->conn);
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
        $username = $data['username'];

        // Comprobar si el nombre de usuario ya existe
        if ($this->model->existsByUsername($username)) {
            echo json_encode(['error' => 'El nombre de usuario ya existe.']);
            http_response_code(400); // Bad Request
            return;
        }

        echo json_encode($this->model->create($data));
    }

    public function put($id) {
        $data = json_decode(file_get_contents('php://input'), true);
        $username = $data['username'];

        // Comprobar si el nombre de usuario ya existe para otro usuario
        $existingUser = $this->model->existsByUsername($username);
        if ($existingUser && $existingUser['IdUser'] != $id) {
            echo json_encode(['error' => 'El nombre de usuario ya existe.']);
            http_response_code(400); // Bad Request
            return;
        }

        echo json_encode($this->model->update($id, $data));
    }

    public function delete($id) {
        echo json_encode($this->model->delete($id));
    }

}
?>
