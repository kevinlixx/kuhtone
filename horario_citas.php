<?php
include("./config/conexion.php");
session_start();
$id_profesional = $_SESSION['id_profesional'];
$id_paciente= $_GET['id_perfil'];

$profesional ="SELECT * FROM profesional WHERE id_profesional = $id_profesional";
$consulta = mysqli_query($conection, $profesional ) or die ("Error al traer los datos");

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Agendamiento</title>
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
                    <?php
                      echo'
                      <li><a href="./index_usr.php?id_perfil='.$id_paciente.'">Inicio</a></li>
                        <li><a href="./queries/consultar_citas.php?id_perfil='.$id_paciente.'">Mis citas</a></li>
                        <li><a href="./perfil.php?id_perfil='.$id_paciente.'">Mi perfil</a></li>
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
      

      <!-- esta parte es la de dias dispobibles -->
      <h1 class="title--main">Agenda tu cita</h1>

      <?php
      
      while($consulta_total= mysqli_fetch_array($consulta))
            {
                echo'

    <form method="POST" action="#">          
      <div class="psicologos--contenedor">
      <input type="hidden" name="id_profesional" value="'.$id_profesional.'">
          <section class="psicologos--card">
              <figure class="figure--card"> 
                  <img 
                  src="'.$consulta_total["foto_perfil"].'"  
                  alt="psicologo"
                  />  
                  <figcaption></figcaption> 
              </figure>
              <div class="psicologo--description">
              <h2>'.$consulta_total["nombres"].' '.$consulta_total["apellidos"].'</h2>
              <p>'.$consulta_total["descripcion"].'</p>
              <a href="./psicologos.php?id_perfil='.$id_paciente.'" class="mas_info--description">cambiar de psicologo</a>
            </div>
          </section>
          <section class="tipo--cita">
          <h2>Selecciona el tipo de cita</h2>
          <div class="tipo--cita--container">
            <div class="tipo--cita--card">
              <input type="radio" id="cita1" name="tipo-cita" value="presencial" required>
              <label for="cita1">Cita presencial</label>
            </div>
            <div class="tipo--cita--card card-derecha">
              <input type="radio" id="cita2" name="tipo-cita" value="virtual" required>
              <label for="cita2">Cita virtual</label>
            </div>
          </div>
        </section>
          
      
      <!-- esta parte es la del calendario -->
      <div class="container">
        
        <div class="calendar">
          <div class="legend--hour">
          <p>Dias disponibles</p>
          <div class="circle"></div>
          </div>
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
          <!-- esta parte es la de seleccionar la hora -->
            <h2 class="select--hour">Selecciona la hora</h2>
            <div class="selecthora">
              <input type="hidden" id="selectedHour" name="selectedHour" value="" required>

              <div class="horariodispo" id="available-hours"/>
              </div>
        </div>
      </div>';
      
              ?>
            <?php
            echo'

            </div>
            <input type="submit" value="Realizar agendamiento" class="asignar--bottom" name="registro-agendamiento"  required>

            ';
            if(isset($_POST['registro-agendamiento'])) {
              // Verificar si la asignación ya existe
              $check_query = "SELECT * FROM paciente_profesional WHERE id_paciente = $id_paciente AND id_profesional = $id_profesional";
              $check_result = mysqli_query($conection, $check_query) or die ("Error al verificar los datos");

              if (mysqli_num_rows($check_result) > 0) {
                  // La asignación ya existe, no hacer nada o mostrar un mensaje
                  echo "La asignación entre el paciente y el profesional ya existe.";
              } else {
                  // La asignación no existe, insertarla
                  $insert_query = "INSERT INTO paciente_profesional (id_paciente, id_profesional) VALUES ($id_paciente, $id_profesional)";
                  mysqli_query($conection, $insert_query) or die ("Error al insertar los datos");
              }
              $id_agendamiento = "";
              $fecha_agendada = $_POST['selected-fecha'];
              $hora_agendada = $_POST['selectedHour'];
              $tipo_cita = $_POST['tipo-cita'];
              $id_sede=$consulta_total["sede_id"];
              $disponibilidad = "SELECT * FROM disponibilidad WHERE (fecha_disponibilidad = '$fecha_agendada') AND (hora_inicio = '$hora_agendada')";
              $consulta_disponibilidad = mysqli_query($conection, $disponibilidad) or die ("Error al traer los datos");
              if($consulta_disponibilidadTotal = mysqli_fetch_array($consulta_disponibilidad)) {
                  $id_disponibilidad = $consulta_disponibilidadTotal["id_disponibilidad"];
                  $hora_final= $consulta_disponibilidadTotal["hora_final"];
                  
                  
                  
                  $link_teams = "https://teams.microsoft.com/l/meetup-join/19:Gu0DchhxSqIfnsnc0S4kTNH_6GgzxgB-I0X_X9RcnQ01@thread.tacv2/1684020271948?context=%7B%22Tid%22:%22b1ba85eb-a253-4467-9ee8-d4f8ed4df300%22,%22Oid%22:%221f586e41-8496-48b3-bc69-eda655c7bd93%22%7D";

                  $instruccion_SQL = "INSERT INTO agendamiento (id_agendamiento, id_paciente, id_disponibilidad, link_teams,tipo_cita,id_sede) VALUES ('$id_agendamiento', $id_paciente, '$id_disponibilidad', '$link_teams', '$tipo_cita','$id_sede')";
                  $resultado = mysqli_query($conection, $instruccion_SQL) or trigger_error("Query Failed! SQL-Error: ".mysqli_error($conection), E_USER_ERROR);
                  $off_dispo = 2;
                  $instruccion_update = "CALL modificarEstado_dispo ($id_disponibilidad,$off_dispo)";
                  $status =  mysqli_query($conection, $instruccion_update) or trigger_error("Query Failed! SQL-Error: ".mysqli_error($conection), E_USER_ERROR);  
                  if($resultado) {
                    echo "<script>alert('Se ha registrado exitosamente el agendamiento');
                    window.location.href = './detalle_cita.php?id_dispo=".$id_disponibilidad."&id_perfil=".$id_paciente."';</script>";          
                  } else {  
                      echo "<script>alert('error en realizar el agendamiento');</script>";
                  } 
                  mysqli_close($conection);
              }
              
          }
          
            echo'
    </form>
            <a href=\'./detalle_psicologo.php?id='.$consulta_total["id_profesional"].'&id_perfil='.$id_paciente.'\' class="back--bottom">Volver</a>
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