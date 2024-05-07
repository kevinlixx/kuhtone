document
  .querySelectorAll(".form-restaurar-cuenta")
  .forEach(form =>
    form.addEventListener("submit", function (event) {
      event.preventDefault();

      const formData = new FormData(event.target);

      fetch("gestion_delCuenta.php", {
        method: "POST",
        body: formData,
      })
      .then((response) => response.text())
      .then((resultado) => {
        console.log('Respuesta del servidor:', resultado); // Agrega esto
        if (resultado.includes("eliminada")) {
            alert(
              "Cuenta restaurada y eliminada de la lista temporal exitosamente"
            );
            location.reload(); // Recarga la página
          } else {
            console.log(resultado);
          }
        });
    })
  );

document.getElementById('form-restaurar-cuenta').addEventListener('submit', function(event) {
    // Muestra el alert después de enviar el formulario
    setTimeout(function() {
        alert("Cuenta restaurada y eliminada de la lista temporal exitosamente");
    }, 10);
});
