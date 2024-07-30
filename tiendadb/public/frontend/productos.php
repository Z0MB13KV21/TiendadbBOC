<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Productos y Categorías - TiendaDB</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:wght@400;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h1 class="text-center mb-4">Gestión de Productos y Categorías</h1>
        <div class="row">
            <div class="col-md-3">
                <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    <!-- Pestañas para productos -->
                    <a class="nav-link active" id="v-pills-create-product-tab" data-toggle="pill" href="#createProduct" role="tab" aria-controls="createProduct" aria-selected="true">Crear Producto</a>
                    <a class="nav-link" id="v-pills-list-product-tab" data-toggle="pill" href="#listProducts" role="tab" aria-controls="listProducts" aria-selected="false">Productos Existentes</a>
                    <a class="nav-link" id="v-pills-edit-product-tab" data-toggle="pill" href="#editProduct" role="tab" aria-controls="editProduct" aria-selected="false" style="display: none;">Editar Producto</a>
                    
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
    <h3>Crear Producto</h3>
    <form id="productForm" class="needs-validation" novalidate>
        <input type="hidden" id="productId">

        <div class="form-group">
            <label for="productName">Nombre del Producto</label>
            <input type="text" class="form-control" id="productName" placeholder="Ingrese el nombre del producto" required>
            <div class="invalid-feedback" id="productName-error">Por favor, ingrese el nombre del producto.</div>
        </div>

        <div class="form-group">
            <label for="productDescription">Descripción</label>
            <textarea class="form-control" id="productDescription" placeholder="Ingrese la descripción" required></textarea>
            <div class="invalid-feedback" id="productDescription-error">Por favor, ingrese una descripción.</div>
        </div>

        <div class="form-group">
            <label for="productPrice">Precio</label>
            <input type="number" step="0.01" class="form-control" id="productPrice" placeholder="Ingrese el precio" required>
            <div class="invalid-feedback" id="productPrice-error">Ingrese un precio válido.</div>
        </div>

        <div class="form-group">
            <label for="productStock">Stock</label>
            <input type="number" class="form-control" id="productStock" placeholder="Ingrese el stock" required>
            <div class="invalid-feedback" id="productStock-error">Ingrese una cantidad de stock válida.</div>
        </div>

        <div class="form-group">
            <label for="productCategory">Categoría</label>
            <select class="form-control" id="productCategory" required>
                <option value="" disabled selected>Seleccione una categoría</option>
                <!-- Aquí se deben agregar las opciones de categorías desde la base de datos -->
            </select>
            <div class="invalid-feedback" id="productCategory-error">Seleccione una categoría.</div>
        </div>

        <div class="form-group">
            <label for="productLink">Enlace</label>
            <input type="text" class="form-control" id="productLink" placeholder="Ingrese el enlace">
            <div class="invalid-feedback" id="productLink-error">Ingrese un enlace válido.</div>
        </div>

        <div class="form-group">
            <label for="productStatus">Estado</label>
            <select class="form-control" id="productStatus" required>
                <option value="" disabled selected>Seleccione un estado</option>
                <option value="1">Activo</option>
                <option value="0">Inactivo</option>
            </select>
            <div class="invalid-feedback" id="productStatus-error">Seleccione un estado.</div>
        </div>

        <button type="submit" class="btn btn-primary" id="saveProductButton">Guardar Producto</button>
    </form>
</div>

<!-- Listar Productos -->
<div class="tab-pane fade" id="listProducts" role="tabpanel" aria-labelledby="v-pills-list-product-tab">
    <h3>Productos Existentes</h3>
    <div id="productCards" class="row">
        <!-- Aquí se cargarán las tarjetas de productos dinámicamente -->
    </div>
</div>

<!-- Editar Producto -->
<div class="tab-pane fade" id="editProduct" role="tabpanel" aria-labelledby="v-pills-edit-product-tab">
    <h3>Editar Producto</h3>
    <form id="editProductForm" class="needs-validation" novalidate>
        <input type="hidden" id="editProductId">

        <div class="form-group">
            <label for="editProductName">Nombre del Producto</label>
            <input type="text" class="form-control" id="editProductName" placeholder="Ingrese el nombre del producto" required>
            <div class="invalid-feedback" id="editProductName-error">Por favor, ingrese el nombre del producto.</div>
        </div>

        <div class="form-group">
            <label for="editProductDescription">Descripción</label>
            <textarea class="form-control" id="editProductDescription" placeholder="Ingrese la descripción" required></textarea>
            <div class="invalid-feedback" id="editProductDescription-error">Por favor, ingrese una descripción.</div>
        </div>

        <div class="form-group">
            <label for="editProductPrice">Precio</label>
            <input type="number" step="0.01" class="form-control" id="editProductPrice" placeholder="Ingrese el precio" required>
            <div class="invalid-feedback" id="editProductPrice-error">Ingrese un precio válido.</div>
        </div>

        <div class="form-group">
            <label for="editProductStock">Stock</label>
            <input type="number" class="form-control" id="editProductStock" placeholder="Ingrese el stock" required>
            <div class="invalid-feedback" id="editProductStock-error">Ingrese una cantidad de stock válida.</div>
        </div>

        <div class="form-group">
            <label for="editProductCategory">Categoría</label>
            <select class="form-control" id="editProductCategory" required>
                <option value="" disabled selected>Seleccione una categoría</option>
                <!-- Aquí se deben agregar las opciones de categorías desde la base de datos -->
            </select>
            <div class="invalid-feedback" id="editProductCategory-error">Seleccione una categoría.</div>
        </div>

        <div class="form-group">
            <label for="editProductLink">Enlace</label>
            <input type="text" class="form-control" id="editProductLink" placeholder="Ingrese el enlace">
            <div class="invalid-feedback" id="editProductLink-error">Ingrese un enlace válido.</div>
        </div>

        <div class="form-group">
            <label for="editProductStatus">Estado</label>
            <select class="form-control" id="editProductStatus" required>
                <option value="" disabled selected>Seleccione un estado</option>
                <option value="1">Activo</option>
                <option value="0">Inactivo</option>
            </select>
            <div class="invalid-feedback" id="editProductStatus-error">Seleccione un estado.</div>
        </div>

        <button type="submit" class="btn btn-primary" id="editSaveProductButton">Guardar Cambios</button>
        <button type="button" class="btn btn-secondary" id="cancelEditProductBtn">Cancelar</button>
    </form>
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

    <script src="scripts/productos.js"></script>
    <script src="scripts/categorias.js"></script>
</body>
</html>
