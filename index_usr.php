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
    <link rel="stylesheet" href="./css/tablet_usr.css" media="screen and (min-width: 500px)"/>
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
                        <li><a href="#">Mis citas</a></li>
                        <!-- <li><a href="./detalle_psicologo.html">Agendar cita</a></li> -->
                        <li><a href="#">Mi perfil</a></li>
                        <li><a href="./index.php" id="selected">Cerrar Sesion</a></li>
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
        <main>
            <div class="container-all" >
              <h1 class="title-categorias" id="catego">Opciones </h1>
              <div class="container-caja" id="container">
                <a href="#"
                  ><div class="caja caja1">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-calendar-plus" width="52" height="52" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ff9300" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <path d="M12.5 21h-6.5a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v5" />
                        <path d="M16 3v4" />
                        <path d="M8 3v4" />
                        <path d="M4 11h16" />
                        <path d="M16 19h6" />
                        <path d="M19 16v6" />
                      </svg>
                    <h4>Agendar cita</h4>
                    <p>Aqui puedes programar nuevas citas con facilidad.</p>
                    <div class="animacion">
                    </div>
                  </div>
              </a>
                <a href="#">
                  <div class="caja caja2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-clock-search" width="52" height="52" viewBox="0 0 24 24" stroke-width="1.5" stroke="#009988" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <path d="M20.993 11.646a9 9 0 1 0 -9.318 9.348" />
                        <path d="M12 7v5l1 1" />
                        <path d="M18 18m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" />
                        <path d="M20.2 20.2l1.8 1.8" />
                      </svg>
                    <h4>Ver cita</h4>
                    <p>Aquí puedes ver los detalles de tus próximas citas para mantenerte organizado y al día.</p>
                    <div class="animacion"></div></div
                ></a>
                <a href="#"
                  ><div class="caja caja3">
                      <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-history" width="52" height="52" viewBox="0 0 24 24" stroke-width="1.5" stroke="#7edfdf" fill="none" stroke-linecap="round" stroke-linejoin="round">
                      <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                      <path d="M12 8l0 4l2 2" />
                      <path d="M3.05 11a9 9 0 1 1 .5 4m-.5 5v-5h5" />
                      </svg>
                    <h4>Historial de citas</h4>
                    <p>¡Aqui puedes ver un registro completo de todas tus citas anteriores.
                    </p>
                    <div class="animacion"></div></div
                ></a>
                
              </div>
            </div>
          </main>
    </main>
   <footer class="pie-pagina">
   <div class="footer_copy">
        <small>&copy; 2023 <b>kuhtone</b> - Todos los Derechos Reservados.</small>
   </div>
</footer>
<script src="js/script.js"></script>
</body>
</html>