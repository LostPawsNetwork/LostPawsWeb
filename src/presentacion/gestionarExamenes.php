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

require_once "../config/neon.php";
require_once "../datos/examenAptitud.php";

// Crea una instancia de la clase ExamenAptitud
$examenAptitud = new ExamenAptitud();
$examenes = $examenAptitud->obtenerExamenesAptitud();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exámenes</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        /* Estilo para el header */
        #header {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            background-color: #ffffff; /* Color de fondo del header */
            z-index: 9999; /* Asegura que el header esté por encima del contenido */
        }

        /* Estilo para el contenido principal */
        #main-content {
            margin-top: 60px; /* Ajusta el margen superior para que empiece después del header */
        }
    </style>
    <script>
            function confirmarOperacion(event, form) {
                event.preventDefault();
                var accion = event.submitter.innerText.toLowerCase();
                var confirmar = confirm("¿Está seguro que desea " + accion + " este examen?");
                if (confirmar) {
                    form.submit();
                }
            }
        </script>
</head>
<body class="bg-gray-100">
    <div id="header">
        <?php include "../components/header3.html"; ?>
    </div>
        <br>
    <div id="main-content" class='min-h-screen'>
        <div class="container mx-auto p-4">
            <div class="">
                <h1 class="text-3xl font-bold mb-6">Exámenes</h1>
                <div class="overflow-x-auto">
                    <a href='https://docs.google.com/forms/d/1NVCjJMX96Nbc48Axl1c5gSrdz9c6I9LD-cyf8VOegpk/edit#response=ACYDBNgTtMvBHnrwMXZXQ_ioCTurUsX0hZfCzrMOQrDxP9aGZkjtkyq4yhGz8J4OPQ' class='text-blue-600 hover:underline'>Ver respuestas</a>
                    <table class="min-w-full bg-white border border-gray-200 rounded-lg text-center">
                        <thead class="bg-gray-200">
                            <tr>
                                <th class="py-2 px-4 border-b">ID Examen</th>
                                <th class="py-2 px-4 border-b">ID Usuario</th>
                                <th class="py-2 px-4 border-b">Estado</th>
                                <th class="py-2 px-4 border-b">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>

                                                    <?php foreach (
                                                        $examenes
                                                        as $examen
                                                    ) {
                                                        echo "<tr>";
                                                        echo "<td class='py-2 px-4 border-b'>{$examen["idexamen"]}</td>";
                                                        echo "<td class='py-2 px-4 border-b'>{$examen["idusuario"]}</td>";
                                                        echo "<td class='py-2 px-4 border-b'>{$examen["estado"]}</td>";
                                                        echo "<td class='py-2 px-4 border-b'>";
                                                        if (
                                                            $examen[
                                                                "estado"
                                                            ] === "pendiente"
                                                        ) {
                                                            echo "
                                                                <form action='../negocio/aprobarExamen.php' method='post' style='display:inline;' onsubmit='confirmarOperacion(event, this)'>
                                                                    <input type='hidden' name='idexamen' value='{$examen["idexamen"]}'>
                                                                    <button type='submit' class='bg-green-500 mr-2 text-white p-2 rounded-md hover:bg-green-600'>Aceptar</button>
                                                                </form>
                                                                <form action='../negocio/rechazarExamen.php' method='post' style='display:inline;' onsubmit='confirmarOperacion(event, this)'>
                                                                    <input type='hidden' name='idexamen' value='{$examen["idexamen"]}'>
                                                                    <button type='submit' class='bg-red-500 text-white p-2 rounded-md hover:bg-red-600'>Rechazar</button>
                                                                </form>";
                                                        } else {
                                                            echo "
                                                                <button type='button' class='bg-gray-400 text-white p-2 rounded-md cursor-not-allowed' disabled>Aceptar</button>
                                                                <button type='button' class='bg-gray-400 text-white p-2 rounded-md cursor-not-allowed' disabled>Rechazar</button>";
                                                        }
                                                        echo "</td>";
                                                        echo "</tr>";
                                                    } ?>
                                                </tbody>
                    </table>
                </div>
            </div>
        <a href="dashAdmin.php"><button class="mt-5 px-4 py-2 bg-white hover:bg-gray-200 rounded-md">Volver</button></a>
        </div>
    </div>

    <?php include "../components/footer.html"; ?>
</body>
</html>
