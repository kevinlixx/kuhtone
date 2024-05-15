<?php
include("../config/conexion.php");
$id_admin= $_GET['id_perfil'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>kuhtone</title>
    <script src="https://kit.fontawesome.com/41bcea2ae3.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" /> 
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700&family=Inter:wght@300;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/style_consultCita.css">
    <link rel="stylesheet" href="../css/tablet_consultCita.css" media="screen and (min-width: 600px)"/>
    <link rel="stylesheet" href="../css/desktop_consultCita.css" media="screen and (min-width: 800px)"/>
</head>
<body>
<header>
        <section class="section_header">
            <figure class="figure_header"> 
                <img 
                src="../img/logo_header.svg" 
                alt="logo de kuhtone"
                />  
                <figcaption></figcaption> 
            </figure>
            <div class="menu menu-header">
                
                    <figure id="btn_menu">
                        <img 
                        src="../img/menu.svg" 
                        alt="menu"
                        />  
                        <figcaption></figcaption> 
                    </figure>                
                <div id="back_menu"></div>
                <nav id="nav" class="menu-section">
                    <img src="../img/logo_header.svG" alt="">
                    <ul> 
                    <?php
                     echo'
                         <li><a href="../index_admin.php?id_perfil='.$id_admin.'">Inicio</a></li>
                       <li><a href="../perfil_admin.php?id_perfil='.$id_admin.'">Mi perfil</a></li>
                       <li><a href="../index.php" id="selected">Cerrar Sesion</a></li>';
                       ?>
                    </ul>
                </nav>
            </div>
            <!-- <a href="" class="menu-header">
            <figure >
                <img 
                src="../img/menu.svg" 
                alt="menu"
                />  
                <figcaption></figcaption> 
            </figure> -->
        </a>
    </header>
    <main style="height:90vh;">
             
        <!-- <h1 class="title--main">Consultar Agendamiento</h1>
        <form class="form--consult" method="POST" action="#">
             <div class ="div--content">
            <figure class= form--logo>
            <img src="../img/experience_logo.svg" alt="logo de un agenda">
            </figure>
             <i class="fa-regular fa-user-tie-hair" style="color: #303030;"></i> 
            <input class="input--consult" type="text" name="consult--calendar" placeholder="Digite el id de la cita">
            </div> --> 
        </form>
        <h2 class= "subtitle"> Sedes </h2>
        <figure class="figure-consult">
                <img src="../img/imgSede.jpeg" alt="img de cita" />
                <figcaption></figcaption>
        </figure>
        <div class= "cites--container">
            <div class="des--sedes">
        <?php
         $consulta = mysqli_query($conection, "SELECT * FROM sedes Where estado_sede = 2") or die ("Error al traer los datos");
            if(mysqli_num_rows($consulta) > 0)
            {
                    while($consulta_sedes= mysqli_fetch_array($consulta))
                    {
                        echo '
                        
                                <div class ="container--history"> 
                                    <div class="info--container">
                                        <section>
                                            <h4>Id sede:</h4>
                                            <p>'.$consulta_sedes["id_sede"].' </p>
                                        </section>
                                        <section>
                                            <h4>Localización</h4>
                                            <p>'.$consulta_sedes["nombre"].'</p>
                                        </section>
                                    </div>
                                    <a class="mas--select" href="consultar_sedesInhabilitadas.php?habilitar_sede='.$consulta_sedes["id_sede"].'">Habilitar sede</a>

                                </div>';
                        
                    }

                        if (isset($_GET['habilitar_sede'])) {
                            $id_sede = $_GET['habilitar_sede'];

                            $query = "UPDATE sedes SET estado_sede = 1 WHERE id_sede = $id_sede";
                            $result = mysqli_query($conection, $query);

                            if (!$result) {
                                die('Error al habilitar la sede: ' . mysqli_error($conection));
                            } else {
                                // Redirige de vuelta a la página de sedes inhabilitadas después de habilitar la sede
                                echo '<script>alert("Sede habilitada correctamente");
                                window.location.href="consultar_sedes.php";</script>';
                                exit;
                            }
                        }
                }
                
            else{
                echo '<script>alert("No tiene ninguna sede inhabilitada");
                window.location.href="../gestion_sedes.php?id_perfil='.$id_admin.'";</script>';
            }
            ?>
             </div>
        </div>
        

    </main>
   <footer class="pie-pagina">
   <div class="footer_copy">
        <small>&copy; 2023 <b>kuhtone</b> - Todos los Derechos Reservados.</small>
   </div>
</footer>
<script src="../js/script.js"></script>
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script src="../js/script_map.js"></script>
</body>
</html>