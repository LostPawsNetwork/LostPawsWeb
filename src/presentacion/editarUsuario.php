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
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Perfil de Usuario</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class='flex min-h-screen'>
        <?php include "../components/header2.html"; ?>
        <div class="flex-1 flex flex-col items-center justify-center pt-10">
            <?php include "../components/sidebar2.php"; ?>
            <div class="max-w-4xl bg-white p-8 rounded-lg shadow-lg text-center">
                <h1 class="text-2xl font-bold pb-4">Editar Perfil de Usuario</h1>
                <fieldset>
                    <form class="w-full max-w-xl pt-2" action="../negocio/procesarEditarUsuario.php">
                        <div class="flex flex-wrap mb-6">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                                Correo electrónico
                            </label>
                            <input class="appearance-none block w-full text-gray-700 rounded py-3 px-4 mb-3 border border-gray-300 leading-tight focus:outline-none focus:bg-white"
                                type="email" id="correo" name="correo" id="correo"
                                required value="<?php echo htmlspecialchars($correo); ?>"
                                placeholder="Correo electrónico"
                                >
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                                Nombre
                            </label>
                            <input class="appearance-none block w-full text-gray-700 rounded py-3 border border-gray-300 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                                id="nombre" name="nombre" type="text"
                                required value="<?php echo htmlspecialchars($nombre); ?>"
                            >
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                                Apellidos
                            </label>
                            <input class="appearance-none block w-full text-gray-700 rounded py-3 px-4 mb-3 border border-gray-300 leading-tight focus:outline-none focus:bg-white"
                                id="apellido" name="apellido" type="text" placeholder="Apellidos"
                                required value="<?php echo htmlspecialchars($apellido); ?>"
                            >
                        </div>
                        <div class="px-4 py-3 xl:px-6 xl:flex xl:flex-row-reverse">
                            <button id="edUsBtn" type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-xl px-4 py-2 bg-blue-600 text-base text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 xl:ml-3 xl:w-auto xl:text-md">Editar</button>
                            <a href="landingPage.php" class="bg-white hover:bg-gray-200 py-2 px-4 rounded border border-gray-300">
                                Volver
                            </a>
                        </div>
                    </form>
                </fieldset>
            </div>
        </div>
    </div>
</body>
</html>