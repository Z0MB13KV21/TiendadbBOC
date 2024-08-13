<?php
require_once '../../src/db/verificarRol.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="https://i.pinimg.com/originals/68/ea/a5/68eaa5f9c3a7ed7e12d0b13b20a6f0fb.jpg">
    <title>Usuarios - TiendaDB</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:wght@400;700&display=swap" rel="stylesheet">
    <style>

    </style>
</head>
<body>
    <div class="container mt-4">
        <h1 class="text-center mb-4">Gestión de Usuarios</h1>
        <div class="row">
            <div class="col-md-3">
                <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
<a class="nav-link" id="v-pills-home-tab" data-toggle="pill" href="#createUser" role="tab" aria-controls="createUser" aria-selected="true">Crear Usuario</a>
<a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#listUsers" role="tab" aria-controls="listUsers" aria-selected="false">Usuarios Existentes</a>
<a class="nav-link" id="v-pills-edit-tab" data-toggle="pill" href="#editUser" role="tab" aria-controls="editUser" aria-selected="false" style="display: none;">Editar Usuario</a>

                </div>
            </div>
            <div class="col-md-9">
                <div class="tab-content" id="v-pills-tabContent">
                  <!-- Crear Usuario -->
<div class="tab-pane fade show active" id="createUser" role="tabpanel" aria-labelledby="v-pills-home-tab">
    <h3>Crear Usuario</h3>
    <form id="userForm" class="needs-validation" novalidate>
        <input type="hidden" id="userId">
        
        <div class="form-group">
            <label for="userUsername">Usuario</label>
            <input type="text" class="form-control" id="userUsername" placeholder="Ingrese el nombre de usuario" autocomplete="username" required>
            <div class="invalid-feedback" id="userUsername-error">El nombre de usuario debe tener al menos 3 caracteres.</div>
        </div>
        
        <div class="form-group">
            <label for="userName">Nombre</label>
            <input type="text" class="form-control" id="userName" placeholder="Ingrese el nombre" required>
            <div class="invalid-feedback" id="userName-error">Por favor, ingrese su nombre.</div>
        </div>
        
        <div class="form-group">
            <label for="userLastName">Apellido</label>
            <input type="text" class="form-control" id="userLastName" placeholder="Ingrese el apellido" required>
            <div class="invalid-feedback" id="userLastName-error">Por favor, ingrese su apellido.</div>
        </div>
        
        <div class="form-group">
            <label for="userEmail">Email</label>
            <input type="email" class="form-control" id="userEmail" placeholder="Ingrese el email" autocomplete="email" required>
            <div class="invalid-feedback" id="userEmail-error">Ingrese una dirección de correo electrónico válida.</div>
        </div>
        
        <div class="form-group">
            <label for="userPassword">Contraseña</label>
            <input type="password" class="form-control" id="userPassword" placeholder="Ingrese la contraseña" autocomplete="current-password" required>
            <div class="invalid-feedback" id="userPassword-error">La contraseña es requerida.</div>
        </div>
        
        <div class="form-group">
            <label for="userRole">Rol</label>
            <select class="form-control" id="userRole" required>
                <option value="" disabled selected>Seleccione un rol</option>
                <option value="Administrador">Administrador</option>
                <option value="Cajero">Cajero</option>
                <option value="Usuario">Usuario</option>
            </select>
            <div class="invalid-feedback" id="userRole-error">Seleccione un rol.</div>
        </div>
        
        <div class="form-group">
            <label for="userStatus">Estado</label>
            <select class="form-control" id="userStatus" required>
                <option value="" disabled selected>Seleccione un estado</option>
                <option value="1">Activo</option>
                <option value="0">Inactivo</option>
            </select>
            <div class="invalid-feedback" id="userStatus-error">Seleccione un estado.</div>
        </div>
        
        <button type="submit" class="btn btn-primary">Guardar Usuario</button>
    </form>
</div>

                    <!-- Listar Usuarios -->
                    <div class="tab-pane fade" id="listUsers" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                        <h3>Usuarios Existentes</h3>
                        <div id="userTable"></div>
                    </div>
                    <!-- Editar Usuario -->
<div class="tab-pane fade" id="editUser" role="tabpanel" aria-labelledby="v-pills-edit-tab">
    <h3>Editar Usuario</h3>
    <form id="editUserForm" class="needs-validation" novalidate>
        <input type="hidden" id="editUserId">
        
        <div class="form-group">
            <label for="editUserUsername">Usuario</label>
            <input type="text" class="form-control" id="editUserUsername" placeholder="Ingrese el nombre de usuario" autocomplete="username" required>
            <div class="invalid-feedback" id="editUserUsername-error">El nombre de usuario debe tener al menos 3 caracteres.</div>
        </div>
        
        <div class="form-group">
            <label for="editUserName">Nombre</label>
            <input type="text" class="form-control" id="editUserName" placeholder="Ingrese el nombre" required>
            <div class="invalid-feedback" id="editUserName-error">Por favor, ingrese su nombre.</div>
        </div>
        
        <div class="form-group">
            <label for="editUserLastName">Apellido</label>
            <input type="text" class="form-control" id="editUserLastName" placeholder="Ingrese el apellido" required>
            <div class="invalid-feedback" id="editUserLastName-error">Por favor, ingrese su apellido.</div>
        </div>
        
        <div class="form-group">
            <label for="editUserEmail">Email</label>
            <input type="email" class="form-control" id="editUserEmail" placeholder="Ingrese el email" autocomplete="email" required>
            <div class="invalid-feedback" id="editUserEmail-error">Ingrese una dirección de correo electrónico válida.</div>
        </div>
        
        <div class="form-group">
            <label for="editUserPassword">Contraseña</label>
            <input type="password" class="form-control" id="editUserPassword" placeholder="Ingrese la nueva contraseña" autocomplete="current-password">
            <div class="invalid-feedback" id="editUserPassword-error">La contraseña es requerida si desea cambiarla.</div>
        </div>
        
        <div class="form-group">
            <label for="editUserRole">Rol</label>
            <select class="form-control" id="editUserRole" required>
                <option value="" disabled selected>Seleccione un rol</option>
                <option value="Administrador">Administrador</option>
                <option value="Cajero">Cajero</option>
                <option value="Usuario">Usuario</option>
            </select>
            <div class="invalid-feedback" id="editUserRole-error">Seleccione un rol.</div>
        </div>
        
        <div class="form-group">
            <label for="editUserStatus">Estado</label>
            <select class="form-control" id="editUserStatus" required>
                <option value="" disabled selected>Seleccione un estado</option>
                <option value="1">Activo</option>
                <option value="0">Inactivo</option>
            </select>
            <div class="invalid-feedback" id="editUserStatus-error">Seleccione un estado.</div>
        </div>
        
        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
        <button type="button" class="btn btn-secondary" id="cancelEditButton">Cancelar</button>
    </form>
</div>

                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="statusModal" tabindex="-1" aria-labelledby="statusModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="statusModalLabel">Aviso</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p id="statusMessage">El mensaje aparecerá aquí.</p>
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
    <script src="scripts/usuarios.js"></script>
</body>
</html>
