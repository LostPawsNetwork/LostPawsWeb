<?php
require_once '../datos/adopcion.php';
require_once '../datos/control.php';
require_once '../datos/solicitud.php';
require_once '../datos/usuario.php'; // Asumiendo que tienes una clase Usuario para obtener información del usuario

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

            // Obtener el correo electrónico del usuario
            $usuario = new Usuario();
            $correoUsuario = $usuario->obtenerCorreoPorId($idUsuario);

            if ($correoUsuario !== null) {
                // Llamar al script de Python para enviar el correo
                $command = escapeshellcmd("python3 ../utils/adopcionAceptada.py $correoUsuario");
                $output = shell_exec($command);
                echo $output;
            } else {
                echo "ERROR: No se pudo obtener el correo del usuario.";
            }
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
