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
  <title>Sobre Nosotros | BOC</title>
  
  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Dancing+Script|Raleway:500,600&display=swap" rel="stylesheet">
  
  <style>
    .principalAU {
      background-color: #f8f9fa;
      padding: 20px;
      border-radius: 8px;
      margin-bottom: 20px;
    }
    .principalAU h2 {
      color: #ff0722;
      margin-bottom: 15px;
    }
    .principalAU p {
      color: #404040;
      line-height: 1.6;
    }
    .principalAU ul {
      list-style-type: none;
      padding: 0;
    }
    .principalAU ul li {
      margin-bottom: 10px;
    }
    .principalAU ul li a {
      color: #ff0722;
      text-decoration: none;
    }
    .principalAU ul li a:hover {
      text-decoration: underline;
    }
    .ubicacion {
      height: 400px;
      border: 1px solid #ddd;
      border-radius: 8px;
    }
    h1 {
      text-align: center !important;
    }
    .ubicacionAU {
      width: 80%;
      border: 1px solid #999;
      background: #ddd;
      border-radius: 20px 20px 30px;
      display: block;
      margin: auto;
      align-items: center;
      text-align: center;
    }
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
          <li class="nav-item"><a class="nav-link" href="index.php">Inicio</a></li>
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
        <li id="cerrarSesionSM"class="list-group-item"><button class="btn btn-danger mt-3" id="logout-button">Cerrar sesión</button></li>
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
      <main class="col-md-8">
        <section class="text-center">
          <h1>Sobre Nosotros</h1>
          <div class="row">
            <div class="col-md-12">
              <section class="principalAU">
                <h2>¿Quiénes somos?</h2>
                <p>Somos una empresa de soporte técnico especializada en el mantenimiento preventivo y correctivo, venta de software y computadoras tanto de escritorio como portátiles. Nuestro objetivo es brindar soluciones tecnológicas confiables y de calidad a nuestros clientes.</p>
              </section>

              <section class="principalAU">
                <h2>¿Qué hacemos?</h2>
                <p>En BOC ofrecemos servicios de reparación de equipos, venta de software licenciado y computadoras, tanto para estudiantes como para profesionales y empresas. Además, proporcionamos asesoramiento técnico y soluciones personalizadas para satisfacer las necesidades de nuestros clientes.</p>
              </section>

              <section class="principalAU">
                <h2>Contacto</h2>
                <p>Puedes contactarnos a través de los siguientes medios:</p>
                <ul>
                  <li>Correo electrónico: <a href="mailto:BOC@bmc-project.es">BOC@bmc-project.es</a></li>
                  <li>Teléfono: +506-2592 5353 (Costa Rica)</li>
                  <li>Página web: <a href="http://www.BOCCR.com">www.BOCCR.com</a></li>
                  <li>WhatsApp: +506 4001 4991</li>
                  <li>Redes sociales:
                    <ul>
                      <li><a href="https://www.facebook.com/BOCCR">Facebook</a></li>
                      <li><a href="https://twitter.com/BOCCR">Twitter</a></li>
                      <li><a href="https://www.instagram.com/BOCCR">Instagram</a></li>
                    </ul>
                  </li>
                </ul>
              </section>
            </div>
          </div>
        </section>
      </main>
      <aside class="col-md-4">
        <div id="map" class="ubicacionAU"></div>
        <script src="public/js/previo.js"></script>
      </aside>
    </div>
  </div>

  <footer class="text-white py-3 mt-4">
    <div class="container text-center">
      <p>&copy; 2024 BOC. Todos los derechos reservados.</p>
    </div>
  </footer>
  <script src="public/js/sublog.js"></script>
  <script>
    var nombreUsuario = localStorage.getItem("nombreUsuario");
    if (nombreUsuario) {
      document.getElementById("nombreUsuario").innerText = nombreUsuario;
    } else {
      window.location.href = "index.php";
    }
document.getElementById('logout-button').addEventListener('click', function() {
    fetch('src/db/logout.php?action=logout', {
        method: 'GET', // Método GET ya que estamos usando query string
    })
    .then(response => response.text()) // Esperar una respuesta de texto
    .then(text => {
        if (text === 'success') {
            // Limpiar el localStorage
            localStorage.removeItem('nombreUsuario');
            localStorage.removeItem('userRole');

            // Mostrar un mensaje de éxito
            alert('Has cerrado sesión con éxito');

            // Redirigir al usuario a la página principal
            window.location.href = '/tiendadb/index.php';
        } else {
            alert('Error al cerrar sesión');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Error al cerrar sesión');
    });
});
</script>
</body>

</html>
