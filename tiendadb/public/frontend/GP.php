<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="https://i.pinimg.com/originals/68/ea/a5/68eaa5f9c3a7ed7e12d0b13b20a6f0fb.jpg">
    <title>Productos</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet">
    <style>
        /* Establece un tamaño uniforme para los modals */
        .card {
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .card-body {
            flex: 1;
            overflow: hidden;
        }

        /* Ajusta la descripción para que se ajuste al tamaño del contenedor */
        .card-text {
            display: -webkit-box;
            -webkit-line-clamp: 3; /* Número de líneas a mostrar */
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: normal; /* Permite saltos de línea */
        }

        /* Estilos para centrar la imagen en el modal */
        .card-img-top {
            display: block;
            margin-left: auto;
            margin-right: auto;
            width: 100%;
            max-height: 150px;
            object-fit: cover;
        }

        /* Ajusta el tamaño del modal */
        .modal-dialog {
            max-width: 600px; /* Ajusta el tamaño del modal */
        }

        /* Centrar el botón de agregar producto */
        .btn-center {
            display: block;
            margin: 0 auto;
        }

        /* Centrar el formulario y el select */
        .form-group {
            text-align: center;
        }

        /* Estilo para hacer el select más angosto */
        #categoryFilter {
            width: 200px; /* Ajusta este valor según lo necesites */
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="container mt-4">
        <h2 class="text-center">Gestión de Productos</h2>
        <button class="btn btn-primary btn-center" data-toggle="modal" data-target="#productModal">Agregar Producto</button>
        <div class="form-group">
            <label for="categoryFilter">Filtrar por Categoría:</label>
            <select id="categoryFilter" class="form-control">
                <option value="">Todas las categorías</option>
            </select>
        </div>
        <div id="productsContainer" class="row"></div>
    </div>

    <!-- Modal para agregar/editar productos -->
    <div class="modal fade" id="productModal" tabindex="-1" role="dialog" aria-labelledby="productModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="productModalLabel">Agregar Producto</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="productForm">
                        <input type="hidden" id="productId" name="id">
                        <div class="form-group">
                            <label for="name">Nombre:</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="description">Descripción:</label>
                            <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="price">Precio:</label>
                            <input type="number" step="0.01" class="form-control" id="price" name="price" required>
                        </div>
                        <div class="form-group">
                            <label for="stock">Stock:</label>
                            <input type="number" class="form-control" id="stock" name="stock" required>
                        </div>
                        <div class="form-group">
                            <label for="category">Categoría:</label>
                            <select class="form-control" id="category" name="category" required>
                                <!-- Opciones de categorías serán cargadas dinámicamente -->
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="enlace">Enlace de Imagen:</label>
                            <input type="text" class="form-control" id="enlace" name="enlace" required>
                        </div>
                        <div class="form-group">
        <label for="estado">Estado</label>
        <select class="form-control" id="estado" name="estado">
            <option value="1">Activo</option>
            <option value="0">Inactivo</option>
        </select>
    </div>
                        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="scripts/añadir.js"></script>
</body>
</html>
