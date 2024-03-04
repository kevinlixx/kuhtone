<?php
                
session_start();
include("./conexion.php");
$id= $_GET['id'];
$id_paciente= $_GET['id_perfil'];

$profesional ="SELECT * FROM profesional WHERE id_profesional = $id";
$consulta = mysqli_query($conection, $profesional ) or die ("Error al traer los datos");
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
    <link rel="stylesheet" href="./css/style_detallePsicologo.css">
    <link rel="stylesheet" href="./css/tablet_detallePsicologo .css" media="screen and (min-width: 600px)"/>
    <link rel="stylesheet" href="./css/desktop_detallePsicologos.css" media="screen and (min-width: 800px)"/>
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
                        <li><a href="./consultar_citas.php?id_perfil='.$id_paciente.'">Mis citas</a></li>
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
    <?php
         while($consulta_total= mysqli_fetch_array($consulta))
            {
                echo'
                    <div class="psicologo-info--card">
                        <div class="section--card">
                            <section class="psicologo--card">
                                <figure class="figure--card"> 
                                    <img 
                                    src="'.$consulta_total["foto_perfil"].'" 
                                    alt="psicologo"
                                    />  
                                    <figcaption></figcaption> 
                                </figure>
                            </section>
                        <div class="psicologo-details-complete--details">
                            <div class="psicologo-details--container">
                                <div class="psicologo-description--container">
                                    <section>
                                        <figure class="description--logo"> 
                                            <img 
                                            src="./img/decription_logo.svg" 
                                            alt="psicologo"
                                            />  
                                            <figcaption></figcaption> 
                                        </figure>
                                    </section>
                                    <h3 >Descripción</h3>
                                    
                                    
                                    <p>'.$consulta_total["descripcion"].'
                                    </p>
                                
                                </div>
                                <div class="psicologo-perfil--container">
                                    <h3>Perfil</h3>
                                    <section>
                                        <figure class="perfil--logos"> 
                                            <img 
                                            src="./img/editor-logo.svg" 
                                            alt="psicologo"
                                            />  
                                            <figcaption></figcaption> 
                                        </figure>
                                    </section>
                                    <h4>Nombres</h4>
                                    <p>
                                        '.$consulta_total["nombres"].' 
                                    </p>
                                    <section>
                                        <figure class="perfil--logos"> 
                                            <img 
                                            src="./img/editor-logo.svg" 
                                            alt="psicologo"
                                            />  
                                            <figcaption></figcaption> 
                                        </figure>
                                    </section>
                                    <h4>Apellidos</h4>
                                    <p>
                                    '.$consulta_total["apellidos"].'  
                                    </p>
                                    <section>
                                        <figure class="perfil--logos"> 
                                            <img 
                                            src="./img/email_logo.svg" 
                                            alt="psicologo"
                                            />  
                                            <figcaption></figcaption> 
                                        </figure>
                                    </section>
                                    <h4>E-mail</h4>
                                    <p>
                                        '.$consulta_total["correo_profesional"].'
                                    </p>
                                    <section>
                                        <figure class="perfil--logos"> 
                                            <img 
                                            src="./img/student_logo.svg" 
                                            alt="psicologo"
                                            />  
                                            <figcaption></figcaption> 
                                        </figure>
                                    </section>
                                    <h4>Educación</h4>
                                    <p>
                                        '.$consulta_total["nom_universidad"].'  
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="psicologo-experience--container">
                        <section class="section-experience--container">
                            <figure class="experience--logo"> 
                                <img 
                                src="./img/experience_logo.svg" 
                                alt="psicologo"
                                />  
                                <figcaption></figcaption> 
                            </figure>
                        
                        <h3>Experiencia</h3>
                        <p >'.$consulta_total["experiencia"].' 
                        </p>
                        </section>
                    </div>           
        ';
       
                $_SESSION['id_profesional'] = $consulta_total["id_profesional"];
            }
            echo'
                    <a href="./horario_citas.php?id_perfil='.$id_paciente.'" class="asignar--bottom">asignar</a>
                    <a href="./psicologos.php?id_perfil='.$id_paciente.'" class="back--bottom">volver</a>';
                    ?>
    
    </main>
   <footer class="pie-pagina">
   <div class="footer_copy">
        <small>&copy; 2023 <b>kuhtone</b> - Todos los Derechos Reservados.</small>
   </div>
</footer>
<script src="js/script.js"></script>
</body>
</html>