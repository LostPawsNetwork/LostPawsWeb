<?php
session_start();

if (
    !isset($_SESSION["loggedin"]) ||
    $_SESSION["loggedin"] !== true ||
    ($_SESSION["tipoUsuario"] !== "admin" &&
        $_SESSION["tipoUsuario"] !== "superadmin")
) {
    header("Location: /lostpaws/presentacion/login.php");
    exit();
}
?>

<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    .custom-button {
        background-color: #1D4ED8; 
        color: white; 
        padding: 1rem; 
        border-radius: 0.5rem; 
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); 
        width: 95%; 
    max-width: 450px; 
    transition: transform 0.2s, background-color 0.2s; 
        transition: transform 0.2s, background-color 0.2s; 
        margin: 0 auto; 
        text-align: center; 
    }

    .custom-button:hover {
        background-color: #2563EB; 
        transform: scale(1.05); 
    }

    .button-container {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 1rem; 
    }
    
    #video-background {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      object-fit: cover;
      z-index: -1; /* Coloca el video detrás de todo el contenido */
      filter: blur(10px); /* Desenfoque opcional para el video */
    }


  </style>
</head>

<video id="video-background" autoplay muted loop class="absolute top-0 left-0 w-full h-full object-cover z-0 filter blur-lg">
        <source src="../assets/videos/ayaha.mp4" type="video/mp4">
        Your browser does not support the video tag.
    </video>
    <div class="min-h-screen flex items-center justify-center">
    <div class="bg-blue-300 p-4 sm:p-8 rounded-lg shadow-md w-full max-w-md mx-auto">
    <div class="flex justify-center items-center">
        <a href="/lostpaws/presentacion/landingPage.php">
            <img src="../assets/images/logoLostPaws.png" alt="Logo" class="h-20" />
        </a>
    </div>
    <br>
        <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-sm container mx-auto p-4">   
              
        <div class="flex flex-col gap-4 flex flex-col gap-4">
                        <!-- Botón Gestionar Can -->
                        <a href="gestionarCan.php">
                            <div class="custom-button">
                                <div class="font-bold">Gestionar Can</div>
                            </div>
                        </a>

                        <!-- Botón Gestionar Solicitudes -->
                        <a href="gestionarSolicitudUsuario.php">
                            <div class="custom-button">
                                <div class="font-bold">Gestionar Solicitudes</div>
                            </div>
                        </a>

                        <!-- Botón Gestionar Exámenes -->
                        <a href="gestionarExamenes.php">
                            <div class="custom-button">
                                <div class="font-bold">Gestionar Exámenes</div>
                            </div>
                        </a>

                        <!-- Botón Gestionar Controles -->
                        <a href="gestionarControl.php">
                            <div class="custom-button">
                                <div class="font-bold">Gestionar Controles</div>
                            </div>
                        </a>

                        <!-- Botón Gestionar Testimonios -->
                        <div class="custom-button">
                            <div class="font-bold">Gestionar Testimonios</div>
                        </div>

                        <!-- Botón Reporte Usuarios Mal Calificados -->
                        <a href="reporteUsuarios.php">
                            <div class="custom-button">
                                <div class="font-bold">Reporte Usuarios Mal Calificados</div>
                            </div>
                        </a>

                        <!-- Solo visible para superadmin -->
                        <?php if ($_SESSION["tipoUsuario"] === "superadmin") { ?>
                            <!-- Botón Gestionar Administradores -->
                            <a href="gestionarAdministradores.php">
                                <div class="custom-button">
                                    <div class="font-bold">Gestionar Administradores</div>
                                </div>
                            </a>

                            <!-- Botón Reporte Donaciones -->
                            <a href="reporteDonaciones.php">
                                <div class="custom-button">
                                    <div class="font-bold">Reporte Donaciones</div>
                                </div>
                            </a>
                        <?php } ?>
                        
                    </div>
                </div>
                <br>
                <a
            href="/lostpaws/negocio/cerrarSesion.php"
            class="bg-blue-900 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded flex justify-center"
        >
            Cerrar Sesión
        </a>
        </div>
    </div>

    <?php include "../components/footer.html"; ?>

    <script src="../scripts/dynamic.js"></script>
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script src="../scripts/map.js"></script>
</body>
</html>
