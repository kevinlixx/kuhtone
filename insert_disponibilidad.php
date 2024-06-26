<?php
    include("./config/conexion.php");
    $id_profesional= $_GET['id_perfil'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style_dispo.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <script src="https://kit.fontawesome.com/e1d55cc160.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./css/desktop_perfil.css" media="screen and (min-width: 800px)"/>
    <link rel="stylesheet" href="./css/tablet_insertDispo.css" media="screen and (min-width: 600px)"/>
    <title>Document</title>
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
    <main>
        <?php
            
                    echo'
                    <h2 class=title--main>Inserta tu disponibilidad</h2>

                    <section class="seccion-perfil-usuario">
                        </div>
                        <div class="perfil-usuario-body">
                            <div class="perfil-usuario-bio">
                            <figure class="dispo_logo">
                                <img src="./img/logo_dispo.svg" alt="">
                            </figure>
                            <form class="form--registroDispo" action="" method="POST">
                            <div class="input--dispo">
                                
                                <p>Fecha</p>
                                <input  class="input-info" type="date" name="fecha_disponibilidad">
                                <p>Hora de inicio</p>
                                <input  class="input-info" type="time" name="hora_inicio">
                                <p>Hora de finalización</p>
                                <input  class="input-info" type="time" name="hora_final">
                            </div>
                            <div class="submit-box">
                            <input class="input-submit" name="registrar" type="submit" value="Registrar">
                            </div>
                            </div>
                        ';
                        if(isset($_POST ['registrar'])){
                            $id_disponibilidad ="";
                            $fecha_disponibilidad =$_POST['fecha_disponibilidad'];
                            $hora_inicio = $_POST['hora_inicio'];
                            $hora_final= $_POST['hora_final'];
                            $estadoDisponibilidad= 1;

                                $instruccion_SQL = "INSERT INTO  disponibilidad (id_disponibilidad, fecha_disponibilidad, hora_inicio, hora_final, id_profesional, id_estadoDisponibilidad)
                                VALUES ('$id_disponibilidad','$fecha_disponibilidad','$hora_inicio','$hora_final.','$id_profesional','$estadoDisponibilidad')";
                                    $resultado = mysqli_query($conection,$instruccion_SQL) or trigger_error("Query Failed! SQL-Error: ".mysqli_error($conection), E_USER_ERROR);
                                    if($resultado) {
                                        $id_disponibilidad = mysqli_insert_id($conection);
                                        echo "<script>alert('Se ha registrado exitosamente');
                                        window.location.href='./queries/consultar_dispo.php?id_perfil=".$id_profesional.'&id_disponibilidad='.$id_disponibilidad."';</script>";       
                                } else {  
                                        echo "<script>alert('error en realizar el registro');</script>";
                                } 
                            mysqli_close($conection);           
                        }
                                        
                            ?>
                                            

 </form>
</main>
<footer class="pie-pagina">
    <div class="footer_copy">
         <small>&copy; 2023 <b>kuhtone</b> - Todos los Derechos Reservados.</small>
    </div>
 </footer>
<script src="./js/script.js"></script>
</body>
</html>