document.addEventListener("DOMContentLoaded", function() {
    const categoryForm = document.getElementById("categoryForm");
    const categoryIdField = document.getElementById("categoryId");
    const categoryTable = document.getElementById("categoryTable");
    const editCategoryIdField = document.getElementById('editCategoryId');
    const editCategoryForm = document.getElementById("editCategoryForm");
    const editCategoryTabLink = document.getElementById('v-pills-edit-category-tab');

    function showStatusMessage(message) {
        const statusMessage = document.getElementById("statusMessage");
        if (!statusMessage) {
            console.error("Elemento con id 'statusMessage' no encontrado");
            return;
        }
        statusMessage.textContent = message;

        $('#statusModal').modal('show');

        setTimeout(function() {
            $('#statusModal').modal('hide');
        }, 800);
    }

    function fetchCategories() {
        axios.get('../index.php/categorias/')
            .then(response => {
                const categories = response.data;
                let tableHTML = '<table class="table">';
                tableHTML += '<thead><tr><th>ID</th><th>Nombre</th><th>Descripción</th><th>Acciones</th></tr></thead><tbody>';
                categories.forEach(category => {
                    tableHTML += `<tr>
                        <td>${category.IdCateg}</td>
                        <td>${category.NCategoria}</td>
                        <td>${category.Descripción}</td>
                        <td>
                            <button class="btn btn-primary btn-sm" onclick="editCategory(${category.IdCateg})">Editar</button>
                            <button class="btn btn-danger btn-sm" onclick="confirmDeleteCategory(${category.IdCateg})">Eliminar</button>
                        </td>
                    </tr>`;
                });
                tableHTML += '</tbody></table>';
                categoryTable.innerHTML = tableHTML;
            })
            .catch(error => {
                console.error("Hubo un error al obtener las categorías: ", error);
            });
    }

    fetchCategories();

    categoryForm.addEventListener("submit", function(event) {
        event.preventDefault();

        const categoryId = categoryIdField.value;
        const categoryData = {
            Nombre: document.getElementById("categoryName").value,
            Descripcion: document.getElementById("categoryDescription").value
        };

        if (categoryId) {
            axios.put(`../index.php/categorias/${categoryId}`, categoryData)
                .then(response => {
                    showStatusMessage("Categoría actualizada correctamente");
                    categoryForm.reset();
                    categoryIdField.value = '';
                    $('#v-pills-home-tab').tab('show');
                    fetchCategories();
                })
                .catch(error => {
                    console.error("Hubo un error al actualizar la categoría: ", error);
                    showStatusMessage("Error al actualizar la categoría");
                });
        } else {
            axios.post('../index.php/categorias/', categoryData)
                .then(response => {
                    showStatusMessage("Categoría creada correctamente");
                    categoryForm.reset();
                    fetchCategories();
                })
                .catch(error => {
                    console.error("Hubo un error al crear la categoría: ", error);
                    showStatusMessage("Error al crear la categoría");
                });
        }
    });

    window.editCategory = function(id) {
        axios.get(`../index.php/categorias/${id}`)
            .then(response => {
                const category = response.data;
                if (category) {
                    editCategoryIdField.value = category.IdCateg || '';
                    document.getElementById('editCategoryName').value = category.NCategoria || '';
                    document.getElementById('editCategoryDescription').value = category.Descripción || '';

                    $('#v-pills-edit-category-tab').tab('show');
                    $('#v-pills-home-tab').removeClass('active');
                    $('#v-pills-list-category-tab').removeClass('active');
                    $('#v-pills-edit-category-tab').addClass('active');
                } else {
                    console.error('Categoría no encontrada');
                    showStatusMessage('Categoría no encontrada');
                }
            })
            .catch(error => {
                console.error('Hubo un error al obtener los datos de la categoría: ', error);
                showStatusMessage('Error al obtener los datos de la categoría');
            });
    };

    window.confirmDeleteCategory = function(id) {
        if (confirm("¿Estás seguro de que deseas eliminar esta categoría?")) {
            deleteCategory(id);
        }
    };

    function deleteCategory(id) {
        axios.delete(`../index.php/categorias/${id}`)
            .then(response => {
                showStatusMessage("Categoría eliminada correctamente");
                fetchCategories();
            })
            .catch(error => {
                console.error("Hubo un error al eliminar la categoría: ", error);
                showStatusMessage("Error al eliminar la categoría");
            });
    }

    editCategoryForm.addEventListener("submit", function(event) {
        event.preventDefault();

        const categoryId = editCategoryIdField.value;
        const categoryData = {
            Nombre: document.getElementById("editCategoryName").value,
            Descripcion: document.getElementById("editCategoryDescription").value
        };

        axios.put(`../index.php/categorias/${categoryId}`, categoryData)
            .then(response => {
                showStatusMessage("Categoría actualizada correctamente");
                editCategoryForm.reset();
                editCategoryIdField.value = '';
                $('#v-pills-edit-category-tab').removeClass('active');
                editCategoryTabLink.style.display = 'none';
                $('#v-pills-list-category-tab').tab('show');
                fetchCategories();
            })
            .catch(error => {
                console.error("Hubo un error al actualizar la categoría: ", error);
                showStatusMessage("Error al actualizar la categoría");
            });
    });

    document.getElementById("cancelEditCategoryBtn").addEventListener("click", function() {
        editCategoryForm.reset();
        editCategoryIdField.value = '';
        $('#v-pills-edit-category-tab').removeClass('active');
        editCategoryTabLink.style.display = 'none';
        $('#v-pills-list-category-tab').tab('show');
    });
});
