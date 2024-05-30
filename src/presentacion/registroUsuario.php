<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Usuario</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
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
                <h2 class="text-xl sm:text-2xl font-semibold mb-4 text-gray-800 text-center">Registrar Usuario</h2>

                <form action="../negocio/procesarRegistro.php" method="post" class="space-y-6">
                    <div>
                        <label for="nombre" class="block text-sm font-medium text-gray-700">Nombre</label>
                        <input type="text" name="nombre" id="nombre" required class="mt-1 p-2 w-full border rounded-md focus:ring focus:ring-blue-200 focus:border-blue-300">
                    </div>
                    <div>
                        <label for="apellido" class="block text-sm font-medium text-gray-700">Apellido</label>
                        <input type="text" name="apellido" id="apellido" required class="mt-1 p-2 w-full border rounded-md focus:ring focus:ring-blue-200 focus:border-blue-300">
                    </div>
                    <div>
                        <label for="tipoDocumento" class="block text-sm font-medium text-gray-700">Tipo de Documento</label>
                        <select name="tipoDocumento" id="tipoDocumento" required class="mt-1 p-2 w-full border rounded-md focus:ring focus:ring-blue-200 focus:border-blue-300">
                            <option value="dni">DNI</option>
                            <option value="cedula de identidad">Cedula de Identidad</option>
                            <option value="pasaporte">Pasaporte</option>
                        </select>
                    </div>
                    <div>
                        <label for="dni" class="block text-sm font-medium text-gray-700">Número de Documento</label>
                        <input type="text" name="dni" id="dni" required class="mt-1 p-2 w-full border rounded-md focus:ring focus:ring-blue-200 focus:border-blue-300">
                    </div>
                    <div>
                        <label for="fechaNacimiento" class="block text-sm font-medium text-gray-700">Fecha de Nacimiento</label>
                        <input type="date" name="fechaNacimiento" id="fechaNacimiento" required class="mt-1 p-2 w-full border rounded-md focus:ring focus:ring-blue-200 focus:border-blue-300">
                    </div>
                    <div>
                        <label for="correo" class="block text-sm font-medium text-gray-700">Correo Electrónico</label>
                        <input type="email" name="correo" id="correo" required class="mt-1 p-2 w-full border rounded-md focus:ring focus:ring-blue-200 focus:border-blue-300">
                    </div>
                    <div>
                        <label for="passwd" class="block text-sm font-medium text-gray-700">Contraseña</label>
                        <input type="password" name="passwd" id="passwd" required class="mt-1 p-2 w-full border rounded-md focus:ring focus:ring-blue-200 focus:border-blue-300">
                    </div>
                    <div>
                        <label for="confirmPassword" class="block text-sm font-medium text-gray-700">Confirmar Contraseña</label>
                        <input type="password" name="confirmPassword" id="confirmPassword" required class="mt-1 p-2 w-full border rounded-md focus:ring focus:ring-blue-200 focus:border-blue-300">
                    </div>

                    <div class="flex flex-col items-center space-y-4">
                        <button type="submit" class="bg-blue-600 text-white w-full sm:w-40 p-2 rounded-md hover:bg-blue-700">Registrar</button>
                        <a href="login.php" class="text-center bg-green-600 text-white w-full sm:w-40 p-2 rounded-md hover:bg-green-700">Iniciar Sesión</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>