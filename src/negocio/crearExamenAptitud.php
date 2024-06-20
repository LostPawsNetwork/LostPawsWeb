<?php
session_start();

if (isset($_SESSION["idUsuario"])) {
    $estado = "pendiente";
    $idUsuario = $_SESSION["idUsuario"];
    require_once "../datos/examenAptitud.php";

    $examenAptitud = new ExamenAptitud();
    $result = $examenAptitud->registrarExamenAptitud($estado, $idUsuario);

    if ($result) {
        echo "Examen de aptitud creado exitosamente.";
    } else {
        echo "Error al crear el examen de aptitud.";
    }
} else {
    echo "Usuario no autenticado.";
}
?>
