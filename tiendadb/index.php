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
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
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

.carousel-image-container {
  position: relative;
  overflow: hidden; 
}

.carousel-image-container img {
  display: block;
  width: 100%;
  max-width: 200px !important;
  height: 100%;
  max-height: 250px !important;  
}

.carousel-caption-overlay {
  position: absolute;
  bottom: 0;
  left: 0;
  right: 0;
  background-color: rgba(0, 0, 0, 0.7); 
  color: #fff;
  padding: 10px; 
  text-align: center;
  opacity: 0;
  transition: opacity 0.3s ease;
  height: 100%; 
  display: flex;
  flex-direction: column;
  justify-content: center; 
  align-items: center;
}

.carousel-image-container:hover .carousel-caption-overlay,
.carousel-image-container:focus .carousel-caption-overlay {
  opacity: 1;
}

.carousel-caption-overlay h5,
.carousel-caption-overlay p {
  margin: 0;
}

.carousel-caption-overlay a {
  margin-top: 10px; 
}


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
                <a class="SesionActiva" id="nombreUsuario" style="color:#ff0722!important">Usuario</a>
              </li>
              <li id="loginSM" class="list-group-item"><a href="log.php">Iniciar Sesión</a></li>
              <li id="perfilSM" class="list-group-item"><a href="perfil.php">Perfil</a></li>
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
      <aside class="col-md-4">
        <div id="map" class="ubicacion"></div>
        <script src="public/js/previo.js"></script>
      </aside>
      <main class="col-md-8" style="height:700px">
      <section class="text-center">
          <h1 id="login">Bienvenidos a BOC</h1>
          
          <!-- Carousel de Ofertas -->
          <h2>Ofertas Especiales</h2>
          <div id="carouselOfertas" class="carousel slide" data-ride="carousel" style="height:200px !important">
            <div class="carousel-inner" id="carousel-ofertas-content">
              <!-- Contenido cargado por AJAX -->
            </div>
            <a class="carousel-control-prev" href="#carouselOfertas" role="button" data-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselOfertas" role="button" data-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="sr-only">Next</span>
            </a>
          </div>
          
          <!-- Carousel de Productos Más Vendidos -->
          <h2>Productos Más Vendidos</h2>
          <div id="carouselMasVendidos" class="carousel slide" data-ride="carousel" style="height:100 !important">
            <div class="carousel-inner" id="carousel-mas-vendidos-content">
              <!-- Contenido cargado por AJAX -->
            </div>
            <a class="carousel-control-prev" href="#carouselMasVendidos" role="button" data-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselMasVendidos" role="button" data-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="sr-only">Next</span>
            </a>
          </div>
        </section>
      </main>

    </div>
  </div>

  <script>
  $(document).ready(function() {
    // Cargar los datos de ofertas y productos más vendidos
    $.getJSON('ofertas_masvendidos.php', function(data) {
      if (data.error) {
        console.error('Error al obtener datos:', data.error);
        return;
      }

      // Cargar ofertas en el carrusel
      var ofertasHtml = '';
      $.each(data.ofertas, function(index, oferta) {
        var activeClass = index === 0 ? 'active' : '';
        ofertasHtml += `
          <div class="carousel-item ${activeClass}">
            <div class="carousel-image-container">
              <img src="${oferta.enlace}" class="d-block"  alt="${oferta.titulo}">
              <div class="carousel-caption-overlay">
                <h5>${oferta.titulo}</h5>
                <p>₡${oferta.precio}</p>
                <a href="ventas.php" class="btn btn-primary">Ver Más</a>
              </div>
            </div>
          </div>
        `;
      });
      $('#carousel-ofertas-content').html(ofertasHtml);

      // Cargar productos más vendidos en el carrusel
      var masVendidosHtml = '';
      $.each(data.masVendidos, function(index, producto) {
        var activeClass = index === 0 ? 'active' : '';
        masVendidosHtml += `
          <div class="carousel-item ${activeClass}">
            <div class="carousel-image-container">
              <img src="${producto.enlace}" class="d-block"  alt="${producto.titulo}">
              <div class="carousel-caption-overlay">
                <h5>${producto.titulo}</h5>
                <p>₡${producto.precio}</p>
                <a href="ventas.php" class="btn btn-primary">Comprar</a>
              </div>
            </div>
          </div>
        `;
      });
      $('#carousel-mas-vendidos-content').html(masVendidosHtml);
    });
  });
</script>
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
