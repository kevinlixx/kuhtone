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
    <title>kuhtone</title>
    <script src="https://kit.fontawesome.com/79e6024c63.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700&family=Inter:wght@300;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./css/style_usr.css">
    <link rel="stylesheet" href="./css/tablet_usr.css" media="screen and (min-width: 600px)"/>
    <link rel="stylesheet" href="./css/desktop_usr.css" media="screen and (min-width: 800px)"/>
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
                        <img src="./img/menu.svg" alt="menu"/>  
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
            <div class="container-all" >
              <h1 class="title-categorias" id="catego">Opciones </h1>
              <div class="container-caja" id="container">
                <?php
                echo'
                <a href="./insert_sede.php?id_perfil='.$id_admin.'"';
                ?>
                  ><div class="caja caja1">
                  <object type="image/svg+xml" data="img/register_sede.svg" class="icon icon-tabler icon-tabler-switch-3" width="52" height="52"></object>
                    <h4>Registrar sede</h4>
                    <p>Aqui puedes registrar las sedes de kuhtone.</p>
                    <div class="animacion">
                    </div>
                  </div>
              </a>
              <?php
              echo '
                <a href="./queries/consultar_sedes.php?id_perfil='.$id_admin.'">';
                ?>
                  <div class="caja caja2">
                  <object type="image/svg+xml" data="img/modifie_sede.svg" class="icon icon-tabler icon-tabler-switch-3" width="52" height="52"></object>
                    <h4>Modificar sedes de kuhtone</h4>
                    <p>Aquí puedes modificar la información de las sedes.</p>
                    <div class="animacion"></div></div
                ></a>
                <?php
              echo '
                <a href="./queries/consultar_sedesInhabilitadas.php?id_perfil='.$id_admin.'">';
                ?>
                  <div class="caja caja3">
                  <object type="image/svg+xml" data="img/sede_del.svg" class="icon icon-tabler icon-tabler-switch-3" width="52" height="52"></object>                   
                    <h4> sedes Inhabilitadas de kuhtone</h4>
                    <p>Aquí puedes vovler a habilitar la información de las sedes.</p>
                    <div class="animacion"></div></div
                ></a>
                <!-- <a href="#"
                  ><div class="caja caja3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user-x" width="52" height="52" viewBox="0 0 24 24" stroke-width="1.5" stroke="#7edfdf" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />
                        <path d="M6 21v-2a4 4 0 0 1 4 -4h3.5" />
                        <path d="M22 22l-5 -5" />
                        <path d="M17 22l5 -5" />
                      </svg>
                    <h4>Inhabilitar Cuenta</h4>
                    <p>Aqui puedes cancelar o eliminar cuenta en caso de inactividad.</p>
                    <div class="animacion"></div></div
                ></a> -->
                
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