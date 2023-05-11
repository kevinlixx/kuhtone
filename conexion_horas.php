<?php
session_start();
$id_profesional = $_SESSION['id_profesional'];
// Conectar a la base de datos
$host = 'localhost';
$dbname = 'kuhtone';
$user = 'root';
$password = '';

$conn = new mysqli($host, $user, $password, $dbname);

// Verificar si la conexión fue exitosa
if ($conn->connect_error) {
  die("Error de conexión a la base de datos: " . $conn->connect_error);
}

// Obtener la fecha seleccionada
$selectedDate = $_GET['fecha'];

// Consultar las horas disponibles para la fecha seleccionada
$query = "SELECT DATE_FORMAT(hora_inicio, '%H:%i') AS hora FROM disponibilidad WHERE (id_profesional = $id_profesional) AND (fecha_disponibilidad = '$selectedDate') AND (id_estadoDisponibilidad = 1)";
$result = $conn->query($query);

// Crear un arreglo con las horas disponibles
$availableHours = array();
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    array_push($availableHours, $row['hora']);
  }
}

// Cerrar la conexión a la base de datos
$conn->close();

// Devolver la respuesta en formato JSON
echo json_encode($availableHours);


?>
