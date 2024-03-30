window.onload = function() {
    var enlaceInicio = document.getElementById('enlace-inicio');
    var enlaceRegistro = document.getElementById('enlace-registro');
    var formularioLogin = document.querySelector('.formulario__login');
    var formularioRegistro = document.querySelector('.formulario__register');
    var cajaTrasera = document.querySelector('.caja__trasera');

    // Ocultar el formulario de registro y la caja trasera al cargar la página
    formularioRegistro.style.display = 'none';
    cajaTrasera.style.display = 'none';

    enlaceInicio.addEventListener('click', function() {
        formularioLogin.style.display = 'block';
        formularioRegistro.style.display = 'none';
        cajaTrasera.style.display = 'none';
    });

    enlaceRegistro.addEventListener('click', function() {
        formularioLogin.style.display = 'none';
        formularioRegistro.style.display = 'block';
        cajaTrasera.style.display = 'block';
    });
}
