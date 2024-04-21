// Inicializa el mapa
const map = L.map('map--container').setView([4.5709, -74.2973], 13); // Ajusta lat, lng y zoom según tu ubicación inicial preferida.

// Añade una capa de mapa base de OpenStreetMap
L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
}).addTo(map);

// Ejemplo de cómo agregar marcadores para las sedes
const sedes = [
    { lat: 51.505, lng: -0.09, name: 'Sede 1' },
    // Agrega más sedes aquí
];
sedes.forEach(sede => {
    L.marker([sede.lat, sede.lng]).addTo(map)
        .bindPopup(sede.name);
});

if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(position => {
        const currentLocation = [position.coords.latitude, position.coords.longitude];
        L.marker(currentLocation).addTo(map)
            .bindPopup('Ubicación actual');
        map.setView(currentLocation, 13);
    });
}

