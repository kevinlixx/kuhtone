document.getElementById('eliminar').addEventListener('click', function(event) {
    if (!confirm('¿Estás seguro de que quieres eliminar tu cuenta?')) {
        event.preventDefault();
    }
});