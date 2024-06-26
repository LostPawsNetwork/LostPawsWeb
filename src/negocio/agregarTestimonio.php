<?php
require_once "../datos/testimonio.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fecha = $_POST["fecha"];
    $texto = $_POST["texto"];
    $idUsuario = $_POST["idUsuario"];
    $foto = $_FILES["foto"];

    $target_dir = "../uploads/testimonios/";
    $target_file = $target_dir . basename($foto["name"]);
    move_uploaded_file($foto["tmp_name"], $target_file);

    $testimonio = new Testimonio();
    $result = $testimonio->registrarTestimonio(
        $fecha,
        $texto,
        $idUsuario,
        $target_file
    );

    if ($result) {
        header("Location: ../presentacion/gestionarTestimonios.php");
        exit();
    } else {
        echo "Error al agregar el testimonio.";
    }
}
?>
