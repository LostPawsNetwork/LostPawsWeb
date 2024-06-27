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

require_once "../datos/can.php";

$can = new Can();
$listaDeCans = $can->listarCanes();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
            background-color: #4a4e78; /* Color de fondo del header */
            z-index: 9999; /* Asegura que el header esté por encima del contenido */
        }

        /* Estilo para el contenido principal */
        #main-content {
            margin-top: 60px; /* Ajusta el margen superior para que empiece después del header */
        }

        /* Estilo para las tarjetas de los perros */
        .dog-card {
            background-color: #d4eaf7;
            transition: transform 0.3s ease-in-out;
        }

        .dog-card:hover {
            transform: scale(1.05);
        }
    </style>
</head>

<body class="bg-white">
    <div id="header">
        <?php include "../components/header3.html"; ?>
    </div>
    <br>
    <div id="main-content" class='flex min-h-screen'>
        <div class="container mx-auto p-4">
            <div class="flex justify-between items-center mb-4">
                <h1 class="text-3xl font-bold">Listado de Canes</h1>
            </div>
            <br>
            <div class="flex justify-end mb-4 space-x-2">
                <a href="agregarPerro.php" class="bg-blue-400 hover:bg-blue-500 text-white p-2 rounded-md">Agregar Perro</a>
                <a href="dashAdmin.php" class="bg-bluey-dark hover:bg-bluey-medium text-white p-2 rounded-md">Volver</a>

            </div>
            <br>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                <?php foreach ($listaDeCans as $can): ?>
                    <div class="dog-card p-4 rounded-lg shadow-md">
                        <?php if ($can["foto1"]): ?>
                            <img src="<?php echo htmlspecialchars(
                                $can["foto1"]
                            ); ?>" alt="Foto de <?php echo htmlspecialchars(
    $can["nombre"]
); ?>" class="h-40 w-full object-cover mb-4 rounded-lg">
                        <?php endif; ?>
                        <h2 class="text-xl font-semibold mb-2"><?php echo htmlspecialchars(
                            $can["nombre"]
                        ); ?></h2>
                        <p class="text-gray-700"><strong>Raza:</strong> <?php echo htmlspecialchars(
                            $can["raza"]
                        ); ?></p>
                        <p class="text-gray-700"><strong>Edad:</strong> <?php echo htmlspecialchars(
                            $can["edad"]
                        ); ?></p>
                        <p class="text-gray-700"><strong>Tamaño:</strong> <?php echo htmlspecialchars(
                            $can["tamano"]
                        ); ?></p>
                        <p class="text-gray-700"><strong>Género:</strong> <?php echo htmlspecialchars(
                            $can["genero"]
                        ); ?></p>
                        <p class="text-gray-700"><strong>Observaciones Médicas:</strong> <?php echo htmlspecialchars(
                            $can["observacionesmedicas"]
                        ); ?></p>
                        <p class="text-gray-700"><strong>Descripción:</strong> <?php echo htmlspecialchars(
                            $can["descripcion"]
                        ); ?></p>
                        <form action="editarCan.php" method="get">
                            <input type="hidden" name="idcan" value="<?php echo $can[
                                "idcan"
                            ]; ?>">
                            <button type="submit" class="mt-4 bg-bluey-medium text-white p-2 rounded-md hover:bg-bluey-dark">Editar</button>
                        </form>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <?php include "../components/footer.html"; ?>
</body>
</html>
