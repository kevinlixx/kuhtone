  // Obtén una referencia al elemento #mensaje-registro y al último botón .option--type
  var mensajeRegistro = document.getElementById('mensaje-login');
  var botones = document.querySelectorAll('.option--type');
  var ultimoBoton = botones[botones.length - 1];
  var loginContainer = document.querySelector('.formulario__login-container');

  // Define una función que se ejecutará cuando se cambie el tamaño de la ventana
  function reposicionarMensajeRegistro() {
      if (window.innerWidth < 600) {
          // Mueve el elemento #mensaje-registro para que se coloque después del último botón .option--type
          ultimoBoton.after(mensajeRegistro);
      } else {
          // Mueve el elemento #mensaje-registro para que se coloque dentro de formulario__login
          loginContainer.appendChild(mensajeRegistro);
      }
  }
  // Añade un oyente de eventos para el evento de cambio de tamaño de la ventana que llame a la función que definiste
  window.addEventListener('resize', reposicionarMensajeRegistro);

  // Llama a la función inicialmente para colocar el mensaje en la posición correcta al cargar la página
  reposicionarMensajeRegistro();