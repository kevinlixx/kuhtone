
<?php
include("./conexion.php");
session_start();
$id_agenda= $_GET['id_agenda'];
$id_paciente= $_GET['id_perfil'];

$agendamiento ="SELECT * FROM agendamiento WHERE id_agendamiento = $id_agenda";
$consulta_agendamiento = mysqli_query($conection, $agendamiento ) or die ("Error al traer los datos");

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Modificación agendamiento</title>
    <script src="https://kit.fontawesome.com/41bcea2ae3.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./css/style_horario.css" />
    <link rel="stylesheet" href="./css/tablet_horario.css" media="screen and (min-width: 600px)"/>
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
      <h1 class="title--main">Modifica tu cita</h1>

      <?php
      
     if($consulta_agenda= mysqli_fetch_array($consulta_agendamiento))
            {
              
              $dispo ="SELECT * FROM disponibilidad WHERE id_disponibilidad = '".$consulta_agenda['id_disponibilidad']."'";
              $consulta_dispo = mysqli_query($conection, $dispo) or die ("Error al traer los datos");
              if($consulta_disponi= mysqli_fetch_array($consulta_dispo)){
                $profesional ="SELECT * FROM profesional WHERE id_profesional = '".$consulta_disponi['id_profesional']."'";
                $consulta_profe = mysqli_query($conection, $profesional) or die ("Error al traer los datos");
                if($consulta_profesional= mysqli_fetch_array($consulta_profe)){
                echo'
                    <form method="POST" action="#">          
                      <div class="psicologos--contenedor">
                      <input type="hidden" name="id_profesional" value="'.$consulta_profesional["id_profesional"].'">
                          <section class="psicologos--card">
                              <figure class="figure--card"> 
                                  <img 
                                  src="'.$consulta_profesional["foto_perfil"].'"  
                                  alt="psicologo"
                                  />  
                                  <figcaption></figcaption> 
                              </figure>
                              <div class="psicologo--description">
                              <p>'.$consulta_profesional["descripcion"].'</p>';
                              /* <a href="./psicologos.php" class="mas_info--description">cambiar de psicologo</a> */
                              echo'
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
                          <input type="hidden" id="selected-fecha" name="selected-fecha" value="" required>
                          <div class="days" id="days-dispo"></div>
                        </div>
                      </div>
                      <!-- esta parte es la de seleccionar la hora -->
                            <h2 class="select--hour">Selecciona la hora</h2>
                            <div class="selecthora">
                              <input type="hidden" id="selectedHour" name="selectedHour" value="" required>

                              <div class="horariodispo" id="available-hours"/>
                              </div>';
                              ?>
                            <?php
                            echo'

                            </div>
                            <input type="submit" value="Realizar cambios" class="asignar--bottom" name="cambio-agendamiento"  required>

            ';
            if(isset($_POST['cambio-agendamiento'])) {
              $id_agendamiento = "";
              $fecha_agendada = $_POST['selected-fecha'];
              $hora_agendada = $_POST['selectedHour'];
              $disponibilidad = "SELECT * FROM disponibilidad WHERE (fecha_disponibilidad = '$fecha_agendada') AND (hora_inicio = '$hora_agendada')";
              $consulta_disponibilidad = mysqli_query($conection, $disponibilidad) or die ("Error al traer los datos");
              if($consulta_disponibilidadTotal = mysqli_fetch_array($consulta_disponibilidad)) {
                  $id_disponibilidad = $consulta_disponibilidadTotal["id_disponibilidad"];
                  $hora_final= $consulta_disponibilidadTotal["hora_final"];
                  
                  $link_teams = "https://teams.microsoft.com/l/meetup-join/19:Gu0DchhxSqIfnsnc0S4kTNH_6GgzxgB-I0X_X9RcnQ01@thread.tacv2/1684020271948?context=%7B%22Tid%22:%22b1ba85eb-a253-4467-9ee8-d4f8ed4df300%22,%22Oid%22:%221f586e41-8496-48b3-bc69-eda655c7bd93%22%7D";
                  
                  $instruccion_SQL = "UPDATE agendamiento SET id_disponibilidad= $id_disponibilidad WHERE id_agendamiento = $id_agenda" ;
                  $resultado = mysqli_query($conection, $instruccion_SQL) or trigger_error("Query Failed! SQL-Error: ".mysqli_error($conection), E_USER_ERROR);
                  
                  $off_dispo = 2;
                  $instruccion_updateOff = "CALL modificarEstado_dispo($id_disponibilidad,$off_dispo)";

                  $status_off =  mysqli_query($conection, $instruccion_updateOff) or trigger_error("Query Failed! SQL-Error: ".mysqli_error($conection), E_USER_ERROR);
                  
                  $dispo_before=$consulta_disponi['id_disponibilidad'];
                  $on_dispo = 1;
                  $instruccion_updateOn = "CALL modificarEstado_dispo($dispo_before,$on_dispo)";
                  $status_on =  mysqli_query($conection, $instruccion_updateOn) or trigger_error("Query Failed! SQL-Error: ".mysqli_error($conection), E_USER_ERROR);
                  if($resultado) {
                    echo "<script>alert('Se ha modificado exitosamente el agendamiento');
                    window.location.href = './detalle_cita.php?id_dispo=".$id_disponibilidad."&id_perfil=".$id_paciente."';</script>";          
                  } else {  
                      echo "<script>alert('error en realizar la modificación del agendamiento');</script>";
                  } 
                  mysqli_close($conection);
              }
          }
        }
          
            echo'
    </form>
            <a href=\'./detalle_cita.php?id_dispo='.$consulta_disponi["id_disponibilidad"].'\' class="back--bottom">volver</a>
            ';
        }
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