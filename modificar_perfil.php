<?php
include("./config/conexion.php");
include("./includes/crud_perfil.php");
$id_paciente = $_GET['id_perfil'];
$crudPerfil = new crudPerfil($conection);
$consulta_perfil = $crudPerfil->obtenerPerfil('paciente', $id_paciente, 'id_paciente');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style_perfil.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <script src="https://kit.fontawesome.com/e1d55cc160.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./css/desktop_perfil.css" media="screen and (min-width: 800px)" />
    <title>Document</title>
</head>

<body>
    <header>
        <section class="section_header">
            <figure class="figure_header">
                <img src="./img/logo_header.svg" alt="lgo de kuhtone" />
                <figcaption></figcaption>
            </figure>
            <div class="menu menu-header">

                <figure id="btn_menu">
                    <img src="./img/menu.svg" alt="menu" />
                    <figcaption></figcaption>
                </figure>
                <div id="back_menu"></div>
                <nav id="nav" class="menu-section">
                    <img src="img/logo_header.svG" alt="">
                    <ul>
                        <?php
                        echo '
                      <li><a href="./index_usr.php?id_perfil=' . $id_paciente . '">Inicio</a></li>
                        <li><a href="./queries/consultar_citas.php?id_perfil=' . $id_paciente . '">Mis citas</a></li>
                        <li><a href="./perfil.php?id_perfil=' . $id_paciente . '">Mi perfil</a></li>
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
            $paciente ="SELECT * FROM paciente WHERE id_paciente =$id_paciente";
            $consulta_paciente = mysqli_query($conection, $paciente ) or die ("Error al traer los datos");
                if($consulta_perfil= mysqli_fetch_array($consulta_paciente)){
                    echo'
                    <form method="POST" action="#">
                        <section class="seccion-perfil-usuario">
                            <div class="perfil-usuario-header">
                                <div class="perfil-usuario-portada">
                                    <div class="perfil-usuario-avatar">
                                        <img src="'.$consulta_perfil["foto_perfil"].'" alt="img-avatar">
                                        <a href= "./modificar_imgPerfil.php?id_perfil='.$id_paciente.'">
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
                                    <input type="hidden" value= "'.$id_paciente.'" name="id" >
                                    <input type="hidden" value= "'.$consulta_perfil["foto_perfil"].'" name="foto_perfil" >
                                    <input type="hidden" value= "'.$consulta_perfil["estado_cuenta"].'" name="estado_cuenta" >
                                    <input type="text" value= "'.$consulta_perfil["nombres"].'" name="nombres" >
                                    <input type="text" value= "'.$consulta_perfil["apellidos"].'" name="apellidos">
                                </div>
                                <div class="footer-users-container">
                                <div class="perfil-usuario-footer">
                                        <div class="footer-users">
                                        <img src="./img/Correo-Perfil.svg" alt="Icono de correo">   
                                            <p>Direccion de correo</p>
                                            <input type="email" value= "'.$consulta_perfil["correo"].'" name="correo">
                                        </div>
                                        <div class="footer-users">
                                        <img src="./img/passw-Perfil.svg" alt="Icono de Contraseña">  
                                            <p>Contraseña</p>
                                            <input type="password" value= "'.$consulta_perfil["contrasena"].'" name="contrasena">
                                        </div>
                                        <div class="footer-users">
                                        <img src="./img/Telefono_Perfil.svg" alt="Icono de teléfono">
                                            <p>Telefono</p>
                                            <input type="number" value= "'.$consulta_perfil["telefono_movil"].'" name="telefono_movil">
                                        </div>
                                        <div class="footer-users">
                                        <img src="./img/agenda-perfil.svg" alt="Icono de agenda">
                                            <p>Fecha de Nacimiento</p>
                                            <input type="date" value= "'.$consulta_perfil["fecha_nacimiento"].'" name="fecha_nacimiento">
                                        </div>
                                        <div class="footer-users">
                                        <img src="./img/Genero-Perfil.svg" alt="Icono de género">
                                            <p>Genero</p>';
                            $consulta_genero = mysqli_query($conection, "SELECT * FROM genero Where id_genero ='".$consulta_perfil['id_genero']."'") or die ("Error al traer los datos");
                            while($consult_genero= mysqli_fetch_array($consulta_genero))
                            { 
                                echo'
                                <select name=genero class=form-control id=tipoproducto value='.$consult_genero["nom_genero"].'>';
                                $sql=$conection->query('select * from genero ');
                                while ($fila=$sql->fetch_array()){
                                    
                                    if($a==0){
                                    echo"<option value=".$consult_genero['id_genero'].">".$consult_genero['nom_genero']."</option>";
                                    }
                                    echo "<option value=".$fila['id_genero'].">".$fila['nom_genero']."</option>";
                                    $a++;
                                }
                            }
                                    echo '
                                    </select>
                                        </div>
                                        <div class="footer-users">
                                        <img src="./img/Documento-Perfil.svg" alt="Icono de documento">
                                            <p>Tipo Documento</p>';
                            $consulta_tipo = mysqli_query($conection, "SELECT * FROM tipo_documento Where id_tipoDocumento='".$consulta_perfil['id_tipoDocumento']."'") or die ("Error al traer los datos");
                            while($consult_tipo= mysqli_fetch_array($consulta_tipo))
                            { 
                                echo'
                                <select name="tipo_documento" class="form-control" id="tipoproducto" value="'.$consult_tipo["nom_tipoDocumento"].'">';
                                $sql=$conection->query('select * from tipo_documento ');
                                while ($fila=$sql->fetch_array()){
                                    
                                    if($b==0){
                                    echo"<option value=".$consult_tipo['id_tipoDocumento'].">".$consult_tipo['nom_tipoDocumento']."</option>";
                                    }
                                    echo "<option value=".$fila['id_tipoDocumento'].">".$fila['nom_tipoDocumento']."</option>";
                                    $b++;
                                }
                            }
                                    echo '
                                    </select>
                                        </div>
                                        <div class="footer-users">
                                        <img src="./img/Documento-Perfil.svg" alt="Icono de documento">
                                            <p>Numero Documento</p>
                                            <input name="nro_documento" type="number" value ="'.$consulta_perfil['nro_documento'].'">
                                        </div>
                                        
                                    </div>
                                    <input class="button" type="submit" value="Modificar Datos" name="modificar">
                                    <input class="button" type="submit" value="Eliminar cuenta" name="inhabilitar" id="eliminar">
                                    <a href="./perfil.php?id_perfil='.$id_paciente.'" class="button">Volver</a>
                                </div>
                            </div>
                        </section>
                        ';

                        if(isset($_POST ['modificar'])){
                  
                            $id = $_POST['id'];
                            $foto_perfil =$_POST['foto_perfil'];
                            $nombres = $_POST ['nombres'];
                            $apellidos= $_POST  ['apellidos'];
                            $correo = $_POST  ['correo'];
                            $contrasena = $_POST  ['contrasena'];
                            $telefono_movil =$_POST  ['telefono_movil'];
                            $fecha_nacimiento =$_POST  ['fecha_nacimiento'];
                            $genero =$_POST['genero'];
                            $tipo_documento =$_POST['tipo_documento'];
                            $nro_documento = $_POST['nro_documento'];
                            $estado_cuenta = $_POST['estado_cuenta'];
                    
                        $actualizar_SQL = "UPDATE paciente SET foto_perfil ='$foto_perfil',nombres='$nombres',apellidos='$apellidos',fecha_nacimiento='$fecha_nacimiento',id_genero='$genero',id_tipoDocumento='$tipo_documento',nro_documento='$nro_documento',telefono_movil='$telefono_movil',correo='$correo',contrasena='$contrasena',estado_cuenta='$estado_cuenta'  Where id_paciente='$id'";
                            $resultado = mysqli_query($conection,$actualizar_SQL) or trigger_error("Query Failed! SQL-Error: ".mysqli_error($conection), E_USER_ERROR);
                            if($resultado){
                              
                              echo '<script>alert("se ha actualizado correctamente");window.location.href="./perfil.php?id_perfil='.$id_paciente.'";  </script>';
                            }
                            else {
                              echo '<script>alert("no se puedo actualizar correctamente");window.history.go(-1);  </script>';
          
                            }
                            mysqli_close($conection);
                           
                         }
                        if(isset($_POST ['inhabilitar'])){
                            $inhabilitar_SQL = "UPDATE paciente SET estado_cuenta='2'  Where id_paciente='$id_paciente'";
                            $resultado = mysqli_query($conection,$inhabilitar_SQL) or trigger_error("Query Failed! SQL-Error: ".mysqli_error($conection), E_USER_ERROR);
                            if($resultado){
                                // Obtén los datos del usuario
                                $datos_usuario_SQL = "SELECT * FROM paciente WHERE id_paciente='$id_paciente'";
                                $resultado_datos = mysqli_query($conection, $datos_usuario_SQL) or trigger_error("Query Failed! SQL-Error: ".mysqli_error($conection), E_USER_ERROR);
                                $datos_usuario = mysqli_fetch_assoc($resultado_datos);

                                // Inserta los datos del usuario en la tabla cuentas_temporales
                                $datos_usuario_JSON = json_encode($datos_usuario, JSON_UNESCAPED_UNICODE);
                                $insertar_temporal_SQL = "INSERT INTO cuentas_temporales (id_original, tipo_usuario, fecha_eliminacion, datos_usuario) VALUES ('$id_paciente', 'paciente', NOW(), '$datos_usuario_JSON')";
                                mysqli_query($conection, $insertar_temporal_SQL) or trigger_error("Query Failed! SQL-Error: ".mysqli_error($conection), E_USER_ERROR);

                                echo '<script>alert("se ha eliminado correctamente");window.location.href="./login-register.php";  </script>';
                            }
                            else {
                                echo '<script>alert("no se pudo eliminar");window.history.go(-1);  </script>';
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
    <script src="js/script_sureDelete.js"></script>
</body>

</html>