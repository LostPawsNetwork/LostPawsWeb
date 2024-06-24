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
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ingresar Token - LostPaws</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f3f4f6; 
        }

        #video-background {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            z-index: -1;
            filter: blur(10px); 
        }

        .min-h-screen {
            min-height: 100vh;
        }

    </style>
</head>
<body class="bg-gray-100">
    <div class="relative min-h-screen flex items-center justify-center">
        <div class="absolute inset-0 bg-black opacity-50 z-10"></div>

        <video id="video-background" autoplay muted loop class="absolute top-0 left-0 w-full h-full object-cover z-0 filter blur-lg">
            <source src="../assets/videos/login.mp4" type="video/mp4">
            Tu navegador no soporta la etiqueta de video.
        </video>

        <div class="bg-blue-300 p-4 sm:p-8 rounded-lg shadow-md w-full max-w-md mx-auto relative z-20">
            <div class="flex justify-center items-center">
                <img src="../assets/images/logoLostPaws.png" alt="Logo" class="h-20">
            </div>
            <br>
            <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-sm">
                <h1 class="text-xl font-semibold mb-4 text-center">Ingresar Token</h1>

                <form action="../negocio/procesarToken.php" method="POST">
                    <div class="mb-4">
                        <label for="token" class="block text-sm font-medium text-gray-700">Token</label>
                        <input type="text" name="token" id="token"
                            class="mt-1 p-2 w-full border rounded-md focus:ring focus:ring-blue-300 focus:border-blue-300"
                            required>
                    </div>
                    <div class="flex justify-center">
                        <button type="submit"
                            class="bg-blue-600 text-white w-full p-2 rounded-md hover:bg-blue-700">Ingresar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>