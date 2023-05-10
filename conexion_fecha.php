<?php
// Establecer los encabezados de respuesta para indicar que se están enviando datos JSON
header('Content-Type: application/json');
// Obtener el valor de $id de la URL


session_start();
$id_profesional = $_SESSION['id_profesional'];
// onectar con la base de datos
$host = 'localhost';
$dbname = 'kuhtone';
$username = 'root';
$password = '';

try {
  $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  // Consultar las fechas disponibles desde la base de datos
  $query = "SELECT fecha_disponibilidad FROM disponibilidad WHERE id_profesional= $id_profesional";
  $stmt = $conn->prepare($query);
  $stmt->execute();
  $fechas_db = array();
  while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $fecha = $row['fecha_disponibilidad'];
    $fechas_db[] = date("Y-m-d", strtotime($fecha));
  }

  // Enviar las fechas como respuesta JSON

header('Content-Type: application/json');
echo json_encode($fechas_db);

} catch(PDOException $e) {
  // Enviar una respuesta de error si ocurre algún problema al conectar con la base de datos
  echo json_encode(array('error' => $e->getMessage()));
}

// Cerrar la conexión con la base de datos
$conn = null;

?>