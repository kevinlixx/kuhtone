// Obtén los elementos
var mainElement = document.querySelector('main');
var formularioLogin = document.querySelector('.formulario__login');

// Función para ajustar el height de 'main'
function adjustMainHeight() {
    // Comprueba si 'formulario__login' está visible
    var isFormularioLoginVisible = window.getComputedStyle(formularioLogin).display !== 'none';

    // Comprueba si el tamaño de la ventana es menor o igual a 600px
    var isWindowSizeSmall = window.innerWidth <= 600;

    // Comprueba si el tamaño de la ventana es mayor o igual a 800px
    var isWindowSizeLarge = window.innerWidth >= 600;

    // Ajusta el height de 'main' basado en la visibilidad de 'formulario__login' y el tamaño de la ventana
    if (isFormularioLoginVisible && isWindowSizeSmall) {
        mainElement.style.height = '1000px';
    } else if (isFormularioLoginVisible && isWindowSizeLarge) {
        mainElement.style.height = '650px';                             
    } else {
        mainElement.style.height = '1000px';
    }
}

// Llama a la función cuando la página se carga
adjustMainHeight();

// Llama a la función cuando se cambia el tamaño de la ventana
window.addEventListener('resize', adjustMainHeight);