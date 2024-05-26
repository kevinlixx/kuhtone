// Inicializa el mapa
const map = L.map('map--container').setView([4.5709, -74.2973], 13); // Ajusta lat, lng y zoom según tu ubicación inicial preferida.

// Añade una capa de mapa base de OpenStreetMap
L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
}).addTo(map);
    var divSede= document.getElementById('select-sede');
    var divpsico= document.getElementById('psicologos--contenedor');
// Obtiene las sedes de la base de datos
getSedesFromDatabase().then(sedes => {
    sedes.forEach(sede => {
        // Crear el enlace a Google Maps
        var googleMapsLink = `https://www.google.com/maps/dir/?api=1&destination=${sede.latitud},${sede.longitud}`;

        // Crear el marcador y añadirlo al mapa
        var marker = L.marker([sede.latitud, sede.longitud]).addTo(map);

        // Añadir un popup al marcador con el enlace a Google Maps
        marker.bindPopup(`<a href="${googleMapsLink}" target="_blank">${sede.nombre} - Abrir en Google Maps</a>`);
    });
}).catch(error => {
    console.error('Error al obtener las sedes de la base de datos:', error);
});

// Define un icono personalizado
const userIcon = L.icon({
    iconUrl: '../img/person-solid.svg', // Reemplaza esto con la ruta a tu icono
    iconSize: [38, 95], // Reemplaza esto con el tamaño de tu icono
});

if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(position => {
        const currentLocation = [position.coords.latitude, position.coords.longitude];
        var marketUser= L.marker(currentLocation,{icon: userIcon}).addTo(map)
            .bindPopup('Ubicación actual');
        map.setView(currentLocation, 13);

        marketUser.on('click', function() {
        });
    });
}

function getSedesFromDatabase() {
    return fetch('../includes/crud_sedes.php')
        .then(response => response.json());
}

