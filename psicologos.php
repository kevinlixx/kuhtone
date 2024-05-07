<?php
include("./config/conexion.php");
$id_paciente= $_GET['id_perfil'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>kuhtone</title>
    <script src="https://kit.fontawesome.com/41bcea2ae3.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" /> /*para el mapa  */
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700&family=Inter:wght@300;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./css/style_psicologos.css">
    <link rel="stylesheet" href="./css/tablet_psicologos.css" media="screen and (min-width: 500px)"/>
    <link rel="stylesheet" href="./css/desktop_psicologos.css" media="screen and (min-width: 800px)"/>
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
        </section>
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

        <h1 class="title--main">Escoge tu psicologo</h1>

        <div class="container-all">
        <div class="map--container" id="map--container">
        </div>

        <div class= "design--container">
            <div class="select-sede" id="select-sede">
                 <h1> Por favor selecciona una sede </h1>
            </div>
            <div class="psicologos--contenedor" id="psicologos--contenedor">
        <?php
         $consulta = mysqli_query($conection, "SELECT * FROM profesional WHERE estado_cuenta = 1" ) or die ("Error al traer los datos");
            if(mysqli_num_rows($consulta) > 0)
            {
                while($consulta_total= mysqli_fetch_array($consulta))
                {           
                        $descripcion_completa = $consulta_total["descripcion"];
                        $descripcion_corta = substr($descripcion_completa, 0, 150); 
                        echo'
                        
                            
                                    <section class="psicologos--card">
                                        <figure class="figure--card"> 
                                            <img 
                                            src="'.$consulta_total["foto_perfil"].'" 
                                            alt="psicologo"
                                            />  
                                            <figcaption></figcaption> 
                                        </figure>
                                        <div class="psicologo--description">
                                        <h4>Psi.'.$consulta_total["nombres"].' '.$consulta_total["apellidos"]. '</h4>

                                        <p class="descripcion-completa">'.$descripcion_completa.'</p>
                                        <p class="descripcion-corta">'.$descripcion_corta.'...</p>
                                        </div>
                                        <a href=\'./detalle_psicologo.php?id='.$consulta_total["id_profesional"].'&id_perfil='.$id_paciente.'\'class="mas_info--description">
                                            <figure class="icon-ingreso"> 
                                                <img 
                                                src="./img/icon-ingreso.svg"
                                                alt="icono de ingreso"
                                                />  
                                                <figcaption></figcaption> 
                                            </figure>
                                        </a>
                                    
                                        </section>
                                    ';
                            
                                    }
                                }
                                echo'
                                        <a href="./index_usr.php?id_perfil='.$id_paciente.'" class="back--bottom">Volver</a>';
                                        ?>  
                                    
                                    
                            </div>
                        </div>
                    </div>
                       
    </main>
   <footer class="pie-pagina">
   <div class="footer_copy">
        <small>&copy; 2023 <b>kuhtone</b> - Todos los Derechos Reservados.</small>
   </div>
</footer>
<script src="js/script.js"></script>
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script src="js/script_map.js"></script>
</body>
</html>