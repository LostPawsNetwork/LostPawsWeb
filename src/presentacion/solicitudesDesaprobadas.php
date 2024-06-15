<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true 
|| ($_SESSION['tipoUsuario'] !== 'admin' && $_SESSION['tipoUsuario'] !== 'superadmin'))
{
    header("Location: /lostpaws/presentacion/login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usurio mal calificado</title>
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
</head>
<body class="bg-gray-100">
    <div id="header">
        <?php include "../components/header3.html"; ?>
    </div>
        <br>
    <div id="main-content" class='min-h-screen'>
        <div class="container mx-auto p-4">
            <div class="">
                <h1 class="text-3xl font-bold mb-6">Usuarios mal calificados</h1>
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white border border-gray-200 rounded-lg text-center">
                        <thead class="bg-gray-200">
                            <tr>
                                <th class="py-2 px-4 border-b">ID Usuario</th>
                                <th class="py-2 px-4 border-b">Fecha</th>
                                <th class="py-2 px-4 border-b">Examen</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Aquí debes reemplazar con tu propia lógica de conexión a la base de datos y consulta
                            $examenes = [
                                ['id_usuario' => 101, 'fecha' => '2024-01-01', 'link_examen' => 'https://example.com/examen/1'],
                                ['id_usuario' => 102, 'fecha' => '2024-02-01', 'link_examen' => 'https://example.com/examen/2'],
                                // Agrega más examenes aquí
                            ];

                            foreach ($examenes as $examen) {
                                echo "<tr>";
                                echo "<td class='py-2 px-4 border-b'>{$examen['id_usuario']}</td>";
                                echo "<td class='py-2 px-4 border-b'>{$examen['fecha']}</td>";
                                echo "<td class='py-2 px-4 border-b'><a href='{$examen['link_examen']}' class='bg-blue-500 mr-2 text-white p-2 rounded-md hover:bg-blue-600'>Ver examen</a></td>";
                            ?></tr>
                            <?php }
                            ?>
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
