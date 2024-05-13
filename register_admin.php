<?php
include("./config/conexion.php");
$id_admin = $_GET['id_perfil'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/e1d55cc160.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./css/style_registerAdmin.css">
    <link rel="stylesheet" href="./css/desktop_registerAdmin.css" media="screen and (min-width: 800px)" />
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
                    <img src="img/logo_header.svg" alt="">
                    <ul>
                        <?php
                        echo '
                      <li><a href="./index_admin.php?id_perfil=' . $id_admin . '">Inicio</a></li>
                        <li><a href="./perfil_admin.php?id_perfil=' . $id_admin . '">Mi perfil</a></li>
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
        <div class="contenedor__todo">
            <!--Formulario de Login y registro-->
            <div class="contenedor__login-register">
                <!--Register-->
                <form class="formulario__register" method="POST">
                    <figure class="figure_login">
                        <img src="./img/login_img_vector.svg" alt="lgo de kuhtone" />
                        <figcaption></figcaption>
                    </figure>
                    <h2>Registrar Administrador</h2>
                    <div class="grid">
                        <div class="grupo__input">
                            <img src="img/userRegis_icon.svg" alt="Icono de usuario" class="input-icon">
                            <input type="text" placeholder="Nombre" name="nombre">
                        </div>
                        <div class="grupo__input">
                            <img src="img/userRegis_icon.svg" alt="Icono de usuario" class="input-icon">
                            <input type="text" placeholder="Apellidos" name="apellido">
                        </div>
                        <div class="grupo__input">
                            <img src="img/email_icon.svg" alt="Icono de correo" class="input-icon">
                            <input type="text" placeholder="Correo Electronico" name="correo">
                        </div>
                        <div class="grupo__input">
                            <img src="img/block_icon.svg" alt="Icono de llave" class="input-icon">
                            <input type="password" placeholder="Contraseña" name="contrasena">
                        </div>
                        <div class="grupo__input">
                            <h3>Genero</h3>
                            <div class="gender-box">
                                <div class="gender-option">
                                    <?php
                                    $sql = $conection->query("select *from genero");
                                    while ($fila = $sql->fetch_array()) {
                                        echo '<div class="gender">
                                            <input type="radio" id="check-male" name="genero" value="' . $fila["id_genero"] . '" checked>
                                            <Label for="check-male">' . $fila["nom_genero"] . '</Label>
                                        </div>';
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="grupo__input nacimiento">
                            <h3>Fecha de Nacimiento</h3>
                            <img src="img/calendar_icon.svg" alt="Icono de calendario" class="input-icon">
                            <input type="date" placeholder="Fecha Nacimiento" name="fecha_nacimiento">
                        </div>
                        <div class="grupo__input document">
                            <h3>Tipo Documento</h3>
                            <select name="tipo_document" class="form--select">
                                <?php
                                $sql = $conection->query("select *from tipo_documento");
                                while ($fila = $sql->fetch_array()) {
                                    echo '<option value=' . $fila['id_tipoDocumento'] . '>' . $fila['nom_tipoDocumento'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="grupo__input">
                            <img src="img/numDoc_icon.svg" alt="Icono de tarjeta de identificación" class="input-icon">
                            <input class="document" type="number" placeholder="Número de Documento" name="documento">
                        </div>
                        <div class="grupo__input">
                            <img src="img/phone_icon.svg" alt="Icono de teléfono" class="input-icon">
                            <input type="number" placeholder="Número Telefónico" class="numtelefono" name="telefono_movil">
                        </div>
                        <div class="button-container">
                            <input class="button" type="submit" value="REGISTRARSE" name="registrar">
                        </div>
                        <?php
                        if (isset($_POST['registrar'])) {
                            $id = " ";
                            $img = "./img/user.png";
                            $nombres = $_POST['nombre'];
                            $apellidos = $_POST['apellido'];
                            $correo = $_POST['correo'];
                            $contrasena = $_POST['contrasena'];
                            $genero = $_POST['genero'];
                            $telefono_movil = $_POST['telefono_movil'];
                            $fecha_nacimiento = $_POST['fecha_nacimiento'];
                            $tipo_document = $_POST['tipo_document'];
                            $documento = $_POST['documento'];
                            $estado_cuenta = 1;

                            $instruccion_SQL = "INSERT INTO  administrador(id_admin, foto_perfil, nombres, apellidos, fecha_nacimiento, id_genero, id_tipoDocumento, nro_documento, telefono_movil, correo, contrasena, estado_cuenta)
                                        VALUES ('$id','$img','$nombres','$apellidos.','$fecha_nacimiento','$genero','$tipo_document','$documento','$telefono_movil','$correo','$contrasena','$estado_cuenta')";
                            $resultado = mysqli_query($conection, $instruccion_SQL) or trigger_error("Query Failed! SQL-Error: " . mysqli_error($conection), E_USER_ERROR);
                            if ($resultado) {
                                $id_perfil = mysqli_insert_id($conection);
                                echo "<script>alert('Se ha registrado exitosamente');window.location.href='gestion_admin.php?id_perfil=" . $id_admin . "';</script>";
                            } else {
                                echo "<script>alert('error en realizar el registro');</script>";
                            }
                            mysqli_close($conection);
                        }
                        ?>
                </form>

            </div>
        </div>

    </main>
    <footer class="pie-pagina">
        <div class="footer_copy">
            <small>&copy; 2023 <b>kuhtone</b> - Todos los Derechos Reservados.</small>
        </div>
    </footer>
    <script src="./js/script.js"></script>
</body>

</html>