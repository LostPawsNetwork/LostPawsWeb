<?php
session_start();
require_once '../datos/adopcion.php';
require_once '../datos/control.php';
require_once '../datos/solicitud.php';
require_once '../datos/usuario.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idUsuario = $_POST['id_usuario'];
    $idCan = $_POST['id_can'];
    $idSolicitud = $_POST['id_solicitud'];

    // Paso 1: Actualizar el estado de la solicitud a 'Aceptada'
    $solicitud = new Solicitud();
    $estadoActualizado = $solicitud->actualizarSolicitud($idSolicitud, 'Aceptada');

    if ($estadoActualizado) {
        // Paso 2: Obtener el correo electrónico del usuario por idUsuario
        $usuario = new Usuario();
        $correoUsuario = $usuario->obtenerCorreoPorId($idUsuario);

        if ($correoUsuario !== null) {
            // Paso 3: Ejecutar el script Python para enviar el correo de adopción aceptada
            $command = escapeshellcmd("python3 ../utils/adopcionAceptada.py $correoUsuario");
            $output = shell_exec($command);

            // Verificar si el correo se envió correctamente desde el script Python
            if ($output === false) {
                echo "Error al ejecutar el script de Python.";
            } else {
                // Si el correo se envió correctamente, proceder con el registro de adopción y habilitación de controles
                $adopcion = new Adopcion();
                $idAdopcion = $adopcion->registrarAdopcion($idUsuario, $idCan);

                if ($idAdopcion !== null) {
                    $control = new Control();
                    $control->habilitarControles($idAdopcion);
                } else {
                    echo "ERROR: Adopción NULL.";
                }
            }
        } else {
            echo "ERROR: No se pudo obtener el correo del usuario.";
        }
    } else {
        echo "ERROR: No se pudo actualizar el estado de la solicitud.";
    }
} else {
    header("Location: dashAdmin.php");
    exit();
}
?>
