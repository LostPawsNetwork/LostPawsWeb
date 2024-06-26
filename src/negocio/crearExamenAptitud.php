<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_SESSION["idUsuario"])) {
        $estado = "Pendiente";
        $idUsuario = $_SESSION["idUsuario"];
        require_once "../datos/examenAptitud.php";

        $examenAptitud = new ExamenAptitud();
        $result = $examenAptitud->registrarExamenAptitud($estado, $idUsuario);

        if ($result) {
            header("Location: ../presentacion/landingPage.php");
        } else {
            echo "Error al crear el examen de aptitud.";
        }
    } else {
        echo "Usuario no autenticado.";
    }
} else {
    http_response_code(405);
    echo "Método no permitido.";
}
?>