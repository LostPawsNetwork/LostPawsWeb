<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $correo = $_POST["correo"];
    $nuevaContrasena = $_POST["nuevaContrasena"];
    $repetirContrasena = $_POST["repetirContrasena"];

    if ($nuevaContrasena === $repetirContrasena) {
        $hashedContrasena = password_hash($nuevaContrasena, PASSWORD_BCRYPT);

        // Conectar a la base de datos y actualizar la contraseña
        require_once "../config/neon.php"; // Asegúrate de tener tu archivo de configuración de la base de datos aquí

        $conn = getPDOConnection();
        $stmt = $conn->prepare(
            "UPDATE usuario SET contrasena = :hashedContrasena WHERE email = :correo"
        );
        $stmt->bindParam(":hashedContrasena", $hashedContrasena);
        $stmt->bindParam(":correo", $correo);
        $stmt->execute();

        echo "Contraseña actualizada exitosamente. <a href='login.php'>Iniciar sesión</a>";
        exit();
    } else {
        $error = "Las contraseñas no coinciden.";
    }
}

$correo = isset($_GET["correo"])
    ? htmlspecialchars($_GET["correo"], ENT_QUOTES, "UTF-8")
    : "";
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restablecer Contraseña</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100 h-screen font-sans">

    <div class="container mx-auto p-4">
        <div class="bg-white p-6 rounded-lg shadow-md space-y-4">
            <h1 class="text-2xl font-bold mb-4">Restablecer Contraseña</h1>
            <?php if (isset($error)): ?>
                <p class="text-red-600"><?php echo htmlspecialchars(
                    $error,
                    ENT_QUOTES,
                    "UTF-8"
                ); ?></p>
            <?php endif; ?>
            <form action="restablecerPassword.php" method="post" class="space-y-4">
                <div>
                    <label for="nuevaContrasena" class="block text-sm font-medium text-gray-700">Nueva Contraseña</label>
                    <input type="password" name="nuevaContrasena" id="nuevaContrasena" required class="mt-1 p-2 w-full border rounded-md focus:ring focus:ring-blue-200 focus:border-blue-300">
                </div>
                <div>
                    <label for="repetirContrasena" class="block text-sm font-medium text-gray-700">Repetir Contraseña</label>
                    <input type="password" name="repetirContrasena" id="repetirContrasena" required class="mt-1 p-2 w-full border rounded-md focus:ring focus:ring-blue-200 focus:border-blue-300">
                </div>
                <input type="hidden" name="correo" value="<?php echo $correo; ?>">
                <div class="flex justify-end">
                    <button type="submit" class="bg-blue-600 text-white p-2 rounded-md hover:bg-blue-700">Restablecer Contraseña</button>
                </div>
            </form>
        </div>
    </div>

</body>

</html>
