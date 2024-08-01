document.addEventListener("DOMContentLoaded", function() {
    const userForm = document.getElementById("userForm");
    const userIdField = document.getElementById("userId");
    const userTable = document.getElementById("userTable");

    const editUserIdField = document.getElementById('editUserId');
    const editUserForm = document.getElementById("editUserForm");
    const editTabLink = document.getElementById('v-pills-edit-tab');

// Función para mostrar el mensaje en el modal
function showStatusMessage(message) {
    const statusMessage = document.getElementById("statusMessage");
    statusMessage.textContent = message;
    
    // Mostrar el modal usando jQuery
    $('#statusModal').modal('show');
    
    // Ocultar el modal después de 1.5 segundos
    setTimeout(function() {
        $('#statusModal').modal('hide');
    }, 800);
}


    // Función para obtener y mostrar los usuarios
    function fetchUsers() {
        axios.get('../index.php/usuarios/')
            .then(response => {
                const users = response.data;
                let tableHTML = '<table class="table">';
                tableHTML += '<thead><tr><th>ID</th><th>Usuario</th><th>Nombre</th><th>Apellido</th><th>Email</th><th>Acciones</th></tr></thead><tbody>';
                users.forEach(user => {
                    tableHTML += `<tr>
                        <td>${user.IdUser}</td>
                        <td>${user.Usuario}</td>
                        <td>${user.Nombre}</td>
                        <td>${user.Apellido}</td>
                        <td>${user.Email}</td>
                        <td>
                            <button class="btn btn-primary btn-sm" onclick="editUser(${user.IdUser})">Editar</button>
                            <button class="btn btn-danger btn-sm" onclick="confirmDeleteUser(${user.IdUser})">Eliminar</button>
                        </td>
                    </tr>`;
                });
                tableHTML += '</tbody></table>';
                userTable.innerHTML = tableHTML;
            })
            .catch(error => {
                console.error("Hubo un error al obtener los usuarios: ", error);
            });
    }

    // Llama a fetchUsers cuando se carga la página
    fetchUsers();

    // Función para crear o actualizar un usuario
    userForm.addEventListener("submit", function(event) {
        event.preventDefault();

        const userId = userIdField.value;
        const userData = {
            username: document.getElementById("userUsername").value,
            name: document.getElementById("userName").value,
            lastName: document.getElementById("userLastName").value,
            email: document.getElementById("userEmail").value,
            password: document.getElementById("userPassword").value,
            role: document.getElementById("userRole").value,
            status: document.getElementById("userStatus").value
        };

        if (userId) {
            axios.put(`../index.php/usuarios/${userId}`, userData)
                .then(response => {
                    showStatusMessage("Usuario actualizado correctamente");
                    userForm.reset();
                    userIdField.value = '';
                    $('#v-pills-home-tab').tab('show'); // Volver a la pestaña de crear
                    fetchUsers();
                })
                .catch(error => {
                    console.error("Hubo un error al actualizar el usuario: ", error);
                    showStatusMessage("Nombre de usuario en uso");
                });
        } else {
            axios.post('../index.php/usuarios/', userData)
                .then(response => {
                    showStatusMessage("Usuario creado correctamente");
                    userForm.reset();
                    fetchUsers();
                })
                .catch(error => {
                    console.error("Hubo un error al crear el usuario: ", error);
                    showStatusMessage("Nombre de usuario en uso");
                });
        }
    });

    // Función para editar un usuario
    window.editUser = function(id) {
        axios.get(`../index.php/usuarios/${id}`)
            .then(response => {
                const user = response.data;
                editUserIdField.value = user.IdUser;
                document.getElementById('editUserUsername').value = user.Usuario;
                document.getElementById('editUserName').value = user.Nombre;
                document.getElementById('editUserLastName').value = user.Apellido;
                document.getElementById('editUserEmail').value = user.Email;
                document.getElementById('editUserRole').value = user.Rol || ''; // Maneja caso nulo
                document.getElementById('editUserStatus').value = user.Estado !== null ? user.Estado.toString() : ''; // Maneja caso nulo

                // Mostrar la pestaña de edición y eliminar display: none
                editTabLink.style.display = 'block';
                $('#v-pills-edit-tab').tab('show');
                $('#v-pills-home-tab').removeClass('active');
                $('#v-pills-profile-tab').removeClass('active');
                $('#v-pills-edit-tab').addClass('active');
            })
            .catch(error => {
                console.error('Hubo un error al obtener los datos del usuario: ', error);
                showStatusMessage('Error al obtener los datos del usuario');
            });
    };

    // Función para confirmar la eliminación de un usuario
    window.confirmDeleteUser = function(id) {
        if (confirm("¿Estás seguro de que deseas eliminar este usuario?")) {
            deleteUser(id);
        }
    };

    // Función para eliminar un usuario
    function deleteUser(id) {
        axios.delete(`../index.php/usuarios/${id}`)
            .then(response => {
                showStatusMessage("Usuario eliminado correctamente");
                fetchUsers();
            })
            .catch(error => {
                console.error("Hubo un error al eliminar el usuario: ", error);
                showStatusMessage("Error al eliminar el usuario");
            });
    }

// Función para actualizar un usuario
editUserForm.addEventListener("submit", function(event) {
    event.preventDefault();

    const userId = editUserIdField.value;
    const userData = {
        username: document.getElementById("editUserUsername").value,
        name: document.getElementById("editUserName").value,
        lastName: document.getElementById("editUserLastName").value,
        email: document.getElementById("editUserEmail").value,
        role: document.getElementById("editUserRole").value,
        status: document.getElementById("editUserStatus").value
    };

    console.log('Datos del usuario a actualizar:', userData); // Verifica los datos

    axios.put(`../index.php/usuarios/${userId}`, userData)
    .then(response => {
        showStatusMessage("Usuario actualizado correctamente");
        editUserForm.reset();
        editUserIdField.value = '';
        $('#v-pills-edit-tab').removeClass('active');
        editTabLink.style.display = 'none'; // Restaurar el estilo display: none
        $('#v-pills-profile-tab').tab('show'); // Volver a la pestaña de usuarios existentes
        fetchUsers();
    })
    .catch(error => {
        console.error("Hubo un error al actualizar el usuario: ", error);
        showStatusMessage("Error al actualizar el usuario");
    });

});


    // Función para cancelar la edición
    document.getElementById('cancelEditButton').addEventListener('click', function() {
        // Limpiar el formulario de edición
        editUserForm.reset();
        editUserIdField.value = '';
        // Ocultar la pestaña de edición y mostrar las otras pestañas

        $('#v-pills-profile-tab').tab('show'); // Mostrar la pestaña de usuarios existentes
        // Restaurar el estilo display: none
        editTabLink.style.display = 'none';
    });

    // Resetear y ocultar la pestaña de edición al cerrarla
    $('#v-pills-edit-tab').on('hide.bs.tab', function() {
        editUserForm.reset();
        editUserIdField.value = '';
        editTabLink.style.display = 'none'; // Restaurar el estilo display: none
    });

    // Mostrar la pestaña de edición y eliminar display: none cuando se activa
    $('#v-pills-edit-tab').on('shown.bs.tab', function() {
        editTabLink.style.display = 'block'; // Eliminar display: none
    });
});
document.addEventListener('DOMContentLoaded', function() {
    // Función para validar campos
    async function validateField(field) {
        let valid = true;
        const errorElement = document.getElementById(`${field.id}-error`);

        if (field.validity.valueMissing) {
            errorElement.textContent = 'Este campo es obligatorio.';
            valid = false;
        } else if (field.type === 'email' && field.validity.typeMismatch) {
            errorElement.textContent = 'Ingrese una dirección de correo electrónico válida.';
            valid = false;
        } else if (field.type === 'text' && field.validity.tooShort) {
            errorElement.textContent = 'Este campo es demasiado corto.';
            valid = false;
        } else {
            errorElement.textContent = '';
        }

        if (valid) {
            field.classList.remove('is-invalid');
            field.classList.add('is-valid');
        } else {
            field.classList.remove('is-valid');
            field.classList.add('is-invalid');
        }

        return valid;
    }

    // Validación en tiempo real para un formulario
    function setupFormValidation(formId) {
        const form = document.getElementById(formId);
        const fields = form.querySelectorAll('.form-control');
        
        fields.forEach(field => {
            field.addEventListener('input', async function() {
                await validateField(this);
            });
        });
        
        form.addEventListener('submit', async function(event) {
            let isValid = true;
            
            for (const field of fields) {
                if (!await validateField(field)) {
                    isValid = false;
                }
            }

            if (!isValid) {
                event.preventDefault();
                event.stopPropagation();
            }

            form.classList.add('was-validated');
        });
    }
    
    // Configurar validación para ambos formularios
    setupFormValidation('userForm');
    setupFormValidation('editUserForm');
});

