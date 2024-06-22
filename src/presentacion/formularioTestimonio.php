<?php
session_start();

if (
    !isset($_SESSION["loggedin"]) ||
    $_SESSION["loggedin"] !== true ||
    ($_SESSION["tipoUsuario"] !== "admin" &&
        $_SESSION["tipoUsuario"] !== "superadmin")
) {
    header("Location: /lostpaws/presentacion/login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Testimonio</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="container mx-auto p-4">
        <h1 class="text-3xl font-bold mb-6">Agregar Testimonio</h1>
        <form action="../negocio/agregarTestimonio.php" method="POST" enctype="multipart/form-data">
            <div class="mb-4">
                <label for="fecha" class="block text-sm font-medium text-gray-700">Fecha</label>
                <input type="date" name="fecha" id="fecha" class="mt-1 p-2 w-full border rounded-md" required>
            </div>
            <div class="mb-4">
                <label for="texto" class="block text-sm font-medium text-gray-700">Texto</label>
                <textarea name="texto" id="texto" class="mt-1 p-2 w-full border rounded-md" required></textarea>
            </div>
            <div class="mb-4">
                <label for="idUsuario" class="block text-sm font-medium text-gray-700">ID Usuario</label>
                <input type="number" name="idUsuario" id="idUsuario" class="mt-1 p-2 w-full border rounded-md" required>
            </div>
            <div class="mb-4">
                <label for="foto" class="block text-sm font-medium text-gray-700">Foto</label>
                <input type="file" name="foto" id="foto" class="mt-1 p-2 w-full border rounded-md" required>
            </div>
            <div class="flex justify-between">
                <button type="submit" class="bg-green-500 text-white p-2 rounded-md hover:bg-green-600">Agregar</button>
                <a href="gestionarTestimonios.php" class="bg-gray-500 text-white p-2 rounded-md hover:bg-gray-600">Cancelar</a>
            </div>
        </form>
    </div>
</body>
</html>
