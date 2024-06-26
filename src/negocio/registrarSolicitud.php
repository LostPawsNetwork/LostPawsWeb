<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true || $_SESSION['tipoUsuario'] !== 'user') {
    header("Location: /lostpaws/presentacion/login.php");
    exit;
}

// Verificar si los parámetros idUsuario y idCan están presentes en la URL
if (!isset($_GET['idUsuario']) || !isset($_GET['idCan'])) {
    echo "Parámetros inválidos.";
    exit;
}

$idUsuario = $_GET['idUsuario'];
$idCan = $_GET['idCan'];

require_once '../datos/solicitud.php';

$solicitud = new Solicitud();

$resultado = $solicitud->registrarSolicitud($idUsuario, $idCan);

if ($resultado) {
    // Obtener el correo electrónico del usuario
    require_once '../datos/usuario.php';
    $usuario = new Usuario();
    $correoUsuario = $usuario->obtenerCorreoPorId($idUsuario);

    if ($correoUsuario !== null) {
        // Llamar al script de Python para enviar el correo
        $command = escapeshellcmd("python3 ../utils/adopcionRevision.py $correoUsuario");
        shell_exec($command);
    } else {
        echo "ERROR: No se pudo obtener el correo del usuario.";
    }

    // Redirigir a landingPage.php si la solicitud se registra correctamente
    header("Location: /lostpaws/presentacion/landingPage.php");
    exit;
} else {
    // Mostrar un mensaje de error si no se puede registrar la solicitud
    echo "Hubo un problema al registrar tu solicitud. Por favor, intenta nuevamente.";
}
?>