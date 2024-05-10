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
        var latitud = position.coords.latitude;
        var longitud = position.coords.longitude;
        // Enviar los valores de latitud y longitud a detalle_cita.php
        $.ajax({
            url: '../detalle_cita.php', // Reemplaza esto con la ruta a tu archivo PHP
            type: 'POST',
            data: { latitud: latitud,
                longitud: longitud,
                id_perfil: id_paciente,
                id_dispo: id_dispo
             },
            success: function(response) {
                 // Convierte la respuesta en un objeto jQuery
                    var $response = $(response);
                    var $rutaSede = $response.find('#ruta--sede');
                    $('#ruta--sede').html($rutaSede.html());
                        },
            error: function(error) {
                // Aquí puedes manejar los errores
                console.error('Error:', error);
            }

        });
    });
}


