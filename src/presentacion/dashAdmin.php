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
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Panel de Administración - LostPaws</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
  <style>
    * {
      box-sizing: border-box;
    }

    body {
      font-family: "Muli", sans-serif;
      display: flex;
      align-items: center;
      justify-content: center;
      height: 100vh;
      overflow: hidden;
      margin: 0;
      background-color: #f3f4f6;
    }

    .container {
      display: flex;
      flex-direction: column;
      align-items: center;
      width: 90vw;
    }

    h1 {
      font-size: 2.5rem;
      margin-bottom: 20px;
      color: #333;
    }

    .panel-container {
      display: flex;
      width: 100%;
    }

    .panel {
      background-size: auto 100%;
      background-position: center;
      background-repeat: no-repeat;
      height: 60vh;
      border-radius: 50px;
      color: #fff;
      cursor: pointer;
      flex: 0.5;
      margin: 10px;
      position: relative;
      transition: flex 0.7s ease-in;
      -webkit-transition: all 700ms ease-in;
    }

    .panel h3 {
      font-size: 24px;
      position: absolute;
      bottom: 20px;
      left: 20px;
      margin: 0;
      opacity: 0;
    }

    .panel.active {
      flex: 5;
    }

    .panel.active h3 {
      opacity: 1;
      transition: opacity 0.3s ease-in 0.4s;
    }

    @media (max-width: 480px) {
      .panel-container {
        flex-direction: column;
      }

      .panel:nth-of-type(4),
      .panel:nth-of-type(5) {
        display: none;
      }
    }
  </style>
</head>

<body>

  <div class="container mt-20">
    <h1>Panel de Administrador</h1>
    <div class="panel-container">
      <div class="panel active" style="background-image: url('../assets/images/gestionarCan.jpg');">
        <a href="gestionarCan.php">
          <h3>Gestionar Can</h3>
        </a>
      </div>
      <div class="panel" style="background-image: url('../assets/images/gestionarSolicitud.jpeg');">
        <a href="gestionarSolicitud.php">
          <h3>Gestionar Solicitudes</h3>
        </a>
      </div>
      <div class="panel" style="background-image: url('../assets/images/gestionarExamenes.jpeg');">
        <a href="gestionarExamenes.php">
          <h3>Gestionar Exámenes</h3>
        </a>
      </div>
      <div class="panel" style="background-image: url('../assets/images/gestionarControles.jpeg');">
        <a href="gestionarControl.php">
          <h3>Gestionar Controles</h3>
        </a>
      </div>
      <div class="panel" style="background-image: url('../assets/images/gestionarTestimonios.jpeg');">
        <a href="gestionarTestimonios.php">
          <h3>Gestionar Testimonios</h3>
        </a>
      </div>
      <div class="panel" style="background-image: url('../assets/images/reportes.jpeg');">
        <a href="reportes.php">
          <h3>Reportes</h3>
        </a>
      </div>
      <div class="panel" style="background-image: url('../assets/images/solicitudesContacto.jpeg');">
        <a href="gestionarContacto.php">
          <h3>Solicitudes de Contacto</h3>
        </a>
      </div>
      <?php if ($_SESSION["tipoUsuario"] === "superadmin") { ?>
        <div class="panel" style="background-image: url('../assets/images/gestionarAdministradores.jpeg');">
          <a href="gestionarAdministradores.php">
            <h3>Gestionar Administradores</h3>
          </a>
        </div>
        <div class="panel" style="background-image: url('../assets/images/reporteDonaciones.jpeg');">
          <a href="reporteDonaciones.php">
            <h3>Reporte Donaciones</h3>
          </a>
        </div>
      <?php } ?>
    </div>
  </div>


  <script>
    const panels = document.querySelectorAll(".panel");

    panels.forEach((panel) => {
      panel.addEventListener("click", () => {
        removeActiveClasses();
        panel.classList.add("active");
      });
    });

    function removeActiveClasses() {
      panels.forEach((panel) => {
        panel.classList.remove("active");
      });
    }
  </script>
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script src="../scripts/map.js"></script>
</body>
</html>
