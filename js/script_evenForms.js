
// Animación de los formularios de login y registro para llevar a cabo la transición entre ellos
window.onload = function() {
    var enlaceInicio = document.getElementById('enlace-inicio');
    var enlaceRegistro = document.getElementById('enlace-registro');
    var formularioLogin = document.querySelector('.formulario__login');
    var formularioRegistro = document.querySelector('.formulario__register');
    var cajaTrasera = document.querySelector('.caja__trasera');
    var mainElement = document.querySelector('main');

    // Ocultar el formulario de registro y la caja trasera al cargar la página
    formularioRegistro.classList.add('oculto');
    cajaTrasera.classList.add('oculto');

    enlaceInicio.addEventListener('click', function() {
        formularioLogin.classList.remove('oculto');
        formularioRegistro.classList.add('oculto');
        cajaTrasera.classList.add('oculto');
        adjustMainHeight(); // Llama a la función después de cambiar la visibilidad de los formularios
    });

    enlaceRegistro.addEventListener('click', function() {
        formularioLogin.classList.add('oculto');
        formularioRegistro.classList.remove('oculto');
        cajaTrasera.classList.remove('oculto');
        adjustMainHeight(); // Llama a la función después de cambiar la visibilidad de los formularios
    });

    // Función para ajustar el height de 'main' al activar el form de login
    function adjustMainHeight() {
        // Comprueba si 'formulario__login' está visible
        var isFormularioLoginVisible = window.getComputedStyle(formularioLogin).display !== 'none';

        // Comprueba si 'formulario__register' está visible
        var isFormularioRegisterVisible = window.getComputedStyle(formularioRegistro).display !== 'none';

        // Comprueba si el tamaño de la ventana es menor o igual a 600px
        var isWindowSizeSmall = window.innerWidth <= 600;

        // Comprueba si el tamaño de la ventana es mayor o igual a 800px
        var isWindowSizeLarge = window.innerWidth >= 600;

        // Ajusta el height de 'main' basado en la visibilidad de 'formulario__login' y el tamaño de la ventana
        if (isFormularioLoginVisible && !isFormularioRegisterVisible && isWindowSizeSmall) {
            mainElement.style.height = '1000px';
        } else if (isFormularioLoginVisible && !isFormularioRegisterVisible && isWindowSizeLarge) {
            mainElement.style.height = '650px';                             
        } else {
            mainElement.style.height = 'auto';
        }
    }

    // Llama a la función cuando la página se carga
    adjustMainHeight();

    // Llama a la función cuando se cambia el tamaño de la ventana
    window.addEventListener('resize', adjustMainHeight);
}