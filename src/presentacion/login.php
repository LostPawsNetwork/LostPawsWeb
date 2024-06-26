<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src='https://www.google.com/recaptcha/api.js'></script>
</head>

<body class="bg-black h-screen font-sans relative overflow-hidden">

    <?php
    session_start();

    header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1.
    header("Pragma: no-cache");
    header("Expires: 0");
    ?>

    <video id="video-background" autoplay muted loop class="absolute top-0 left-0 w-full h-full object-cover z-0 filter blur-lg">
        <source src="../assets/videos/login.mp4" type="video/mp4">
    </video>

    <div class="absolute inset-0 bg-black opacity-50 z-10"></div>

    <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 z-30 w-full px-4">
        <div class="bg-blue-300 p-4 sm:p-8 rounded-lg shadow-md w-full max-w-md mx-auto">
               <div class="flex justify-center items-center">
               <img src="../assets/images/logoLostPaws.png" alt="Logo" class="h-20" />
               </div>
               <br>
                <div class="bg-blue-100 p-6 rounded-lg">
                    <h2 class="text-xl sm:text-2xl font-semibold mb-4 text-gray-800 text-center">Iniciar Sesión</h2>

                <form action="../negocio/procesarLogin.php" method="post" class="space-y-6">
                    <div>
                        <label for="correo" class="block text-sm font-medium text-gray-700">Correo Electronico</label>
                        <input type="email" name="correo" id="correo" required class="mt-1 p-2 w-full border rounded-md focus:ring focus:ring-blue-200 focus:border-blue-300">
                    </div>

                    <div>
                        <label for="passwd" class="block text-sm font-medium text-gray-700">Contraseña</label>
                        <input type="password" name="passwd" id="passwd" required class="mt-1 p-2 w-full border rounded-md focus:ring focus:ring-blue-200 focus:border-blue-300">
                    </div>
                    <div class="items-center">
                        <div class="g-recaptcha mb-4 w-full" data-sitekey="6LfVXgspAAAAAD82ltcbTlmK1rvhUfwR2R1MGCuf"></div>
                    </div>

                    <div class="flex flex-col items-center space-y-4">
                        <button type="submit" class="bg-blue-400 text-white w-full sm:w-40 p-2 rounded-md hover:bg-blue-500">Ingresar</button>
                        <a href="registroUsuario.php" class="text-center bg-teal-500	 text-white w-full sm:w-40 p-2 rounded-md hover:bg-teal-600">Registrarse</a>
                        <a href="recuperarPassword.php" class="text-teal-500 hover:underline">¿Has olvidado tu contraseña?</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
