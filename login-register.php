<?php
include("./config/conexion.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login y Register</title>

    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">

    <script src="https://kit.fontawesome.com/e1d55cc160.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./css/style_login-register.css">
    <link rel="stylesheet" href="./css/tablet_login-register.css" media="screen and (min-width: 600px)" />
    <link rel="stylesheet" href="./css/desktop_login-register.css" media="screen and (min-width: 800px)" />
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
                        <li><a href="./index.php">Inicio</a></li>
                        <li><a href="#" id="selected">Iniciar Sesion</a></li>
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
        <div class="contenedor__todo" id="contenedorTodo">
            <div class="caja__trasera oculto">
                <div class="caja__trasera-login">
                    <h3>Bienvenido A</h3>
                    <figure class="figure_login">
                        <img src="./img/login_vector.svg" alt="logo de kuhtone" />
                        <figcaption></figcaption>
                    </figure>
                        <p id="mensaje-registro">¿Ya posees una cuenta? <a id="enlace-inicio">Inicia sesión</a></p>
                </div>
            </div>

            <!--Formulario de Login y registro-->
            <div class="contenedor__login-register">
                <!--Login-->
                <form action="" class="formulario__login" method="POST">
                    <div class="right-side">
                        <h1>BIENVENID@ A</h1>
                        <figure class="figure_login">
                            <img src="./img/login_vector.svg" alt="lgo de kuhtone" />
                            <figcaption></figcaption>
                        </figure>
                        <p id="mensaje-login">¿No tienes cuenta? <a id="enlace-registro">Regístrate aquí</a></p>

                    </div>
                    <div class="left-side">
                        <h2>Iniciar Sesión</h2>
                        <div class="input-container">
                            <input class="text" type="text" placeholder="Correo Electronico" name="correo">
                            <img src="img/email_icon.svg" alt="Icono de correo electrónico" class="input-icon">
                        </div>
                        <div class="input-container">
                            <input class="password" type="password" placeholder="Contraseña" name="contrasena">
                            <img src="img/block_icon.svg" alt="Icono de password" class="input-icon">
                        </div>
                        <input class="button" type="submit" value="ENTRAR" name="ingresar">
                        <button class="option--type" type="button" onclick="window.location.href='./login-register_psico.php'">
                            <img src="./img/psico_icon.svg" alt="Icono de psicólogo" style="vertical-align: middle;">
                            Iniciar como psicologo
                        </button>
                        <button class="option--type" type="button" onclick="window.location.href='./login-register_admi.php'">
                            <img src="./img/admin_icon.svg" alt="Icono de administrador" style="vertical-align: middle;">
                            Iniciar como administrador
                        </button>
                    </div>

                    <?php
                    if (isset($_POST["ingresar"])) {
                        $correo = $_POST['correo'];
                        $contrasena = $_POST['contrasena'];
                        $sentencia = $conection->prepare("SELECT * FROM paciente WHERE correo=? AND contrasena=? AND estado_cuenta = 1");
                        $sentencia->bind_param('ss', $correo, $contrasena);
                        $sentencia->execute();
                        $insertar = $sentencia->get_result();
                        if ($fila = $insertar->fetch_assoc()) {
                            $consulta = "SELECT * FROM paciente WHERE correo= '$correo' AND contrasena= '$contrasena' AND estado_cuenta = '1' ";
                            $consult = mysqli_query($conection, $consulta) or die("Error al traer los datos");

                            if ($busqueda = mysqli_fetch_array($consult)) {
                                echo '<script>alert("se has iniciado correctamente");window.location.href="./index_usr.php?id_perfil=' . $busqueda["id_paciente"] . '";  </script>';
                            }
                        } else {
                            echo "<script>alert('Usuario o contraseña incorrecto intente nuevamente')</script>";
                            echo "<script>location.href='login-register.php'</script>";
                        }
                    }
                    ?>
                </form>

                <!--Register-->
                <div class="formulario__register-wrapper">
                    <form class="formulario__register oculto" method="POST">
                        <h2>Regístrate en el siguiente formulario</h2>
                        <div class="grid">
                            <div class="grupo__input">
                                <h3>Nombre Completo</h3>
                                <input type="text" placeholder="Nombre" name="nombre">
                                <img src="img/userRegis_icon.svg" alt="Icono de usuario" class="input-icon">
                            </div>
                            <div class="grupo__input">
                                <input type="text" placeholder="Apellidos" name="apellido">
                                <img src="img/userRegis_icon.svg" alt="Icono de usuario" class="input-icon">
                            </div>
                            <div class="grupo__input">
                                <h3>Correo y contraseña</h3>
                                <input type="text" placeholder="Correo Electronico" name="correo">
                                <img src="img/email_icon.svg" alt="Icono de correo" class="input-icon">
                            </div>
                            <div class="grupo__input">
                                <input type="password" placeholder="Contraseña" name="contrasena">
                                <img src="img/block_icon.svg" alt="Icono de llave" class="input-icon">
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
                                <input type="date" placeholder="Fecha Nacimiento" name="fecha_nacimiento">
                                <img src="img/calendar_icon.svg" alt="Icono de calendario" class="input-icon">
                            </div>
                            <div class="grupo__input document">
                                <h3>NIT y Teléfono</h3>
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
                                <input class="document" type="number" placeholder="Número de Documento" name="documento">
                                <img src="img/numDoc_icon.svg" alt="Icono de tarjeta de identificación" class="input-icon">
                            </div>
                            <div class="grupo__input">
                                <input type="number" placeholder="Número Telefónico" class="numtelefono" name="telefono_movil">
                                <img src="img/phone_icon.svg" alt="Icono de teléfono" class="input-icon">
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

                                $instruccion_SQL = "INSERT INTO  paciente(id_paciente, foto_perfil, nombres, apellidos, fecha_nacimiento, id_genero, id_tipoDocumento, nro_documento, telefono_movil, correo, contrasena, estado_cuenta)
                                        VALUES ('$id','$img','$nombres','$apellidos.','$fecha_nacimiento','$genero','$tipo_document','$documento','$telefono_movil','$correo','$contrasena','$estado_cuenta')";
                                $resultado = mysqli_query($conection, $instruccion_SQL) or trigger_error("Query Failed! SQL-Error: " . mysqli_error($conection), E_USER_ERROR);
                                if ($resultado) {
                                    $id_perfil = mysqli_insert_id($conection);
                                    echo "<script>alert('Se ha registrado exitosamente');
                                                window.location.href='./perfil.php?id_perfil=" . $id_perfil . "';</script>";
                                } else {
                                    echo "<script>alert('error en realizar el registro');</script>";
                                }
                                mysqli_close($conection);
                            }
                            ?>
                    </form>
                </div>
            </div>
        </div>

    </main>
    <footer class="pie-pagina">
        <div class="footer_copy">
            <small>&copy; 2023 <b>kuhtone</b> - Todos los Derechos Reservados.</small>
        </div>
    </footer>
    <script src="./js/script.js"></script>
    <script src="./js/script_evenForms.js"></script>
     <!-- <script src="./js/script_registerM.js"></script> -->
</body>

</html>