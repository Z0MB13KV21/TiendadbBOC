<?php
require_once '../../src/db/verificarRol.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="https://i.pinimg.com/originals/68/ea/a5/68eaa5f9c3a7ed7e12d0b13b20a6f0fb.jpg">
    <title>Gestión de Productos y Categorías - TiendaDB</title>
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
        <h1 class="text-center mb-4">Gestión de Productos y Categorías</h1>
        <div class="row">
            <div class="col-md-3">
                <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    <!-- Pestañas para productos -->
                    <a class="nav-link active" id="v-pills-create-product-tab" data-toggle="pill" href="#createProduct" role="tab" aria-controls="createProduct" aria-selected="true">Crear Producto</a>
                    
                    <!-- Pestañas para categorías -->
                    <a class="nav-link" id="v-pills-create-category-tab" data-toggle="pill" href="#createCategory" role="tab" aria-controls="createCategory" aria-selected="false">Crear Categoría</a>
                    <a class="nav-link" id="v-pills-list-category-tab" data-toggle="pill" href="#listCategories" role="tab" aria-controls="listCategories" aria-selected="false">Categorías Existentes</a>
                    <a class="nav-link" id="v-pills-edit-category-tab" data-toggle="pill" href="#editCategory" role="tab" aria-controls="editCategory" aria-selected="false" style="display: none;">Editar Categoría</a>
                </div>
            </div>
            <div class="col-md-9">
                <div class="tab-content" id="v-pills-tabContent">
<!-- Crear Producto -->
<div class="tab-pane fade show active" id="createProduct" role="tabpanel" aria-labelledby="v-pills-create-product-tab">
                    <!-- Productos -->
                    <div class="tab-pane fade show active iframe-container" id="products" role="tabpanel" aria-labelledby="v-pills-products-tab">
                        <iframe src="GP.php"></iframe>
                    </div>
</div>
                  <!-- Crear Categoría -->
<div class="tab-pane fade" id="createCategory" role="tabpanel" aria-labelledby="v-pills-create-category-tab">
    <h3>Crear Categoría</h3>
    <form id="categoryForm" class="needs-validation" novalidate>
        <input type="hidden" id="categoryId">
        
        <div class="form-group">
            <label for="categoryName">Nombre de la Categoría</label>
            <input type="text" class="form-control" id="categoryName" placeholder="Ingrese el nombre de la categoría" required>
            <div class="invalid-feedback" id="categoryName-error">Por favor, ingrese el nombre de la categoría.</div>
        </div>
        
        <div class="form-group">
            <label for="categoryDescription">Descripción</label>
            <input type="text" class="form-control" id="categoryDescription" placeholder="Ingrese una descripción de la categoría" required>
            <div class="invalid-feedback" id="categoryDescription-error">Por favor, ingrese una descripción para la categoría.</div>
        </div>
        
        <button type="submit" class="btn btn-primary">Guardar Categoría</button>
    </form>
</div>

<!-- Listar Categorías -->
<div class="tab-pane fade" id="listCategories" role="tabpanel" aria-labelledby="v-pills-list-category-tab">
    <h3>Categorías Existentes</h3>
    <div id="categoryTable">
        <!-- Aquí se cargarán las categorías dinámicamente -->
    </div>
</div>

<!-- Editar Categoría -->
<div class="tab-pane fade" id="editCategory" role="tabpanel" aria-labelledby="v-pills-edit-category-tab">
    <h3>Editar Categoría</h3>
    <form id="editCategoryForm" class="needs-validation" novalidate>
        <input type="hidden" id="editCategoryId">
        
        <div class="form-group">
            <label for="editCategoryName">Nombre de la Categoría</label>
            <input type="text" class="form-control" id="editCategoryName" placeholder="Ingrese el nombre de la categoría" required>
            <div class="invalid-feedback" id="editCategoryName-error">Por favor, ingrese el nombre de la categoría.</div>
        </div>
        
        <div class="form-group">
            <label for="editCategoryDescription">Descripción</label>
            <input type="text" class="form-control" id="editCategoryDescription" placeholder="Ingrese una descripción de la categoría" required>
            <div class="invalid-feedback" id="editCategoryDescription-error">Por favor, ingrese una descripción para la categoría.</div>
        </div>
        
        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
        <button type="button" class="btn btn-secondary" id="cancelEditCategoryBtn">Cancelar</button>
    </form>
</div>
<!-- Modal -->
<div class="modal fade" id="statusModal" tabindex="-1" aria-labelledby="statusModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="statusModalLabel">Estado</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p id="statusMessage"></p>
      </div>
    </div>
  </div>
</div>

                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <script src="scripts/añadir.js"></script>
    <script src="scripts/categorias.js"></script>
</body>
</html>
