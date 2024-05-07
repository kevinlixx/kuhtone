<?php
include("./config/conexion.php");
include("./includes/cuentaTemporalModel.php");

$id_admin = $_GET['id_perfil'];
$cuentaTemporal = new CuentaTemporal($conection);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $tipo_usuario = $_POST['tipo_usuario'];
  $correo = $_POST['correo'];
  $cuentaTemporal->restaurarCuenta($tipo_usuario, $correo);
  $resultado = $cuentaTemporal->eliminarCuentaTemporal($tipo_usuario, $correo);
}

function obtenerCuentas($conection) {
    $cuentaTemporal = new CuentaTemporal($conection);
    return $cuentaTemporal->obtenerCuentasTemporales();
}

$cuentas = obtenerCuentas($conection);
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
    <link rel="stylesheet" href="./css/style_cuentasTemp.css">
    <link rel="stylesheet" href="./css/tablet_cuentasTemp.css" media="screen and (min-width: 500px)"/>
    <link rel="stylesheet" href="./css/desktop_cuentasTemp.css" media="screen and (min-width: 800px)"/>
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
                     <li><a href="../index_admin.php?id_perfil='.$id_admin.'">Inicio</a></li>
                       <li><a href="../perfil_admin.php?id_perfil='.$id_admin.'">Mi perfil</a></li>
                       <li><a href="../index.php" id="selected">Cerrar Sesion</a></li>';
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
      <h1 class="title--main">Cuentas Eliminadas</h1>
      <div class= "design--container">
        <div class="psicologos--contenedor">
        <?php
        $cuentas = obtenerCuentas($conection);
        foreach ($cuentas as $cuenta) {
          echo '
          <section class="psicologos--card">
            <h4>'.$cuenta['tipo_usuario'].'</h4> 
            <div class="content--container">
              <figure class="figure--card"> 
                <img 
                src="'.$cuenta['ruta_imagen'].'" 
                alt="usuario"
                />  
                <figcaption></figcaption> 
              </figure>
              <div class="psicologo--description">
                <p><span class="item--aco">Nombres:</span> '.$cuenta['nombres'].' '.$cuenta['apellidos'].'</p>
                <p><span class="item--aco">Correo:</span> '.$cuenta['correo'].'</p>
                <p><span class="item--aco">Teléfono:</span> '.$cuenta['telefono_movil'].'</p>';
                if (array_key_exists('especializacion', $cuenta)) {
                  echo '<p><span class="item--aco">Especialización:</span> '.$cuenta['especializacion'].'</p>';
                }
              echo '
              </div>
            </div>
            <form id="form-restaurar-cuenta" method="POST">
                <input type="hidden" name="tipo_usuario" value="' . $cuenta['tipo_usuario'] . '">
                <input type="hidden" name="correo" value="' . $cuenta['correo'] . '">
                <button type="submit" name="restaurar_cuenta" class="rest_account">Restaurar Cuenta</button>
            </form>
        </section>
        ';
        }
        echo '<a href="../index_admin.php?id_perfil='.$id_admin.'" class="back--bottom">Volver</a>';
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
<script src="js/script_restaurarCuenta.js"></script>
</body>
</html>