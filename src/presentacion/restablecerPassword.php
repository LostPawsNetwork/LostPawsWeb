<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $correo = $_POST["correo"];
    $nuevaContrasena = $_POST["nuevaContrasena"];
    $repetirContrasena = $_POST["repetirContrasena"];

    if ($nuevaContrasena === $repetirContrasena) {
        $hashedContrasena = password_hash($nuevaContrasena, PASSWORD_BCRYPT);

        require_once "../config/neon.php";
        $conn = getPDOConnection();
        $stmt = $conn->prepare(
            "UPDATE usuario SET contrasena = :hashedContrasena WHERE email = :correo"
        );
        $stmt->bindParam(":hashedContrasena", $hashedContrasena);
        $stmt->bindParam(":correo", $correo);
        $stmt->execute();

        echo "<script>
                alert('Contraseña actualizada exitosamente.');
                window.location.href = 'login.php';
              </script>";
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
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-black h-screen font-sans relative overflow-hidden">
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
                <h2 class="text-xl sm:text-2xl font-semibold mb-4 text-gray-800 text-center">Restablecer Contraseña</h2>
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
                    <div class="flex justify-center">
                        <button type="submit" class="bg-blue-400 text-white w-full sm:w-60 h-12 p-2 rounded-md hover:bg-blue-500">Restablecer Contraseña</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
