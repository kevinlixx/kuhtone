<?php
// Incluir el archivo de conexión a la base de datos
include("./config/conexion.php");

// Obtener el ID del perfil del profesional, la fecha de búsqueda y el ID del paciente de la URL
$id_profesional = isset($_GET['id_perfil']) ? $_GET['id_perfil'] : null;
$fecha_busqueda = isset($_GET['fecha']) ? $_GET['fecha'] : null;
$id_paciente = isset($_GET['id_paciente']) ? $_GET['id_paciente'] : null;

// Consulta SQL para obtener la descripción del diagnóstico
$sql = "SELECT * FROM paciente WHERE id_paciente = ?";

$stmt = $conection->prepare($sql);
$stmt->bind_param("i", $id_paciente);
$stmt->execute();
$result = $stmt->get_result();

$paciente = $result->fetch_assoc();

$stmt->close();
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
    <link rel="stylesheet" href="./css/style_info_pacPsico.css">
    <link rel="stylesheet" href="./css/tablet.css" media="screen and (min-width: 600px)" />
    <link rel="stylesheet" href="./css/desktop.css" media="screen and (min-width: 800px)" />
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
        <?php
        // Verificar si se ha proporcionado un ID de paciente
        if ($id_paciente !== null) {
            // Realizar la consulta a la base de datos para obtener la información del paciente
            $consulta = "
                    SELECT 
                        foto_perfil as foto,
                        nombres, 
                        apellidos, 
                        correo, 
                        telefono_movil 
                    FROM 
                        paciente 
                    WHERE 
                        id_paciente = '$id_paciente'
                ";
            $resultado = $conection->query($consulta);

            // Verificar si se encontró algún resultado
            if ($resultado->num_rows > 0) {
                // Obtener la información del paciente
                $paciente = $resultado->fetch_assoc();

                // Mostrar la información del paciente
                echo '
                    <div class="Contendor-info-paciente">
                        <section class="psicologo--card">
                            <figure class="figure--card"> 
                                <img class="paciente-img" src="' . $paciente["foto"] . '" alt="Foto del paciente"/>  
                                <figcaption></figcaption> 
                            </figure>
                        </section>
                        <div class="psicologo-details--container">
                            <div class="psicologo-perfil--container">
                                <h3>Paciente</h3>
                                <section>
                                    <div class="info-group">
                                        <img class="small-image" src="./img/NameUsuario.svg" alt="Icono de Nombre">
                                        <div>
                                            <h4>Nombres:</h4>
                                            <p class="paciente-nombre">' . $paciente["nombres"] . '</p>
                                        </div>
                                    </div>
                                    <div class="info-group">
                                        <img class="small-image" src="./img/NameUsuario.svg" alt="Icono de Apellido">
                                        <div>
                                            <h4>Apellidos:</h4>
                                            <p class="paciente-apellidos">' . $paciente["apellidos"] . '</p>
                                        </div>
                                    </div>
                                    <div class="info-group">
                                        <img class="small-image" src="./img/Correo-Perfil.svg" alt="Icono de correo">
                                        <div>
                                            <h4>E-mail:</h4>
                                            <p class="paciente-correo">' . $paciente["correo"] . '</p>
                                        </div>
                                    </div>
                                    <div class="info-group">
                                         <img class="small-image" src="./img/phone_icon.svg" alt="Telefono">
                                         <div>
                                            <h4>Teléfono móvil:</h4>
                                            <p class="paciente-telefono">' . $paciente["telefono_movil"] . '</p>
                                        </div>
                                    </div>
                               </div>
                                    
                                
                                </section>
                            </div>
                        </div>
                    </div>
                    ';
            } else {
                // Si no se encontró ningún paciente con ese ID
                echo "No se encontró ningún paciente con ese ID.";
            }
        }
        ?>
        <div class="button-container">
            <button class="form-bottom" onclick="location.href='./asistencia_paciente.php?id_paciente=<?php echo $id_paciente; ?>&id_profesional=<?php echo $id_profesional; ?>'">Asistencia</button>
            <button class="form-bottom" onclick="location.href='./reportes_psicologo.php?id_perfil=<?php echo $id_profesional; ?>&id_paciente=<?php echo $id_paciente; ?>'">Reportes</button>

        </div>
        <div class="back-button-container">
        <a href="./Citas_psicologo.php?id_perfil=<?php echo $id_profesional; ?>" class="back--bottom">Volver</a>
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