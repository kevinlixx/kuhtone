<?php
    include("./config/conexion.php");
    include("./includes/cuentaTemporalModel.php");
    $id_admin= $_GET['id_perfil'];
    function obtenerCuentas($conection) {
    $cuentaTemporal = new CuentaTemporal($conection);
    return $cuentaTemporal->obtenerCuentasTemporales();
  }
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
    <link rel="stylesheet" href="./css/tablet_psicologos.css" media="screen and (min-width: 500px)"/>
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
                      <li><a href="./index_usr.php?id_perfil='.$id_admin.'">Inicio</a></li>
                        <li><a href="./queries/consultar_citas.php?id_perfil='.$id_admin.'">Mis citas</a></li>
                        <li><a href="./perfil.php?id_perfil='.$id_admin.'">Mi perfil</a></li>
                        <li><a href="./index.php" id="selected">Cerrar Sesion</a></li>';
                        ?>
                    </ul>
                </nav>
            </div>
        </section>
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
      <h1 class="title--main">Cuentas Temporales</h1>
      <div class= "design--container">
        <div class="psicologos--contenedor">
        <?php
        $cuentas = obtenerCuentas($conection);
        foreach ($cuentas as $cuenta) {
          echo '
          <section class="psicologos--card">
            <figure class="figure--card"> 
              <img 
              src="'.$cuenta['ruta_imagen'].'" 
              alt="usuario"
              />  
              <figcaption></figcaption> 
            </figure>
            <div class="psicologo--description">
              <h4>'.$cuenta['tipo_usuario'].'</h4> 
              <p><span class="item--aco">Nombres:</span> '.$cuenta['nombres'].' '.$cuenta['apellidos'].'</p>
              <p><span class="item--aco">Correo:</span> '.$cuenta['correo'].'</p>
              <p><span class="item--aco">Teléfono:</span> '.$cuenta['telefono_movil'].'</p>';
              if (array_key_exists('especializacion', $cuenta)) {
                echo '<p><span class="item--aco">Especialización:</span> '.$cuenta['especializacion'].'</p>';
              }
          echo '</div>
            <a class="mas_info--description rest_account">Restaurar Cuenta</a>
          </section>
          ';
        }
        echo'
          <a href="../gestion_admin.php?id_perfil='.$id_admin.'" class="back--bottom">Volver</a>';
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