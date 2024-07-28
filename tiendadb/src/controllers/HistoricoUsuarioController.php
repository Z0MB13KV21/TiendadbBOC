<?php
require_once __DIR__ . '/../db/Database.php';

class HistoricoUsuarioController {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function get($id = null) {
        $query = "SELECT * FROM historicousuario";
        if ($id) {
            $query .= " WHERE IdUser = :id";
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

        if (!isset($data['IdUser']) || !isset($data['Usuario']) || !isset($data['NFactura']) || !isset($data['IdPedido'])) {
            header('Content-Type: application/json');
            http_response_code(400);
            echo json_encode(['error' => 'Datos incompletos.']);
            return;
        }

        $query = "INSERT INTO historicousuario (IdUser, Usuario, NFactura, IdPedido) VALUES (:iduser, :usuario, :nfactura, :idpedido)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':iduser', $data['IdUser']);
        $stmt->bindParam(':usuario', $data['Usuario']);
        $stmt->bindParam(':nfactura', $data['NFactura']);
        $stmt->bindParam(':idpedido', $data['IdPedido']);

        if ($stmt->execute()) {
            header('Content-Type: application/json');
            http_response_code(201);
            echo json_encode(['message' => 'Histórico de usuario creado correctamente.']);
        } else {
            header('Content-Type: application/json');
            http_response_code(500);
            echo json_encode(['error' => 'Error al crear el histórico de usuario.']);
        }
    }

    public function put($id) {
        $data = json_decode(file_get_contents("php://input"), true);

        if (!isset($data['Usuario']) || !isset($data['NFactura']) || !isset($data['IdPedido'])) {
            header('Content-Type: application/json');
            http_response_code(400);
            echo json_encode(['error' => 'Datos incompletos.']);
            return;
        }

        $query = "UPDATE historicousuario SET Usuario = :usuario, NFactura = :nfactura, IdPedido = :idpedido WHERE IdUser = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':usuario', $data['Usuario']);
        $stmt->bindParam(':nfactura', $data['NFactura']);
        $stmt->bindParam(':idpedido', $data['IdPedido']);

        if ($stmt->execute()) {
            header('Content-Type: application/json');
            http_response_code(200);
            echo json_encode(['message' => 'Histórico de usuario actualizado correctamente.']);
        } else {
            header('Content-Type: application/json');
            http_response_code(500);
            echo json_encode(['error' => 'Error al actualizar el histórico de usuario.']);
        }
    }

    public function delete($id) {
        $query = "DELETE FROM historicousuario WHERE IdUser = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            header('Content-Type: application/json');
            http_response_code(200);
            echo json_encode(['message' => 'Histórico de usuario eliminado correctamente.']);
        } else {
            header('Content-Type: application/json');
            http_response_code(500);
            echo json_encode(['error' => 'Error al eliminar el histórico de usuario.']);
        }
    }
}
?>
