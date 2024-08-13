function calcularCoordenadaMasCercana() {
  var puntos = [
    { nombre: "TikoTech Heredia", x:  9.9962656, y: -84.111725 },
    { nombre: "TikoTech Montes de Oca", x:  9.9318497, y: -84.0501641 },
    { nombre: "TikoTech San Pedro", x: 9.9331021, y: -84.0749026},
    { nombre: "TikoTech San Ramón", x: 10.0827215, y: -84.4692864 },
    { nombre: "TikoTech Pavas", x:9.9327116 , y:  -84.1505603 },
    { nombre: "TikoTech Escazú", x: 10.0145081 , y: -84.2148353 },
    { nombre: "TikoTech Guápiles", x:10.2146956 , y:  -83.7902913},
    { nombre: "TikoTech La Uruca" , x:9.9327116 , y: -84.1505603},
    { nombre: "TikoTech Pérez Zeledón" , x:9.3725525, y:  -83.7006544 },
    { nombre:  "TikoTech Cartago" , x:9.8637299, y:-83.9248337 },
    //Ubicaciones de las tiendas guardadas en un array llamado puntos
  ];

  // Obtener la ubicación actual del usuario
  navigator.geolocation.getCurrentPosition(function(position) {
    var ubicacionActual = {
      x: position.coords.latitude,
      y: position.coords.longitude
    };

    var distanciaMinima = Number.MAX_VALUE;
    var puntoMasCercano = null;

    for (var i = 0; i < puntos.length; i++) {
      var punto = puntos[i];
      var distancia = calcularDistancia(ubicacionActual.x, ubicacionActual.y, punto.x, punto.y);

      if (distancia < distanciaMinima) {
        distanciaMinima = distancia;
        puntoMasCercano = punto;
      }
    }

    // Mostrar la ubicación actual
    document.getElementById("ubicacion").innerHTML =
      "Latitud: " + ubicacionActual.x + ", Longitud: " + ubicacionActual.y;

    // Mostrar el nombre del punto más cercano y la distancia en kilómetros
    var servicioexpress= parseInt(distanciaMinima*2000);
    document.getElementById("resultado").innerHTML =
      "Punto más cercano: " + puntoMasCercano.nombre + "<br>" +
      "Distancia: " + distanciaMinima.toFixed(2) + " kilómetros"+"<br>"+
      "El valor del servicios express es de: " + servicioexpress + " colones";
      

  });
}

// Función auxiliar para calcular la distancia entre dos puntos utilizando la fórmula del haversine
function calcularDistancia(lat1, lon1, lat2, lon2) {
  var R = 6371; // Radio de la Tierra en kilómetros
  var dLat = toRad(lat2 - lat1);
  var dLon = toRad(lon2 - lon1);
  var a = Math.sin(dLat / 2) * Math.sin(dLat / 2) +
          Math.cos(toRad(lat1)) * Math.cos(toRad(lat2)) *
          Math.sin(dLon / 2) * Math.sin(dLon / 2);
  var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
  var distancia = R * c;

  return distancia;
}

// Función auxiliar para convertir grados a radianes
function toRad(degrees) {
  return degrees * Math.PI / 180;
}
