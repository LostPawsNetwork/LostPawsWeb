<?php
session_start();
require_once "../datos/control.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (!isset($_POST["idControl"]) || !isset($_POST["nroControl"])) {
        echo "Parámetros inválidos.";
        exit();
    }

    $idControl = $_POST["idControl"];
    $nroControl = $_POST["nroControl"];

    $uploadDir = "../uploads/controles/";

    // Manejo de la foto del can
    $fotoCan = $_FILES["fotoCan"];
    $fotoCanPath = $uploadDir . basename($fotoCan["name"]);
    move_uploaded_file($fotoCan["tmp_name"], $fotoCanPath);

    // Manejo del archivo de vacunas
    $archivoVacunas = $_FILES["archivoVacunas"];
    $archivoVacunasPath = $uploadDir . basename($archivoVacunas["name"]);
    move_uploaded_file($archivoVacunas["tmp_name"], $archivoVacunasPath);

    // Manejo de las fotos del hogar
    $fotosHogar = $_FILES["fotosHogar"];
    $fotoPaths = [];
    for ($i = 0; $i < count($fotosHogar["name"]); $i++) {
        $fotoPath = $uploadDir . basename($fotosHogar["name"][$i]);
        move_uploaded_file($fotosHogar["tmp_name"][$i], $fotoPath);
        $fotoPaths[] = $fotoPath;
    }

    // Inicializa las variables de las fotos del hogar
    $foto2Path = $fotoPaths[0] ?? null;
    $foto3Path = $fotoPaths[1] ?? null;
    $foto4Path = $fotoPaths[2] ?? null;

    // Llama a la función para rellenar el control
    $control = new Control();
    $resultado = $control->rellenarControl(
        $idControl,
        $fotoCanPath,
        $archivoVacunasPath,
        $foto2Path,
        $foto3Path,
        $foto4Path
    );

    if ($resultado) {
        header("Location: ../presentacion/misControles.php");
        exit();
    } else {
        echo "Hubo un problema al procesar el control. Por favor, intenta nuevamente.";
    }
} else {
    echo "Método de solicitud no permitido.";
    exit();
}
?>
