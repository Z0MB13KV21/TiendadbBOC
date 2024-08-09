<?php
// Incluye la clase del carrito de compras
// La clase Cart maneja la lógica del carrito, como agregar, actualizar y eliminar artículos
include 'La-carta.php';

// Crea una instancia de la clase Cart
$cart = new Cart;
?>
<!DOCTYPE html>
<html lang="es-ES">

<head>
<link rel="icon" href="https://i.pinimg.com/originals/68/ea/a5/68eaa5f9c3a7ed7e12d0b13b20a6f0fb.jpg">
    <title>Ver Carrito - Tutorial de Carrito de Compras en PHP</title>
    <meta charset="utf-8">
    <!--  Bootstrap para el diseño responsivo y jQuery para manipulación del DOM -->
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="public/css/TIndex.css">
    <style>
        .container {
            padding: 20px; /* Espaciado interno para el contenedor */
        }

        input[type="number"] {
            width: 50%; /* Ancho del campo de entrada para la cantidad */
        }
        h1{text-align: center !important}
        html, body {
    height: 100%; 
    margin: 0;
    display: flex; 
    justify-content: center; 
    align-items: center;
}

.container {
    text-align: center; /* Opcional: centra el texto dentro del contenedor */
}

    </style>
    <script>
        // Función para actualizar la cantidad de un artículo en el carrito
        function updateCartItem(obj, id) {
            $.get("cartAction.php", {
                action: "updateCartItem", // Acción para actualizar el artículo
                id: id, // ID del artículo
                qty: obj.value // Nueva cantidad del artículo
            }, function(data) {
                // Cuando la respuesta es 'ok', recargar la página para actualizar la vista
                if (data == 'ok') {
                    location.reload();
                } else {
                    // Muestra un mensaje de error si la actualización falla
                    alert('Actualización del carrito fallida, por favor intenta nuevamente.');
                }
            });
        }
    </script>
</head>

<body>
    
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading">
                <!-- Barra de navegación con enlaces a otras secciones -->
                <ul class="nav nav-pills">
                    <li role="presentation"><a href="Ventas.php">Inicio</a></li>
                    <li role="presentation" class="active"><a href="VerCarta.php">Carrito de Compras</a></li>
                    <li role="presentation"><a href="Pagos.php">Pagar</a></li>
                </ul>
            </div>

            <div class="panel-body">
                <h1>Carrito de compras</h1>
                <!-- Tabla para mostrar los artículos del carrito -->
                <table class="table">
                    <thead>
                        <tr>
                            <th>Producto</th>
                            <th>Precio</th>
                            <th>Cantidad</th>
                            <th>Sub total</th>
                            <th>&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Verifica si el carrito tiene artículos
                        if ($cart->total_items() > 0) {
                            // Obtiene los artículos del carrito desde la sesión
                            $cartItems = $cart->contents();
                            foreach ($cartItems as $item) {
                        ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($item["name"]); ?></td>
                                    <td><?php echo htmlspecialchars($item["price"]) . ' Colones'; ?></td>
                                    <td>
                                        <!-- Campo para actualizar la cantidad del artículo -->
                                        <input type="number" class="form-control text-center" value="<?php echo htmlspecialchars($item["qty"]); ?>" onchange="updateCartItem(this, '<?php echo htmlspecialchars($item["rowid"]); ?>')">
                                    </td>
                                    <td><?php echo htmlspecialchars($item["subtotal"]) . ' Colones'; ?></td>
                                    <td>
                                        <!-- Enlace para eliminar el artículo del carrito -->
                                        <a href="AccionCarta.php?action=removeCartItem&id=<?php echo htmlspecialchars($item["rowid"]); ?>" class="btn btn-danger" onclick="return confirm('¿Confirma eliminar?')"><i class="glyphicon glyphicon-trash"></i></a>
                                    </td>
                                </tr>
                            <?php }
                        } else { ?>
                            <tr>
                                <td colspan="5">
                                    <p>No has solicitado ningún producto.....</p>
                                </td>
                            <?php } ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <!-- Enlace para volver a la tienda -->
                            <td><a href="Ventas.php" class="btn btn-warning"><i class="glyphicon glyphicon-menu-left"></i> Volver a la tienda</a></td>
                            <td colspan="2"></td>
                            <?php if ($cart->total_items() > 0) { ?>
                                <!-- Muestra el total y el enlace para proceder al pago si hay artículos en el carrito -->
                                <td class="text-center"><strong>Total <?php echo htmlspecialchars($cart->total()) . ' Colones'; ?></strong></td>
                                <td><a href="Pagos.php" class="btn btn-success btn-block">Pagos <i class="glyphicon glyphicon-menu-right"></i></a></td>
                            <?php } ?>
                        </tr>
                    </tfoot>
                </table>

            </div>
        </div>
    </div>
</body>

</html>
