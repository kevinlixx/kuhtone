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
    <link rel="stylesheet" href="./css/Style_perfil.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <script src="https://kit.fontawesome.com/e1d55cc160.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./css/desktop_perfil.css" media="screen and (min-width: 800px)">
    
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
            $profesional ="SELECT * FROM profesional WHERE id_profesional =$id_profesional";
            $consulta_profesional= mysqli_query($conection, $profesional ) or die ("Error al traer los datos");
                if($consulta_perfil= mysqli_fetch_array($consulta_profesional)){
                    echo'
                    <section class="seccion-perfil-usuario">
                        <div class="perfil-usuario-header">
                            <div class="perfil-usuario-portada">
                                <div class="perfil-usuario-avatar">
                                    <img src="'.$consulta_perfil["foto_perfil"].'">
                                    <a href= "./modificar_imgPsico.php?id_perfil='.$id_profesional.'">
                                    <button type="button" class="boton-avatar">
                                        <i class="far fa-image"></i>
                                    </button>
                                    </a>
                                </div>
                                <!-- <button type="button" class="boton-portada">
                                    <i class="far fa-image"></i> Cambiar fondo
                                </button> -->
                            </div>
                        </div>
                        <div class="perfil-usuario-body">
                            <div class="perfil-usuario-bio">
                                <div class="container--info">
                                    <h4>ID Usuario</h4>
                                    <p>#'.$consulta_perfil["id_profesional"].'</p>
                                </div>
                                <div class="container--info">
                                    <h4>Nombres</h4>
                                    <p>'.$consulta_perfil["nombres"].'</p>
                                </div>
                                <div class="container--info">
                                    <h4>Apellidos</h4>
                                    <p>'.$consulta_perfil["apellidos"].'</p>
                                </div>
                            </div>
                            <div class="footer-users-container">
                            <div class="info--container">
                                <div class="perfil-usuario-footer">
                                        <div class="footer-users psico">
                                        <img src="./img/Correo-Perfil.svg" alt="Icono de psicólogo">   
                                            <h4>Direccion de correo</h4>
                                            <p>'.$consulta_perfil["correo_profesional"].'</p>
                                        </div>
                                        <div class="footer-users psico">
                                        <img src="./img/Telefono_Perfil.svg" alt="Icono de psicólogo">
                                            <h4>Telefono</h4>
                                            <p>'.$consulta_perfil["telefono_movil"].'</p>
                                        </div>
                                        <div class="footer-users psico">
                                        <img src="./img/agenda-perfil.svg" alt="Icono de psicólogo">
                                            <h4>Fecha de Nacimiento</h4>
                                            <p>'.$consulta_perfil["fecha_nacimiento"].'</p>
                                        </div>
                                        <div class="footer-users psico">
                                        <img src="./img/Genero-Perfil.svg" alt="Icono de psicólogo">
                                            <h4>Genero</h4>';
                            $consul_genero = "SELECT * FROM genero WHERE id_genero ='".$consulta_perfil['id_genero']."'";
                            $consulta_genero = mysqli_query($conection, $consul_genero ) or die ("Error al traer los datos");
                            if($genero= mysqli_fetch_array($consulta_genero)){
                                $consul_tipoDocu= "SELECT * FROM tipo_documento WHERE id_tipoDocumento ='".$consulta_perfil['id_tipoDocumento']."'";
                                $consulta_tipoDocumento = mysqli_query($conection, $consul_tipoDocu ) or die ("Error al traer los datos");
                                if($tipo_documento= mysqli_fetch_array($consulta_tipoDocumento)){
                                    echo'

                                            <p>'.$genero["nom_genero"].'</p>
                                        </div>
                                        </div>
                                        <div class="perfil-usuario-footer">
                                        <div class="footer-users psico">
                                        <img src="./img/Documento-Perfil.svg" alt="Icono de psicólogo">
                                            <h4>Tipo Documento</h4>
                                            <p>'.$tipo_documento["nom_tipoDocumento"].'</p>
                                        </div>
                                        <div class="footer-users psico">
                                        <img src="./img/Documento-Perfil.svg" alt="Icono de psicólogo">
                                            <h4>Numero Documento</h4>
                                            <p>'.$consulta_perfil["nro_documento"].'</p>
                                        </div>
                                        <div class="footer-users psico">
                                        <img src="./img/Universidad-Perfil.svg" alt="Icono de psicólogo">
                                            <h4>Universidad egresada</h4>
                                            <p>'.$consulta_perfil["nom_universidad"].'</p>
                                        </div>
                                        </div>
                                        <div class="perfil-usuario-footer">
                                        <div class="footer-users psico">
                                        <img src="./img/experiencia-Perfil.svg" alt="Icono de psicólogo">
                                            <h4>Experiencia</h4>
                                            <p>'.$consulta_perfil["experiencia"].'</p>
                                        </div>
                                        
                                        <div class="footer-users psico">
                                        <img src="./img/Especializacion-Perfil.svg" alt="Icono de psicólogo">
                                            <h4>Especialización</h4>
                                            <p>'.$consulta_perfil["especializacion"].'</p>
                                        </div>
                                        <div class="footer-users psico">
                                        <img src="./img/description-Perfil.svg" alt="Icono de psicólogo">
                                            <h4>Descripción</h4>
                                            <p>'.$consulta_perfil["descripcion"].'</p>
                                        </div>
                                        </div>
                                    </div>
                                    <a href="./modificar_perfilPsico.php?id_perfil='.$id_profesional.'" class="button">Modificar Datos</a>
                                </div>
                            </div>
                        </div>
                    </section>
                    ';
                                }
                            }
                }
                    ?>
</main>
<footer class="pie-pagina">
    <div class="footer_copy">
         <small>&copy; 2023 <b>kuhtone</b> - Todos los Derechos Reservados.</small>
    </div>
 </footer>
<script src="./js/script.js"></script>
</body>
</html>