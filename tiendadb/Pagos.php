
<?php
// Incluye el archivo de configuración de la base de datos
include 'Configuracion.php';

// Incluye la clase del carrito de compras
// La clase Cart maneja operaciones como agregar, actualizar, eliminar artículos del carrito y calcular totales.
include 'La-carta.php';

// Crea una instancia de la clase Cart para usar sus métodos
$cart = new Cart;

// Si el carrito está vacío, redirige al usuario a la página de ventas
// Esto asegura que los usuarios no puedan acceder a la página de pagos sin tener artículos en el carrito.
if ($cart->total_items() <= 0) {
    header("Location: Ventas.php");
    exit(); // Finaliza el script para asegurar que no se ejecute más código después de la redirección.
}

// Establece un ID de cliente en la sesión para propósitos de prueba
$_SESSION['sessCustomerID'] = 1;
?>

<!DOCTYPE html>
<html lang="es">

<head>
<link rel="icon" href="https://i.pinimg.com/originals/68/ea/a5/68eaa5f9c3a7ed7e12d0b13b20a6f0fb.jpg">
    <title>Pagos - Tutorial de Carrito de Compras en PHP</title>
    <meta charset="utf-8">
    <!-- Archivos CSS y JavaScript necesarios para el diseño y la funcionalidad -->
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="public/js/sublog.js"></script> <!-- Archivo JavaScript personalizado  -->
    <link rel="stylesheet" href="public/css/TIndex.css">
    <style>
        .container {
            padding: 20px; /* Espaciado interno del contenedor principal */
        }

        .table {
            width: 65%; /* Ancho de la tabla para mostrar el carrito de compras */
            float: left; /* Tabla a la izquierda */
        }
        h1{text-align: center !important}
        .footBtn {
            width: 95%; /* Ancho del contenedor de botones de acción */
            float: left; /* Contenedor a la izquierda */
        }

        .orderBtn {
            float: right; /* Botón de realizar pedido a la derecha */
        }
        html, body {
    height: 100%; 
    margin: 0;
    display: flex; 
    justify-content: center; 
    align-items: center;
}
    </style>
    <script>
        // Script para mostrar el nombre del usuario desde el localStorage cuando se carga la página
        document.addEventListener("DOMContentLoaded", function() {
            var nombreUsuario = localStorage.getItem("nombreUsuario"); // Obtiene el nombre del usuario del localStorage
            if (nombreUsuario) {
                document.getElementById("nombreUsuario").innerText = nombreUsuario; // Muestra el nombre del usuario en el HTML
            }
        });
    </script>
</head>

<body>
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading">
                <!-- Barra de navegación para cambiar entre las diferentes secciones -->
                <ul class="nav nav-pills">
                    <li role="presentation"><a href="Ventas.php">Inicio</a></li>
                    <li role="presentation"><a href="VerCarta.php">Carrito de Compras</a></li>
                    <li role="presentation" class="active"><a href="Pagos.php">Pagar</a></li>
                </ul>
            </div>

            <div class="panel-body">
                <h1>Vista previa de la Orden</h1>
                <p>Nombre del Usuario: <span id="nombreUsuario"></span></p> <!-- Lugar para mostrar el nombre del usuario -->
                <!-- Tabla para mostrar los detalles de los artículos en el carrito -->
                <table class="table">
                    <thead>
                        <tr>
                            <th>Producto</th>
                            <th>Precio</th>
                            <th>Cantidad</th>
                            <th>Sub total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Verifica si hay artículos en el carrito
                        if ($cart->total_items() > 0) {
                            // Obtiene los artículos del carrito desde la sesión
                            $cartItems = $cart->contents();
                            foreach ($cartItems as $item) {
                        ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($item["name"]); ?></td> <!-- Muestra el nombre del producto -->
                                    <td><?php echo htmlspecialchars($item["price"]) . ' Colones'; ?></td> <!-- Muestra el precio del producto -->
                                    <td><?php echo htmlspecialchars($item["qty"]); ?></td> <!-- Muestra la cantidad del producto -->
                                    <td><?php echo htmlspecialchars($item["subtotal"]) . ' Colones'; ?></td> <!-- Muestra el subtotal del producto -->
                                </tr>
                            <?php }
                        } else { ?>
                            <tr>
                                <td colspan="4">
                                    <p>No hay artículos en tu carrito...</p> <!-- Mensaje cuando el carrito está vacío -->
                                </td>
                            <?php } ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3"></td> <!-- Espacio en blanco para alinear el total a la derecha -->
                            <?php if ($cart->total_items() > 0) { ?>
                                <!-- Muestra el total del carrito si hay artículos -->
                                <td class="text-center"><strong>Total <?php echo htmlspecialchars($cart->total()) . ' Colones'; ?></strong></td>
                            <?php } ?>
                        </tr>
                    </tfoot>
                </table>
                <div class="footBtn">
                    <!-- Botones para continuar comprando o realizar el pedido -->
                    <a href="Ventas.php" class="btn btn-warning"><i class="glyphicon glyphicon-menu-left"></i> Continuar Comprando</a>
                    <a href="AccionCarta.php?action=placeOrder" class="btn btn-success orderBtn">Realizar pedido <i class="glyphicon glyphicon-menu-right"></i></a>
                </div>
            </div>
        <!-- Panel cierra -->
    </div>
</body>

</html>
