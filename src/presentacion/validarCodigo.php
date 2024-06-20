<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $correo = $_POST["correo"];
    $codigo = $_POST["codigo"];

    require_once "../config/neon.php";

    $conn = getPDOConnection();
    $stmt = $conn->prepare(
        "SELECT * FROM usuario WHERE email = :correo AND codigo = :codigo"
    );
    $stmt->bindParam(":correo", $correo);
    $stmt->bindParam(":codigo", $codigo);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        header(
            "Location: restablecerPassword.php?correo=" . urlencode($correo)
        );
        exit();
    } else {
        $error = "El código de recuperación es incorrecto.";
    }
} ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Validar Código de Recuperación</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100 h-screen font-sans">

    <div class="container mx-auto p-4">
        <div class="bg-white p-6 rounded-lg shadow-md space-y-4">
            <h1 class="text-2xl font-bold mb-4">Validar Código de Recuperación</h1>
            <?php if (isset($error)): ?>
                <p class="text-red-600"><?php echo htmlspecialchars(
                    $error,
                    ENT_QUOTES,
                    "UTF-8"
                ); ?></p>
            <?php endif; ?>
            <a href="recuperarPassword.php" class="text-blue-600 hover:underline">Volver</a>
        </div>
    </div>

</body>

</html>
