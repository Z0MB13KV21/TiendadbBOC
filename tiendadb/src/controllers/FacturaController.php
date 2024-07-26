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
        echo json_encode($result);
    }

    public function post() {
        $data = json_decode(file_get_contents("php://input"));
        $query = "INSERT INTO facturas (IdProduct, Total, IdUser, Usuario) VALUES (:idproduct, :total, :iduser, :usuario)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':idproduct', $data->IdProduct);
        $stmt->bindParam(':total', $data->Total);
        $stmt->bindParam(':iduser', $data->IdUser);
        $stmt->bindParam(':usuario', $data->Usuario);
        if ($stmt->execute()) {
            echo json_encode(['message' => 'Factura creada correctamente.']);
        } else {
            echo json_encode(['error' => 'Error al crear la factura.']);
        }
    }

    public function put($id) {
        $data = json_decode(file_get_contents("php://input"));
        $query = "UPDATE facturas SET IdProduct = :idproduct, Total = :total, IdUser = :iduser, Usuario = :usuario WHERE NFactura = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':idproduct', $data->IdProduct);
        $stmt->bindParam(':total', $data->Total);
        $stmt->bindParam(':iduser', $data->IdUser);
        $stmt->bindParam(':usuario', $data->Usuario);
        if ($stmt->execute()) {
            echo json_encode(['message' => 'Factura actualizada correctamente.']);
        } else {
            echo json_encode(['error' => 'Error al actualizar la factura.']);
        }
    }

    public function delete($id) {
        $query = "DELETE FROM facturas WHERE NFactura = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        if ($stmt->execute()) {
            echo json_encode(['message' => 'Factura eliminada correctamente.']);
        } else {
            echo json_encode(['error' => 'Error al eliminar la factura.']);
        }
    }
}
?>
