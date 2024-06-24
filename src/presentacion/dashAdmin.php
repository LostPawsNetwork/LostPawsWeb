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
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
</head>

<body class="bg-gray-100">

    <div class='flex'>
        <?php include "../components/header3.html"; ?>

        <div class="flex-1">
            <!-- Contenido principal de la página -->
            <div id="main-content" class='flex min-h-screen p-4 mt-20 text-center'>
                <div class="container mx-auto p-4">
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 gap-8">
                        <a href="gestionarCan.php"><div class="bg-blue-600 hover:bg-blue-600 p-4 rounded-lg shadow-md font-bold transform transition duration-500 hover:scale-105 text-white">
                            Gestionar Can
                        </div></a>
                        <a href="gestionarSolicitudUsuario.php"><div class="bg-blue-600 hover:bg-blue-600 p-4 rounded-lg shadow-md font-bold transform transition duration-500 hover:scale-105 text-white">
                            Gestionar Solicitudes
                        </div></a>
                        <a href="gestionarExamenes.php"><div class="bg-blue-600 hover:bg-blue-600 p-4 rounded-lg shadow-md font-bold transform transition duration-500 hover:scale-105 text-white">
                            Gestionar Exámenes
                        </div></a>
                        <a href="gestionarControl.php"><div class="bg-blue-600 hover:bg-blue-600 p-4 rounded-lg shadow-md font-bold transform transition duration-500 hover:scale-105 text-white">
                            Gestionar Controles
                        </div></a>
                        <a href="gestionarTestimonios.php"><div class="bg-blue-600 hover:bg-blue-600 p-4 rounded-lg shadow-md font-bold transform transition duration-500 hover:scale-105 text-white">
                            Gestionar Testimonios
                        </div></a>
                        <a href="reportes.php"><div class="bg-blue-600 hover:bg-blue-600 p-4 rounded-lg shadow-md font-bold transform transition duration-500 hover:scale-105 text-white">
                            Reportes
                        </div></a>
                        <a href="gestionarContacto.php"><div class="bg-blue-600 hover:bg-blue-600 p-4 rounded-lg shadow-md font-bold transform transition duration-500 hover:scale-105 text-white">
                            Solicitudes de Contacto
                        </div></a>

                        <?php if ($_SESSION["tipoUsuario"] === "superadmin") { ?>
                            <a href="gestionarAdministradores.php"><div class="bg-blue-500 hover:bg-blue-600 p-4 rounded-lg shadow-md font-bold transform transition duration-500 hover:scale-105 text-white">
                                Gestionar Administradores
                            </div></a>
                            <a href="reporteDonaciones.php"><div class="bg-blue-500 hover:bg-blue-600 p-4 rounded-lg shadow-md font-bold transform transition duration-500 hover:scale-105 text-white">
                                Reporte Donaciones
                            </div></a>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include "../components/footer.html"; ?>

    <script src="../scripts/dynamic.js"></script>
    <
