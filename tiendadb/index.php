<?php

require_once 'src/db/verificarRol.php';
?>


<!DOCTYPE html>
<html lang="es-ES">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
  <meta name="apple-mobile-web-app-status-bar-style" content="default">
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="public/css/TIndex.css">
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <link rel="icon" href="https://i.pinimg.com/originals/68/ea/a5/68eaa5f9c3a7ed7e12d0b13b20a6f0fb.jpg">
  <title>Inicio | BOC</title>
  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Dancing+Script|Raleway:500,600&display=swap" rel="stylesheet">
  <style>
#submenu {
  position: absolute; 
  top: 100%;
  height: auto; 
  right: 0;
  z-index: 1050; 
  background-color: white;
  border: 1px solid #ccc; 
  display: none; 
}
#loginSM{display: none;}
#perfilSM{display: none;}
#cerrarSesionSM{display: none;}
#nombreUsuario{display: none;}
  </style>
</head>
<body>
<div class="background-container"></div>
  <header class="text-white py-3">
    <div class="container d-flex justify-content-between align-items-center">
      <h1 class="h3">BOC</h1>
      <nav class="navbar navbar-expand-lg navbar-light">
        <div class="collapse navbar-collapse">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item"><a class="nav-link" href="ventas.php">Ventas y servicios</a></li>
            <li class="nav-item"><a class="nav-link" href="sobrenosotros.php">Sobre Nosotros</a></li>
            <li class="nav-item">
              <a class="nav-link" href="#" id="logout-link">
                <img class="logout" src="public/img/logout.png" alt="Logout">
              </a>
              
            </li>
            <div id="submenu" class="submenu-container list-group hidden">
        <li class="list-group-item">
          <a class="SesionActiva" id="nombreUsuario"style="color:#ff0722!important">Usuario</a>
        </li>
        <li id="loginSM" class="list-group-item"><a href="log.php">Iniciar Sesion</a></li>
        <li id="perfilSM"class="list-group-item"><a href="perfil.php">Perfil</a></li>
        <li id="cerrarSesionSM" class="list-group-item">
    <a href="#" onclick="logout(); return false;">Cerrar Sesión</a>
</li>
      </div>
          </ul>
        </div>
      </nav>

      <div class="text-center">
      <img class="logo" src="https://i.pinimg.com/originals/68/ea/a5/68eaa5f9c3a7ed7e12d0b13b20a6f0fb.jpg" alt="Logo BOC" width="200" height="150">
        <label class="label" id="nombreUsuario"></label>
      </div>
    </div>
  </header>

  <div class="container mt-4">
    <div class="row">
      <aside class="col-md-4">
        <div id="map" class="ubicacion"></div>
        <script src="public/js/previo.js"></script>
      </aside>
      <main class="col-md-8">
        <section class="text-center">
          <h1 id="login">Bienvenidos a BOC</h1> 
          <div class="row">
            <div class="col-md-6 mb-3">
              <a class="btn btn-outline-primary btn-block" href="ventas.php">
                <img src="IMAGEN/Ventas.jpg" class="img-fluid" alt="Ventas">
                <span class="d-block mt-2">Ventas y servicios</span>
              </a>
            </div>
            <div class="col-md-6 mb-3">
              <a class="btn btn-outline-primary btn-block" href="sobrenosotros.php">
                <img src="IMAGEN/soporte.jpg" class="img-fluid" alt="Sobre Nosotros">
                <span class="d-block mt-2">Sobre Nosotros</span>
              </a>
            </div>
          </div>
        </section>
      </main>
    </div>
  </div>
  

  <footer class="text-white py-3 mt-4">
    <div class="container text-center">
      <p>&copy; 2024 BOC. Todos los derechos reservados.</p>
    </div>


</div>
  </footer>
  <script src="public/js/sublog.js"></script>
  <script>
    var nombreUsuario = localStorage.getItem("nombreUsuario"); 
    if (nombreUsuario) { 
      document.getElementById("nombreUsuario").innerText = nombreUsuario;
    }
    function logout() {
      localStorage.removeItem("nombreUsuario");
      window.location.href = "index.php";
      alert("Has cerrado sesión exitosamente");
    }
  </script>

</body>
</html>
