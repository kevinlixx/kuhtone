<?php
    include("./config/conexion.php");
    $id_admin= $_GET['id_perfil'];
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
                    <h2 class=title--main>Inserta sede</h2>

                    <section class="seccion-perfil-usuario">
                        </div>
                        <div class="perfil-usuario-body">
                            <div class="perfil-usuario-bio">
                            <figure class="dispo_logo">
                                <img src="./img/logo_dispo.svg" alt="">
                            </figure>
                            <form class="form--registroDispo" action="" method="POST">
                            <div class="input--dispo">
                                
                                <p>Latitud</p>
                                <input  class="input-info" type="text" name="latitud">
                                <p>Longitud</p>
                                <input  class="input-info" type="text" name="longitud">
                                <p>Nombre de la sede</p>
                                <input  class="input-info" type="text" name="nombre_sede">
                            </div>
                            <div class="submit-box">
                            <input class="input-submit" name="registrar" type="submit" value="Registrar">
                            </div>
                            </div>
                        ';
                        if(isset($_POST ['registrar'])){
                            $id_sede ="";
                            $latitud =$_POST['latitud'];
                            $longitud = $_POST['longitud'];
                            $nombre_sede= $_POST['nombre_sede'];
                            if (!is_numeric($latitud) || !is_numeric($longitud)) {
                                // Mostrar un mensaje de error
                                echo "<script>alert('Error: La latitud y longitud deben ser valores numéricos');</script>";
                            } else {
                                // Procesar los datos
                                $instruccion_SQL = "INSERT INTO  sedes (id_sede, nombre, latitud, longitud)
                                VALUES ('$id_sede','$nombre_sede.','$latitud','$longitud')";
                                    $resultado = mysqli_query($conection,$instruccion_SQL) or trigger_error("Query Failed! SQL-Error: ".mysqli_error($conection), E_USER_ERROR);
                                    if($resultado) {
                                        $id_disponibilidad = mysqli_insert_id($conection);
                                        echo "<script>alert('Se ha registrado exitosamente la sede');
                                        window.location.href='./queries/consultar_sedes.php?id_perfil=".$id_profesional.'&id_disponibilidad='.$id_disponibilidad."';</script>";       
                                } else {  
                                        echo "<script>alert('error en realizar el registro');</script>";
                                } 
                            mysqli_close($conection); 
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
<script src="./js/script.js"></script>
</body>
</html>