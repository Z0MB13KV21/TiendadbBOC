<?php
require_once __DIR__ . '/../db/Database.php';
require_once __DIR__ . '/../module/HistoricoUsuario.php';

class HistoricoUsuarioController {
    private $model;
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
        $this->model = new HistoricoUsuario($this->conn);
    }

    public function get($id = null) {
        if ($id) {
            $result = $this->model->find($id);
        } else {
            $result = $this->model->all();
        }
        echo json_encode($result);
    }

    public function post() {
        $data = json_decode(file_get_contents('php://input'), true);

        // Validar los datos
        if (!$this->validarDatos($data)) {
            echo json_encode(['error' => 'Datos incompletos.']);
            http_response_code(400); // Bad Request
            return;
        }

        echo json_encode($this->model->create($data));
    }

    public function put($id) {
        $data = json_decode(file_get_contents('php://input'), true);

        // Validar los datos
        if (!$this->validarDatos($data)) {
            echo json_encode(['error' => 'Datos incompletos.']);
            http_response_code(400); // Bad Request
            return;
        }

        echo json_encode($this->model->update($id, $data));
    }

    public function delete($id) {
        echo json_encode($this->model->delete($id));
    }

    private function validarDatos($data) {
        return isset($data['IdUser']) && isset($data['Fecha']) && isset($data['Accion']) && isset($data['Detalle']);
    }
}
?>
