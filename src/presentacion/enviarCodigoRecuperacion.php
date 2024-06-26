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
        header("Location: recuperarPassword.php?error=correo_no_registrado");
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
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100 h-screen font-sans">
    <div class="container mx-auto p-4">
        <div class="bg-white p-6 rounded-lg shadow-md space-y-4">
            <h1 class="text-2xl font-bold mb-4">Enviar Código de Recuperación</h1>
            <?php if (isset($codigoEnviado) && $codigoEnviado): ?>
                <p class="text-green-600">El código de recuperación ha sido enviado a tu correo electrónico.</p>
                <form action="validarCodigo.php" method="post" class="space-y-4">
                    <div>
                        <label for="codigo" class="block text-sm font-medium text-gray-700">Ingresa el Código de Recuperación</label>
                        <input type="text" name="codigo" id="codigo" required class="mt-1 p-2 w-full border rounded-md focus:ring focus:ring-blue-200 focus:border-blue-300">
                        <input type="hidden" name="correo" value="<?php echo htmlspecialchars(
                            $correo,
                            ENT_QUOTES,
                            "UTF-8"
                        ); ?>">
                    </div>
                    <div class="flex justify-end">
                        <button type="submit" class="bg-blue-600 text-white p-2 rounded-md hover:bg-blue-700">Validar Código</button>
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
            <a href="recuperarPassword.php" class="text-blue-600 hover:underline">Volver</a>
        </div>
    </div>
</body>

</html>
