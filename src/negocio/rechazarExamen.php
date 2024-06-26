<?php
session_start();
require_once "../config/neon.php";
require_once "../datos/examenAptitud.php";
require_once "../datos/usuario.php"; // Asegúrate de importar la clase Usuario

if (isset($_POST["idexamen"])) {
    $idexamen = $_POST["idexamen"];
    $examenAptitud = new ExamenAptitud();

    // Obtener el ID del usuario relacionado con el examen
    $idUsuario = $examenAptitud->obtenerIdUsuarioPorExamen($idexamen);

    if ($idUsuario !== null) {
        // Rechazar el examen
        $examenAptitud->rechazarExamenAptitud($idexamen);

        // Obtener el correo electrónico del usuario
        $usuario = new Usuario();
        $correoUsuario = $usuario->obtenerCorreoPorId($idUsuario);

        if ($correoUsuario !== null) {
            // Llamar al script de Python para enviar el correo
            $command = escapeshellcmd("python3 ../utils/examenRechazado.py $correoUsuario");
            shell_exec($command);
        }

        header("Location: ../presentacion/gestionarExamenes.php");
    } else {
        echo "ERROR: No se pudo obtener el ID del usuario.";
    }
}
?>
