<?php
                
session_start();
include("./config/conexion.php");

if (isset($_POST['id_perfil'])) {
    $id_paciente = $_POST['id_perfil'];
    $id_dispo= $_POST['id_dispo'];
} else {
    $id_paciente = $_GET['id_perfil'];
    $id_dispo= $_GET['id_dispo'];
} 

$agendamiento ="SELECT * FROM agendamiento WHERE id_disponibilidad = $id_dispo";
$consulta_agendamiento = mysqli_query($conection, $agendamiento ) or die ("Error al traer los datos");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>kuhtone</title>
    <script src="https://kit.fontawesome.com/41bcea2ae3.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700&family=Inter:wght@300;500&display=swap" rel="stylesheet"/>
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="./css/style_detalleCita.css"/>
    <link rel="stylesheet" href="./css/tablet_detalleCita.css" media="screen and (min-width: 600px)"/>
    <link rel="stylesheet" href="./css/desktop_detalleCita.css" media="screen and (min-width: 800px)"/>
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
                        <img 
                        src="./img/menu.svg" 
                        alt="menu"
                        />  
                        <figcaption></figcaption> 
                    </figure>                
                <div id="back_menu"></div>
                <nav id="nav" class="menu-section">
                    <img src="img/logo_header.svG" alt="">
                    <ul> 
                    <?php
                      echo'
                        <li><a href="./index_usr.php?id_perfil='.$id_paciente.'">Inicio</a></li>
                        <li><a href="./queries/consultar_citas.php?id_perfil='.$id_paciente.'">Mis citas</a></li>
                        <li><a href="./perfil.php?id_perfil='.$id_paciente.'">Mi perfil</a></li>
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
        <form action="#" method="POST">
    <?php
         if($consulta_agenda= mysqli_fetch_array($consulta_agendamiento))
            {
                $consult_sede = "SELECT * FROM sedes WHERE id_sede = {$consulta_agenda['id_sede']}";
                $consulta_sede = mysqli_query($conection, $consult_sede) or die ("Error al traer los datos");

                if (!$consulta_sede) {
                    echo json_encode(["error" => mysqli_error($conection)]);
                    exit();
                }
                $sede = mysqli_fetch_all($consulta_sede, MYSQLI_ASSOC);
        ?>
                <script>
                    var sede = <?php echo json_encode($sede); ?>;
                </script>
        <?php
                

                // Convertimos el array en JSON y lo devolvemos


                $_SESSION['id_agendamiento'] = $consulta_agenda["id_agendamiento"];
                $disponibilidad = "SELECT * FROM disponibilidad WHERE id_disponibilidad ='".$consulta_agenda['id_disponibilidad']."'";
                $consulta_disponibilidad = mysqli_query($conection, $disponibilidad ) or die ("Error al traer los datos");
                // Convertimos los resultados en un array asociativo
                
                if($consulta_dispo= mysqli_fetch_array($consulta_disponibilidad))
                    {
                        $profesional ="SELECT * FROM profesional WHERE id_profesional =$consulta_dispo[id_profesional]";
                        $consulta_profesional = mysqli_query($conection, $profesional ) or die ("Error al traer los datos");
                        if($consulta_profe= mysqli_fetch_array($consulta_profesional)){
                            echo'
                                <div class="psicologo-info--card">
                                    <div class="section--card">
                                        <section class="psicologo--card">
                                            <figure class="figure--card"> 
                                                <img 
                                                src="'.$consulta_profe["foto_perfil"].'" 
                                                alt="psicologo"
                                                />  
                                                <figcaption></figcaption> 
                                            </figure>
                                        </section>
                                        <div class="psicologo-details--container">
                                            <div class="psicologo-perfil--container">
                                                <h3>Psicologo</h3>

                                                <section>
                                                    <div class="info-group">
                                                        <img class="small-image" src="./img/NameUsuario.svg" alt="Icono de Nombre">
                                                        <div>
                                                            <h4>Nombres</h4>
                                                            <p>'.$consulta_profe["nombres"].'</p>
                                                        </div>
                                                    </div>
                                                    <div class="info-group">
                                                        <img class="small-image" src="./img/NameUsuario.svg" alt="Icono de Apellido">
                                                        <div>
                                                            <h4>Apellidos</h4>
                                                            <p>'.$consulta_profe["apellidos"].'</p>
                                                        </div>
                                                    </div>
                                                    <div class="info-group">
                                                        <img class="small-image" src="./img/Correo-Perfil.svg" alt="Icono de correo">
                                                        <div>
                                                            <h4>E-mail</h4>
                                                            <p>'.$consulta_profe["correo_profesional"].'</p>
                                                        </div>
                                                    </div>
                                                    <div class="info-group">
                                                        <img class="small-image" src="./img/Especializacion-Perfil.svg" alt="Educacion">
                                                        <div>
                                                            <h4>Educación</h4>
                                                            <p>'.$consulta_profe["nom_universidad"].'</p>
                                                        </div>
                                                    </div>
                                                </section>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="calendar--container">
                                    <div class="section-calendar--container">
                                        <section class="calendar--logo"
                                        <figure class="calendar--logo"> 
                                        <img class="small-image" src="./img/calendar_icon.svg" alt="Icono de correo"> 
                                        </figure>
                                    <h3>Agendamiento</h3>
                                    </section>
                                    <section class="id--calendar">
                                    <h4>Id Agendamiento </h4>
                                    <p>'.$consulta_agenda["id_agendamiento"].'</p>
                                    </section>
                                    <section class="fecha--calendar">
                                    <h4>Fecha de la cita </h4>
                                    <p>'.$consulta_dispo["fecha_disponibilidad"].'</p>
                                    </section>
                                    <section class="hour--calendar">
                                    <h4>Hora de la cita </h4>
                                    <p>'.$consulta_dispo["hora_inicio"].'</p>
                                    </section>  
                                    </div> 
                                    <div  class="qr--generator">
                                        <figure>
                                        <img  class="qr--img"src="./qr_generator.php" alt="Código QR">
                                        </figure>
                                        <section class="qr--info">
                                        <img class:"teams--logo" src="./img/teams--logo.svg">
                                        <a href="'.$consulta_agenda["link_teams"].'">Encuentro virtual en la plataforma Teams</a>
                                        </section>
                                    </div>
                                          
                                ';

            ?>  
                                 
                                </div> 

                               
                               
                                <div class="container--map"> 
                                    <h3>Ruta hacia la sede</h3>
                                    <div class="map" id="map">
                                        
                                    </div> 
                                    <section class="ruta--sede" id="ruta--sede">
                                            <?php
                                            // Comprueba si los datos de latitud y longitud están establecidos
                                            
                                            if (isset($_POST['latitud']) && isset($_POST['longitud'])) {
                                                # code...
                                                $latitud = $_POST['latitud'];
                                                $longitud = $_POST['longitud'];
                                                echo '
                                                
                                                    
                                                    <figure class="icon--map"> 
                                                        <img 
                                                        src="./img/icon_map.png" 
                                                        alt="psicologo"
                                                        />  
                                                        <figcaption></figcaption>
                                                    <a href="https://www.google.com/maps/dir/?api=1&origin='.$latitud.','.$longitud.'&destination='.$sede[0]['latitud'].','.$sede[0]['longitud'].'" target="_blank">Ver ruta</a>
                                                    </figure>
                                                    ';
                                                }
                                                
                                                ?>
                                            </section>
                                    
                                </div>
                                    <div class="bottom--container">
                                        <?php
                                        echo'
                                        <a href="./modificar_cita.php?id_agenda='.$consulta_agenda["id_agendamiento"].'&id_perfil='.$id_paciente.'" class="change--bottom">Modificar cita</a>
                                        <input type="submit" value="Cancelar cita" class="cancel--bottom" name="eliminar" required>
                                        ';
                                        ?>
                                    </div>
            <?php                  
                                 echo'   
                                    <a href="./queries/consultar_citas.php?id_perfil='.$id_paciente.'" class="back--bottom">Volver</a>';
            
                         if(isset($_POST ['eliminar'])){
                            $id_agenda =$consulta_agenda ['id_agendamiento'];
                            $instruccion_SQL="DELETE FROM agendamiento WHERE id_agendamiento = $id_agenda";
                            $dispo_on=$consulta_dispo['id_disponibilidad'];
                            $on_dispo = 1;
                            $instruccion_updateOn = "CALL modificarEstado_dispo($dispo_on,$on_dispo)";
                            $status_on =  mysqli_query($conection, $instruccion_updateOn) or trigger_error("Query Failed! SQL-Error: ".mysqli_error($conection), E_USER_ERROR);
                            $resultados = mysqli_query($conection,$instruccion_SQL) or trigger_error("Query Failed! SQL-Error: ".mysql_error($conection), E_USER_ERROR);
                            
                            if($resultados){
                            echo "<script>alert('Se ha eliminado exitosamente el agendamiento');
                                    window.location.href ='./index_usr.php?id_perfil=".$id_paciente."';</script>";          
                                } else {  
                                    echo "<script>alert('error en eliminar el agendamiento');</script>";
                                } 
                                mysqli_close($conection);
                    
                            
                         }
                                             
                    if ($consulta_agenda['tipo_cita'] == "presencial") {
                        # code...
                        echo'
                        <script>
                            document.querySelector(".qr--generator").style.display = "none";
                            document.querySelector(".container--map").style.display = "flex";
                            
                        </script>

                        ';
                    }
                    if ($consulta_agenda['tipo_cita'] == "virtual") {
                        # code...
                        echo'
                        <script>
                            document.querySelector(".qr--generator").style.display = "block";
                            document.querySelector(".container--map").style.display = "none";
                            
                            
                        </script>

                        ';
                    }
                }
            }
        }

    ?>
    </form>
    </main>
   <footer class="pie-pagina">
   <div class="footer_copy">
        <small>&copy; 2023 <b>kuhtone</b> - Todos los Derechos Reservados.</small>
   </div>
</footer>
<script src="js/script.js"></script>

<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script src="./js/script_consultMap.js"></script>
    <script>
    var id_paciente = <?php echo json_encode($id_paciente); ?>;
    var id_dispo = <?php echo json_encode($id_dispo); ?>;
    
    </script>

</body>
</html>