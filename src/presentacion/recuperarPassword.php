<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar Contraseña</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .bg-bluey-light {
            background-color: #d4eaf7;
        }

        .bg-bluey-medium {
            background-color: #80c4f4;
        }

        .bg-bluey-dark {
            background-color: #4a4e78;
        }

        .hover-lighten:hover {
            filter: brightness(1.1);
        }

        .text-bluey-dark {
            color: #4a4e78;
        }
    </style>
</head>

<body class="bg-bluey-dark h-screen font-sans relative overflow-hidden">
    <video id="video-background" autoplay muted loop class="absolute top-0 left-0 w-full h-full object-cover z-0 filter blur-lg">
        <source src="../assets/videos/login.mp4" type="video/mp4">
    </video>

    <div class="absolute inset-0 bg-black opacity-50 z-10"></div>

    <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 z-30 w-full px-4">
        <div class="bg-bluey-dark p-4 sm:p-8 rounded-lg shadow-md w-full max-w-md mx-auto">
            <div class="flex justify-center items-center bg-bluey-light p-4 rounded-lg">
                <img src="../assets/images/logoLostPaws.png" alt="Logo" class="h-20" />
            </div>
            <br>
            <div class="bg-bluey-light p-6 rounded-lg">
                <h2 class="text-xl sm:text-2xl font-semibold mb-4 text-bluey-dark text-center">Recuperar Contraseña</h2>
                <form action="enviarCodigoRecuperacion.php" method="post" class="space-y-6">
                    <div>
                        <label for="correo" class="block text-sm font-medium text-bluey-dark">Correo Electrónico</label>
                        <input type="email" name="correo" id="correo" required class="mt-1 p-2 w-full border rounded-md focus:ring focus:ring-bluey-medium focus:border-bluey-dark">
                    </div>
                    <div class="flex flex-col items-center space-y-4">
                        <button type="submit" class="bg-bluey-medium text-white w-full sm:w-40 p-2 rounded-md hover:bg-bluey-dark">Enviar Código</button>
                        <a href="/lostpaws/presentacion/login.php" class="text-center bg-bluey-dark text-white w-full sm:w-40 p-2 rounded-md hover-lighten">Volver</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        <?php if (
            isset($_GET["error"]) &&
            $_GET["error"] == "correo_no_registrado"
        ): ?>
        alert('El correo electrónico no está registrado.');
        window.location.href = 'recuperarPassword.php';
        <?php endif; ?>
    </script>
</body>

</html>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar Contraseña</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .bg-bluey-light {
            background-color: #d4eaf7; /* Color del primer bloque */
        }

        .bg-bluey-medium {
            background-color: #80c4f4; /* Color del segundo bloque */
        }

        .bg-bluey-dark {
            background-color: #4a4e78; /* Color del tercer bloque */
        }

        .hover-lighten:hover {
            filter: brightness(1.1); /* Aclara el elemento un 10% */
        }

        .text-bluey-dark {
            color: #4a4e78;
        }
    </style>
</head>

<body class="bg-bluey-dark h-screen font-sans relative overflow-hidden">
    <video id="video-background" autoplay muted loop class="absolute top-0 left-0 w-full h-full object-cover z-0 filter blur-lg">
        <source src="../assets/videos/login.mp4" type="video/mp4">
    </video>

    <div class="absolute inset-0 bg-black opacity-50 z-10"></div>

    <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 z-30 w-full px-4">
        <div class="bg-bluey-dark p-4 sm:p-8 rounded-lg shadow-md w-full max-w-md mx-auto">
            <div class="flex justify-center items-center bg-bluey-light p-4 rounded-lg">
                <img src="../assets/images/logoLostPaws.png" alt="Logo" class="h-20" />
            </div>
            <br>
            <div class="bg-bluey-light p-6 rounded-lg">
                <h2 class="text-xl sm:text-2xl font-semibold mb-4 text-bluey-dark text-center">Recuperar Contraseña</h2>
                <form action="enviarCodigoRecuperacion.php" method="post" class="space-y-6">
                    <div>
                        <label for="correo" class="block text-sm font-medium text-bluey-dark">Correo Electrónico</label>
                        <input type="email" name="correo" id="correo" required class="mt-1 p-2 w-full border rounded-md focus:ring focus:ring-bluey-medium focus:border-bluey-dark">
                    </div>
                    <div class="flex flex-col items-center space-y-4">
                        <button type="submit" class="bg-bluey-medium text-white w-full sm:w-40 p-2 rounded-md hover:bg-bluey-dark">Enviar Código</button>
                        <a href="/lostpaws/presentacion/login.php" class="text-center bg-bluey-dark text-white w-full sm:w-40 p-2 rounded-md hover-lighten">Volver</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        <?php if (
            isset($_GET["error"]) &&
            $_GET["error"] == "correo_no_registrado"
        ): ?>
        alert('El correo electrónico no está registrado.');
        window.location.href = 'recuperarPassword.php';
        <?php endif; ?>
    </script>
</body>

</html>
