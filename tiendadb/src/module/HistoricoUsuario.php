<?php
class HistoricoUsuario {
    private $conn;
    private $table_name = 'historicousuario';

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function find($id) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE IdUser = ?";
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
        $query = "INSERT INTO " . $this->table_name . " (IdUser, Usuario, NFactura, IdPedido) VALUES (:iduser, :usuario, :nfactura, :idpedido)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':iduser', $data['IdUser']);
        $stmt->bindParam(':usuario', $data['Usuario']);
        $stmt->bindParam(':nfactura', $data['NFactura']);
        $stmt->bindParam(':idpedido', $data['IdPedido']);
        $stmt->execute();
        return ['id' => $this->conn->lastInsertId()];
    }

    public function update($id, $data) {
        $query = "UPDATE " . $this->table_name . " SET Usuario = :usuario, NFactura = :nfactura, IdPedido = :idpedido WHERE IdUser = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':usuario', $data['Usuario']);
        $stmt->bindParam(':nfactura', $data['NFactura']);
        $stmt->bindParam(':idpedido', $data['IdPedido']);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return ['status' => 'updated'];
    }

    public function delete($id) {
        $query = "DELETE FROM " . $this->table_name . " WHERE IdUser = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return ['status' => 'deleted'];
    }
}
?>
