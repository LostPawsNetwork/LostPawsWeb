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
        #header {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            background-color: #ffffff;
            z-index: 9999;
        }

        #main-content {
            margin-top: 60px;
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
    <br><br>
    <div id="main-content" class='min-h-screen'>
        <div class="container mx-auto p-4">
            <div class="">
                <h1 class="text-3xl font-bold mb-6">Exámenes</h1>
                <div class="flex justify-end space-x-2 mb-4">
                    <a href="https://docs.google.com/forms/d/14hm1OzFjjb7r6ol2VSea5h8c9fWQHjI0_D8rv2a8hdc/edit#response=ACYDBNh21KQVFfxu9cXFhjdG8VlTZQ-kz2LL8XMczl9W9oqPo6iJwTDXaRwLDEvhyA" class="bg-blue-400 hover:bg-blue-500 text-white p-2 rounded-md" target="_blank">Ver respuestas</a>
                    <a href="dashAdmin.php" class="bg-bluey-dark hover:bg-bluey-medium text-white p-2 rounded-md">Volver</a>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white border border-gray-200 rounded-lg text-center">
                        <thead class="bg-gray-200">
                            <tr>
                                <th class="py-2 px-4 border-b">ID Examen</th>
                                <th class="py-2 px-4 border-b">Usuario</th>
                                <th class="py-2 px-4 border-b">Correo</th>
                                <th class="py-2 px-4 border-b">Estado</th>
                                <th class="py-2 px-4 border-b">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($examenes as $examen) {
                                echo "<tr>";
                                echo "<td class='py-2 px-4 border-b'>{$examen["idexamen"]}</td>";
                                echo "<td class='py-2 px-4 border-b'>{$examen["nombre"]}</td>";
                                echo "<td class='py-2 px-4 border-b'>{$examen["email"]}</td>";
                                echo "<td class='py-2 px-4 border-b'>{$examen["estado"]}</td>";
                                echo "<td class='py-2 px-4 border-b'>";
                                if ($examen["estado"] === "Pendiente") {
                                    echo "
                                        <form action='../negocio/aprobarExamen.php' method='post' style='display:inline;' onsubmit='confirmarOperacion(event, this)'>
                                            <input type='hidden' name='idexamen' value='{$examen["idexamen"]}'>
                                            <button type='submit' class='bg-green-400 mr-2 text-white p-2 rounded-md hover:bg-green-500'>Aceptar</button>
                                        </form>
                                        <form action='../negocio/rechazarExamen.php' method='post' style='display:inline;' onsubmit='confirmarOperacion(event, this)'>
                                            <input type='hidden' name='idexamen' value='{$examen["idexamen"]}'>
                                            <button type='submit' class='bg-red-400 text-white p-2 rounded-md hover:bg-red-500'>Rechazar</button>
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
        </div>
    </div>
    <?php include "../components/footer.html"; ?>
</body>
</html>
