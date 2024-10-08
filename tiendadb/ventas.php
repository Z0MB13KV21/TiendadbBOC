<?php
require_once 'src/db/verificarRol.php';
include 'Configuracion.php';

if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}

$categoryQuery = $db->query("SELECT DISTINCT NCategoria FROM categorias ORDER BY IdCateg");
if ($categoryQuery === false) {
    die("Error en la consulta de categorías: " . $db->error);
}

$query = $db->query("SELECT * FROM productos WHERE estado = 1 ORDER BY IdProduct DESC LIMIT 10");
if ($query === false) {
    die("Error en la consulta de productos: " . $db->error);
}
?>

<!DOCTYPE html>
<html lang="es-ES">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
  
    <link rel="stylesheet" href="public/css/TIndex.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css">
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  
    <link rel="icon" href="https://i.pinimg.com/originals/68/ea/a5/68eaa5f9c3a7ed7e12d0b13b20a6f0fb.jpg">
    <title>Ventas | BOC</title>
  
    <link href="https://fonts.googleapis.com/css?family=Dancing+Script|Raleway:500,600&display=swap" rel="stylesheet">
  
    <style>
        .container {
            padding: 20px;
        }

        .cart-link {
            width: 100%;
            text-align: right;
            display: block;
            font-size: 22px;
        }

        .principalAU {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .principalAU h2 {
            color: #ff0722;
            margin-bottom: 15px;
        }

        .principalAU p {
            color: #404040;
            line-height: 1.6;
        }

        .principalAU ul {
            list-style-type: none;
            padding: 0;
        }

        .principalAU ul li {
            margin-bottom: 10px;
        }

        .principalAU ul li a {
            color: #ff0722;
            text-decoration: none;
        }

        .principalAU ul li a:hover {
            text-decoration: underline;
        }

        .ubicacion {
            height: 400px;
            border: 1px solid #ddd;
            border-radius: 8px;
        }

        h1 {
            text-align: center !important;
        }

        .ubicacionAU {
            width: 80%;
            border: 1px solid #999;
            background: #ddd;
            border-radius: 20px 20px 30px;
            display: block;
            margin: auto;
            align-items: center;
            text-align: center;
        }

        #submenu {
            position: absolute;
            top: 100%;
            height: auto;
            right: 0;
            z-index: 1050;
            background-color: white;
            border: 1px solid #ccc;
            display: none;
        }

        #loginSM, #perfilSM, #cerrarSesionSM, #nombreUsuario {
            display: none;
        }

        .select-category {
            max-width: 40%; 
        }

        .select-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            margin-bottom: 1rem;
        }
    </style>
</head>

<body>
    <header class="text-white py-3">
        <div class="container d-flex justify-content-between align-items-center">
            <h1 class="h3">BOC</h1>
            <nav class="navbar navbar-expand-lg navbar-light">
                <div class="collapse navbar-collapse">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item"><a class="nav-link" href="index.php">Inicio</a></li>
                        <li class="nav-item"><a class="nav-link" >Ventas y servicios</a></li>
                        <li class="nav-item"><a class="nav-link" href="sobrenosotros.php">Sobre Nosotros</a></li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" id="logout-link">
                                <img class="logout" src="public/img/logout.png" alt="Logout">
                            </a>
                        </li>
                        <div id="submenu" class="submenu-container list-group hidden">
                            <li class="list-group-item">
                                <a class="SesionActiva" id="nombreUsuario" style="color:#ff0722!important">Usuario</a>
                            </li>
                            <li id="loginSM" class="list-group-item"><a href="log.php">Iniciar Sesion</a></li>
                            <li id="perfilSM" class="list-group-item"><a href="perfil.php">Perfil</a></li>
                            <li id="cerrarSesionSM"class="list-group-item"><button class="btn btn-danger mt-3" id="logout-button">Cerrar sesión</button></li>
                        </div>
                    </ul>
                </div>
            </nav>

            <div class="text-center">
                <img class="logo" src="https://i.pinimg.com/originals/68/ea/a5/68eaa5f9c3a7ed7e12d0b13b20a6f0fb.jpg" alt="Logo Ticotech" width="200" height="150">
                <label class="label" id="nombreUsuario"></label>
            </div>
        </div>
    </header>
