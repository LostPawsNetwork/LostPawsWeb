<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
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
} else {
    http_response_code(405);
    echo "Método no permitido.";
}
?>
