document.addEventListener("DOMContentLoaded", function() {

    var map = L.map('map').setView([9.9327116, -84.1505603], 9); // Vista inicial en Costa Rica




    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {

        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors',

        maxZoom: 18,

    }).addTo(map);

    var BOCLocations = [

        { latitude: 9.9962656, longitude: -84.111725, name: "BOC Heredia" },

        { latitude: 9.9318497, longitude: -84.0501641, name: "BOC Montes de Oca" },

        { latitude: 9.9331021, longitude: -84.0749026, name: "BOC San Pedro" },

        { latitude: 10.0827215, longitude: -84.4692864, name: "BOC San Ramón" },

        { latitude: 9.9327116, longitude: -84.1505603, name: "BOC Pavas" },

        { latitude: 10.0145081, longitude: -84.2148353, name: "BOC Escazú" },

        { latitude: 10.2146956, longitude: -83.7902913, name: "BOC Guápiles" },

        { latitude: 9.9327116, longitude: -84.1505603, name: "BOC La Uruca" },

        { latitude: 9.3725525, longitude: -83.7006544, name: "BOC Pérez Zeledón" },

        { latitude: 9.8637299, longitude: -83.9248337, name: "BOC Cartago" }

    ];




    BOCLocations.forEach(function(location) {

        L.marker([location.latitude, location.longitude]).addTo(map)

            .bindPopup(location.name)

            .openPopup();

    });




    function getCoordinates() {

        // ...

    }

});

