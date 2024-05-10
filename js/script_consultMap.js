// Inicializa el mapa
const map = L.map('map').setView([4.5709, -74.2973], 13); // Ajusta lat, lng y zoom según tu ubicación inicial preferida.

// Añade una capa de mapa base de OpenStreetMap
L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
}).addTo(map);
// Obtiene las sedes de la base de datos


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

        // Enviar los valores de latitud y longitud a detalle_cita.php
        fetch('../detalle_cita.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                latitud: currentLocation[0],
                longitud: currentLocation[1],
            }),
        })
        .then(response => response.json())
        .then(data => console.log(data))
        .catch((error) => {
            console.error('Error:', error);
        });
    });
}


