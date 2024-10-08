document.addEventListener('DOMContentLoaded', function () {
    const productForm = document.getElementById('productForm');
    const productsContainer = document.getElementById('productsContainer');
    const categoryFilter = document.getElementById('categoryFilter');
    const categorySelect = document.getElementById('category');
    const roleLabel = document.querySelector('label[for="RA"]');
    const userRole = roleLabel ? roleLabel.textContent.trim() : '';
    let editingProductId = null;

    // Función para limpiar el formulario
    function resetForm() {
        productForm.reset();
        document.getElementById('productId').value = '';
        document.getElementById('productModalLabel').textContent = 'Agregar Producto';
    }

    // Cargar productos y categorías
    function loadProducts() {
        fetch('php/GPs.php?action=get_products')
            .then(response => response.json())
            .then(data => {
                renderProducts(data);
            });
    }

    function loadCategories() {
        fetch('php/GPs.php?action=get_categories')
            .then(response => response.json())
            .then(data => {
                data.forEach(category => {
                    const option = document.createElement('option');
                    option.value = category;
                    option.textContent = category;
                    categorySelect.appendChild(option);
                    categoryFilter.appendChild(option.cloneNode(true));
                });
            });
    }

    // Renderizar productos
    function renderProducts(products) {
        productsContainer.innerHTML = '';
        products.forEach(product => {
            const col = document.createElement('div');
            col.className = 'col-md-4 mb-4';
            col.innerHTML = `
                <div class="card">
                    <img src="${product.enlace}" class="card-img-top" alt="${product.NProducto}">
                    <div class="card-body">
                        <h5 class="card-title">${product.NProducto}</h5>
                        <p class="card-text">${product.Descripcion}</p>
                        <p class="card-text"><strong>Precio:</strong> ${product.Precio}</p>
                        <p class="card-text"><strong>Stock:</strong> ${product.Stock}</p>
                        <p class="card-text"><strong>Categoría:</strong> ${product.NCategoria}</p>
                        <p class="card-text"><strong>Estado:</strong> ${product.estado == 1 ? 'Activo' : 'Inactivo'}</p>

                        <button class="btn btn-warning" onclick="editProduct(${product.IdProduct})">Editar</button>
                        <button class="btn btn-danger" ${userRole === 'Cajero' ? 'disabled' : ''} onclick="deleteProduct(${product.IdProduct})">Eliminar</button>
                    </div>
                </div>
            `;
            productsContainer.appendChild(col);
        });
    }

    // Función para editar producto
    window.editProduct = function (IdProduct) {
        fetch(`php/GPs.php?action=get_product&IdProduct=${IdProduct}`)
            .then(response => response.json())
            .then(product => {
                if (product) {
                    document.getElementById('name').value = product.NProducto;
                    document.getElementById('description').value = product.Descripcion;
                    document.getElementById('price').value = product.Precio;
                    document.getElementById('stock').value = product.Stock;
                    document.getElementById('category').value = product.NCategoria;
                    document.getElementById('enlace').value = product.enlace;
                    document.getElementById('estado').value = product.estado;
                    document.getElementById('productId').value = product.IdProduct;
                    document.getElementById('productModalLabel').textContent = 'Editar Producto';
                    $('#productModal').modal('show');
                }
            });
    };

    // Función para eliminar producto
    window.deleteProduct = function(id) {
        if (userRole === 'Cajero') {
            alert("No tienes permiso para eliminar productos.");
            return; // Salir de la función si el rol es "Cajero"
        }

        if (!confirm('¿Estás seguro de que deseas eliminar este producto?')) return;

        fetch('php/GPs.php', {
            method: 'DELETE',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: new URLSearchParams({ IdProduct: id })
        })
        .then(response => response.json())
        .then(data => {
            alert(data.message);
            if (data.status === 'success') {
                loadProducts();
            }
        })
        .catch(error => console.error('Error:', error));
    };

    // Manejar el formulario de productos
    productForm.addEventListener('submit', function (e) {
        e.preventDefault();
        const IdProduct = document.getElementById('productId').value;
        const NProducto = document.getElementById('name').value;
        const Descripcion = document.getElementById('description').value;
        const Precio = document.getElementById('price').value;
        const Stock = document.getElementById('stock').value;
        const NCategoria = document.getElementById('category').value;
        const enlace = document.getElementById('enlace').value;
        const estado = document.getElementById('estado').value;

        const data = {
            IdProduct: IdProduct,
            NProducto: NProducto,
            Descripcion: Descripcion,
            Precio: Precio,
            Stock: Stock,
            NCategoria: NCategoria,
            enlace: enlace,
            estado: estado
        };

        fetch('php/GPs.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: new URLSearchParams(data)
        })
        .then(response => response.text())
        .then(result => {
            const message = IdProduct ? 'Modificado con éxito' : 'Añadido con éxito';
            alert(message);
            $('#productModal').modal('hide');
            loadProducts();
        });
    });

    // Filtrar productos por categoría
    categoryFilter.addEventListener('change', function () {
        const selectedCategory = this.value;
        fetch('php/GPs.php?action=get_products')
            .then(response => response.json())
            .then(products => {
                const filteredProducts = selectedCategory 
                    ? products.filter(p => p.NCategoria === selectedCategory)
                    : products;
                renderProducts(filteredProducts);
            });
    });

    // Al abrir el modal, asegúrate de limpiar el formulario
    $('#addProductBtn').on('click', function () {
        resetForm();
        $('#productModal').modal('show');
    });

    // Al cerrar el modal, limpia el formulario
    $('#productModal').on('hidden.bs.modal', function () {
        resetForm();
    });

    // Inicializar datos
    loadCategories();
    loadProducts();
});
