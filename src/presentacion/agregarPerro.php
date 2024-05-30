<?php
session_start();

if (!isset($_SESSION["correo"])) {
    header("Location: login.php");
    exit();
}

ob_start(); // Iniciar el almacenamiento en búfer de salida

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once "../datos/can.php";

    $nombre = $_POST["nombre"];
    $raza = $_POST["raza"];
    $edad = $_POST["edad"];
    $tamano = $_POST["tamano"];
    $genero = $_POST["genero"];
    $observacionesmedicas = $_POST["observacionesmedicas"];
    $descripcion = $_POST["descripcion"];

    // Manejar la subida de la imagen
    $target_dir = "../assets/imagenes/perros/";
    $target_file = $target_dir . basename($_FILES["foto1"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $error = "";

    // Comprobar si el archivo es una imagen real
    $check = getimagesize($_FILES["foto1"]["tmp_name"]);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        $error = "El archivo no es una imagen.";
        $uploadOk = 0;
    }

    // Comprobar si el archivo ya existe
    if (file_exists($target_file)) {
        $error = "Lo siento, el archivo ya existe.";
        $uploadOk = 0;
    }

    // Comprobar el tamaño del archivo
    if ($_FILES["foto1"]["size"] > 500000) {
        $error = "Lo siento, tu archivo es demasiado grande.";
        $uploadOk = 0;
    }

    // Permitir ciertos formatos de archivo
    if (
        $imageFileType != "jpg" &&
        $imageFileType != "png" &&
        $imageFileType != "jpeg" &&
        $imageFileType != "gif"
    ) {
        $error = "Lo siento, solo se permiten archivos JPG, JPEG, PNG y GIF.";
        $uploadOk = 0;
    }

    // Comprobar si $uploadOk está establecido en 0 por un error
    if ($uploadOk == 0) {
        $error = "Lo siento, tu archivo no fue subido.";
    } else {
        if (move_uploaded_file($_FILES["foto1"]["tmp_name"], $target_file)) {
            $foto1 = $target_file; // Guardar la ruta del archivo subido
        } else {
            $error = "Lo siento, hubo un error al subir tu archivo.";
        }
    }

    if ($uploadOk == 1) {
        $can = new Can();
        $can->registrarCan(
            $nombre,
            $raza,
            $edad,
            $tamano,
            $genero,
            $observacionesmedicas,
            $descripcion,
            $foto1,
            null,
            null
        );
        header("Location: dashboard.php");
        exit();
    }
}

ob_end_flush();

// Finalizar el almacenamiento en búfer de salida y enviar la salida
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Perro</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 h-screen font-sans">

    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Agregar Nuevo Perro</h1>
        <?php if (!empty($error)): ?>
            <div class="bg-red-500 text-white p-4 mb-4 rounded"><?php echo $error; ?></div>
        <?php endif; ?>
        <form action="agregarPerro.php" method="post" enctype="multipart/form-data" class="bg-white p-6 rounded-lg shadow-md space-y-4">
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
                <label for="observacionesmedicas" class="block text-sm font-medium text-gray-700">Observaciones Médicas</label>
                <textarea name="observacionesmedicas" id="observacionesmedicas" class="mt-1 p-2 w-full border rounded-md focus:ring focus:ring-blue-200 focus:border-blue-300"></textarea>
            </div>
            <div>
                <label for="descripcion" class="block text-sm font-medium text-gray-700">Descripción</label>
                <textarea name="descripcion" id="descripcion" class="mt-1 p-2 w-full border rounded-md focus:ring focus:ring-blue-200 focus:border-blue-300"></textarea>
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
