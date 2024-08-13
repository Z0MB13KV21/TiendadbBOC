<?php
require_once 'src/db/verificarRol.php';
// Incluye el archivo de configuración de la base de datos
include 'Configuracion.php';

// Incluye la clase del carrito de compras
include 'La-carta.php';

// Crea una instancia de la clase Cart
$cart = new Cart;

// Si el carrito está vacío, redirige al usuario a la página de ventas
if ($cart->total_items() <= 0) {
    header("Location: ventas.php");
    exit();
}

// Obtiene el total del carrito
$total = $cart->total();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <link rel="icon" href="https://i.pinimg.com/originals/68/ea/a5/68eaa5f9c3a7ed7e12d0b13b20a6f0fb.jpg">
    <title>Pago | BOC</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="public/css/TIndex.css">
    <style>
        .container {
            padding: 20px;
            max-width: 600px;
            margin: auto;
        }
        .form-group {
            margin-bottom: 1.5rem;
        }
        label {
            position: static !important;
        }
        .table {
            width: 65%; /* Ancho de la tabla para mostrar el carrito de compras */
            float: left; /* Tabla a la izquierda */
        }
        h1 { text-align: center !important; }
        html, body {
            height: 100%; 
            margin: 0;
            display: flex; 
            justify-content: center; 
            align-items: center;
        }
    </style>
    <script>
        function validateForm() {
            var cardNumber = document.getElementById('cardNumber').value;
            var cvv = document.getElementById('cvv').value;
            var expiryMonth = document.getElementById('expiryMonth').value;
            var expiryYear = document.getElementById('expiryYear').value;

            // Validación básica de tarjeta y campos
            if (cardNumber.length < 15 || cardNumber.length > 19) {
                alert('Número de tarjeta debe tener entre 15 y 19 dígitos.');
                return false;
            }

            if (cvv.length !== 3 && cvv.length !== 4) {
                alert('CVV debe tener 3 o 4 dígitos.');
                return false;
            }

            if (expiryMonth < 1 || expiryMonth > 12) {
                alert('Mes de vencimiento no válido.');
                return false;
            }

            return true;
        }

        function processPayment() {
            if (!validateForm()) {
                return;
            }

            var cardNumber = document.getElementById('cardNumber').value;
            var cvv = document.getElementById('cvv').value;
            var expiryMonth = document.getElementById('expiryMonth').value;
            var expiryYear = document.getElementById('expiryYear').value;

            var total = <?php echo json_encode($total); ?>;

            // Obtener el IdUser desde localStorage
            var idUser = localStorage.getItem('IdUser');

            // Realizar la actualización del saldo y el stock en el servidor
            $.post('ProcesarPago.php', {
                cardNumber: cardNumber,
                cvv: cvv,
                expiryMonth: expiryMonth,
                expiryYear: expiryYear,
                total: total,
                idUser: idUser  // Enviar IdUser al servidor
            }, function() {
                // Mostrar mensaje de éxito directamente
                document.getElementById('message').innerText = 'Pago realizado exitosamente.';
            }).fail(function() {
                // Mostrar mensaje de error en caso de fallo
                document.getElementById('message').innerText = 'Error al procesar el pago.';
            });
        }
    </script>
</head>

<body>
    <div class="container">
        <header>
            <img class="logo" src="https://i.pinimg.com/originals/68/ea/a5/68eaa5f9c3a7ed7e12d0b13b20a6f0fb.jpg" alt="Logo Ticotech" width="250" height="150">
        </header>
        <h1>Pasarela de Pago</h1>
        <form onsubmit="event.preventDefault(); processPayment();">
            <div class="form-group">
                <label for="cardNumber">Número de Tarjeta</label>
                <input type="text" id="cardNumber" class="form-control" maxlength="19" required>
            </div>
            <div class="form-group">
                <label for="cvv">CVV</label>
                <input type="text" id="cvv" class="form-control" maxlength="4" required>
            </div>
            <div class="form-group">
                <label for="expiryMonth">Mes de Vencimiento</label>
                <select id="expiryMonth" class="form-control" required>
                    <option value="" disabled selected>Mes</option>
                    <?php for ($i = 1; $i <= 12; $i++) {
                        echo "<option value=\"$i\">$i</option>";
                    } ?>
                </select>
            </div>
            <div class="form-group">
                <label for="expiryYear">Año de Vencimiento</label>
                <select id="expiryYear" class="form-control" required>
                    <option value="" disabled selected>Año</option>
                    <option value="2025">2025</option>
                    <option value="2026">2026</option>
                    <option value="2027">2027</option>
                    <option value="2028">2028</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Pagar</button>
            <div id="message" class="alert alert-info mt-3" role="alert"></div>
            <footer class="text-white py-3 mt-4">
                <div class="container text-center">
                    <p>&copy; 2024 BOC. Todos los derechos reservados.</p>
                </div>
            </footer>
        </form>
    </div>
</body>

</html>
