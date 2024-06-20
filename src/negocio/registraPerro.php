<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true 
|| ($_SESSION['tipoUsuario'] !== 'admin' && $_SESSION['tipoUsuario'] !== 'superadmin'))
{
    header("Location: /lostpaws/presentacion/login.php");
    exit;
}

ob_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once "../datos/can.php";

    $nombre = $_POST["nombre"];
    $raza = $_POST["raza"];
    $edad = $_POST["edad"];
    $tamano = $_POST["tamano"];
    $genero = $_POST["genero"];
    $observacionesMedicas = $_POST["observacionesMedicas"];
    $descripcion = $_POST["descripcion"];
    $estado = $_POST["estado"];

    // Manejar la subida de la imagen
    $target_dir = "../assets/images/canes/";
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
            $foto1 = $target_file;
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
            $observacionesMedicas,
            $descripcion,
            $foto1,
            null,
            null,
            $estado
        );
        header("Location: ../presentacion/dashboard.php");
        exit();
    }
}

ob_end_flush();

?>