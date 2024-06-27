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
    <div id="header">
        <?php include "../components/header3.html"; ?>
    </div>
    <br><br><br><br>
    <br>
    <div class="container mx-auto p-4 bg-bluey-light rounded-lg shadow-md overflow-y-auto" style="max-height: 90vh;">
        <h1 class="text-3xl font-bold mb-6 text-bluey-dark">Agregar Testimonio</h1>
        <form action="../negocio/agregarTestimonio.php" method="POST" enctype="multipart/form-data" class="space-y-4">
            <div>
                <label for="fecha" class="block text-sm font-medium text-bluey-dark">Fecha</label>
                <input type="date" name="fecha" id="fecha" class="mt-1 p-2 w-full border rounded-md focus:ring focus:ring-bluey-medium focus:border-bluey-dark" required>
            </div>
            <div>
                <label for="texto" class="block text-sm font-medium text-bluey-dark">Texto</label>
                <textarea name="texto" id="texto" class="mt-1 p-2 w-full border rounded-md focus:ring focus:ring-bluey-medium focus:border-bluey-dark" required></textarea>
            </div>
            <div>
                <label for="idUsuario" class="block text-sm font-medium text-bluey-dark">ID Usuario</label>
                <input type="number" name="idUsuario" id="idUsuario" class="mt-1 p-2 w-full border rounded-md focus:ring focus:ring-bluey-medium focus:border-bluey-dark" required>
            </div>
            <div>
                <label for="foto" class="block text-sm font-medium text-bluey-dark">Foto</label>
                <input type="file" name="foto" id="foto" class="mt-1 p-2 w-full border rounded-md focus:ring focus:ring-bluey-medium focus:border-bluey-dark" required>
            </div>
            <div class="flex justify-end space-x-2">
                <button type="submit" class="bg-blue-400 hover:bg-blue-500 text-white p-2 rounded-md ">Agregar</button>
                <a href="gestionarTestimonios.php" class="bg-bluey-dark hover:bg-bluey-medium text-white p-2 rounded-md">Volver</a>
            </div>
        </form>
    </div>
    <?php include "../components/footer.html"; ?>
</body>
</html>
