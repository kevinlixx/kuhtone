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
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" /> 
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700&family=Inter:wght@300;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/tablet.css" media="screen and (min-width: 600px)" />
    <link rel="stylesheet" href="./css/desktop.css" media="screen and (min-width: 800px)" />
</head>

<body>
    <header>
        <section class="section_header">
            <figure class="figure_header">
                <img src="./img/logo_header.svg" alt="lgo de kuhtone" />
                <figcaptio></figcaptio n>
            </figure>
            <div class="menu menu-header">

                <figure id="btn_menu">
                    <img src="./img/menu.svg" alt="menu" />
                    <figcaption></figcaption>
                </figure>
                <div id="back_menu"></div>
                <nav id="nav" class="menu-section">
                    <img src="img/logo_header.svg" alt="">
                    <ul>
                        <li><a href="./index.php">Inicio</a></li>
                        <li><a href="./login-register.php" id="selected">Iniciar Sesion</a></li>
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
        <!-- Intro de la pagina -->
        <div class="div-info-container" id="intro">
            <div class="row--right">
                <div class="col-md-6">
                    <div class="text">
                        <h1 class="text-colored">¡Agenda tus citas de manera presencial o virtual de forma rápida y sencilla con nuestro aplicativo!</h1>
                        <p> Logra una mejor salud y bienestar: ¡Agenda tus citas médicas en línea con nuestro aplicativo web de consultorios virtuales y recibe atención médica de calidad desde la comodidad de tu hogar!
                        </p>
                        <a href="./login-register.php">
                            <input type="button" value="Empieza Ya!">
                        </a>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="intro_svg">
                        <img src="img/intro_psico_pa.svg" alt="seleccion cita">
                    </div>
                </div>
            </div>
        </div>
        <!-- Seccion de especialidades -->
        <!-- <section class="container_cov"></section> -->
        <div class="div-info-container" id="options">
            <div class="row--left">
                <div class="col-md-6">
                    <div class="text">
                        <h2>La asistencia que necesitas está disponible aquí</h2>
                        <div class="opcs">
                            <p>
                                <object type="image/svg+xml" data="img/camera.svg" class="icon icon-tabler icon-tabler-switch-3" width="52" height="52"></object>
                                LLeva la terapia contigo siempre que la necesites y a tu comodidad.
                            </p>
                            <p>
                                <object type="image/svg+xml" data="img/peop.svg" class="icon icon-tabler icon-tabler-switch-3" width="52" height="52"></object>
                                Encuentra la ayuda de psicólogos especializados disponibles para acompañarte.
                            </p>
                            <p>
                                <object type="image/svg+xml" data="img/localt.svg" class="icon icon-tabler icon-tabler-switch-3" width="52" height="52"></object>
                                Adaptado a tus necesidades desde el punto mas cercano a tu hogar.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="image_svg">
                        <img src="img/psico_intro.svg" alt="consultorio">
                    </div>
                </div>
            </div>
        </div>
        <!-- Seccion de modalidad virtual -->
        <div class="div-info-container" id="virtual">
            <div class="row--right">
                <div class="col-md-6">
                    <div class="text">
                        <h2>Inicia tu terapia desde cualquier ubicación en la que te encuentres con solo tener conexión a internet</h2>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="image_svg">
                        <img src="img/qr_intro.svg" alt="qrCode">
                    </div>
                </div>
            </div>
        </div>
        <!-- Seccion de modalidad presencial: Modificar estructura para visualización de mapa con las sedes-->
        <div class="div-info-container" id="presencial">
            <div class="row--left">
                <div class="col-md-6 text-map">
                    <div class="text">
                        <h2>Si prefieres la atención presencial, también puedes agendar tu cita en sede del consultorio de tu preferencia</h2>
                    </div>
                </div>
                <div class="col-md-6 map">
                    <div class="map">
                         <div class="map--container" id="map--container">
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <footer class="pie-pagina">
        <div class="footer_copy">
            <small>&copy; 2023 <b>kuhtone</b> - Todos los Derechos Reservados.</small>
        </div>
    </footer>
    <script src="js/script.js"></script>
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script src="./js/script_sedes.js"></script>
</body>

</html>