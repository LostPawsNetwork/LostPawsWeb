<?php
require_once '../datos/adopcion.php';
require_once '../datos/control.php';
require_once '../datos/solicitud.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idUsuario = $_POST['id_usuario'];
    $idCan = $_POST['id_can'];
    $idSolicitud = $_POST['id_solicitud'];

    $solicitud = new Solicitud();
    $estadoActualizado = $solicitud->actualizarSolicitud($idSolicitud, 'Aceptada');

    if ($estadoActualizado) {

        $adopcion = new Adopcion();
        $idAdopcion = $adopcion->registrarAdopcion($idUsuario, $idCan);

        if ($idAdopcion !== null) {
            $control = new Control();
            $control->habilitarControles($idAdopcion);
        } else {
            echo "ERROR: Adopción NULL.";
        }
    } else {
        echo "ERROR: No se pudo actualizar el estado de la solicitud.";
    }
} else {
    header("Location: dashAdmin.php");
    exit();
}
?>
