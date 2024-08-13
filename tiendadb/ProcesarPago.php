<?php
// Incluye el archivo de configuración de la base de datos
include 'Configuracion.php';

// Incluye la clase del carrito de compras
include 'La-carta.php';

// Crea una instancia de la clase Cart
$cart = new Cart;

// Verifica si el carrito no está vacío
if ($cart->total_items() <= 0) {
    echo 'error';
    exit();
}

// Obtiene los datos del POST
$cardNumber = $_POST['cardNumber'];
$cvv = $_POST['cvv'];
$expiryMonth = $_POST['expiryMonth'];
$expiryYear = $_POST['expiryYear'];
$total = $_POST['total'];
$idUser = $_POST['idUser'];  // Obtener IdUser desde POST

// Usa consultas preparadas para obtener el saldo del banco
$stmt = $db->prepare("SELECT saldo FROM banco WHERE tarjeta = ? AND CVV = ? AND mes = ? AND año = ?");
$stmt->bind_param("ssss", $cardNumber, $cvv, $expiryMonth, $expiryYear);
$stmt->execute();
$result = $stmt->get_result();

// Verifica si se obtuvo un saldo
if ($result->num_rows === 0) {
    echo 'error';
    exit();
}

$row = $result->fetch_assoc();
$saldo = $row['saldo'];

// Verifica si el saldo es suficiente
if ($saldo < $total) {
    echo 'error';
    exit();
}

// Actualiza el saldo en la base de datos
$newSaldo = $saldo - $total;
$stmt = $db->prepare("UPDATE banco SET saldo = ? WHERE tarjeta = ? AND CVV = ?");
$stmt->bind_param("sss", $newSaldo, $cardNumber, $cvv);
if (!$stmt->execute()) {
    echo 'error';
    exit();
}

// Actualiza el stock de los productos
$cartItems = $cart->contents();
foreach ($cartItems as $item) {
    $productID = $item['id'];
    $quantity = $item['qty'];

    // Usa una consulta preparada para actualizar el stock
    $stmt = $db->prepare("UPDATE productos SET stock = stock - ? WHERE id = ?");
    $stmt->bind_param("ii", $quantity, $productID);
    if (!$stmt->execute()) {
        echo 'error';
        exit();
    }
}

// Inserta el registro en la tabla facturas
$stmt = $db->prepare("INSERT INTO facturas (IdUser, total) VALUES (?, ?)");
$stmt->bind_param("id", $idUser, $total);
if (!$stmt->execute()) {
    echo 'error';
    exit();
}

// Limpia el carrito
$cart->destroy();

// Devuelve una respuesta de éxito
echo 'success';
?>
