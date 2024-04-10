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
    <link rel="stylesheet" href="./css/style_login-register_admin.css">
    <link rel="stylesheet" href="./css/tablet_login-register_admin.css" media="screen and (min-width: 600px)"/>
    <link rel="stylesheet" href="./css/desktop_login-register_admin.css" media="screen and (min-width: 800px)"/>
    <link rel="stylesheet" href="./css/tablet_login-register_admin.css" media="screen and (min-width: 600px)"/>
    <link rel="stylesheet" href="./css/desktop_login-register_admin.css" media="screen and (min-width: 800px)"/>
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
                        <li><a href="./index.php" >Inicio</a></li>
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
            <div class="contenedor__todo">
                <!--Formulario de Login-->
                <div class="contenedor__login-register">
                    <!--Login-->
                    <form action="" class="formulario__login" method="POST">
                        <div class="right-side">
                            <h1>Bienvenid@ Admin</h1>
                            <figure class="figure_login"> 
                                <img 
                                src="./img/login_vector.svg" 
                                alt="lgo de kuhtone"
                                />  
                                <figcaption></figcaption> 
                            </figure>
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
                            <button class="option--type" type="button" onclick="window.location.href='./login-register.php'">
                                <img src="./img/user-icon.svg" alt="Icono de psicólogo" style="vertical-align: middle;">
                                Iniciar como paciente
                            </button>
                            <button class="option--type" type="button" onclick="window.location.href='./login-register_psico.php'">
                                <img src="./img/psico_icon.svg" alt="Icono de administrador" style="vertical-align: middle;">
                                Iniciar como psicologo
                            </button>
                        </div>
                        
                        <?php 
                            if(isset($_POST["ingresar"])){
                            $correo=$_POST['correo'];
                            $contrasena=$_POST['contrasena'];
                            $sentencia=$conection->prepare("SELECT * FROM administrador WHERE correo=? AND contrasena=? AND estado_cuenta = 1");
                            $sentencia->bind_param('ss',$correo,$contrasena);
                            $sentencia->execute();
                            $insertar = $sentencia ->get_result();
                                if($fila = $insertar->fetch_assoc()){
                                    $consulta = "SELECT * FROM administrador WHERE correo= '$correo' AND contrasena= '$contrasena' AND estado_cuenta = '1' ";
                                    $consult = mysqli_query($conection, $consulta ) or die ("Error al traer los datos");

                                    if($busqueda= mysqli_fetch_array($consult)){
                                    echo '<script>alert("te has iniciado correctamente");window.location.href="./index_admin.php?id_perfil='.$busqueda["id_admin"].'";  </script>';
                                    }
                                }else{
                                    echo "<script>alert('Usuario o contraseña incorrecto intente nuevamente')</script>";
                                    echo "<script>location.href='login-register_admi.php'</script>";
                                }
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
        <script src="./js/script_login-register.js"></script>
</body>
</html>