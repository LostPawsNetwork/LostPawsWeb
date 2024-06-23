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

require_once "../datos/testimonio.php";
$testimonio = new Testimonio();
$testimonios = $testimonio->obtenerTestimonios();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Testimonios</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
</head>
<body class="bg-gray-100">
    <div id="header">
        <?php include "../components/header3.html"; ?>
    </div>
        <br>
    <div id="main-content" class='min-h-screen'>
        <div class="container mx-auto p-4">
            <div class="">
                <div class="flex justify-between items-center mb-4">
                    <h1 class="text-3xl font-bold mb-6">Gestionar Testimonios</h1>
                    <a href="formularioTestimonio.php" class="bg-green-500 text-white p-2 rounded-md hover:bg-green-600">Agregar Testimonio</a>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white border border-gray-200 rounded-lg text-center mt-8">
                        <thead class="bg-gray-200">
                            <tr>
                                <th class="py-2 px-4 border-b">ID Testimonio</th>
                                <th class="py-2 px-4 border-b">Fecha</th>
                                <th class="py-2 px-4 border-b">Texto</th>
                                <th class="py-2 px-4 border-b">idUsuario</th>
                                <th class="py-2 px-4 border-b">Foto</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($testimonios as $testimonio) {
                                echo "<tr>";
                                echo "<td class='py-2 px-4 border-b'>{$testimonio["idtestimonio"]}</td>";
                                echo "<td class='py-2 px-4 border-b'>{$testimonio["fecha"]}</td>";
                                echo "<td class='py-2 px-4 border-b'>{$testimonio["texto"]}</td>";
                                echo "<td class='py-2 px-4 border-b'>{$testimonio["idusuario"]}</td>";
                                echo "<td class='py-2 px-4 border-b'><img src='{$testimonio["foto"]}' alt='Foto del Testimonio' class='h-12 w-12 object-cover'></td>";
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
