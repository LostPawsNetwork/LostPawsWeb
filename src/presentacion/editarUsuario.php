<?php
session_start();

if (
    !isset($_SESSION["loggedin"]) ||
    $_SESSION["loggedin"] !== true ||
    $_SESSION["tipoUsuario"] !== "user"
) {
    header("Location: /lostpaws/presentacion/login.php");
    exit();
}

require_once "../datos/usuario.php";

$correo = $_SESSION["correo"];

$usuario = new Usuario();
$datosUsuario = $usuario->obtenerUsuario($correo);

if ($datosUsuario !== false && !empty($datosUsuario)) {
    $nombre = $datosUsuario[0]["nombre"];
    $apellido = $datosUsuario[0]["apellido"];
} else {
    // Manejo de error si no se encuentra el usuario
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Perfil de Usuario</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            min-height: 100vh;
            position: relative;
            font-family: 'Inter', sans-serif;
        }

        .form-container {
            background-color: rgba(255, 255, 255, 0.8);
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 800px;
            margin-top: 100px; /* Ajusta según sea necesario */
            z-index: 1;
        }

        .profile-image {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            margin: 0 auto;
            display: block;
            margin-bottom: 20px;
            object-fit: cover;
        }

        .header {
            width: 100%;
            z-index: 2;
        }

        .sidebar {
            z-index: 2; /* Asegúrate de que el sidebar esté delante del video */
        }
    </style>
</head>
<body>

<?php include "../components/header2.html"; ?>

<video id="video-background" autoplay muted loop class="absolute top-0 left-0 w-full h-full object-cover z-0 filter blur-lg">
    <source src="../assets/videos/editarPerfil.mp4" type="video/mp4">
</video>
<div class="sidebar">
    <?php include "../components/sidebar2.php"; ?>
</div>

<div class="form-container mt-28">
    <img src="../assets/images/perfil.jpg" alt="Profile Picture" class="profile-image">
    <h2 class="text-3xl font-bold mb-6 text-center">Editar Perfil de Usuario</h2>
    <form action="../negocio/procesarEditarUsuario.php" method="post" class="space-y-6">
        <div>
            <label for="correo" class="block text-sm font-medium text-gray-700">Correo Electrónico:</label>
            <input type="email" id="correo" name="correo" class="mt-1 block w-full px-3 py-2 border border-gray-300
            rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
            required value="<?php echo htmlspecialchars($correo); ?>">
        </div>

        <div>
            <label for="nombre" class="block text-sm font-medium text-gray-700">Nombre:</label>
            <input type="text" id="nombre" name="nombre" class="mt-1 block w-full px-3 py-2 border border-gray-300
            rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
            required value="<?php echo htmlspecialchars($nombre); ?>">
        </div>

        <div>
            <label for="apellido" class="block text-sm font-medium text-gray-700">Apellido:</label>
            <input type="text" id="apellido" name="apellido" class="mt-1 block w-full px-3 py-2 border border-gray-300
            rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
            required value="<?php echo htmlspecialchars($apellido); ?>">
        </div>

        <div class="flex justify-center">
            <button type="submit" class="bg-blue-600 text-white w-full p-3 rounded-md hover:bg-blue-700">Actualizar Perfil</button>
        </div>
    </form>
</div>

<?php include "../components/footer.html"; ?>

<script src="../scripts/dynamic.js"></script>
</body>
</html>
