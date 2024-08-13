<?php
require_once 'src/db/verificarRol.php';
// Incluye la clase del carrito de compras
include 'La-carta.php';

// Crea una instancia de la clase Cart
$cart = new Cart;

// Incluye el archivo de configuración de la base de datos
include 'Configuracion.php';

// Función para obtener el stock de un producto
function getStock($productId) {
    global $db;
    $query = $db->query("SELECT Stock FROM productos WHERE IdProduct = ".$productId);
    $row = $query->fetch_assoc();
    return $row['Stock'];
}
?>
<!DOCTYPE html>
<html lang="es-ES">

<head>
    <link rel="icon" href="https://i.pinimg.com/originals/68/ea/a5/68eaa5f9c3a7ed7e12d0b13b20a6f0fb.jpg">
    <title>Carrito | BOC</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="public/css/TIndex.css">
    <style>
        .container {
            padding: 20px; /* Espaciado interno del contenedor principal */
        }

        input[type="number"] {
            width: 50%;
        }

        h1 {
            text-align: center !important;
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
        // Función para actualizar la cantidad de un artículo en el carrito
        function updateCartItem(obj, id, stock) {
            var qty = obj.value;
            if (qty > stock) {
                alert('No hay suficiente stock. La cantidad ha sido ajustada al máximo disponible.');
                obj.value = stock;
                qty = stock;
            }
            $.get("AccionCarta.php", {
                action: "updateCartItem",
                id: id,
                qty: qty
            }, function(data) {
                if (data == 'ok') {
                    location.reload();
                } else {
                    alert('Actualización del carrito fallida, por favor intenta nuevamente.');
                }
            });
        }
    </script>
</head>
<script src="public/js/sublog.js"></script>


<body>
    <div class="container">
    <header>
                <img class="logo" src="https://i.pinimg.com/originals/68/ea/a5/68eaa5f9c3a7ed7e12d0b13b20a6f0fb.jpg" alt="Logo Ticotech" width="250" height="150">
    </header>
        <div class="panel panel-default">
            <div class="panel-heading">
                <ul class="nav nav-pills">
                    <li role="presentation"><a href="ventas.php">Inicio</a></li>
                    <li role="presentation" class="active"><a href="VerCarta.php">Carrito de Compras</a></li>
                    <li role="presentation"><a href="Pagos.php">Pagar</a></li>
                </ul>
            </div>

            <div class="panel-body">
                <h1>Carrito de compras</h1>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Producto</th>
                            <th>Precio</th>
                            <th>Cantidad</th>
                            <th>Stock Disponible</th>
                            <th>Sub total</th>
                            <th>&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($cart->total_items() > 0) {
                            $cartItems = $cart->contents();
                            foreach ($cartItems as $item) {
                                $stock = getStock($item["id"]);
                        ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($item["name"]); ?></td>
                                    <td><?php echo htmlspecialchars($item["price"]) . ' Colones'; ?></td>
                                    <td>
                                        <input type="number" class="form-control text-center" value="<?php echo htmlspecialchars($item["qty"]); ?>" onchange="updateCartItem(this, '<?php echo htmlspecialchars($item['rowid']); ?>', <?php echo $stock; ?>)">
                                    </td>
                                    <td><?php echo $stock; ?></td>
                                    <td><?php echo htmlspecialchars($item["subtotal"]) . ' Colones'; ?></td>
                                    <td>
                                        <a href="AccionCarta.php?action=removeCartItem&id=<?php echo htmlspecialchars($item["rowid"]); ?>" class="btn btn-danger" onclick="return confirm('¿Confirma eliminar?')"><i class="glyphicon glyphicon-trash"></i></a>
                                    </td>
                                </tr>
                            <?php }
                        } else { ?>
                            <tr>
                                <td colspan="6">
                                    <p>No has solicitado ningún producto.....</p>
                                </td>
                            <?php } ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td><a href="ventas.php" class="btn btn-warning"><i class="glyphicon glyphicon-menu-left"></i> Volver a la tienda</a></td>
                            <td colspan="3"></td>
                            <?php if ($cart->total_items() > 0) { ?>
                                <td class="text-center"><strong>Total <?php echo htmlspecialchars($cart->total()) . ' Colones'; ?></strong></td>
                                <td><a href="Pagos.php" class="btn btn-success btn-block">Pagos <i class="glyphicon glyphicon-menu-right"></i></a></td>
                            <?php } ?>
                        </tr>
                    </tfoot>
                </table>
                <footer class="text-white py-3 mt-4">
                            <div class="container text-center">
                                <p>&copy; 2024 BOC. Todos los derechos reservados.</p>
                            </div>
                        </footer>
            </div>
        </div>

    </div>
</body>

</html>
