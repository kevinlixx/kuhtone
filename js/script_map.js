// Inicializa el mapa
const map = L.map('map--container').setView([4.5709, -74.2973], 13); // Ajusta lat, lng y zoom según tu ubicación inicial preferida.

// Añade una capa de mapa base de OpenStreetMap
L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
}).addTo(map);

// Obtiene las sedes de la base de datos
getSedesFromDatabase().then(sedes => {
    // Itera sobre las sedes y crea un marcador para cada una
    sedes.forEach(sede => {
       var marker= L.marker([sede.latitud, sede.longitud]).addTo(map)
            .bindPopup(sede.nombre);
    // Obtén el div que quieres mostrar
    var divSede= document.getElementById('select-sede');
    var divpsico= document.getElementById('psicologos--contenedor');
    // Agrega un evento de clic al marcador
    marker.on('click', function() {
        // Muestra el div
        divSede.style.display = 'none';
        divpsico.style.display = 'block';
    });

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
        L.marker(currentLocation,{icon: userIcon}).addTo(map)
            .bindPopup('Ubicación actual');
        map.setView(currentLocation, 13);
    });
}

function getSedesFromDatabase() {
    return fetch('../config/crud_sedes.php')
        .then(response => response.json());
}

