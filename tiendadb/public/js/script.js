function getCoordinates() {
  if ("geolocation" in navigator) {
      navigator.geolocation.getCurrentPosition(function(position) {
          var latitude = position.coords.latitude;
          var longitude = position.coords.longitude;

          var coordsElement = document.getElementById("coords");
          coordsElement.textContent = "Tus coordenadas actuales son: Latitud: " + latitude + ", Longitud: " + longitude;
          coordsElement.style.display = "block";

          // Mostrar el mapa con Leaflet.js
          var map = L.map('map').setView([latitude, longitude], 14);

          L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
              attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors',
              maxZoom: 18,
          }).addTo(map);

          L.marker([latitude, longitude]).addTo(map)
              .bindPopup('¡Estás aquí!')
              .openPopup();
      });
  } else {
      alert("La geolocalización no está disponible en tu navegador.");
  }
}

// Asignar la función al evento click del botón
document.getElementById("btnGetCoords").addEventListener("click", getCoordinates);

