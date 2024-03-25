<?php
    include("./config/conexion.php");
    $id_profesional= $_GET['id_perfil'];
    $id_disponibilidad= $_GET['id_dispo'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/Style_dispo.css">
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
    <form method="POST">
    <?php
    $consulta = mysqli_query($conection, "SELECT * FROM disponibilidad WHERE id_disponibilidad = '$id_disponibilidad'") or die("Error al traer los datos");
    if (mysqli_num_rows($consulta) > 0) {
        if ($consulta_dispo = mysqli_fetch_array($consulta)) {
            echo '
            <section class="seccion-perfil-usuario">
                <div class="perfil-usuario-body">
                    <div class="perfil-usuario-bio">
                        <figure class="dispo_logo">
                            <img src="./img/logo_dispo.svg" alt="">
                        </figure>
                        <div class="input--dispo">
                            <h3>Insertar Disponibilidad</h3>
                            <p>Fecha</p>
                            <input class="input-info" type="date" name="fecha_disponibilidad" value="' . $consulta_dispo["fecha_disponibilidad"] . '">
                            <p>Hora de inicio</p>
                            <input class="input-info" type="time" name="hora_inicio" value="' . $consulta_dispo["hora_inicio"] . '">
                            <p>Hora de finalización</p>
                            <input class="input-info" type="time" name="hora_final" value="' . $consulta_dispo["hora_final"] . '">
                            <div class="bottom">
                            <input class="input-submit" name="modificar" type="submit" value="Modificar">
                            <input class="input-submit" name="eliminar" type="submit" value="Eliminar">
                            </div>
                        </div>
                        
                    </div>
                    <a href="./index_psicologos.php?id_perfil='.$id_profesional.'" class="back--bottom">volver</a>
                </div>
            </section>';
            if (isset($_POST['modificar'])) {
                $fecha_disponibilidad = $_POST['fecha_disponibilidad'];
                $hora_inicio = $_POST['hora_inicio'];
                $hora_final = $_POST['hora_final'];

                $instruccion_SQL = "UPDATE disponibilidad SET fecha_disponibilidad = '$fecha_disponibilidad', hora_inicio = '$hora_inicio', hora_final = '$hora_final', id_profesional = '$id_profesional' WHERE id_disponibilidad = '$id_disponibilidad'";
                $resultado = mysqli_query($conection, $instruccion_SQL) or trigger_error("Query Failed! SQL-Error: " . mysqli_error($conection), E_USER_ERROR);
                if ($resultado) {
                    echo "<script>alert('Se ha actualizado exitosamente');
                        window.location.href='./modificar_disponibilidad.php?id_perfil=" . $id_profesional . '&id_dispo=' . $id_disponibilidad . "';</script>";
                } else {
                    echo "<script>alert('Error al realizar la actualización');</script>";
                }

                mysqli_close($conection);
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
<script src="./js/script.js"></script>
</body>
</html>