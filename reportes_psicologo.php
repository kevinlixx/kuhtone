<?php
include("./config/conexion.php");

// Obtener el ID del perfil del profesional, la fecha de búsqueda y el ID del paciente de la URL
$id_profesional = isset($_GET['id_perfil']) ? $_GET['id_perfil'] : null;
$fecha_busqueda = isset($_GET['fecha']) ? $_GET['fecha'] : null;
$id_paciente = isset($_GET['id_paciente']) ? $_GET['id_paciente'] : null;

$sql = "SELECT s.fecha_sesion, d.descripcion as diagnostico, s.reporte_sesion
            FROM sesion s
            INNER JOIN diagnostico d ON s.id_diagnostico = d.id_diagnostico
            WHERE s.id_profesional = $id_profesional";

// Si se proporcionó un ID de paciente, añadirlo a la consulta
if ($id_paciente !== null) {
    $sql .= " AND s.id_paciente = $id_paciente";
}

// Si se proporcionó una fecha de búsqueda, añadirla a la consulta
if ($fecha_busqueda !== null) {
    $sql .= " AND s.fecha_sesion = '$fecha_busqueda'";
}

$sql .= " ORDER BY s.fecha_sesion DESC";

$result = mysqli_query($conection, $sql);

if (!$result) {
    die("Error en la consulta: " . mysqli_error($conection));
}

$sesiones = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Metadatos y enlaces a archivos externos -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>kuhtone</title>
    <script src="https://kit.fontawesome.com/79e6024c63.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700&family=Inter:wght@300;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./css/style_cuentasTemp.css">
    <link rel="stylesheet" href="./css/tablet_cuentasTemp.css" media="screen and (min-width: 500px)" />
    <link rel="stylesheet" href="./css/desktop_cuentasTemp.css" media="screen and (min-width: 800px)" />
</head>

<body>
    <!-- Encabezado de la página -->
    <header>
        <section class="section_header">
            <!-- Logo -->
            <figure class="figure_header">
                <img src="./img/logo_header.svg" alt="lgo de kuhtone" />
                <figcaption></figcaption>
            </figure>

            <!-- Menú de navegación -->
            <div class="menu menu-header">
                <figure id="btn_menu">
                    <img src="./img/menu.svg" alt="menu" />
                    <figcaption></figcaption>
                </figure>
                <div id="back_menu"></div>
                <nav id="nav" class="menu-section">
                    <img src="img/logo_header.svG" alt="">
                    <ul>
                        <!-- Enlaces dinámicos según el ID del perfil del profesional -->
                        <?php
                        echo '
                            <li><a href="./index_psicologos.php?id_perfil=' . $id_profesional . '">Inicio</a></li>
                            <li><a href="./queries/consultar_dispo.php?id_perfil=' . $id_profesional . '">Mi disponibilidad</a></li>
                            <li><a href="./perfil_psicologo.php?id_perfil=' . $id_profesional . '">Mi perfil</a></li>
                            <li><a href="./index.php" id="selected">Cerrar Sesión</a></li>';
                        ?>
                    </ul>
                </nav>
            </div>
        </section>
    </header>

    <!-- Contenido principal -->
    <main>
        <h1 class="title--main">Reportes de Sesiones</h1>
        <div class="design--container">
            <div id="cuentas-contenedor" class="psicologos--contenedor">
                <?php foreach ($sesiones as $sesion) : ?>
                    <section class="psicologos--card">
                        <h4>Fecha de sesión:</h4>
                        <p><?= $sesion['fecha_sesion'] ?></p>
                        <h4>Diagnóstico:</h4>
                        <p><?= $sesion['diagnostico'] ?? 'N/A' ?></p>
                        <h4>Reporte de sesión:</h4>
                        <p><?= nl2br($sesion['reporte_sesion']) ?></p>
                    </section>
                <?php endforeach; ?>
                <div><a href="./citas_psicologo.php?id_perfil=<?= $id_profesional ?>" class="back--bottom">Volver</a></div>
            </div>
        </div>
    </main>
    <!-- Pie de página -->
    <footer class="pie-pagina">
        <div class="footer_copy">
            <small>&copy; 2023 <b>kuhtone</b> - Todos los Derechos Reservados.</small>
        </div>
    </footer>

    <!-- Archivo de script -->
    <script src="js/script.js"></script>
</body>

</html>