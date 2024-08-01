function login() {
    // Obtener los valores ingresados por el usuario
    var usuario = document.getElementById("correoInicioSesion").value;
        localStorage.setItem("nombreUsuario", usuario);
}

