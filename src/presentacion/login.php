<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src='https://www.google.com/recaptcha/api.js'></script>
</head>

<body class="bg-black h-screen font-sans relative overflow-hidden">

    <video id="video-background" autoplay muted loop class="absolute top-0 left-0 w-full h-full object-cover z-0 filter blur-lg">
        <source src="../assets/videos/login.mp4" type="video/mp4">
    </video>

    <div class="absolute inset-0 bg-black opacity-50 z-10"></div>

    <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 z-30 w-full px-4">
        <div class="bg-blue-300 p-4 sm:p-8 rounded-lg shadow-md w-full max-w-md mx-auto">
               <div class="flex justify-center items-center">
               <img src="../assets/imagenes/logoLostPaws.png" alt="Logo" class="h-20" />
               </div>
               <br>
                <div class="bg-blue-100 p-6 rounded-lg">
                    <h2 class="text-xl sm:text-2xl font-semibold mb-4 text-gray-800 text-center">Iniciar Sesión</h2>

                <form action="../negocio/usuarioNegocio.php" method="post" class="space-y-6">
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">Correo Electronico</label>
                        <input type="text" name="email" id="email" required class="mt-1 p-2 w-full border rounded-md focus:ring focus:ring-blue-200 focus:border-blue-300">
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700">Contraseña</label>
                        <input type="password" name="password" id="password" required class="mt-1 p-2 w-full border rounded-md focus:ring focus:ring-blue-200 focus:border-blue-300">
                    </div>
                    <div class="items-center">
                        <div class="g-recaptcha mb-4 w-full" data-sitekey="6LfVXgspAAAAAD82ltcbTlmK1rvhUfwR2R1MGCuf"></div>
                    </div>

                    <div class="flex flex-col items-center space-y-4">
                        <button type="submit" class="bg-blue-600 text-white w-full sm:w-40 p-2 rounded-md hover:bg-blue-700">Ingresar</button>
                        <a href="register" class="text-center bg-green-600 text-white w-full sm:w-40 p-2 rounded-md hover:bg-green-700">Registrarse</a>
                        <a href="recuperar" class="text-green-600 hover:underline">¿Has olvidado tu contraseña?</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>