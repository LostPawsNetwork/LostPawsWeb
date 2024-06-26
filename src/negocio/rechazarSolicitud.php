<?php
session_start();
require_once "../config/neon.php";
require_once "../datos/solicitud.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
    $idSolicitud = $_POST['id_solicitud'];

    $solicitud = new Solicitud();
    $estadoActualizado = $solicitud->actualizarSolicitud($idSolicitud, 'Rechazada');

    if ($estadoActualizado) {
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
