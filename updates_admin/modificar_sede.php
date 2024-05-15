<?php
    include("../config/conexion.php");
    $id_admin= $_GET['id_perfil'];
    $id_sede= $_GET['id_sede'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style_dispo.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <script src="https://kit.fontawesome.com/e1d55cc160.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../css/desktop_perfil.css" media="screen and (min-width: 800px)"/>
    <link rel="stylesheet" href="../css/tablet_insertDispo.css" media="screen and (min-width: 600px)"/>
    <title>Document</title>
</head>
<body>
    <header>
        <section class="section_header">
            <figure class="figure_header"> 
                <img 
                src="../img/logo_header.svg" 
                alt="lgo de kuhtone"
                />  
                <figcaption></figcaption> 
            </figure>
            <div class="menu menu-header">
                
                    <figure id="btn_menu">
                        <img 
                        src="../img/menu.svg" 
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
                         <li><a href="../index_admin.php?id_perfil='.$id_admin.'">Inicio</a></li>
                       <li><a href="../perfil_admin.php?id_perfil='.$id_admin.'">Mi perfil</a></li>
                       <li><a href="../index.php" id="selected">Cerrar Sesion</a></li>';
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
    
    $consulta = mysqli_query($conection, "SELECT * FROM sedes WHERE id_sede = '$id_sede'") or die("Error al traer los datos");
    if (mysqli_num_rows($consulta) > 0) {
        if ($consulta_sede = mysqli_fetch_array($consulta)) {
            echo '
            <section class="seccion-perfil-usuario">
                <div class="perfil-usuario-body">
                    <div class="perfil-usuario-bio">
                        <figure class="dispo_logo">
                            <img src="../img/logo_dispo.svg" alt="">
                        </figure>
                        <div class="input--dispo">
                            <h3>Insertar Disponibilidad</h3>
                            <p>Fecha</p>
                            <input class="input-info" type="text" name="latitud" value="' . $consulta_sede["latitud"] . '">
                            <p>Hora de inicio</p>
                            <input class="input-info" type="text" name="longitud" value="' . $consulta_sede["longitud"] . '">
                            <p>Hora de finalización</p>
                            <input class="input-info" type="text" name="nombre" value="' . $consulta_sede["nombre"] . '">
                            <div class="bottom">
                            <input class="input-allow" name="modificar" type="submit" value="Modificar">
                            <input class="input-allow" name="eliminar" type="submit" value="Eliminar">
                            </div>
                        </div>
                        
                    </div>
                    <div class="submit-box">
                    <a href="../queries/consultar_sedes.php?id_perfil='.$id_admin.'" class="back--bottom">Volver</a>
                    </div>
                </div>
            </section>';
            if (isset($_POST['modificar'])) {
                $latitud = $_POST['latitud'];
                $longitud = $_POST['longitud'];
                $nombre = $_POST['nombre'];
                if (!is_numeric($latitud) || !is_numeric($longitud)) {
                    // Mostrar un mensaje de error
                    echo "<script>alert('Error: La latitud y longitud deben ser valores numéricos');</script>";
                } else {
                        $instruccion_SQL = "UPDATE sedes SET latitud = '$latitud', longitud = '$longitud', nombre = '$nombre' WHERE id_sede = '$id_sede'";
                        $resultado = mysqli_query($conection, $instruccion_SQL) or trigger_error("Query Failed! SQL-Error: " . mysqli_error($conection), E_USER_ERROR);
                        if ($resultado) {
                            echo "<script>alert('Se ha actualizado exitosamente');
                                window.location.href='./modificar_sede.php?id_perfil=" . $id_admin . '&id_sede=' . $id_sede . "';</script>";
                        } else {
                            echo "<script>alert('Error al realizar la actualización');</script>";
                        }

                        mysqli_close($conection);
                    }
            }
        }
        if (isset($_POST['eliminar'])) {
            $instruccion_SQL = "UPDATE sedes SET estado_sede = 2 WHERE id_sede = '$id_sede'";
            $resultado = mysqli_query($conection, $instruccion_SQL) or trigger_error("Query Failed! SQL-Error: " . mysqli_error($conection), E_USER_ERROR);
            if ($resultado) {
                echo "<script>alert('Se ha eliminado exitosamente');
                    window.location.href='../queries/consultar_sedes.php?id_perfil=" . $id_admin . "';</script>";
            } else {
                echo "<script>alert('Error al realizar la eliminación');</script>";
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
<script src="./js/script.js"></script>
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script src="js/script_map.js"></script>
</body>
</html>