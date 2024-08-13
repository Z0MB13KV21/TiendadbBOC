<?php
// Establece la zona horaria predeterminada
date_default_timezone_set("America/Costa_Rica");

// archivo de la clase del carrito
include 'La-carta.php';
$cart = new Cart;

// archivo de configuración de la base de datos
include 'Configuracion.php';

// Verifica si se ha enviado una acción y que no esté vacía
if(isset($_REQUEST['action']) && !empty($_REQUEST['action'])){
    // Si la acción es agregar al carrito y hay un ID de producto
    if($_REQUEST['action'] == 'addToCart' && !empty($_REQUEST['id'])){
        $productID = $_REQUEST['id'];
        // Obtiene detalles del producto desde la base de datos
        $query = $db->query("SELECT * FROM productos WHERE IdProduct = ".$productID);
        $row = $query->fetch_assoc();
        $itemData = array(
            'id' => $row['IdProduct'],
            'name' => $row['NProducto'],
            'price' => $row['Precio'],
            'qty' => 1
        );
        
        // Inserta el producto en el carrito
        $insertItem = $cart->insert($itemData);
        // Redirige a la página correspondiente según el resultado de la inserción
        $redirectLoc = $insertItem ? 'VerCarta.php' : 'ventas.php';
        header("Location: ".$redirectLoc);
    // Si la acción es actualizar un producto en el carrito y hay un ID de producto
    } elseif($_REQUEST['action'] == 'updateCartItem' && !empty($_REQUEST['id'])){
        $itemData = array(
            'rowid' => $_REQUEST['id'],
            'qty' => $_REQUEST['qty']
        );
        // Actualiza la cantidad del producto en el carrito
        $updateItem = $cart->update($itemData);
        // Devolve el resultado de la actualización
        echo $updateItem ? 'ok' : 'err'; die;
    // Si la acción es eliminar un producto del carrito y hay un ID de producto
    } elseif($_REQUEST['action'] == 'removeCartItem' && !empty($_REQUEST['id'])){
        // Elimina el producto del carrito
        $deleteItem = $cart->remove($_REQUEST['id']);
        // Redirige a la página del carrito
        header("Location: VerCarta.php");
    // Si la acción es realizar un pedido, el carrito no está vacío y hay un ID de cliente en la sesión
    } elseif($_REQUEST['action'] == 'placeOrder' && $cart->total_items() > 0 && !empty($_SESSION['sessCustomerID'])){
        // Inserta detalles del pedido en la base de datos
        $insertOrder = $db->query("INSERT INTO orden (customer_id, total_price, created, modified) VALUES ('".$_SESSION['sessCustomerID']."', '".$cart->total()."', '".date("Y-m-d H:i:s")."', '".date("Y-m-d H:i:s")."')");
        
        if($insertOrder){
            $orderID = $db->insert_id;
            $sql = '';
            // Obtiene los elementos del carrito
            $cartItems = $cart->contents();
            // Crea las consultas para insertar los artículos del pedido
            foreach($cartItems as $item){
                $sql .= "INSERT INTO orden_articulos (order_id, product_id, quantity) VALUES ('".$orderID."', '".$item['id']."', '".$item['qty']."');";
            }
            // Inserta artículos del pedido en la base de datos
            $insertOrderItems = $db->multi_query($sql);
            
            if($insertOrderItems){
                // Destruye el carrito después de completar el pedido
                $cart->destroy();
                // Redirige a la página de éxito del pedido
                header("Location: OrdenExito.php?id=$orderID");
            } else {
                // Redirige a la página de pagos en caso de error
                header("Location: Pagos.php");
            }
        } else {
            // Redirige a la página de pagos en caso de error
            header("Location: Pagos.php");
        }
    } else {
        // Redirige a la página de ventas si la acción no es reconocida
        header("Location: ventas.php");
    }
} else {
    // Redirige a la página de ventas si no hay acción especificada
    header("Location: ventas.php");
}
?>
