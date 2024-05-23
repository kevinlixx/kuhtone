<?php
    include("./config/conexion.php");

    $id_profesional= $_GET['id_perfil'];
    $fecha_busqueda = isset($_GET['fecha']) ? $_GET['fecha'] : null;

    // Verificar si se proporciona el ID del perfil del profesional
    if (!isset($id_profesional)) {
        die("Error: No se proporcionó el id_perfil del profesional.");
    }

    // Consulta SQL para obtener los pacientes asignados a un profesional específico
    $consulta = mysqli_query($conection, "SELECT paciente.* FROM paciente JOIN paciente_profesional ON paciente.id_paciente = paciente_profesional.id_paciente WHERE paciente_profesional.id_profesional = $id_profesional") or die ("Error al traer los datos");
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
    <link rel="stylesheet" href="./css/Pacientes_psicologos.css">
    <link rel="stylesheet" href="./css/tablet_usr.css" media="screen and (min-width: 600px)"/>
    <link rel="stylesheet" href="./css/desktop_usr.css" media="screen and (min-width: 800px)"/>
</head>
<body>
    <header>
        <section class="section_header">
            <figure class="figure_header"> 
                <img src="./img/logo_header.svg" alt="lgo de kuhtone"/>  
                <figcaption></figcaption> 
            </figure>
            <div class="menu menu-header">
                <figure id="btn_menu">
                    <img src="./img/menu.svg" alt="menu"/>  
                    <figcaption></figcaption> 
                </figure>                
                <div id="back_menu"></div>
                <nav id="nav" class="menu-section">
                    <img src="img/logo_header.svG" alt="">
                    <ul> 
                    <?php
                      echo'
                      <li><a href="./index_psicologos.php?id_perfil='.$id_profesional.'">Inicio</a></li>
                        <li><a href="./queries/consultar_dispo.php?id_perfil='.$id_profesional.'">Mi disponibilidad</a></li>
                        <li><a href="./perfil_psicologo.php?id_perfil='.$id_profesional.'">Mi perfil</a></li>
                        <li><a href="./index.php" id="selected">Cerrar Sesion</a></li>';
                    ?>
                    </ul>
                </nav>
            </div>
        </section>
    </header>
    <main>
        <h1 class="title--main">Mis Pacientes</h1> <!-- Título con id -->
        <div class="design--container">
        <?php
            if(mysqli_num_rows($consulta) > 0) {
                while($consulta_total = mysqli_fetch_array($consulta)) {
                    echo '
                    <section class="psicologos--card">
                        <figure class="figure--card"> 
                            <img src="'.$consulta_total["foto_perfil"].'" alt="psicologo"/>  
                            <figcaption></figcaption> 
                        </figure>
                        <div class="psicologo--description">
                            <h4>Paciente</h4>
                            <p><span class="item--aco">Nombres:</span> <span class="item--value">'.$consulta_total["nombres"].' '.$consulta_total["apellidos"].'</span></p>
                            <p><span class="item--aco">Correo:</span> <span class="item--value">'.$consulta_total["correo"].'</span></p>
                            <p><span class="item--aco">Teléfono móvil:</span> <span class="item--value">'.$consulta_total["telefono_movil"].'</span></p>
                        </div>
                    </section>';
                }
            } else {
                echo "<p style='color: #000000; font-weight: bold; text-align: center; font-size: 20px;'>No se encontraron pacientes asignados a este profesional.</p>";
            }
        ?>

        </div>
        <a href="./index_psicologos.php?id_perfil=<?php echo $id_profesional; ?>" class="back--bottom">Volver</a>
    </main>
    
    <footer class="pie-pagina">
        <div class="footer_copy">
            <small>&copy; 2023 <b>kuhtone</b> - Todos los Derechos Reservados.</small>
        </div>
    </footer>
    <script src="js/script.js"></script>
</body>
</html>