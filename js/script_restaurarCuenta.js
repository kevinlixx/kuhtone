document
  .getElementById("form-restaurar-cuenta")
  .addEventListener("submit", function (event) {
    event.preventDefault();

    const formData = new FormData(event.target);

    fetch("gestion_delCuenta.php", {
      method: "POST",
      body: formData,
    })
      .then((response) => response.text())
      .then((resultado) => {
        if (resultado.includes("eliminada exitosamente")) {
          alert(
            "Cuenta restaurada y eliminada de la lista temporal exitosamente"
          );
        } else {
          console.log(resultado);
        }
      });
  });
