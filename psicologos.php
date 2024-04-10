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

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700&family=Inter:wght@300;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./css/style_psicologos.css">
    <link rel="stylesheet" href="./css/tablet_psicologos.css" media="screen and (min-width: 600px)"/>
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
        <?php
         $consulta = mysqli_query($conection, "SELECT * FROM profesional WHERE estado_cuenta = 1" ) or die ("Error al traer los datos");
            if(mysqli_num_rows($consulta) > 0)
            {
                while($consulta_total= mysqli_fetch_array($consulta))
                {
                        echo'
                        <div class="psicologos--contenedor">
                            <section class="psicologos--card">
                                <figure class="figure--card"> 
                                    <img 
                                    src="'.$consulta_total["foto_perfil"].'" 
                                    alt="psicologo"
                                    />  
                                    <figcaption></figcaption> 
                                </figure>
                                <div class="psicologo--description">
                                <h4>Descripción</h4>
                                <p class="">'.$consulta_total["descripcion"].'<a href=\'./detalle_psicologo.php?id='.$consulta_total["id_profesional"].'&id_perfil='.$id_paciente.'\'class="mas_info--description">ver más</a></p>
                            </section>
                            ';
                        
                        }
                    }
                    echo'
                            <a href="./index_usr.php?id_perfil='.$id_paciente.'" class="back--bottom">Volver</a>';
                            ?>  
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
</html>