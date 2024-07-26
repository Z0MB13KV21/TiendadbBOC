<?php
class Pedido {
    private $conn;
    private $table_name = 'pedidos';

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function find($id) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE IdPedido = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $id);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function all() {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($data) {
        $query = "INSERT INTO " . $this->table_name . " (NFactura, IdProduct, IdUser, Usuario, Direccion, Provincia, Canton, NumeroContacto, Sede) VALUES (:nfactura, :idproduct, :iduser, :usuario, :direccion, :provincia, :canton, :numerocontacto, :sede)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':nfactura', $data['NFactura']);
        $stmt->bindParam(':idproduct', $data['IdProduct']);
        $stmt->bindParam(':iduser', $data['IdUser']);
        $stmt->bindParam(':usuario', $data['Usuario']);
        $stmt->bindParam(':direccion', $data['Direccion']);
        $stmt->bindParam(':provincia', $data['Provincia']);
        $stmt->bindParam(':canton', $data['Canton']);
        $stmt->bindParam(':numerocontacto', $data['NumeroContacto']);
        $stmt->bindParam(':sede', $data['Sede']);
        $stmt->execute();
        return ['id' => $this->conn->lastInsertId()];
    }

    public function update($id, $data) {
        $query = "UPDATE " . $this->table_name . " SET NFactura = :nfactura, IdProduct = :idproduct, IdUser = :iduser, Usuario = :usuario, Direccion = :direccion, Provincia = :provincia, Canton = :canton, NumeroContacto = :numerocontacto, Sede = :sede WHERE IdPedido = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':nfactura', $data['NFactura']);
        $stmt->bindParam(':idproduct', $data['IdProduct']);
        $stmt->bindParam(':iduser', $data['IdUser']);
        $stmt->bindParam(':usuario', $data['Usuario']);
        $stmt->bindParam(':direccion', $data['Direccion']);
        $stmt->bindParam(':provincia', $data['Provincia']);
        $stmt->bindParam(':canton', $data['Canton']);
        $stmt->bindParam(':numerocontacto', $data['NumeroContacto']);
        $stmt->bindParam(':sede', $data['Sede']);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return ['status' => 'updated'];
    }

    public function delete($id) {
        $query = "DELETE FROM " . $this->table_name . " WHERE IdPedido = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return ['status' => 'deleted'];
    }
}
?>
