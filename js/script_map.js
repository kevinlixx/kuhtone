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
    // Itera sobre las sedes y crea un marcador para cada una
    sedes.forEach(sede => {
       var marker= L.marker([sede.latitud, sede.longitud]).addTo(map)
            .bindPopup(sede.nombre);
    // Obtén el div que quieres mostrar
    
    // Agrega un evento de clic al marcador

    marker.on('click', function() {
        // Muestra el div
        divSede.style.display = 'none';
        divpsico.style.display = 'block';
    
        // Enviar el ID de la sede a un archivo PHP
        var sede_id = sede.id_sede; // Asegúrate de que 'id' es la propiedad correcta
        $.ajax({
            url: '../psicologos.php', // Reemplaza esto con la ruta a tu archivo PHP
            type: 'POST',
            data: { sede_id: sede_id,
                id_perfil: id_paciente
             },
            success: function(response) {
                 // Convierte la respuesta en un objeto jQuery
        var $response = $(response);

        // Selecciona el contenido de #psicologos--contenedor y agrégalo a tu página
        var $psicologosContenedor = $response.find('#psicologos--contenedor');
        $('#psicologos--contenedor').html($psicologosContenedor.html());
            },
            error: function(error) {
                // Aquí puedes manejar los errores
                console.error('Error:', error);
            }
        });
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
        var marketUser= L.marker(currentLocation,{icon: userIcon}).addTo(map)
            .bindPopup('Ubicación actual');
        map.setView(currentLocation, 13);

        marketUser.on('click', function() {
            divSede.style.display = 'block';
        divpsico.style.display = 'none';
        });
    });
}

function getSedesFromDatabase() {
    return fetch('../includes/crud_sedes.php')
        .then(response => response.json());
}

