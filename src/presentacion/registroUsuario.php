<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Usuario</title>
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

        .form-container {
            max-height: calc(100vh - 10rem);
            overflow-y: auto;
        }
    </style>
    <script>
        function validarFormulario() {
            var passwd = document.getElementById('passwd').value;
            var confirmPassword = document.getElementById('confirmPassword').value;

            if (passwd !== confirmPassword) {
                alert('Las contraseñas no coinciden.');
                return false;
            }
            return true;
        }
    </script>
</head>

<body class="bg-bluey-dark h-screen font-sans relative overflow-hidden">

    <video id="video-background" autoplay muted loop class="absolute top-0 left-0 w-full h-full object-cover z-0 filter blur-lg">
        <source src="../assets/videos/login.mp4" type="video/mp4">
    </video>

    <div class="absolute inset-0 bg-black opacity-50 z-10"></div>

    <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 z-30 w-full px-4">
        <div class="bg-bluey-dark p-4 sm:p-8 rounded-lg shadow-md w-full max-w-md mx-auto form-container">
            <div class="flex justify-center items-center bg-bluey-light p-4 rounded-lg">
                <img src="../assets/images/logoLostPaws.png" alt="Logo" class="h-20" />
            </div>
            <br>
            <div class="bg-bluey-light p-6 rounded-lg">
                <h2 class="text-xl sm:text-2xl font-semibold mb-4 text-bluey-dark text-center">Registrar Usuario</h2>

                <form action="../negocio/procesarRegistro.php" method="post" class="space-y-6" onsubmit="return validarFormulario()">
                    <div>
                        <label for="nombre" class="block text-sm font-medium text-bluey-dark">Nombre</label>
                        <input type="text" name="nombre" id="nombre" required class="mt-1 p-2 w-full border rounded-md focus:ring focus:ring-bluey-medium focus:border-bluey-dark">
                    </div>
                    <div>
                        <label for="apellido" class="block text-sm font-medium text-bluey-dark">Apellido</label>
                        <input type="text" name="apellido" id="apellido" required class="mt-1 p-2 w-full border rounded-md focus:ring focus:ring-bluey-medium focus:border-bluey-dark">
                    </div>
                    <div>
                        <label for="tipoDocumento" class="block text-sm font-medium text-bluey-dark">Tipo de Documento</label>
                        <select name="tipoDocumento" id="tipoDocumento" required class="mt-1 p-2 w-full border rounded-md focus:ring focus:ring-bluey-medium focus:border-bluey-dark">
                            <option value="dni">DNI</option>
                            <option value="cedula de identidad">Cédula de Identidad</option>
                            <option value="pasaporte">Pasaporte</option>
                        </select>
                    </div>
                    <div>
                        <label for="dni" class="block text-sm font-medium text-bluey-dark">Número de Documento</label>
                        <input type="text" name="dni" id="dni" required class="mt-1 p-2 w-full border rounded-md focus:ring focus:ring-bluey-medium focus:border-bluey-dark">
                    </div>
                    <div>
                        <label for="fechaNacimiento" class="block text-sm font-medium text-bluey-dark">Fecha de Nacimiento</label>
                        <input type="date" name="fechaNacimiento" id="fechaNacimiento" required class="mt-1 p-2 w-full border rounded-md focus:ring focus:ring-bluey-medium focus:border-bluey-dark">
                    </div>
                    <div>
                        <label for="correo" class="block text-sm font-medium text-bluey-dark">Correo Electrónico</label>
                        <input type="email" name="correo" id="correo" required class="mt-1 p-2 w-full border rounded-md focus:ring focus:ring-bluey-medium focus:border-bluey-dark">
                    </div>
                    <div>
                        <label for="passwd" class="block text-sm font-medium text-bluey-dark">Contraseña</label>
                        <input type="password" name="passwd" id="passwd" required class="mt-1 p-2 w-full border rounded-md focus:ring focus:ring-bluey-medium focus:border-bluey-dark">
                    </div>
                    <div>
                        <label for="confirmPassword" class="block text-sm font-medium text-bluey-dark">Confirmar Contraseña</label>
                        <input type="password" name="confirmPassword" id="confirmPassword" required class="mt-1 p-2 w-full border rounded-md focus:ring focus:ring-bluey-medium focus:border-bluey-dark">
                    </div>

                    <div class="flex flex-col items-center space-y-4">
                        <button type="submit" class="bg-bluey-medium text-white w-full sm:w-40 p-2 rounded-md hover:bg-bluey-dark">Registrar</button>
                        <a href="login.php" class="text-center bg-bluey-dark text-white w-full sm:w-40 p-2 rounded-md hover-lighten">Volver</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
