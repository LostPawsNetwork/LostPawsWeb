<?php
// session_start();
// if (!isset($_SESSION['correo'])) {
//     header("Location: login.php");
//     exit();
// }
?>

<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

    <div class='flex'>
        <?php include "../components/header2.html"; ?>

        <div class="flex-1">
            <!-- Menú Lateral -->
            <?php include "../components/sidebar2.html"; ?>
            <!-- Contenido principal de la página -->
            <div id="main-content" class='flex min-h-screen p-4 mt-20'>
                <div class="container mx-auto p-4">
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 gap-8">
                        <div class="bg-blue-500 hover:bg-blue-600 p-4 rounded-lg shadow-md transform transition duration-500 hover:scale-105">
                            <div class="bg-white text-black font-bold py-2 px-4 rounded">
                                <a href="dashboard.php">Gestionar Can</a>
                            </div>
                        </div>
                        <div class="bg-blue-500 hover:bg-blue-600 p-4 rounded-lg shadow-md transform transition duration-500 hover:scale-105">
                            <div class="bg-white text-black font-bold py-2 px-4 rounded">
                                <button type="submit">Gestionar Solicitudes</button>
                            </div>
                        </div>
                        <div class="bg-blue-500 hover:bg-blue-600 p-4 rounded-lg shadow-md transform transition duration-500 hover:scale-105">
                            <div class="bg-white text-black font-bold py-2 px-4 rounded">
                                <button type="submit">Gestionar Exámenes</button>
                            </div>
                        </div>
                        <div class="bg-blue-500 hover:bg-blue-600 p-4 rounded-lg shadow-md transform transition duration-500 hover:scale-105">
                            <div class="bg-white text-black font-bold py-2 px-4 rounded">
                                <button type="submit">Gestionar Controles</button>
                            </div>
                        </div>
                        <div class="bg-blue-500 hover:bg-blue-600 p-4 rounded-lg shadow-md transform transition duration-500 hover:scale-105">
                            <div class="bg-white text-black font-bold py-2 px-4 rounded">
                                <button type="submit">Gestionar Testimonios</button>
                            </div>
                        </div>
                        <div class="bg-blue-500 hover:bg-blue-600 p-4 rounded-lg shadow-md transform transition duration-500 hover:scale-105">
                            <div class="bg-white text-black font-bold py-2 px-4 rounded">
                                <button type="submit">Gestionar Administradores</button>
                            </div>
                        </div>
                        <div class="bg-blue-500 hover:bg-blue-600 p-4 rounded-lg shadow-md transform transition duration-500 hover:scale-105">
                            <div class="bg-white text-black font-bold py-2 px-4 rounded">
                                <button type="submit">Reporte Usuarios Mal Calificados</button>
                            </div>
                        </div>
                        <div class="bg-blue-500 hover:bg-blue-600 p-4 rounded-lg shadow-md transform transition duration-500 hover:scale-105">
                            <div class="bg-white text-black font-bold py-2 px-4 rounded">
                                <button type="submit">Reporte Donaciones</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include "../components/footer.html"; ?>

    <script src="../scripts/dynamic.js"></script>
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script src="../scripts/map.js"></script>
</body>
</html>
