<?php
include("../config/conexion.php");
$id_profesional= $_GET['id_perfil'];
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
                      <li><a href="../index_psicologos.php?id_perfil='.$id_profesional.'">Inicio</a></li>
                        <li><a href="../queries/consultar_dispo.php?id_perfil='.$id_profesional.'">Mi disponibilidad</a></li>
                        <li><a href="../perfil_psicologo.php?id_perfil='.$id_profesional.'">Mi perfil</a></li>
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
    <main>
             
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
        <h2 class= "subtitle"> Tus horarios disponibles </h2>
        <figure class ="figure-consult">
                <img 
                src="../img/pag1.jpg" 
                alt="img de cita"/>  
                <figcaption></figcaption> 
            </figure>
        <div class= "cites--container">
        
        <?php
         $consulta = mysqli_query($conection, "SELECT * FROM disponibilidad WHERE id_profesional = '$id_profesional'") or die ("Error al traer los datos");
            if(mysqli_num_rows($consulta) > 0)
            {
                    while($consulta_dispo= mysqli_fetch_array($consulta))
                    {
                        echo '
                            <div class ="container--history"> 
                                <div class="info--container">
                                    <section>
                                        <h4>Id disponibilidad:</h4>
                                        <p>'.$consulta_dispo["id_disponibilidad"].' </p>
                                    </section>
                                    <section>
                                        <h4>Fecha de disponibilidad</h4>
                                        <p>'.$consulta_dispo["fecha_disponibilidad"].'</p>
                                    </section>
                                    <section>
                                        <h4>Hora de disponibilidad:</h4>
                                        <p>'.$consulta_dispo["hora_inicio"].'</p>
                                    </section>
                                </div>
                                <a class="mas--select" href="../modificar_disponibilidad.php?id_dispo='.$consulta_dispo['id_disponibilidad'].'&id_perfil='.$id_profesional.'">Modificar</a>

                            </div>';
                    }
                }
            else{
                echo '<script>alert("No tiene ninguna disponibilidad registrada");
                window.location.href="../insert_disponibilidad.php?id_perfil='.$id_profesional.'";</script>';
            }
            ?>
        
        </div>
        

    </main>
   <footer class="pie-pagina">
   <div class="footer_copy">
        <small>&copy; 2023 <b>kuhtone</b> - Todos los Derechos Reservados.</small>
   </div>
</footer>
<script src="../js/script.js"></script>
</body>
</html>