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

require_once '../datos/usuario.php';

$correo = $_SESSION['correo'];

$usuario = new Usuario();
$datosUsuario = $usuario->obtenerUsuario($correo);

if ($datosUsuario !== false && !empty($datosUsuario)) {
    $nombre = $datosUsuario[0]['nombre'];
    $apellido = $datosUsuario[0]['apellido'];
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
        }

        #video-background {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            z-index: -1;
            filter: blur(10px);
        }

        .form-container {
            background-color: rgba(255, 255, 255, 0.8);
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
            margin-top:270px; /* Asegura que el formulario no se superponga con el encabezado */
            z-index: 1;
        }

        .header {
            width: 100%;
            z-index: 2;
        }
    </style>
</head>
<body>

<?php include "../components/header2.html"; ?>
<?php include "../components/sidebar2.php"; ?>
<br>
<br>
    <div class="form-container">
        <h2 class="text-2xl font-bold mb-6 text-center">Editar Perfil de Usuario</h2>
        <form action="../negocio/procesarEditarUsuario.php" method="post" class="space-y-4">
            <div>
                <label for="correo" class="block text-sm font-medium text-gray-700">Correo Electrónico:</label>
                <input type="email" id="correo" name="correo" class="mt-1 block w-full px-3 py-2 border border-gray-300 
                rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" 
                required value="<?php echo htmlspecialchars($correo); ?>">
            </div>

            <div>
                <label for="nombre" class="block text-sm font-medium text-gray-700">Nombre:</label>
                <input type="text" id="nombre" name="nombre" class="mt-1 block w-full px-3 py-2 border border-gray-300 
                rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" 
                required value="<?php echo htmlspecialchars($nombre); ?>">
            </div>

            <div>
                <label for="apellido" class="block text-sm font-medium text-gray-700">Apellido:</label>
                <input type="text" id="apellido" name="apellido" class="mt-1 block w-full px-3 py-2 border border-gray-300 
                rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" 
                required value="<?php echo htmlspecialchars($apellido); ?>">
            </div>

            <div class="flex justify-center">
                <button type="submit" class="bg-blue-600 text-white w-full p-2 rounded-md hover:bg-blue-700">Actualizar Perfil</button>
            </div>
        </form>
    </div>

</body>
</html>