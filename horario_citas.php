<?php
include("./conexion.php");
$id= $_GET['id'];
$profesional ="SELECT * FROM profesional WHERE id_profesional = $id";
$disponibilidad ="SELECT * FROM disponibilidad WHERE id_profesional = $id";
$consulta = mysqli_query($conection, $profesional ) or die ("Error al traer los datos");
$consulta_disponibilidad = mysqli_query($conection, $disponibilidad ) or die ("Error al traer los datos");


?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Agendamiento</title>
    <script src="https://kit.fontawesome.com/41bcea2ae3.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./css/style_horario.css" />
    <link rel="stylesheet" href="./css/tablet.css" media="screen and (min-width: 600px)"/>
    <link rel="stylesheet" href="./css/desktop_horario.css" media="screen and (min-width: 800px)"/>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css"
    />
    <link
      href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&display=swap"
      rel="stylesheet"
    />
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
                        <li><a href="./psicologos.html" >Inicio</a></li>
                        <li><a href="#">Asignar cita</a></li>
                        <li><a href="#" >Mis citas</a></li>
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
      

      <!-- esta parte es la de dias dispobibles -->
      <h1 class="title--main">Agenda tu cita</h1>

      <?php
      
      while($consulta_total= mysqli_fetch_array($consulta))
            {
                echo'
      <div class="psicologos--contenedor">
          <section class="psicologos--card">
              <figure class="figure--card"> 
                  <img 
                  src="'.$consulta_total["foto_perfil"].'"  
                  alt="psicologo"
                  />  
                  <figcaption></figcaption> 
              </figure>
              <div class="psicologo--description">
              <p>'.$consulta_total["descripcion"].'</p>
              <a href="./psicologos.php" class="mas_info--description">cambiar de psicologo</a>
            </div>
          </section>

          <div class="legend--hour">
              <p>Dias disponibles</p>
              <div class="circle"></div>
              </div>
      
      <!-- esta parte es la del calendario -->
      <div class="container">
        <div class="calendar">
          <div class="month">
            <i class="fas fa-angle-left prev"></i>
            <div class="date">
              <h1></h1>
              <p></p>
            </div>
            <i class="fas fa-angle-right next"></i>
          </div>
          <div class="weekdays">
            <div>Dom</div>
            <div>Lun</div>
            <div>Mar</div>
            <div>Mie</div>
            <div>Jue</div>
            <div>Vie</div>
            <div>Sab</div>
          </div>
          <div class="days"></div>
        </div>
      </div>
      
      <!-- esta parte es la de seleccionar la hora -->
      <h2 class="select--hour">Selecciona la hora</h2>
      <div class="selecthora">

      

            <div class="horariodispo">';
            while($consultaTotal_disponibilidad= mysqli_fetch_array($consulta_disponibilidad))
          {
            $hora = $consultaTotal_disponibilidad["hora_inicio"];
            $hora_disponible = date('H:i', strtotime($hora));
            echo'
              <div>'.$hora_disponible.'</div>
              '; 
            }
            echo'
            </div>
            </div>
            
            <a href=\'./detalle_psicologo.php?id='.$consulta_total["id_profesional"].'\' class="back--bottom">volver</a>
            ';
            
    }
    
    ?>
  </main>
  <footer class="pie-pagina">
    <div class="footer_copy">
         <small>&copy; 2023 <b>kuhtone</b> - Todos los Derechos Reservados.</small>
    </div>
 </footer>
    <script src="./js/script_horario.js"></script>
    <script src="js/script.js"></script>
    
  </body>
</html>