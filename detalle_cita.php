<?php
                
session_start();
include("./conexion.php");
$id_dispo= $_GET['id_dispo'];

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
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700&family=Inter:wght@300;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./css/style_detalleCita.css">
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
                        <li><a href="./psicologos.html" >Inicio</a></li>
                        <li><a href="#">Asignar cita</a></li>
                        <li><a href="#" >Mis citas</a></li>
                        <li><a href="#" id="selected">Iniciar Sesion</a></li>
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
    <?php
         if($consulta_agenda= mysqli_fetch_array($consulta_agendamiento))
            {
                $_SESSION['id_agendamiento'] = $consulta_agenda["id_agendamiento"];
                $disponibilidad = "SELECT * FROM disponibilidad WHERE id_disponibilidad ='".$consulta_agenda['id_disponibilidad']."'";
                $consulta_disponibilidad = mysqli_query($conection, $disponibilidad ) or die ("Error al traer los datos");
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
                                                    <figure class="perfil--logos"> 
                                                        <img 
                                                        src="./img/editor-logo.svg" 
                                                        alt="psicologo"
                                                        />  
                                                        <figcaption></figcaption> 
                                                    </figure>
                                                
                                                <h4>Nombres</h4>
                                                <p>
                                                    '.$consulta_profe["nombres"].' 
                                                </p>
                                                
                                                    <figure class="perfil--logos"> 
                                                        <img 
                                                        src="./img/editor-logo.svg" 
                                                        alt="psicologo"
                                                        />  
                                                        <figcaption></figcaption> 
                                                    </figure>
                                                
                                                <h4>Apellidos</h4>
                                                <p>
                                                '.$consulta_profe["apellidos"].'  
                                                </p>
                                                
                                                    <figure class="perfil--logos"> 
                                                        <img 
                                                        src="./img/email_logo.svg" 
                                                        alt="psicologo"
                                                        />  
                                                        <figcaption></figcaption> 
                                                    </figure>
                                               
                                                <h4>E-mail</h4>
                                                <p>
                                                    '.$consulta_profe["correo_profesional"].'
                                                </p>
                                                
                                                    <figure class="perfil--logos"> 
                                                        <img 
                                                        src="./img/student_logo.svg" 
                                                        alt="psicologo"
                                                        />  
                                                        <figcaption></figcaption> 
                                                    </figure>
                                                
                                                <h4>Educación</h4>
                                                <p>
                                                    '.$consulta_profe["nom_universidad"].'  
                                                </p>
                                                </section>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="calendar--container">
                                    <div class="section-calendar--container">
                                        <section class="calendar--logo"
                                        <figure class="calendar--logo"> 
                                            <img 
                                            src="./img/calendar.svg" 
                                            alt="calendario"
                                            />  
                                            <figcaption></figcaption> 
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
                                    <div id="qr--link">
                                    <img  class="qr--img"src="qr_generator.php" alt="Código QR">
                                    </div>         
                                ';
                    

                }
            }
        }
    ?>

                                 </div> 
                                        <a href="./psicologos.php" class="back--bottom">volver</a>
    
    </main>
   <footer class="pie-pagina">
   <div class="footer_copy">
        <small>&copy; 2023 <b>kuhtone</b> - Todos los Derechos Reservados.</small>
   </div>
</footer>
<script src="js/script.js"></script>
</body>
</html>