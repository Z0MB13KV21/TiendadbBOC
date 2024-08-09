<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tiendadb";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Obtener productos
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['action'])) {
        if ($_GET['action'] === 'get_products') {
            $sql = "SELECT * FROM productos";
            $result = $conn->query($sql);
            $products = array();
            while ($row = $result->fetch_assoc()) {
                $products[] = $row;
            }
            echo json_encode($products);
        }

        if ($_GET['action'] === 'get_categories') {
            $sql = "SELECT DISTINCT NCategoria FROM categorias";
            $result = $conn->query($sql);
            $categories = array();
            while ($row = $result->fetch_assoc()) {
                $categories[] = $row['NCategoria'];
            }
            echo json_encode($categories);
        }

        // Obtener un producto específico
        if ($_GET['action'] === 'get_product' && isset($_GET['IdProduct'])) {
            $id = intval($_GET['IdProduct']);
            $sql = "SELECT * FROM productos WHERE IdProduct=$id";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                echo json_encode($result->fetch_assoc());
            } else {
                echo json_encode([]);
            }
        }
    }
}

// Operación para agregar/editar productos
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['IdProduct'] ?? null;
    $name = $conn->real_escape_string($_POST['NProducto']);
    $description = $conn->real_escape_string($_POST['Descripcion']);
    $price = floatval($_POST['Precio']);
    $stock = intval($_POST['Stock']);
    $category = $conn->real_escape_string($_POST['NCategoria']);
    $enlace = $conn->real_escape_string($_POST['enlace']);
    $status = intval($_POST['estado']);

    if ($id) {
        // Editar producto
        $sql = "UPDATE productos SET NProducto='$name', Descripcion='$description', Precio='$price', Stock='$stock', NCategoria='$category', enlace='$enlace', estado='$status' WHERE IdProduct='$id'";
    } else {
        // Agregar producto
        $sql = "INSERT INTO productos (NProducto, Descripcion, Precio, Stock, NCategoria, enlace, estado) VALUES ('$name', '$description', '$price', '$stock', '$category', '$enlace', '$status')";
    }
    if ($conn->query($sql) === TRUE) {
        echo "Success";
    } else {
        echo "Error: " . $conn->error;
    }
}

// Operación para eliminar productos
if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    parse_str(file_get_contents("php://input"), $data);
    $id = intval($data['IdProduct']);
    $sql = "DELETE FROM productos WHERE IdProduct='$id'";
    if ($conn->query($sql) === TRUE) {
        echo "Success";
    } else {
        echo "Error: " . $conn->error;
    }
}

$conn->close();
?>
