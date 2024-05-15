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
    <link rel="stylesheet" href="./css/style_imgPerfil.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <script src="https://kit.fontawesome.com/e1d55cc160.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./css/desktop_perfil.css" media="screen and (min-width: 800px)"/>
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
                      <li><a href="./index_admin.php?id_perfil='.$id_admin.'">Inicio</a></li>
                        <li><a href="./perfil_admin.php?id_perfil='.$id_admin.'">Mi perfil</a></li>
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
                $admin ="SELECT * FROM administrador WHERE id_admin =$id_admin";
                $consulta_admin = mysqli_query($conection, $admin ) or die ("Error al traer los datos");
                    if($consulta_perfil= mysqli_fetch_array($consulta_admin)){
                        echo'
                        <form method="POST" enctype="multipart/form-data">
                            <section class="seccion-perfil-usuario">
                                <div class="perfil-usuario-header">
                                    <div class="perfil-usuario-portada">
                                        <div class="perfil-usuario-avatar">
                                            <img src="'.$consulta_perfil["foto_perfil"].'" alt="img-avatar">
                                        </div>
                                    </div>
                                </div>
                                <div class="perfil-usuario-body">
                                    <div class="perfil-usuario-bio">
                                    <input  type="file"  name="imagen_producto">
                                    <input type="submit" class="button" name="actualiza_img" value="Actualizar foto">
                                    
                                    </div>
                                    <a href="./modificar_admin.php?id_perfil='.$id_admin.'" class="button">Volver</a>
                                </div>
                            </section>
                            ';
                            if(isset($_POST ['actualiza_img'])){
                                if($_FILES['imagen_producto']['size']>2024000){
                                    echo "solo se permiten imagenes menores a 2MB";
                                    exit;
                                }
                                $dir="./img/"; 
                                $nombre_archivo = $_FILES['imagen_producto']['name'];
                                    
                                if(!move_uploaded_file($_FILES['imagen_producto']['tmp_name'],$dir.$nombre_archivo)) 
                                {
                                    echo "error en subir la imagen";
                                }

                                $imagen_producto=$dir.$nombre_archivo;

                                $actualizar_SQL = "UPDATE administrador SET foto_perfil='$imagen_producto' Where id_admin='$id_admin'";
                                $resultado = mysqli_query($conection,$actualizar_SQL) or trigger_error("Query Failed! SQL-Error: ".mysqli_error($conection), E_USER_ERROR);
                                if($resultado){ 
                                    echo '<script>alert("se ha actualizado correctamente");
                                    window.location.href="./perfil_admin.php?id_perfil='.$id_admin.'";  </script>';
                                }
                                else {
                                    echo '<script>alert("no se puedo actualizar correctamente");window.history.go(-1);</script>';
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
 <script src="js/script.js"></script>
</body>
</html>