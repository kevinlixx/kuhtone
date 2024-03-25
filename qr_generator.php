<?php
session_start();
$id_agenda = $_SESSION['id_agendamiento'];
include("./config/conexion.php");
include "phpqrcode/qrlib.php";
require_once "phpqrcode/qrlib.php";

$disponibilidad = "SELECT * FROM agendamiento WHERE id_agendamiento = $id_agenda ";
$consulta_disponibilidad = mysqli_query($conection, $disponibilidad) or die ("Error al traer los datos");
if($consulta_disponibilidadTotal = mysqli_fetch_array($consulta_disponibilidad)) {
    $link_teams= $consulta_disponibilidadTotal["link_teams"];

    // Tamaño del código QR (1-10, donde 10 es el más grande)
    $tamaño = 5;

    // Generar el código QR
    ob_start(); // Guardar la salida en un buffer
    QRcode::png($link_teams, null, QR_ECLEVEL_Q, $tamaño);
    $qr_image = ob_get_clean(); // Obtener la salida del buffer y limpiarlo

    // Devolver la imagen como respuesta
    header('Content-Type: image/png');
    echo $qr_image;
}
?>

