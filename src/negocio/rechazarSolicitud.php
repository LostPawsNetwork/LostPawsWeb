<?php
session_start();
require_once "../config/neon.php";
require_once "../datos/solicitud.php";
require_once "../datos/usuario.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idSolicitud = $_POST['id_solicitud'];

    $solicitud = new Solicitud();
    $estadoActualizado = $solicitud->actualizarSolicitud($idSolicitud, 'Rechazada');

    if ($estadoActualizado) {
        // Obtener el ID del usuario relacionado con la solicitud
        $idUsuario = $solicitud->obtenerIdUsuarioPorSolicitud($idSolicitud);

        // Obtener el correo electrónico del usuario
        $usuario = new Usuario();
        $correoUsuario = $usuario->obtenerCorreoPorId($idUsuario);

        if ($correoUsuario !== null) {
            $command = escapeshellcmd("python3 ../utils/adopcionRechazada.py $correoUsuario");
            shell_exec($command);
        } else {
            echo "ERROR: No se pudo obtener el correo del usuario.";
        }

        header("Location: /lostpaws/presentacion/gestionarSolicitudUsuario.php");
        exit;
    } else {
        echo "Hubo un problema al rechazar la solicitud. Por favor, intenta nuevamente.";
    }

} else {
    header("Location: dashAdmin.php");
    exit();
}
?>