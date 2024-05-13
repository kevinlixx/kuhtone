<?php
    include("./config/conexion.php");

    if (!isset($_GET['id_perfil'])) {
        die("Error: No se proporcionó el id_perfil.");
    }

    $id_profesional = $_GET['id_perfil'];

    // Consulta SQL para obtener la información de los pacientes asignados a este psicólogo
    $sql = "SELECT p.foto_perfil, p.nombres, p.apellidos, p.correo, p.telefono_movil, d.descripcion 
            FROM paciente p 
            JOIN asignacion a ON p.id_paciente = a.id_paciente 
            JOIN diagnostico d ON p.id_paciente = d.id_paciente 
            WHERE a.id_profesional = ?"; // Asegúrate de reemplazar ? con el id del psicólogo

    $stmt = $conection->prepare($sql);
    if ($stmt === false) {
        die("Error: No se pudo preparar la consulta SQL. " . $conection->error);
    }

    $stmt->bind_param("i", $id_profesional);
    $stmt->execute();
    $result = $stmt->get_result();
    $pacientes = $result->fetch_all(MYSQLI_ASSOC);
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
                <img 
                src="./img/logo_header.svg" 
                alt="lgo de kuhtone"
                />  
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

    <h1 id="titulo-citas">Mis Pacientes</h1> <!-- Título con id -->
    <main>
        <?php
            foreach ($pacientes as $paciente) {
                echo '
                <div class="Contendor-info-paciente">
                    <section class="psicologo--card">
                        <figure class="figure--card"> 
                            <img class="paciente-img" src="'.$paciente["foto_perfil"].'" alt="Foto del paciente"/>  
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
                                        <p class="paciente-nombre">'.$paciente["nombres"].'</p>
                                    </div>
                                </div>
                                <div class="info-group">
                                    <img class="small-image" src="./img/NameUsuario.svg" alt="Icono de Apellido">
                                    <div>
                                        <h4>Apellidos:</h4>
                                        <p class="paciente-apellidos">'.$paciente["apellidos"].'</p>
                                    </div>
                                </div>
                                <div class="info-group">
                                    <img class="small-image" src="./img/Correo-Perfil.svg" alt="Icono de correo">
                                    <div>
                                        <h4>E-mail:</h4>
                                        <p class="paciente-correo">'.$paciente["correo"].'</p>
                                    </div>
                                </div>
                                <div class="info-group">
                                     <img class="small-image" src="./img/phone_icon.svg" alt="Telefono">
                                     <div>
                                        <h4>Teléfono móvil:</h4>
                                        <p class="paciente-telefono">'.$paciente["telefono_movil"].'</p>
                                    </div>
                                </div>
                                <div class="info-group">
                                <img class="small-image" src="./img/Diagnostico.svg" alt="Diagnóstico">
                                <div>
                                   <h4>Diagnóstico:</h4>
                                   <p class="descripcion-diagnostico">'.$paciente["descripcion"].'</p>
                               </div>
                           </div>
                            </section>
                        </div>
                    </div>
                </div>
                ';
            }
        ?> 
        <!-- ... -->
    </main>

    <footer class="pie-pagina">
    <div class="footer_copy">
        <small>&copy; 2023 <b>kuhtone</b> - Todos los Derechos Reservados.</small>
    </div>
    </footer>
    <script src="js/script.js"></script>
</body>