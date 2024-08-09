<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="https://i.pinimg.com/originals/68/ea/a5/68eaa5f9c3a7ed7e12d0b13b20a6f0fb.jpg">
    <title>Gestión - TiendaDB</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:wght@400;700&display=swap" rel="stylesheet">
    <style>
        .iframe-container {
            height: 80vh; /* Ajusta la altura del iframe */
            overflow: hidden;
            position: relative;
            border: 1px solid #ddd; /* Borde opcional para el contenedor del iframe */
        }
        iframe {
            border: none;
            width: 100%;
            height: 100%;
            position: absolute;
            top: 0;
            left: 0;
        }
    </style>
</head>
<body>
    <div class="container mt-4">
        <h1 class="text-center mb-4">Gestión de Productos y Usuarios</h1>
        <div class="row">
            <div class="col-md-3">
                <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    <a class="nav-link active" id="v-pills-products-tab" data-toggle="pill" href="#products" role="tab" aria-controls="products" aria-selected="true">Productos</a>
                    <a class="nav-link" id="v-pills-users-tab" data-toggle="pill" href="#users" role="tab" aria-controls="users" aria-selected="false">Usuarios</a>
                </div>
            </div>
            <div class="col-md-9">
                <div class="tab-content" id="v-pills-tabContent">
                    <!-- Productos -->
                    <div class="tab-pane fade show active iframe-container" id="products" role="tabpanel" aria-labelledby="v-pills-products-tab">
                        <iframe src="productos.php"></iframe>
                    </div>
                    
                    <!-- Usuarios -->
                    <div class="tab-pane fade iframe-container" id="users" role="tabpanel" aria-labelledby="v-pills-users-tab">
                        <iframe src="usuarios.php"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Incluye jQuery, Popper.js y Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- Incluye Axios -->
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <!-- Incluye tu archivo JS -->
    <script src="scripts/main.js"></script>
</body>
</html>
