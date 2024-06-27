<?php
require_once "../config/neon.php";
require_once "../datos/usuario.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $correo = $_POST["correo"];
    $usuario = new Usuario();

    // Verificar si el correo está registrado
    $resultado = $usuario->obtenerUsuario($correo);

    if (empty($resultado)) {
        // Redirigir con un mensaje de error si el correo no está registrado
        header(
            "Location: enviarCodigoRecuperacion.php?error=correo_no_registrado"
        );
        exit();
    }

    $command = escapeshellcmd("python3 ../utils/correo.py $correo");
    $output = shell_exec($command . " 2>&1");

    if ($output !== null) {
        $codigoEnviado =
            strpos($output, "Correo enviado exitosamente") !== false;
    } else {
        $codigoEnviado = false;
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enviar Código de Recuperación</title>
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
                <h2 class="text-xl sm:text-2xl font-semibold mb-4 text-bluey-dark text-center">Enviar Código de Recuperación</h2>
                <?php if (isset($codigoEnviado) && $codigoEnviado): ?>
                    <p class="text-teal-500">El código de recuperación ha sido enviado a tu correo electrónico.</p>
                    <form action="validarCodigo.php" method="post" class="space-y-4">
                        <div>
                            <label for="codigo" class="block text-sm font-medium text-bluey-dark">Ingresa el Código de Recuperación</label>
                            <input type="text" name="codigo" id="codigo" required class="mt-1 p-2 w-full border rounded-md focus:ring focus:ring-bluey-medium focus:border-bluey-dark">
                            <input type="hidden" name="correo" value="<?php echo htmlspecialchars(
                                $correo,
                                ENT_QUOTES,
                                "UTF-8"
                            ); ?>">
                        </div>
                        <div class="flex flex-col items-center space-y-4">
                            <button type="submit" class="bg-bluey-medium text-white w-full sm:w-40 p-2 rounded-md hover:bg-bluey-dark">Validar Código</button>
                            <a href="recuperarPassword.php" class="text-center bg-bluey-dark text-white w-full sm:w-40 p-2 rounded-md hover-lighten">Volver</a>
                        </div>
                    </form>
                <?php elseif (isset($codigoEnviado)): ?>
                    <p class="text-red-600">Hubo un error al enviar el correo. Por favor, inténtalo de nuevo.</p>
                    <?php if ($output !== null): ?>
                        <pre><?php echo htmlspecialchars(
                            $output,
                            ENT_QUOTES,
                            "UTF-8"
                        ); ?></pre>
                    <?php endif; ?>
                <?php endif; ?>
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
