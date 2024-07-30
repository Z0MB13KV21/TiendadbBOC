document.addEventListener("DOMContentLoaded", function() {
    const productForm = document.getElementById("productForm");
    const editProductForm = document.getElementById("editProductForm");
    const editProductIdField = document.getElementById('editProductId');
    const editProductNameField = document.getElementById('editProductName');
    const editProductDescriptionField = document.getElementById('editProductDescription');
    const editProductPriceField = document.getElementById('editProductPrice');
    const editProductStockField = document.getElementById('editProductStock');
    const editProductCategorySelect = document.getElementById("editProductCategory");
    const editProductLinkField = document.getElementById('editProductLink');
    const editProductStatusSelect = document.getElementById('editProductStatus');
    const editSaveProductButton = document.getElementById('editSaveProductButton');
    const cancelEditProductBtn = document.getElementById('cancelEditProductBtn');
    const productCategorySelect = document.getElementById("productCategory");
    let categories = [];

    function showStatusMessage(message) {
        const statusMessage = document.getElementById("statusMessage");
        statusMessage.textContent = message;
        $('#statusModal').modal('show');
        setTimeout(function() {
            $('#statusModal').modal('hide');
        }, 3800);
    }

    function validateField(field) {
        if (field.checkValidity()) {
            field.classList.remove('is-invalid');
            field.classList.add('is-valid');
        } else {
            field.classList.remove('is-valid');
            field.classList.add('is-invalid');
        }
        checkFormValidity();
    }

    function checkFormValidity() {
        if (productForm) {
            document.getElementById('saveProductButton').disabled = !productForm.checkValidity();
        }
        if (editProductForm) {
            editSaveProductButton.disabled = !editProductForm.checkValidity();
        }
    }

    productForm?.querySelectorAll("input, select, textarea").forEach((field) => {
        field.addEventListener("input", () => validateField(field));
    });

    editProductForm?.querySelectorAll("input, select, textarea").forEach((field) => {
        field.addEventListener("input", () => validateField(field));
    });

    function resetForm(form) {
        form.reset();
        form.querySelectorAll(".is-valid, .is-invalid").forEach((field) => {
            field.classList.remove("is-valid", "is-invalid");
        });
        checkFormValidity();
    }

    function loadProducts() {
        fetch("../index.php/productos/")
            .then(response => response.json())
            .then(products => {
                //console.log("Productos recibidos:", products);
                const productCards = document.getElementById("productCards");
                productCards.innerHTML = "";

                products.forEach(product => {
                    const imageUrl = product.enlace || 'https://fastly.picsum.photos/id/0/5000/3333.jpg?hmac=_j6ghY5fCfSD6tvtcV74zXivkJSPIfR9B8w34XeQmvU';
                    const categoryName = categories.find(cat => cat.IdCateg == product.NCategoria)?.NCategoria || "Categoría no disponible";

                    const productCard = document.createElement("div");
                    productCard.classList.add("col-md-4");
                    productCard.innerHTML = `
                        <div class="card mb-4">
                            <img src="${imageUrl}" class="card-img-top" alt="${product.NProducto || 'Imagen no disponible'}" onerror="this.onerror=null; this.src='https://fastly.picsum.photos/id/0/5000/3333.jpg?hmac=_j6ghY5fCfSD6tvtcV74zXivkJSPIfR9B8w34XeQmvU'">
                            <div class="card-body">
                                <h5 class="card-title">${product.NProducto || "Nombre no disponible"}</h5>
                                <p class="card-text">Id: ${product.IdProduct || "id no disponible"}</p>
                                <p class="card-text">Descripción: ${product.Descripcion || "Descripción no disponible"}</p>
                                <p class="card-text">Precio: ₵${product.Precio || "Precio no disponible"}</p>
                                <p class="card-text">Stock: ${product.Stock || "Stock no disponible"}</p>
                                <p class="card-text">Categoría: ${categoryName}</p>
                                <p class="card-text">Enlace: <a href="${imageUrl}" target="_blank">Ver Imagen</a></p>
                                <p class="card-text">Estado: ${product.estado === 1 ? 'Activo' : 'Inactivo'}</p>
                                <button class="btn btn-primary" onclick="editProduct(${product.IdProduct})">Editar</button>
                                <button class="btn btn-danger" onclick="confirmDeleteProduct(${product.IdProduct})">Eliminar</button>
                            </div>
                        </div>
                    `;
                    productCards.appendChild(productCard);
                });
            })
            .catch(error => {
                console.error("Error al cargar productos:", error);
                showStatusMessage("Error al cargar productos.");
            });
    }

    function loadCategories() {
        fetch("../index.php/categorias/")
            .then(response => response.json())
            .then(data => {
                categories = data;
                if (!productCategorySelect || !editProductCategorySelect) {
                    console.error("Error: Los selects de categoría no se encontraron en el DOM.");
                    return;
                }

                productCategorySelect.innerHTML = "";
                editProductCategorySelect.innerHTML = "";

                const defaultOption = document.createElement("option");
                defaultOption.value = "";
                defaultOption.textContent = "Seleccione una categoría";
                defaultOption.disabled = true;
                defaultOption.selected = true;

                productCategorySelect.appendChild(defaultOption.cloneNode(true));
                editProductCategorySelect.appendChild(defaultOption.cloneNode(true));

                categories.forEach(category => {
                    const option = document.createElement("option");
                    option.value = category.IdCateg;
                    option.textContent = `${category.IdCateg} - ${category.NCategoria} - ${category.Descripción}`;

                    productCategorySelect.appendChild(option.cloneNode(true));
                    editProductCategorySelect.appendChild(option.cloneNode(true));
                });

                productCategorySelect.value = "";
                editProductCategorySelect.value = "";
            })
            .catch(error => {
                console.error("Error al cargar categorías:", error);
                showStatusMessage("Error al cargar categorías.");
            });
    }

    productForm.addEventListener("submit", function(event) {
        event.preventDefault();

        if (!productForm.checkValidity()) {
            showStatusMessage("Por favor, complete todos los campos requeridos.");
            return;
        }

        const formData = new FormData(productForm);
        const selectedCategory = productCategorySelect.value || "";
        formData.append("categoria", selectedCategory);

        fetch("../index.php/productos/", {
            method: "POST",
            body: formData
        })
        .then(response => response.text()) // Cambiar a text() para depurar
        .then(result => {
            try {
                const jsonResult = JSON.parse(result); // Intentar parsear como JSON
                if (jsonResult.success) {
                    showStatusMessage("Producto guardado con éxito.");
                    loadProducts();
                    resetForm(productForm);
                } else {
                    showStatusMessage(jsonResult.message || "Error al guardar el producto.");
                }
            } catch (e) {
                console.error("Error al parsear respuesta JSON:", e);
                showStatusMessage("Error al guardar el producto. Respuesta del servidor no válida.");
            }
        })
        .catch(error => {
            console.error("Error al guardar producto:", error);
            showStatusMessage("Error al guardar el producto.");
        });
    });

    window.editProduct = function(id) {
        if (!id) {
            console.error("ID del producto es indefinido o nulo.");
            showStatusMessage("ID del producto es indefinido.");
            return;
        }
    
        fetch(`../index.php/productos/?id=${id}`)
            .then(response => response.json())
            .then(product => {
                if (product) {
                    console.log("Producto recibido para edición:", product); // Depuración
    
                    if (editProductIdField) {
                        editProductIdField.value = product.IdProduct || "";
                    }
                    if (editProductNameField) {
                        editProductNameField.value = product.NProducto || "";
                    }
                    if (editProductDescriptionField) {
                        editProductDescriptionField.value = product.Descripcion || "";
                    }
                    if (editProductPriceField) {
                        editProductPriceField.value = product.Precio || "";
                    }
                    if (editProductStockField) {
                        editProductStockField.value = product.Stock || "";
                    }
                    if (editProductCategorySelect) {
                        editProductCategorySelect.value = product.IdCateg || ""; // Ajuste aquí
                    }
                    if (editProductLinkField) {
                        editProductLinkField.value = product.enlace || "";
                    }
                    if (editProductStatusSelect) {
                        editProductStatusSelect.value = product.estado || "";
                    }
    
                    const editProductTabLink = document.getElementById('v-pills-edit-product-tab');
                    if (editProductTabLink) {
                        editProductTabLink.click();
                    } else {
                        console.error("Error: No se encontró el enlace de la pestaña de edición.");
                        showStatusMessage("Error al abrir la pestaña de edición.");
                    }
                } else {
                    console.error("Producto no encontrado.");
                    showStatusMessage("Producto no encontrado.");
                }
            })
            .catch(error => {
                console.error("Error al cargar el producto:", error);
                showStatusMessage("Error al cargar el producto.");
            });
    };
    editProductForm?.addEventListener("submit", function(event) {
        event.preventDefault();

        if (!editProductForm.checkValidity()) {
            showStatusMessage("Por favor, complete todos los campos requeridos.");
            return;
        }

        const formData = new FormData(editProductForm);
        const selectedCategory = editProductCategorySelect.value || "";
        formData.append("categoria", selectedCategory);

        fetch(`../index.php/productos/${editProductIdField.value}`, {
            method: "PUT",
            body: formData
        })
        .then(response => response.text()) // Cambiar a text() para depurar
        .then(result => {
            try {
                const jsonResult = JSON.parse(result); // Intentar parsear como JSON
                if (jsonResult.success) {
                    showStatusMessage("Producto actualizado con éxito.");
                    loadProducts();
                    resetForm(editProductForm);
                } else {
                    showStatusMessage(jsonResult.message || "Error al actualizar el producto.");
                }
            } catch (e) {
                console.error("Error al parsear respuesta JSON:", e);
                showStatusMessage("Error al actualizar el producto. Respuesta del servidor no válida.");
            }
        })
        .catch(error => {
            console.error("Error al actualizar producto:", error);
            showStatusMessage("Error al actualizar el producto.");
        });
    });

// Función para confirmar la eliminación de un producto
window.confirmDeleteProduct = function(id) {
    if (confirm("¿Estás seguro de que deseas eliminar este producto?")) {
        deleteProduct(id);
    }
};

// Función para eliminar un producto
function deleteProduct(id) {
    axios.delete(`../index.php/productos/${id}`)
        .then(response => {
            console.log('Respuesta del servidor:', response.data); // Revisa el contenido de la respuesta
            if (response.data.status === "deleted") {
                showStatusMessage("Producto eliminado correctamente");
                loadProducts(); // Actualiza la lista de productos
            } else {
                showStatusMessage("Error al eliminar el producto");
            }
        })
        .catch(error => {
            console.error("Hubo un error al eliminar el producto: ", error);
            showStatusMessage("Error al eliminar el producto");
        });
}

    cancelEditProductBtn?.addEventListener("click", function() {
        resetForm(editProductForm);
        const editProductTabLink = document.getElementById('v-pills-edit-product-tab');
        const existingUsersTabLink = document.getElementById('v-pills-existing-users-tab');

        if (editProductTabLink) {
            editProductTabLink.classList.remove('active');
        }
        if (existingUsersTabLink) {
            existingUsersTabLink.classList.add('active');
        }

        document.getElementById('v-pills-existing-users').style.display = 'block';
        document.getElementById('v-pills-create-product').style.display = 'none';
        document.getElementById('v-pills-edit-product').style.display = 'none';
    });

    loadProducts();
    loadCategories();
});
