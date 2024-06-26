<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_SESSION["idUsuario"])) {
        $estado = "Pendiente";
        $idUsuario = $_SESSION["idUsuario"];
        require_once "../datos/examenAptitud.php";
        require_once "../datos/usuario.php";

        $examenAptitud = new ExamenAptitud();
        $result = $examenAptitud->registrarExamenAptitud($estado, $idUsuario);

        if ($result) 
        {
            $usuario = new Usuario();
            $correoUsuario = $usuario->obtenerCorreoPorId($idUsuario);

            if ($correoUsuario !== null) 
            {
                $command = escapeshellcmd("python3 ../utils/examenRevision.py $correoUsuario");
                $output = shell_exec($command);
            } else {
                echo "ERROR: No se pudo obtener el correo del usuario.";
            }

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
