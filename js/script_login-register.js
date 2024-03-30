window.addEventListener('load', function() {
    animateForm();
});

window.addEventListener('resize', function() {
    animateForm();
});

function animateForm() {
    var formularioRegister = document.querySelector('.formulario__register');
    var cajaTrasera = document.querySelector('.caja__trasera');

    if (formularioRegister.style.display !== 'none') {
        cajaTrasera.classList.add('animate');
    } else {
        cajaTrasera.classList.remove('animate');
    }
}