<br>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <ul class="nav nav-pills">
                    <li class="nav-item">
                        <a class="nav-link active" href="index.php">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="VerCarta.php">Carrito de Compras</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="Pagos.php">Pagar</a>
                    </li>
                </ul>
            </div>

            <div class="card-body">
                <h1>Productos disponibles</h1>
                <a href="VerCarta.php" class="cart-link" title="Ver Carta"><i class="glyphicon glyphicon-shopping-cart"></i></a>

                <!-- Select para categorías -->
                <div class="mb-4">
                    <div class="select-container">
                        <select id="category-select" class="form-control select-category">
                            <option value="">Todas las categorías</option>
                            <?php
                            if ($categoryQuery->num_rows > 0) {
                                while ($category = $categoryQuery->fetch_assoc()) {
                                    echo '<option value="' . htmlspecialchars($category['NCategoria']) . '">' . htmlspecialchars($category['NCategoria']) . '</option>';
                                }
                            }
                            ?>
                        </select>
                    </div>
                </div>

                <div id="products" class="row">
    <?php
    // Muestra productos
    if ($query->num_rows > 0) {
        while ($row = $query->fetch_assoc()) {
            // Asignar un ID único al modal
            $modalId = 'productModal' . $row['IdProduct'];
    ?>
            <div class="col-lg-4 mb-4 product-card" data-category="<?php echo htmlspecialchars($row['NCategoria']); ?>">
                <div class="card">
                    <img src="<?php echo htmlspecialchars($row['enlace']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($row['NProducto']); ?>" style="width: 200px; height: 200px;">
                    <div class="card-body">
                        <h4 class="card-title"><?php echo htmlspecialchars($row["NProducto"]); ?></h4>
                        <p class="lead">Precio: <?php echo htmlspecialchars($row["Precio"]) . ' Colones'; ?></p>
                        <div class="row">
                            <div class="col-md-12 text-center">
                <!-- Botón para abrir el modal -->
                <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#<?php echo $modalId; ?>">
                                    Ver Detalles
                                </button>
                                <?php if ($row["Stock"] > 0) { ?>
                                                    <a class="btn btn-success" href="AccionCarta.php?action=addToCart&id=<?php echo $row["IdProduct"]; ?>">Agregar al carrito</a>
                                                <?php } else { ?>
                                                    <button class="btn btn-danger" disabled>Sin Stock</button>
                                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="<?php echo $modalId; ?>" tabindex="-1" aria-labelledby="<?php echo $modalId; ?>Label" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="<?php echo $modalId; ?>Label"><?php echo htmlspecialchars($row["NProducto"]); ?></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <!-- Imagen del producto a la izquierda -->
                                <div class="col-md-4">
                                    <img src="<?php echo htmlspecialchars($row['enlace']); ?>" class="img-fluid mb-3" alt="<?php echo htmlspecialchars($row['NProducto']); ?>">
                                </div>
                                <!-- Descripción y precio a la derecha -->
                                <div class="col-md-8">
                                    <p>Descripción: <?php echo htmlspecialchars($row["Descripcion"]); ?></p>
                                    <p class="lead">Precio: <?php echo htmlspecialchars($row["Precio"]) . ' Colones'; ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            <!-- Verificar si el producto está en stock -->
                            <?php if ($row["Stock"] > 0) { ?>
                                <a class="btn btn-success" href="AccionCarta.php?action=addToCart&id=<?php echo $row["IdProduct"]; ?>">Agregar al carrito</a>
                            <?php } else { ?>
                                <button class="btn btn-danger" disabled>Sin Stock</button>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>

    <?php }
    } else { ?>
        <p>No se encontraron productos.</p>
    <?php } ?>
</div>
            </div>
        </div>
    </div>
    <script src="public/js/sublog.js"></script>
    <script>
        // Filtro por categoría
        document.getElementById('category-select').addEventListener('change', function() {
            var selectedCategory = this.value;
            var productCards = document.querySelectorAll('.product-card');
            productCards.forEach(function(card) {
                var productCategory = card.getAttribute('data-category');
                if (selectedCategory === "" || productCategory === selectedCategory) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        });
 
document.getElementById('logout-button').addEventListener('click', function() {
    fetch('src/db/logout.php?action=logout', {
        method: 'GET', // Método GET ya que estamos usando query string
    })
    .then(response => response.text()) // Esperar una respuesta de texto
    .then(text => {
        if (text === 'success') {
            // Limpiar el localStorage
            localStorage.removeItem('nombreUsuario');
            localStorage.removeItem('userRole');

            // Mostrar un mensaje de éxito
            alert('Has cerrado sesión con éxito');

            // Redirigir al usuario a la página principal
            window.location.href = '/tiendadb/index.php';
        } else {
            alert('Error al cerrar sesión');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Error al cerrar sesión');
    });
});

</script>
</body>
</html>
