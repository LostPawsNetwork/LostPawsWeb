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
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ingresar Token - LostPaws</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-black h-screen font-sans relative overflow-hidden">

    <video id="video-background" autoplay muted loop class="absolute top-0 left-0 w-full h-full object-cover z-0 filter blur-lg">
        <source src="../assets/videos/login.mp4" type="video/mp4">
        Tu navegador no soporta la etiqueta de video.
    </video>

    <div class="absolute inset-0 bg-black opacity-50 z-10"></div>

    <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 z-30 w-full px-4">
        <div class="bg-blue-300 p-4 sm:p-8 rounded-lg shadow-md w-full max-w-md mx-auto">
            <div class="flex justify-center items-center">
                <img src="../assets/images/logoLostPaws.png" alt="Logo" class="h-20" />
            </div>
            <br>
            <div class="bg-blue-100 p-6 rounded-lg">
                <h2 class="text-xl sm:text-2xl font-semibold mb-4 text-gray-800 text-center">Ingresar Token</h2>

                <form action="../negocio/procesarToken.php" method="POST" class="space-y-6">
                    <div>
                        <label for="token" class="block text-sm font-medium text-gray-700">Token</label>
                        <input type="text" name="token" id="token" required class="mt-1 p-2 w-full border rounded-md focus:ring focus:ring-blue-200 focus:border-blue-300">
                    </div>
                    <div class="flex justify-center">
                        <button type="submit" class="bg-blue-400 text-white w-full sm:w-40 p-2 rounded-md hover:bg-blue-500">Ingresar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
