// Obtén una referencia al elemento #mensaje-registro y al último botón .option--type
var mensajeRegistro = document.getElementById('mensaje-registro');
var botones = document.querySelectorAll('.option--type');
var ultimoBoton = botones[botones.length - 1];
var figure = document.querySelector('.figure_login');

// Define una función que se ejecutará cuando se cambie el tamaño de la ventana
function reposicionarMensajeRegistro() {
    // Comprueba el ancho de la ventana
    if (window.innerWidth < 600) {
        // Mueve el elemento #mensaje-registro para que se coloque después del último botón .option--type
        ultimoBoton.after(mensajeRegistro);
    } else {
        // Mueve el elemento #mensaje-registro para que se coloque después de la figura
        figure.after(mensajeRegistro);
    }
}

// Añade un oyente de eventos para el evento de cambio de tamaño de la ventana que llame a la función que definiste
window.addEventListener('resize', reposicionarMensajeRegistro);

// Llama a la función inicialmente para colocar el mensaje en la posición correcta al cargar la página
reposicionarMensajeRegistro();