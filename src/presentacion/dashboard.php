<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true || $_SESSION['tipoUsuario'] !== 'admin') 
{
    header("Location: /lostpaws/presentacion/login.php");
    exit;
}

require_once "../datos/can.php";

$can = new Can();
$listaDeCans = $can->listarCanes();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
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
    <div id="main-content" class='flex min-h-screen'>
        <div class="container mx-auto p-4">
            <div class="flex justify-between items-center mb-4">
                <h1 class="text-2xl font-bold">Listado de Perros</h1>
                <a href="agregarPerro.php" class="bg-green-500 text-white p-2 rounded-md hover:bg-green-600">Agregar Perro</a>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                <?php foreach ($listaDeCans as $can): ?>
                    <div class="bg-white p-4 rounded-lg shadow-md transform transition duration-500 hover:scale-105">
                        <?php if ($can["foto1"]): ?>
                            <img src="<?php echo htmlspecialchars($can["foto1"]); ?>" alt="Foto de <?php echo htmlspecialchars($can["nombre"]); ?>" class="h-40 w-full object-cover mb-4 rounded-lg">
                        <?php endif; ?>
                        <h2 class="text-xl font-semibold mb-2"><?php echo htmlspecialchars($can["nombre"]); ?></h2>
                        <p class="text-gray-700"><strong>Raza:</strong> <?php echo htmlspecialchars($can["raza"]); ?></p>
                        <p class="text-gray-700"><strong>Edad:</strong> <?php echo htmlspecialchars($can["edad"]); ?></p>
                        <p class="text-gray-700"><strong>Tamaño:</strong> <?php echo htmlspecialchars($can["tamano"]); ?></p>
                        <p class="text-gray-700"><strong>Género:</strong> <?php echo htmlspecialchars($can["genero"]); ?></p>
                        <p class="text-gray-700"><strong>Observaciones Médicas:</strong> <?php echo htmlspecialchars($can["observacionesmedicas"]); ?></p>
                        <p class="text-gray-700"><strong>Descripción:</strong> <?php echo htmlspecialchars($can["descripcion"]); ?></p>
                        <form action="editarCan.php" method="post">
                            <input type="hidden" name="idCan" value="<?php echo $can["idcan"]; ?>">
                            <button type="submit" class="mt-4 bg-blue-500 text-white p-2 rounded-md hover:bg-blue-600">Editar</button>
                        </form>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <?php include "../components/footer.html"; ?>
</body>
</html>
