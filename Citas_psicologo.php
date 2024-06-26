<?php
include("./config/conexion.php");
$id_profesional = $_GET['id_perfil'];
$fecha_busqueda = isset($_GET['fecha']) ? $_GET['fecha'] : null;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>kuhtone</title>
    <script src="https://kit.fontawesome.com/79e6024c63.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700&family=Inter:wght@300;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./css/style_mis_citas.css">
    <!-- <link rel="stylesheet" href="./css/tablet_usr.css" media="screen and (min-width: 600px)" /> -->
    <link rel="stylesheet" href="./css/desktop_mis_citas.css" media="screen and (min-width: 800px)" />
</head>

<body>
    <header>
        <section class="section_header">
            <figure class="figure_header">
                <img src="./img/logo_header.svg" alt="lgo de kuhtone" />
                <figcaption></figcaption>
            </figure>
            <div class="menu menu-header">

                <figure id="btn_menu">
                    <img src="./img/menu.svg" alt="menu" />
                    <figcaption></figcaption>
                </figure>
                <div id="back_menu"></div>
                <nav id="nav" class="menu-section">
                    <img src="img/logo_header.svG" alt="">
                    <ul>
                        <?php
                        echo '
                      <li><a href="./index_psicologos.php?id_perfil=' . $id_profesional . '">Inicio</a></li>
                        <li><a href="./queries/consultar_dispo.php?id_perfil=' . $id_profesional . '">Mi disponibilidad</a></li>
                        <li><a href="./perfil_psicologo.php?id_perfil=' . $id_profesional . '">Mi perfil</a></li>
                        <li><a href="./index.php" id="selected">Cerrar Sesion</a></li>';
                        ?>

                    </ul>
                </nav>
            </div>
            <!-- <a href="" class="menu-header">
            <figure >
                <img 
                src="./img/menu.svg" 
                alt="menu"
                />  
                <figcaption></figcaption> 
            </figure> -->
            </a>
    </header>
    <main>
        <div class="design--container">
            <figure class="figure-consult">
                <img src="../img/consulta_cita.svg" alt="img de cita" />
                <figcaption></figcaption>
            </figure>
            <h1 class="title--main">Mis citas</h1>
            <h2 class="sub-titulo">Seleccione la fecha de la cita:</h2>
            <form action="./Citas_psicologo.php" method="get">
                <input type="date" id="fecha" name="fecha">
                <input type="hidden" name="id_perfil" value="<?php echo $id_profesional; ?>">
                <input type="submit" value="Buscar citas" class="change--bottom">
            </form>
            <div class="psicologos--contenedor">
                <?php
                include("./config/conexion.php");

                if ($fecha_busqueda) {
                    $consulta = mysqli_query($conection, "SELECT paciente.*, disponibilidad.fecha_disponibilidad, disponibilidad.hora_inicio, disponibilidad.hora_final FROM paciente
                                                      JOIN agendamiento ON paciente.id_paciente = agendamiento.id_paciente
                                                      JOIN disponibilidad ON agendamiento.id_disponibilidad = disponibilidad.id_disponibilidad
                                                      WHERE disponibilidad.id_profesional = $id_profesional AND disponibilidad.fecha_disponibilidad = '$fecha_busqueda'")
                        or die("Error al traer los datos");

                    if (mysqli_num_rows($consulta) > 0) {
                        while ($consulta_total = mysqli_fetch_array($consulta)) {

                            echo '
                            <section class="psicologos--card">
                                <figure class="figure--card"> 
                                    <img 
                                    src="' . $consulta_total["foto_perfil"] . '" 
                                    alt="psicologo"
                                    />  
                                    <figcaption></figcaption> 
                                </figure>
                                <div class="psicologo--description">
                                    <h4>Paciente</h4>
                                    <p><span class="item--aco">Nombre:</span> ' . $consulta_total["nombres"] . '</p>
                                    <p><span class="item--aco">Apellidos:</span> ' . $consulta_total["apellidos"] . '</p>
                                    <p><span class="item--aco">Correo:</span> ' . $consulta_total["correo"] . '</p>
                                    <p><span class="item--aco">Teléfono móvil:</span> ' . $consulta_total["telefono_movil"] . '</p>
                                    <p><span class="item--aco">Fecha de la cita:</span> ' . $consulta_total["fecha_disponibilidad"] . '</p>
                                    <p><span class="item--aco">Hora de inicio:</span> ' . $consulta_total["hora_inicio"] . '</p>
                                    <p><span class="item--aco">Hora de finalización:</span> ' . $consulta_total["hora_final"] . '</p>
                                </div>
                                <div class="mas_info--description-container">                              
                                <a href="info_paciente.php?id_paciente=' . $consulta_total["id_paciente"] . '&id_perfil=' . $id_profesional . '" class="mas_info--description">
                                    <figure class="icon-ingreso"> 
                                        <img src="./img/icon-ingreso.svg" alt="icono de ingreso"/>  
                                    </figure>
                                </a>
                            </section>
                            ';
                        }
                    } else {
                        echo "<p style='color: #000000; font-weight: bold; text-align: center; font-size: 20px;'>No se encontraron pacientes asignados en la fecha especificada.</p>";
                    }
                }
                ?>
                <a href="./index_psicologos.php?id_perfil=<?php echo $id_profesional; ?>" class="back--bottom">Volver</a>
            </div>
        </div>
    </main>
    <footer class="pie-pagina">
        <div class="footer_copy">
            <small>&copy; 2023 <b>kuhtone</b> - Todos los Derechos Reservados.</small>
        </div>
    </footer>

    <script src="js/script.js"></script>
</body>