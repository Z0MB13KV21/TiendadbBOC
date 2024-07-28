<?php
require_once __DIR__ . '/../db/Database.php';

class FacturaController {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function get($id = null) {
        $query = "SELECT * FROM facturas";
        if ($id) {
            $query .= " WHERE NFactura = :id";
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

        if (!isset($data['IdProduct']) || !isset($data['Total']) || !isset($data['IdUser']) || !isset($data['Usuario'])) {
            header('Content-Type: application/json');
            http_response_code(400);
            echo json_encode(['error' => 'Datos incompletos.']);
            return;
        }

        $query = "INSERT INTO facturas (IdProduct, Total, IdUser, Usuario) VALUES (:idproduct, :total, :iduser, :usuario)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':idproduct', $data['IdProduct']);
        $stmt->bindParam(':total', $data['Total']);
        $stmt->bindParam(':iduser', $data['IdUser']);
        $stmt->bindParam(':usuario', $data['Usuario']);

        if ($stmt->execute()) {
            header('Content-Type: application/json');
            http_response_code(201);
            echo json_encode(['message' => 'Factura creada correctamente.']);
        } else {
            header('Content-Type: application/json');
            http_response_code(500);
            echo json_encode(['error' => 'Error al crear la factura.']);
        }
    }

    public function put($id) {
        $data = json_decode(file_get_contents("php://input"), true);

        if (!isset($data['IdProduct']) || !isset($data['Total']) || !isset($data['IdUser']) || !isset($data['Usuario'])) {
            header('Content-Type: application/json');
            http_response_code(400);
            echo json_encode(['error' => 'Datos incompletos.']);
            return;
        }

        $query = "UPDATE facturas SET IdProduct = :idproduct, Total = :total, IdUser = :iduser, Usuario = :usuario WHERE NFactura = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':idproduct', $data['IdProduct']);
        $stmt->bindParam(':total', $data['Total']);
        $stmt->bindParam(':iduser', $data['IdUser']);
        $stmt->bindParam(':usuario', $data['Usuario']);

        if ($stmt->execute()) {
            header('Content-Type: application/json');
            http_response_code(200);
            echo json_encode(['message' => 'Factura actualizada correctamente.']);
        } else {
            header('Content-Type: application/json');
            http_response_code(500);
            echo json_encode(['error' => 'Error al actualizar la factura.']);
        }
    }

    public function delete($id) {
        $query = "DELETE FROM facturas WHERE NFactura = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            header('Content-Type: application/json');
            http_response_code(200);
            echo json_encode(['message' => 'Factura eliminada correctamente.']);
        } else {
            header('Content-Type: application/json');
            http_response_code(500);
            echo json_encode(['error' => 'Error al eliminar la factura.']);
        }
    }
}
?>
