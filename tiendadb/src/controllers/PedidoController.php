<?php
require_once __DIR__ . '/../db/Database.php';

class PedidoController {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function get($id = null) {
        $query = "SELECT * FROM pedidos";
        if ($id) {
            $query .= " WHERE IdPedido = :id";
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
        $query = "INSERT INTO pedidos (NFactura, IdProduct, IdUser, Usuario, Direccion, Provincia, Canton, NumeroContacto, Sede) VALUES (:nfactura, :idproduct, :iduser, :usuario, :direccion, :provincia, :canton, :numerocontacto, :sede)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':nfactura', $data->NFactura);
        $stmt->bindParam(':idproduct', $data->IdProduct);
        $stmt->bindParam(':iduser', $data->IdUser);
        $stmt->bindParam(':usuario', $data->Usuario);
        $stmt->bindParam(':direccion', $data->Direccion);
        $stmt->bindParam(':provincia', $data->Provincia);
        $stmt->bindParam(':canton', $data->Canton);
        $stmt->bindParam(':numerocontacto', $data->NumeroContacto);
        $stmt->bindParam(':sede', $data->Sede);
        if ($stmt->execute()) {
            echo json_encode(['message' => 'Pedido creado correctamente.']);
        } else {
            echo json_encode(['error' => 'Error al crear el pedido.']);
        }
    }

    public function put($id) {
        $data = json_decode(file_get_contents("php://input"));
        $query = "UPDATE pedidos SET NFactura = :nfactura, IdProduct = :idproduct, IdUser = :iduser, Usuario = :usuario, Direccion = :direccion, Provincia = :provincia, Canton = :canton, NumeroContacto = :numerocontacto, Sede = :sede WHERE IdPedido = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':nfactura', $data->NFactura);
        $stmt->bindParam(':idproduct', $data->IdProduct);
        $stmt->bindParam(':iduser', $data->IdUser);
        $stmt->bindParam(':usuario', $data->Usuario);
        $stmt->bindParam(':direccion', $data->Direccion);
        $stmt->bindParam(':provincia', $data->Provincia);
        $stmt->bindParam(':canton', $data->Canton);
        $stmt->bindParam(':numerocontacto', $data->NumeroContacto);
        $stmt->bindParam(':sede', $data->Sede);
        if ($stmt->execute()) {
            echo json_encode(['message' => 'Pedido actualizado correctamente.']);
        } else {
            echo json_encode(['error' => 'Error al actualizar el pedido.']);
        }
    }

    public function delete($id) {
        $query = "DELETE FROM pedidos WHERE IdPedido = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        if ($stmt->execute()) {
            echo json_encode(['message' => 'Pedido eliminado correctamente.']);
        } else {
            echo json_encode(['error' => 'Error al eliminar el pedido.']);
        }
    }
}
?>
