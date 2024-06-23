<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true 
|| ($_SESSION['tipoUsuario'] !== 'admin' && $_SESSION['tipoUsuario'] !== 'superadmin'))
{
    header("Location: /lostpaws/presentacion/login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Perro</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f3f4f6; 
            font-family: 'sans-serif';
        }

        #video-background {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            z-index: -1;
            filter: blur(10px); 
        }

        .container {
            position: relative;
            z-index: 1; 
            max-width: 768px; 
            margin: 0 auto;
            padding: 2rem;
        }

        .bg-white {
            background-color: rgba(255, 255, 255, 0.9); 
            backdrop-filter: blur(5px); 
            border-radius: 0.5rem;
            padding: 1.5rem;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); 
        }
    </style>
</head>
<body class="bg-gray-100 h-screen font-sans">
<video id="video-background" autoplay muted loop class="absolute top-0 left-0 w-full h-full object-cover z-0 filter blur-lg">
        <source src="../assets/videos/login.mp4" type="video/mp4">
        Your browser does not support the video tag.
    </video>
    <div class="container mx-auto p-4">
        <?php if (!empty($error)): ?>
            <div class="bg-red-500 text-white p-4 mb-4 rounded"><?php echo $error; ?></div>
        <?php endif; ?>
        <form action="../negocio/registraPerro.php" method="post" enctype="multipart/form-data" class="bg-white p-6 rounded-lg shadow-md space-y-4">
        <h1 class="text-2xl font-bold mb-4">Agregar Nuevo Perro</h1>
        <div>
                <label for="nombre" class="block text-sm font-medium text-gray-700">Nombre</label>
                <input type="text" name="nombre" id="nombre" required class="mt-1 p-2 w-full border rounded-md focus:ring focus:ring-blue-200 focus:border-blue-300">
            </div>
            <div>
                <label for="raza" class="block text-sm font-medium text-gray-700">Raza</label>
                <input type="text" name="raza" id="raza" required class="mt-1 p-2 w-full border rounded-md focus:ring focus:ring-blue-200 focus:border-blue-300">
            </div>
            <div>
                <label for="edad" class="block text-sm font-medium text-gray-700">Edad</label>
                <input type="number" name="edad" id="edad" required class="mt-1 p-2 w-full border rounded-md focus:ring focus:ring-blue-200 focus:border-blue-300">
            </div>
            <div>
                <label for="tamano" class="block text-sm font-medium text-gray-700">Tamaño</label>
                <input type="text" name="tamano" id="tamano" required class="mt-1 p-2 w-full border rounded-md focus:ring focus:ring-blue-200 focus:border-blue-300">
            </div>
            <div>
                <label for="genero" class="block text-sm font-medium text-gray-700">Género</label>
                <input type="text" name="genero" id="genero" required class="mt-1 p-2 w-full border rounded-md focus:ring focus:ring-blue-200 focus:border-blue-300">
            </div>
            <div>
                <label for="observacionesMedicas" class="block text-sm font-medium text-gray-700">Observaciones Médicas</label>
                <textarea name="observacionesMedicas" id="observacionesMedicas" class="mt-1 p-2 w-full border rounded-md focus:ring focus:ring-blue-200 focus:border-blue-300"></textarea>
            </div>
            <div>
                <label for="descripcion" class="block text-sm font-medium text-gray-700">Descripción</label>
                <textarea name="descripcion" id="descripcion" class="mt-1 p-2 w-full border rounded-md focus:ring focus:ring-blue-200 focus:border-blue-300"></textarea>
            </div>
            <div>
                <label for="estado" class="block text-sm font-medium text-gray-700">Estado</label>
                <input type="text" name="estado" id="estado" required class="mt-1 p-2 w-full border rounded-md focus:ring focus:ring-blue-200 focus:border-blue-300">
            </div>
            <div>
                <label for="foto1" class="block text-sm font-medium text-gray-700">Foto 1 (Subir)</label>
                <input type="file" name="foto1" id="foto1" required class="mt-1 p-2 w-full border rounded-md focus:ring focus:ring-blue-200 focus:border-blue-300">
            </div>
            <div class="flex justify-end">
                <button type="submit" class="bg-green-500 text-white p-2 rounded-md hover:bg-green-600">Guardar</button>
            </div>
        </form>
    </div>

</body>
</html>
