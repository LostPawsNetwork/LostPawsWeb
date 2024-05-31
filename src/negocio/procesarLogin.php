<?php
session_start();

require_once 'loginManager.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $correo = $_POST["correo"];
    $passwd = $_POST["passwd"];

    $loginManager = new LoginManager();
    $loginExitoso = $loginManager->iniciarSesion($correo, $passwd);

    if ($loginExitoso) {
        if ($_SESSION['tipoUsuario'] == 'admin') {
            // Usar 'python3' si estás en un entorno donde 'python' puede referirse a Python 2
            $command = escapeshellcmd("python3 ../utils/enviarToken.py $correo");
            $output = shell_exec($command . " 2>&1");

            if ($output !== null) {
                $correoEnviado = strpos($output, "Correo enviado exitosamente") !== false;
                if ($correoEnviado) {
                    header("Location: ../presentacion/ingresarToken.php");
                } else {
                    echo "Error al enviar el correo.";
                }
            } else {
                echo "Error al ejecutar el script.";
            }
        } else {
            echo "Error: Token incorrecto.";
        }
    } else {
        echo "Email y/o contraseña incorrectos.";
    }
}
?>
